<?php

namespace App\Services;

use App\Models\CouponCode;
use App\Models\ItemStock;
use App\Models\Quote;
use App\Models\QuoteDetail;
use App\Repositories\CouponCode\CouponCodeRepositoryInterface;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Quote\QuoteRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;

/**
 * Class CartService
 * @package App\Services
 */
class CartService
{
 /**
     * @var QuoteRepositoryInterface
     */
    protected QuoteRepositoryInterface $quoteRepository;

    /**
     * @var QuoteDetailRepositoryInterface
     */
    protected QuoteDetailRepositoryInterface $quoteDetailRepository;
    /**
     * @var ItemStockRepositoryInterface
     */
    protected ItemStockRepositoryInterface $itemStockRepository;
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;
    /**
     * @var PaymentMethodRepositoryInterface
     */
    protected PaymentMethodRepositoryInterface $paymentMethodRepository;
    /**
     * @var OrderService
     */
    protected OrderService $orderService;
    /**
     * @var CouponCodeService
     */
    protected CouponCodeService $couponCodeService;
    /**
     * @var ItemVariantRepositoryInterface
     */
    private $itemVariantRepository;

    /**
     * @var CouponCodeRepositoryInterface
     */
    protected CouponCodeRepositoryInterface $couponCodeRepository;

    /**
     * CartService constructor.
     * @param QuoteRepositoryInterface $quoteRepository
     * @param QuoteDetailRepositoryInterface $quoteDetailRepository
     * @param ItemVariantRepositoryInterface $itemVariantRepository
     * @param ItemStockRepositoryInterface $itemStockRepository
     * @param UserRepositoryInterface $userRepository
     * @param PaymentMethodRepositoryInterface $paymentMethodRepository
     * @param OrderService $orderService
     * @param CouponCodeService $couponCodeService
     * @param CouponCodeRepositoryInterface $couponCodeRepository
     */
    public function __construct(
        QuoteRepositoryInterface $quoteRepository,
        QuoteDetailRepositoryInterface $quoteDetailRepository,
        ItemVariantRepositoryInterface $itemVariantRepository,
        ItemStockRepositoryInterface $itemStockRepository,
        UserRepositoryInterface $userRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository,
        OrderService $orderService,
        CouponCodeService $couponCodeService,
        CouponCodeRepositoryInterface $couponCodeRepository
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->quoteDetailRepository = $quoteDetailRepository;
        $this->itemVariantRepository = $itemVariantRepository;
        $this->itemStockRepository = $itemStockRepository;
        $this->userRepository = $userRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
        $this->orderService = $orderService;
        $this->couponCodeService = $couponCodeService;
        $this->couponCodeRepository = $couponCodeRepository;
    }

    /**
     * @param $itemStock
     * @param null $quoteId
     * @param int $quantity
     * @return JsonResponse
     */
    public function addToCartCustomer($itemStock, $quoteId = null, $quantity = QUANTITY_ADD_CART_DEFAULT)
    {
        if (!empty($quoteId)) {
            if ($this->addToExistQuote($itemStock, $quoteId, $quantity)) {
                return $quoteId;
            }

            return false;
        } else if (Session::has('quote_id')) {
            return $this->addToExistQuote($itemStock, Session::get('quote_id'), $quantity);
        } else {
            if ($quote = $this->quoteRepository->create($itemStock)) {
                $this->quoteRepository->updateQuoteCode($quote->id);
                $this->quoteDetailRepository->createWithQuote($quote->id, $itemStock, $quantity);
                Session::put(['quote_id' => $quote->id]);

                return $quote->id;
            }
        }
    }

