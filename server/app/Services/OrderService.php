<?php

namespace App\Services;

use App\Acl\Acl;
use App\Jobs\AddOrder;
use App\Jobs\AutoAllocateItemStock;
use App\Jobs\SendOrderEmail;
use App\Models\ItemBidConfirmation;
use App\Models\ItemStock;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Repositories\Item\ItemRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\OrderStatus\OrderStatusRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Quote\QuoteRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use App\Repositories\ShippingFee\ShippingFeeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{
    private $orderRepository,
        $orderDetailRepository,
        $orderItemRepository,
        $orderStatusRepository,
        $userRepository,
        $itemRepository,
        $itemVariantRepository,
        $shippingFeeRepository,
        $couponCodeService,
        $itemService,
        $paymentMethodRepository,
        $itemStockService,
        $itemStockRepository,
        $quoteRepository,
        $quoteDetailRepository;

    private const COMISSION_DEFAULT_VALUE = 0;

    /**
     * @param $orderRepository
     */
    public function __construct(
        OrderRepositoryInterface         $orderRepository,
        OrderDetailRepositoryInterface   $orderDetailRepository,
        OrderItemRepositoryInterface     $orderItemRepository,
        OrderStatusRepositoryInterface   $orderStatusRepository,
        UserRepositoryInterface          $userRepository,
        ItemRepositoryInterface          $itemRepository,
        ItemVariantRepositoryInterface   $itemVariantRepository,
        // ShippingFeeRepositoryInterface $shippingFeeRepository,
        CouponCodeService                $couponCodeService,
        ItemService                      $itemService,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        ItemStockService                 $itemStockService,
        ItemStockRepositoryInterface     $itemStockRepository,
        QuoteRepositoryInterface         $quoteRepository,
        QuoteDetailRepositoryInterface   $quoteDetailRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderStatusRepository = $orderStatusRepository;
        $this->userRepository = $userRepository;
        $this->itemRepository = $itemRepository;
        $this->itemVariantRepository = $itemVariantRepository;
        // $this->shippingFeeRepository = $shippingFeeRepository;
        $this->couponCodeService = $couponCodeService;
        $this->itemService = $itemService;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->itemStockService = $itemStockService;
        $this->itemStockRepository = $itemStockRepository;
        $this->quoteRepository = $quoteRepository;
        $this->quoteDetailRepository = $quoteDetailRepository;
    }


    /**
     * @param $request
     */
    public function create($validatedData = [], $validatedDataDetail = [], $couponCheck = false)
    {
        $customer = $this->userRepository->checkExistUserByEmail(auth()->user()->email);

        // try {
        //     DB::beginTransaction();
        $quote = $this->quoteRepository->find($validatedData['id']);
        foreach ($validatedDataDetail as $quoteDetail) {
            if (!empty($quoteDetail['coupon_code']) && $couponCheck == false) {
                $coupon = $this->couponCodeService->getAndValidateCode(['code' => $quoteDetail['coupon_code'], 'user_id' => $customer->id]);

                if (isset($coupon['error_message'])) {
                    //Update quote status to draft
                    $this->quoteRepository->update($quote, ['status' => Quote::STT_DRAFT]);
                    return $coupon;
                }
                $countCoupon = $this->quoteDetailRepository->countCouponInQuote($quoteDetail['quote_id'], $coupon->code);

                //If coupon appear two times or more => exist;
                if ($countCoupon >= 2) {
                    $this->quoteRepository->update($quote, ['status' => Quote::STT_DRAFT]);
                    throw new \Exception(__('error.coupon.is_exist_in_cart', ['coupon' => $quoteDetail['coupon_code']]));
                }
                $this->couponCodeService->createCouponHistory(['code' => $quoteDetail['coupon_code']], $customer->id);
            }
        }
        // DB::commit();

        $this->quoteRepository->update($quote, ['status' => Quote::STT_ORDER]);

        $this->handleAddOrder($validatedData, $validatedDataDetail);
        // return true;
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return ['error_message' => $e->getMessage()];
        // }
    }

    /**
     * Add order
     *
     * @param $quote
     * @param $quoteDetails
     * @return void
     */
    function handleAddOrder($quote, $quoteDetails)
    {
        // try {
        //     DB::beginTransaction();

        $order = $this->createOrder(['quote' => $quote], ['quote_details' => $quoteDetails]);

        if (empty($order)) {
            return false;
        }

        $orderDetail = $this->createOrderDetail($order, ['quote_details' => $quoteDetails]);

        if (empty($orderDetail)) {
            return false;
        }

        $order = $this->updateOrderStatus($order, $order->order_status_id, ORDER_STT_PENDING);

        if ($order) {
            $result = $this->createOrderItems($order, $quoteDetails, $order->order_status_id);
        }

        //     DB::commit();
        //     return true;
        // } catch (Throwable $e) {
        //     return false;
        // }
    }

    /**
     * Create order
     * @param array $inputQuote
     * @return mixed
     */
    public function createOrder($inputQuote = [], $inputQuoteDetails = [])
    {
        $order = new Order();
        $quote = $this->quoteRepository->find($inputQuote['quote']['id']);

        $order->fill($quote->toArray());
        $quoteDetails = $quote->quoteDetails->toArray();

//        $user = $this->userRepository->find($order['created_by']);

        $order->order_status_id = ORDER_STT_DRAFT;

        /**
         *Calculate price
         */

        $total_price = $total_payment_fee = $total_tax = $original_total = $total_discount = $total = 0;

        if (!empty($quoteDetails)) {
            $totalItem = 0;
            foreach ($quoteDetails as $quoteDetail) {
                $quantity = $quoteDetail['quantity'];
                $price = $quoteDetail['price'];
                $item = $this->itemRepository->find($quoteDetail['item_id']);
                $total_price += $price * $quantity;
                $total_tax += $this->taxWithPrice($price);
                $totalItem += $quantity;
            }
            // $total_shipping = $shippingPrice * $totalItem;
        }

        /**
         * Save order
         */
        // $this->fillAddressFromCustomer($order, $customer);
        $order->order_code = $this->generateInvoicePrefix();

        $paymentOption = $this->findByPaymentMethodKey($order['payment_method_id']);

        $order->payment_method_id = $paymentOption->id ?? 1;
        $order->payment_fee = $paymentOption->fee ?? 0;
        $order->payment_fee_type = $paymentOption->fee_type ?? 1;
        $order->payment_method = $paymentOption->key ?? null;

        //Total discount has been filled above.
        $total_discount = floatval($order->total_discount);
        $total_tax = floatval($total_tax);

        $total_payment_fee = $this->totalPaymentFee($order->payment_fee, $order->payment_fee_type);
        $total = $total_price + $total_tax + $total_payment_fee;
        $total = $this->couponCodeService->checkDiscountOverTotal($total, $total_discount);

        $order->total_price = $total_price;
        $order->total_discount = $total_discount;
        $order->total_tax = $total_tax;
        // $order->original_total = $total_price;
        $order->total = $total;
        // $order->grand_total = $total;
        $order->staff_id = $inputQuote['quote']['staff_id'];
        $order->customer_id = $inputQuote['quote']['customer_id'];
        $order->created_by = $inputQuote['quote']['created_by'];
        $order->updated_by = $inputQuote['quote']['updated_by'];
        $order->tracking = uniqid();
        $order->uuid = (string)Str::uuid();
        $order->ip = request()->ip();
        $order->forwarded_ip = request()->getClientIp();
        $order->user_agent = request()->header('User-Agent');
        $order->accept_language = app()->getLocale();
        // dd($order);

        return tap($order)->save();
    }

    /**
     * Create order detail
     * @param $order
     * @param array $input
     */
    function createOrderDetail($order, $input = [])
    {
        $quoteDetails = $input['quote_details'];
        $result = [];
        if (empty($quoteDetails)) {
            return false;
        }
        if (!empty($order->id) && !empty($order->order_code)) {
            // dd(456);

            foreach ($quoteDetails as $quoteDetail) {
                $sizeID = $quoteDetail['size_id'];
                $sizeValue = $quoteDetail['size_value'];
                $colorID = $quoteDetail['color_id'];
                $colorValue = $quoteDetail['color_value'];
                $colorName = $quoteDetail['color_name'];
                $quantity = $quoteDetail['quantity'];
                $itemID = $quoteDetail['item_id'];
                $price = $quoteDetail['price'];
                $item_variant_id = $quoteDetail['item_variant_id'];
                $orderDetail = $this->getOrderDetail(
                    [
                        'order_id' => $order->id,
                        'item_id' => $itemID,
                        'size_id' => $sizeID,
                        'color_id' => $colorID,
                        'price' => $price,
                        'item_variant_id' => $item_variant_id
                    ]
                );

                if (empty($orderDetail->id)) {
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $order['id'];
                    $orderDetail->item_id = $itemID;
                    $orderDetail->size_id = $sizeID;
                    $orderDetail->size_value = $sizeValue;
                    $orderDetail->color_id = $colorID;
                    $orderDetail->color_name = $colorName;
                    $orderDetail->color_value = $colorValue;
                    $orderDetail->price = $price;
                    $orderDetail->item_variant_id = $quoteDetail['item_variant_id'];
                }
                $orderDetail->coupon_code = $quoteDetail['coupon_id'] ?? null;
                $orderDetail->quantity = $quantity;
                $orderDetail->items = !empty($quoteDetail['items']) ? $quoteDetail['items'] : null;

                $result[] = tap($orderDetail)->save();
            }
        }

        return $result;
    }

    /**
     * Create order item
     * @param $order
     * @param array $input
     */
    function createOrderItems($order, $input = [], $orderStatusId)
    {
        $totalItemsCount = $this->orderItemRepository->countItemInOrder($order->id);
        if (!empty($totalItemsCount)) {
            return false;
        }
        $orderStatusId = $orderStatusId ?? ORDER_STT_COMPLETED;

        $pids = null;

        $orderDetails = $this->getOrderDetail(['order_id' => $order->id]);
        // dd($orderDetails);

        $total_discount = 0;
        $totalPaymentFee = 0;
        if (!empty($orderDetails)) {
            foreach ($orderDetails as $orderDetail) {
                $item = $this->itemRepository->find($orderDetail->item_id);

                //Check item stock.
                $itemsCollection = $this->checkExistItemStocks($orderDetail);

                if (isset($itemsCollection['error'])) {
                    return false;
                }

                $totalQuantity = $this->getSumQuantityOrderDetail($order->id);
                $payment_fee = $shipping = $discount = 0;
                if (!empty($totalQuantity->total)) {
                    $payment_fee = $order->total_payment_fee / $totalQuantity->total;
                    $shipping = $order->total_shipping / $totalQuantity->total;
                }

                //Get price per item after apply coupon
                $coupon_id = null;
                if (!empty($orderDetail->coupon_code)) {

                    $user_id = $order->created_by ?? auth()->user()->id;
                    $couponCode = $this->getCouponCode(['code' => $orderDetail->coupon_code]);
                    $discount = $this->getTotalDiscount(['coupon_codes' => [$orderDetail->couponCode], 'price' => $orderDetail->price, 'ship_amount' => $shipping]);

                    $coupon_id = $couponCode->id;
                    $total_discount += $discount;
                }


                //Create order item
                if (!empty($itemsCollection) && $itemsCollection->count() > 0) {
                    foreach ($itemsCollection as $itemCollection) {
                        $quantity = 1;
                        $itemPrice = $itemCollection['price'];
                        $totalPriceItem = ($itemPrice * $quantity) - $discount;
                        $tax = $this->taxWithPrice($itemPrice);
                        $orderItem = $this->getOrderItem(['order_id' => $order->id, 'item_stock_id' => $itemCollection->id]);

                        if (empty($orderItem->id)) {
                            $orderItem = new OrderItem();
                            $orderItem->order_id = $order->id;
                            $orderItem->order_detail_id = $orderDetail->id;
                            $orderItem->item_stock_id = $itemCollection->id;
                            $orderItem->item_variant_id = $itemCollection->item_variant_id;
                        }

                        $orderItem->item_variant_id = $itemCollection->item_variant_id;
                        $orderItem->item_id = $itemCollection->item_id;
                        $orderItem->order_status_id = $orderStatusId;
                        $orderItem->item_name = $item->name;
                        $orderItem->sku = $itemCollection->sku;
                        $orderItem->code = $itemCollection->code;
                        $orderItem->size_id = $itemCollection->itemVariant->size_id;
                        $orderItem->size_value = $itemCollection->size_value;
                        $orderItem->color_id = $itemCollection->itemVariant->color_id;
                        $orderItem->color_value = $itemCollection->color_value;
                        $orderItem->color_name = $itemCollection->color_name;
                        $orderItem->quantity = $quantity;
                        $orderItem->price_in = $itemCollection->price_in;
                        $orderItem->price = $itemPrice;
                        $orderItem->discount = $discount;
                        $orderItem->tax = $tax;
                        $orderItem->shipping = $shipping;

                        $orderItem->coupon_code_id = $coupon_id;
                        $orderItem->total = $totalPriceItem;
                        $orderItem->reward = 0;
                        $orderItem->save();

                        $this->updateItemStockOut(
                            ['item_stock_id' => $orderItem->item_stock_id],
                            [
                                'stock_out_type' => ItemStock::STOCK_OUT_TYPE_SOLD
                            ]
                        );
                        $pids[] = $item->id;
                        // $totalPaymentFee = $totalPaymentFee + $orderItem->payment_fee;
                    }
                } else {
                    abort(400, 'Not enough product !');
                }
            }
        }

        //If coupon ( discount by amount) larger than item price => total order = 0
        if ($order->total_price - $total_discount < 0) {
            $totalPrice = 0;
        } else {
            $totalPrice = $order->original_total - $total_discount;
        }

        // $dataNeedUpdated = [
        //     'total' => $totalPrice,
        //     'total_discount' => $total_discount,
        //     'total_payment_fee' => $totalPaymentFee,
        //     'order_status_id' => $orderStatusId,
        // ];
        // $this->orderRepository->update($order, $dataNeedUpdated);

        $this->updateStockByIds($pids);

        return true;
    }

    /**
     * [Order] Get all orders.
     * Get all orders
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllOrders()
    {
        return $this->orderRepository->all();
    }

    /**
     * [OrderItem] Get order items.
     * @param $id
     * @return mixed
     */
    public function getOrderItemsById($id)
    {
        $result = $this->orderItemRepository->find($id);
        return $result;
    }

    /**
     *[User] Get customer by email and phone.
     * @return UserRepositoryInterface
     */
    public function getUserByEmailAndPhone($email, $phone)
    {
        return $this->userRepository->getUserByEmailAndPhone($email, $phone);
    }

    /**
     * [Shipping]Get shipping price
     * @param $countryId
     * @param $cityId
     * @return int
     */
    public function getShippingPrice($countryId, $cityId)
    {
        $shipFeePrice = 0;
        if (!empty($cityId)) {
            $shipFee = $this->shippingFeeRepository->getShippingPrice($countryId, $cityId);
            if (empty($shipFee)) {
                $shipFee = $this->shippingFeeRepository->getShippingPrice(COUNTRY_VN, null);
            }
            $shipFeePrice = !empty($shipFee) ? $shipFee->value : 0;
        }
        return $shipFeePrice;
    }

    /**
     * [OrderStatus] Check current status match.
     * @param $order
     * @param $orderStatusBefore
     * @param $orderStatusAfter
     * @return false
     */
    public function updateOrderStatus($order, $orderStatusBefore, $orderStatusAfter)
    {
        $result = $this->orderStatusRepository->checkOrderStatusByOrderFlow($orderStatusBefore, $orderStatusAfter);
        if ($result)
            $order->order_status_id = $orderStatusAfter;
        return tap($order)->save();
        return false;
    }

    /**
     * [OrderDetail] get order detail
     * @param array $conditions
     * @return mixed
     */
    public function getOrderDetail(array $conditions = [])
    {
        return $this->orderDetailRepository->getOrderDetail($conditions);
    }

    /**
     * [OrderItem]
     * @param array $conditions
     * @return mixed
     */
    public function getOrderItem(array $conditions = [])
    {
        return $this->orderItemRepository->getOrderItem($conditions);
    }

    /**
     * [OrderItem]
     * Count item in order
     * @param $orderId
     * @return mixed
     */
    public function countItemInOrder($orderId)
    {
        return $this->orderItemRepository->countItemInOrder($orderId);
    }

    /**
     * [ItemStocks] Get item stocks by itemId in order detail
     * @param $itemIds
     * @return mixed
     */
    public function getItemStocks($itemIds)
    {
        return $this->itemStockRepository->getItemStocks($itemIds);
    }

    /**
     * [ItemStocks] Get item in item stock.
     * @param $size
     * @param $price
     * @param $quantity
     * @param string $direction
     * @param array $itemsIDExclude
     * @return mixed
     */
    public function getItemsBySize($item_id, $size_id, $color_id, $price, $quantity, $direction, array $itemsIDExclude = [], $itemVariantIdd)
    {
        return $this->itemStockRepository->getItemsBySize($item_id, $size_id, $color_id, $price, $quantity, $direction, $itemsIDExclude, $itemVariantIdd);
    }

    /**
     * [ItemStock] Update item stock status.
     * @param array $attributes
     * @return mixed
     */
    public function updateItemStockOut($attributes = [], array $options = [])
    {
        return $this->itemStockService->updateItemStockOut($attributes, $options);
    }

    /**
     * [OrderDetail]Get total item quantity in order detail
     * @param $orderId
     * @return mixed
     */
    public function getSumQuantityOrderDetail($orderId)
    {
        return $this->orderDetailRepository->getSumQuantityOrderDetail($orderId);
    }

    /**
     * [CouponCodeService] Get coupon code.
     * @param array $param
     * @return mixed
     */
    public function getCouponCode(array $param = [])
    {
        return $this->couponCodeService->getCouponCode($param)->first();
    }

    /**
     * [CouponCodeService] Get total discount per item.
     * @param $coupon_code
     * @param $total_amount
     * @param $ship_amount
     * @param $user_id
     * @return float|int
     */
    public function getTotalDiscount(array $params = [])
    {
        return $this->couponCodeService->getTotalDiscount($params);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function findByPaymentMethodKey($id)
    {
        return $this->paymentMethodRepository->find($id);
    }
    /* Utils */
    /**
     * [OrderService]Create Invoice prefix
     * @return string
     */
    public function generateInvoicePrefix()
    {
        $suffix = $this->orderRepository->getLatest();
        //If doesnt have id, assign 0
        if (empty($suffix->id)) {
            $suffix = new Order();
            $suffix->id = 0;
        }
        $invID = Order::ORDER_INVOICE_CODE_PREFIX . date('Ymd') . '-' . str_pad($suffix->id + 1, 4, '0', STR_PAD_LEFT);
        return $invID;
    }


    /**
     *[OrderService] Mapping address from customer to order
     * @param $order
     * @param $customer
     */
    public function fillAddressFromCustomer($order)
    {
        if (empty($order->shipping_address)) {
            $order->shipping_address = $order->billing_address;
            $order->shipping_country_id = $order->billing_country_id;
            $order->shipping_city_id = $order->billing_city_id;
            $order->shipping_district_id = $order->billing_district_id;
            $order->shipping_ward_id = $order->billing_ward_id;
        }

        $order->billing_country_id = COUNTRY_VN;
        $order->shipping_country_id = COUNTRY_VN;
    }

    /**
     * @param int $totalPrice
     * @return float|int|mixed
     */
    public function totalPaymentFee($payment_fee, $payment_fee_type, $totalPrice = 0)
    {
        $total = 0;
        if (!empty($payment_fee) && $payment_fee > 0) {
            if ($payment_fee_type == PaymentMethod::FEE_TYPE_PERCENT) {
                $total = ($totalPrice * $payment_fee / 100);
            } elseif ($payment_fee_type == PaymentMethod::FEE_TYPE_PRICE) {
                $total = $payment_fee;
            }
        }
        return $total;
    }

    /**
     * [Tax] Calculate tax
     * @param $price
     * @return float|int
     */
    public function taxWithPrice($price)
    {
        if (!empty($this->tax)) {
            if ($this->tax->type == ShopTaxClass::TYPE_FLAT) {
                return $this->tax->rate;
            } elseif ($this->tax->type == ShopTaxClass::TYPE_PERCENT) {
                return ($this->tax->rate / 100) * $price;
            }
        }
        return 0;
    }

    /**
     * [ItemStock] Update item stock count
     * @param array $arrId
     * @return mixed
     */
    public function updateStockByIds($arrId = [])
    {
        return $this->itemService->updateStockByIds($arrId);
    }

    /**
     * [Order] Check order status and update status.
     * @param array $arrId
     * @return mixed
     */
    public function updateStatus(array $param = [])
    {
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->find($param['order_id']);
            $order->updated_by = $param['user_id'];
            $order->updated_at = Carbon::now();
            $itemCancelIDs = !empty($param['productCancelIDs']) ? explode(',', $param['productCancelIDs']) : null;

            if (in_array($param['order_status_id'], [OrderStatus::STT_COMPLETED, OrderStatus::STT_SHIPPED])) {
                $totalOrderProduct = $this->orderItemRepository->getOrderItem(['order_id' => $order->id])->count();
                $flag = true;

                if ($param['order_status_id'] == OrderStatus::STT_SHIPPED) {
                    $order->shipper_id = $param['shipper_id'];
                    $order->save();
                }

                //Check if orderItem has been created yet, if not create one (this mean order status either draft or pending)
                if (empty($totalOrderProduct)) {

                    $orderDetails = $this->getOrderDetail(['order_id' => $order->id]);
                    foreach ($orderDetails as $orderDetail) {
                        $itemsStock = $this->checkExistItemStocks($orderDetail);
                        if (isset($itemsStock['error'])) {
                            return $itemsStock;
                        }
                    }

                    $order->order_status_id = OrderStatus::STT_ALLOCATED;
                    $order->save();
                } else {
                    $order->order_status_id = $param['order_status_id'];
                    $order->save();
                    $result = $this->orderItemRepository->getOrderItem(['order_id' => $order->id])->first();

                    $this->orderItemRepository->update($result, [
                        'order_status_id' => $param['order_status_id'],
                    ]);
                }
            } else {
                $order->order_status_id = $param['order_status_id'];
                $order->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get shipping fee by city, current default country is VN
     * @param $cityID
     * @return int
     */
    public function getShipFeeWithCity($cityID)
    {
        $shipFeePrice = 0;
        if (!empty($cityID)) {
            $shipFee = $this->shippingFeeRepository->getShippingPrice(COUNTRY_VN, $cityID);

            if (empty($shipFee)) {
                $shipFee = $this->shippingFeeRepository->getDefaultShippingPrice(COUNTRY_VN);
            }
            $shipFeePrice = !empty($shipFee) ? $shipFee->value : 0;
        }
        return $shipFeePrice;
    }

    /**
     * check chosen items have any stock.
     * @param $params
     * @return
     */
    public function checkExistItemStocks($params)
    {
        $itemsIDs = !empty($params->items) ? json_decode($params->items) : [];

        $quantity = $params->quantity - count($itemsIDs);
        $itemsCollection = new Collection();
        if (!empty($itemsIDs) && is_array($itemsIDs)) {
            $itemChosen = $this->getItemStocks($itemsIDs);
            $itemsCollection = $itemsCollection->merge($itemChosen);
        }

        if (!empty($quantity)) {
            $ItemsFifo = $this->getItemsBySize(
                $params->item_id,
                $params->size_id,
                $params->color_id,
                $params->price,
                $quantity,
                'asc',
                $itemsIDs,
                $params->item_variant_id
            );

            if (empty($ItemsFifo) || $ItemsFifo->isEmpty()) {
                return ['error' => __(
                    'error.order.out_of_stock',
                    ['item_name' => $params->item->name]
                )];
            }
            $itemsCollection = $itemsCollection->merge($ItemsFifo);
        }


        //All items in order dont have any stock.
        if (empty($itemsCollection)) {
            return ['error' => __('error.order.out_of_stock_all')];
        }

        return $itemsCollection;
    }
}