    /**
     * @param $itemStock
     * @param $quoteId
     * @param int $quantity
     * @return false
     */
    public function addToExistQuote($itemStock, $quoteId, $quantity = QUANTITY_ADD_CART_DEFAULT)
    {
        $quoteDetailCart = $this->quoteDetailRepository->updateWithQuote($quoteId, $itemStock, $quantity);
        if (!$quoteDetailCart) {
            return false;
        }
        $quote = $this->quoteRepository->updateWithStock($quoteId, $itemStock);

        $this->updateTotal($quoteId);
        $quote = $this->quoteRepository->find($quoteId);

        return $quote;
    }

    /**
     * @param $quoteId
     * @return array|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCustomerQuote($quoteId)
    {
        if ($quoteId) {
            return $this->quoteDetailRepository->getWithQuoteId($quoteId);
        }

        return [];
    }

    /**
     * @param $quoteDetailId
     * @return bool
     */
    public function plusCart($quoteDetailId)
    {
        $quoteDetail = $this->quoteDetailRepository->find($quoteDetailId);

        if (empty($quoteDetail->item_variant_id)) {
            return false;
        }
        $itemStockQuantity = ItemStock::where('item_variant_id', $quoteDetail->item_variant_id)
            ->where('price', $quoteDetail->price)
            ->where('stock_status_id', CONST_STOCK_IN_STOCK)
            ->count();

        $data = [
            'quantity' => $quoteDetail->quantity + 1
        ];

        if ($data['quantity'] > $itemStockQuantity) {
            return false;
        }


        $quoteDetail->update($data);

        $this->updateTotal($quoteDetail->quote_id);

        return true;
    }

    /**
     * @param $quoteId
     */
    public function updateTotal($quoteId)
    {
        $total = $totalDiscount  = $totalPrice = 0;
        $quote = $this->quoteRepository->find($quoteId);

        if (empty($quote->quoteDetails)) {
            return;
        }

        foreach ($quote->quoteDetails as $detail) {
            $totalPrice += $detail->quantity * $detail->price;
            $totalDiscount += $detail->discount;
        }

        $total = $totalPrice + $quote->total_shipping;
        $totalAmount  = CouponCodeService::checkDiscountOverTotal($total, $totalDiscount);

        $data = [
            'total_price' => $totalPrice,
            'total_discount' => $totalDiscount,
            'total' => $totalAmount
        ];

        $quote->update($data);
    }

    /**
     * @param $quoteDetailId
     */
    public function minusCart($quoteDetailId, $quoteId = null)
    {
        $quoteDetail = $this->quoteDetailRepository->find($quoteDetailId);

        if (empty($quoteDetail) || (Session::has('quote_id') && !$this->checkExistCart(Session::get('quote_id')))) {
            return false;
        }

        $data = [
            'quantity' => $quoteDetail->quantity - 1
        ];

        $quoteDetail->update($data);

        if ($quoteDetail->quantity < 1) {
            $this->updateTotal($quoteDetail->quote->id);
            $this->destroyCart($quoteDetailId, $quoteId);

            return true;
        }

        $this->updateTotal($quoteDetail->quote->id);

        return true;
    }

    /**
     * @param $id
     * @return bool|void
     */
    public function destroyCart($id, $quoteId = null)
    {
        if (empty($id)) {
            return;
        }

        $quoteId = !empty($quoteId) ? $quoteId : Session::get('quote_id');

        $quote = $this->quoteRepository->find($quoteId);

        if (empty($quote)) {
            return;
        }

        $quoteDetailCount = $quote->quoteDetails->count();
        $quoteDetail = $this->quoteDetailRepository->find($id);

        if (!in_array($quote->status, [Quote::STT_DRAFT, Quote::STT_PENDING])) {
            return;
        }

        if (empty($quoteDetail)) {
            return;
        }

        if ($quoteDetailCount <= 1) {
            $this->quoteDetailRepository->destroy($id);
            $this->quoteRepository->update(
                $quote,
                [
                    'total' => 0,
                    'total_price' => 0,
                    'total_discount' => 0,
                ]
            );
            $this->quoteRepository->destroy($quoteId);

            Session::remove('quote_id');

            return;
        }

        $result = $this->quoteDetailRepository->destroy($id);

        $this->updateTotal($quoteId);

        return $result;
    }

    /**
     * @param $quoteId
     * @return array
     */
    public function getQuote($quoteId)
    {
        return !empty($this->quoteRepository->find($quoteId)) ? $this->quoteRepository->find($quoteId)->toArray() : [];
    }

    /**
     * @param $quoteId
     * @return int
     */
    public function countQuoteDetail($quoteId)
    {
        return !empty($this->quoteRepository->find($quoteId)) ? $this->quoteRepository->find(
            $quoteId
        )->quoteDetails->count() : 0;
    }

    /***
     * @param $quote
     * @return bool
     */
    public function destroyQuote($quote)
    {
        if (Session::has('quote')) {
            $session = Session::get('quote');
            $key = array_search($quote->id, $session);

            unset($session[$key]);

            Session::put('quote', $session);

            if (count(Session::get('quote')) < 1) {
                Session::remove('quote');
            }

            $quote->delete();

            return true;
        }

        return false;
    }

    /**
     * @param $quote
     * @param $userId
     * @param $paymentMethodId
     * @param $note
     * @return bool
     */
    public function completeQuote($quote, $userId, $paymentMethodId, $note)
    {
        $user = $this->userRepository->find($userId);
        $paymentMethod = $this->paymentMethodRepository->find($paymentMethodId);

        if (
            !$user
            || !$user->email
            || !$paymentMethod
            || $quote->quoteDetails->count() < 1
        ) {
            return false;
        }

        $data = [
            'shipping_name' => $user->name ?: '',
            'shipping_phone' => $user->userProfile->phone ?? '',
            'email' => $user->email ?: '',
            'comment' => $note,
            'payment_method_id' => $paymentMethod->id,
            'payment_method' => $paymentMethod->key,
            'status' => Quote::STT_ORDER
        ];

        if ($paymentMethod->fee_type === FEE_TYPE_PERCENT) {
            $data['total'] = $quote->total + ($quote->total * $paymentMethod->fee / 100);
        } else {
            $data['total'] = $quote->total + $paymentMethod->fee;
        }

        if (
            !empty($user->userProfile->address)
            && !empty($user->userProfile->city_id)
            && !empty($user->userProfile->district_id)
            && !empty($user->userProfile->ward_id)
        ) {
            $data['shipping_address'] = $user->userProfile->address ?? '';
            $data['shipping_city_id'] = $user->userProfile->city_id ?? '';
            $data['shipping_district_id'] = $user->userProfile->district_id ?? '';
            $data['shipping_ward_id'] = $user->userProfile->ward_id ?? '';
        }

        if (!empty($this->itemStockRepository->checkItemOutOfStock($quote))) {
            return ['items' => implode(', ', $this->itemStockRepository->checkItemOutOfStock($quote))];
        }

        if ($this->quoteRepository->update($quote, $data)) {
            $quoteDetailArray = $quote->quoteDetails->toArray();
            $result = $this->orderService->create($quote->toArray(), $quoteDetailArray);
            if ($result == true) {
                $this->itemStockRepository->updateStatusStock($quote);
            }

            $this->destroyQuote($quote);

            return $result;
        }

        return false;
    }

    /**
     * @param $quoteDetail
     * @param $userId
     * @param $couponCode
     * @return array|false|float|int|mixed
     */
    public function updateQuoteDetail($quoteDetail, $userId, $couponCode)
    {
        $user = $this->userRepository->find($userId);

        if (
            !$user
            || !$couponCode
            || !$quoteDetail
        ) {
            $discount = $this->couponCodeService->getTotalDiscount(
                ['coupon_codes' => [], 'price' => $quoteDetail->price]
            );

            return $discount;
        }

        $coupon = $this->couponCodeService->getAndValidateCode(
            ['code' => $couponCode, 'user_id' => $user->id ?? '']
        );
        $arrCoupon = [$coupon];
        if (!empty($coupon['error_message'])) {
            return $coupon;
        }

        foreach ($arrCoupon as $cpCode) {
            //Check if first time apply
            if (empty($quoteDetail->coupon_code)) {
                $result = $this->quoteDetailRepository->update($quoteDetail, ['coupon_code' => $cpCode->code]);
            }
            //Check if applied code exist in quote
            if ($cpCode->code != $quoteDetail->coupon_code && !empty($quoteDetail->coupon_code)) {
                $result = $this->quoteDetailRepository->update($quoteDetail, ['coupon_code' => $cpCode->code]);
            }
        }

        $discount = $this->couponCodeService->getTotalDiscount(
            ['coupon_codes' => $arrCoupon, 'price' => $quoteDetail->price]
        );
        return $discount;
    }

    /**
     * Clear the applied coupon to the quote detail
     *
     * @param QuoteDetail $quoteDetail
     * @return void
     */
    public function clearCouponFromQuoteDetail($quoteDetail)
    {
        return $quoteDetail->update([
            'coupon_code' => '',
            'discount' => 0,
        ]);
    }

    /**
     * @param $quoteId
     * @return float|int
     */
    public function getDiscountOfQuote($quoteId)
    {
        $totalDiscount = 0;
        $total = 0;

        $quote = $this->quoteRepository->find($quoteId);

        if (!isset($quote->quoteDetails)) {
            return false;
        }

        foreach ($quote->quoteDetails as $detail) {
            $total += $detail->price * $detail->quantity;

            if (empty($detail->coupon_code)) {
                continue;
            }

            $coupon = $this->couponCodeRepository->findCouponByCode($detail->coupon_code);

            switch ($coupon->amount_type) {
                case CouponCode::AMOUNT_TYPE_PERCENT:
                    $totalDiscount += $detail->price * $coupon->amount / 100;
                    break;
                case CouponCode::AMOUNT_TYPE_PRICE:
                    $totalDiscount += $coupon->amount;
                    break;
            }
        }

        $this->quoteRepository->update($quote, [
            'total_discount' => $totalDiscount,
            'total' => $total
        ]);

        return $totalDiscount;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getQuoteByUSer($userId)
    {
        $quote = $this->quoteRepository->getQuoteByUser($userId);

        //If quote empty -> new
        if (empty($quote)) {
            return $this->createUserQuoteIfNotExist($userId);
        }
        //If quote not status draft or pending -> new
        if (
            (!in_array($quote->status, [Quote::STT_DRAFT, Quote::STT_PENDING])
                || $quote->deleted_at !== null
            )
            && $quote->customer_id === $quote->created_by

        ) {

            return $this->createUserQuoteIfNotExist($userId);
        }

        return $quote;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findQuoteDetail($id)
    {
        return $this->quoteDetailRepository->find($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function checkExistCart($id)
    {
        $quote = $this->quoteRepository->find($id);

        if (!auth()->check()) {
            return true;
        }

        if (
            !empty($quote)
            && in_array($quote->status, [Quote::STT_DRAFT, Quote::STT_PENDING])
            && $quote->customer_id === $quote->created_by
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param $userId
     */
    public function getQuoteByUSerInCart($userId)
    {
        $quote = $this->quoteRepository->getQuoteByUser($userId);

        if (
            !empty($quote) &&
            in_array($quote->status, [Quote::STT_DRAFT, Quote::STT_PENDING])
            && $quote->deleted_at === null
            && $quote->customer_id === $quote->created_by
        ) {
            Session::put(['quote_id' => $quote->id]);
        }
    }

    public function createUserQuoteIfNotExist($userId)
    {
        $quote = $this->quoteRepository->create(['customer_id' => $userId]);
        $this->quoteRepository->updateQuoteCode($quote->id);
        return $quote;
    }
}
