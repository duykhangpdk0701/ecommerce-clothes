<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\SaveCartRequest;
use App\Http\Requests\Quote\ApiQuoteCustomerUpdateRequest;
use App\Http\Requests\Quote\PlusCartRequest;
use App\Http\Resources\api\PaymentMethodResource;
use App\Http\Resources\api\QuoteResource;
use App\Models\Quote;
use App\Repositories\ItemStock\ItemStockRepository;
use App\Repositories\ItemVariant\ItemVariantRepository;
use App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface;
use App\Repositories\Quote\QuoteRepositoryInterface;
use App\Repositories\QuoteDetail\QuoteDetailRepositoryInterface;
use App\Responses\JsonResponse;
use App\Services\CartService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Cart
 *
 * API for managing Cart
 */
class CartController extends Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;
    protected QuoteRepositoryInterface $quoteRepository;
    protected QuoteDetailRepositoryInterface $quoteDetailRepository;
    protected ItemStockRepository $itemStockRepository;
    protected ItemVariantRepository $itemVariantRepository;
    protected PaymentMethodRepositoryInterface $paymentMethodRepository;


    public function __construct(
        CartService                      $cartService,
        OrderService                     $orderService,
        QuoteRepositoryInterface         $quoteRepository,
        QuoteDetailRepositoryInterface   $quoteDetailRepository,
        ItemStockRepository              $itemStockRepository,
        ItemVariantRepository            $itemVariantRepository,
        PaymentMethodRepositoryInterface $paymentMethodRepository
    )
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->quoteRepository = $quoteRepository;
        $this->quoteDetailRepository = $quoteDetailRepository;
        $this->itemStockRepository = $itemStockRepository;
        $this->itemVariantRepository = $itemVariantRepository;
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    /**
     * Create cart session and add to quote.
     *
     * This endpoint lets you Add item to cart.
     * @authenticated
     *
     * @bodyParam  item_variant int required The id of the item stock. Example: 1
     * @bodyParam  quantity int The quantity of the item stock. Example: 1
     * @bodyParam  quote_id int The id of the quote is optional because if add the first item to quote, you don't need quote id. Example: 1
     *
     * <p>- Add stock with id = 1 (item_stock_id = 1)</p>
     * <p>- Add stock with quantity = 1 (quantity = 1)</p>
     * <p>- select quote with id = 1 (quote_id = 1)</p>
     *
     *
     * @param SaveCartRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart(SaveCartRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $quoteId = $data['quote_id'] ?? null;

        $quantity = $data['quantity'] ?? QUANTITY_ADD_CART_DEFAULT;

        $itemStock = $this->itemStockRepository->getAvailableStockWithVariant($data['item_variant']);

        if ($quote = $this->cartService->addToCartCustomer($itemStock, $quoteId, $quantity)) {

            $quote = $this->quoteRepository->getQuoteWithRelation($quote);

            return response()->json([
                'message' => __('success.quote.add_to_cart'),
                'data' => new QuoteResource($quote)
            ]);
        }

        return response()->json(new JsonResponse([], __('error.quote.quantity_item')));
    }

    /**
     * Plus item quantity.
     *
     * This endpoint lets you Plus item quantity if have item same variant and price.
     * @authenticated
     *
     * @bodyParam  quote_detail_id int required The id of the quote item. Example: 1
     * @bodyParam  quote_id int required The id of the quote Example: 1
     * <p>- Plus stock with id = 1 (item_stock_id = 1)</p>
     * <p>- Show quote with id = 1 (quote_id = 1)</p>
     *
     *
     * @param PlusCartRequest $request
     * @return QuoteResource|\Illuminate\Http\JsonResponse
     */
    public function plusCart(PlusCartRequest $request): \Illuminate\Http\JsonResponse|QuoteResource
    {
        $data = $request->validated();
        if ($this->cartService->plusCart($data['quote_detail_id'])) {
            $quote = $this->quoteRepository->getQuoteWithRelation($data['quote_id']);

            return new QuoteResource($quote);
        }

        return response()->json(new JsonResponse([], __('error.quote.plus_item')));
    }

    /**
     * Minus item quantity.
     *
     * This endpoint lets you Minus item quantity if have item same variant and price.
     * @authenticated
     *
     * @bodyParam  quote_detail_id int required The id of the quote item. Example: 1
     * @bodyParam  quote_id int required The id of the quote Example: 1
     * <p>- Plus stock with id = 1 (item_stock_id = 1)</p>
     * <p>- Show quote with id = 1 (quote_id = 1)</p>
     *
     *
     * @param PlusCartRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function minusCart(PlusCartRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        $quote = $this->quoteRepository->getQuoteWithRelation($data['quote_id']);

        if (empty($quote)) {
            return response()->json(new JsonResponse([], __('error.quote.minus_fail')));
        }

        if ($this->cartService->minusCart($data['quote_detail_id'], $data['quote_id'])) {
            $result = $this->quoteRepository->getQuoteWithRelation($data['quote_id']);
            return response()->json([
                'message' => __('success.quote.minus_item'),
                'data' => new QuoteResource($result)
            ]);
        }
        return response()->json(new JsonResponse([], __('error.quote.minus_fail')));
    }

    /**
     * Delete item quantity.
     *
     * This endpoint lets you Delete item if the item is final item the quote will delete .
     * @authenticated
     *
     * @bodyParam  quote_detail_id int required The id of the quote item. Example: 1
     * @bodyParam  quote_id int required The id of the quote Example: 1
     * <p>- Plus stock with id = 1 (item_stock_id = 1)</p>
     * <p>- Show quote with id = 1 (quote_id = 1)</p>
     *
     *
     * @param PlusCartRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteItem(PlusCartRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $this->cartService->destroyCart($data['quote_detail_id'], $data['quote_id']);

        $quote = $this->quoteRepository->getQuoteWithRelation($data['quote_id']);

        if (empty($quote)) {
            return response()->json([
                'message' => __('error.quote.delete_item'),
                'data' => []
            ]);
        }

        return response()->json([
            'message' => __('success.quote.delete_item'),
            'data' => new QuoteResource($quote)
        ]);
    }

    /**
     * Get quote by user
     *
     * This endpoint lets you Get data quote by user.
     * @authenticated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getQuoteId(): \Illuminate\Http\JsonResponse
    {
        if ($quote = $this->cartService->getQuoteByUSer(auth()->user()->id)) {
            return response()->json(new JsonResponse(new QuoteResource($quote)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.quote.user')));
    }

    /**
     * Get a list payment method
     *
     * This endpoint lets you Get a list payment method.
     * @authenticated
     *
     * @return AnonymousResourceCollection
     */
    public function getPaymentMethod(): AnonymousResourceCollection
    {
        $paymentMethods = $this->paymentMethodRepository->getPaymentMethodCustomer();
        return PaymentMethodResource::collection($paymentMethods);
    }

    /**
     * Confirm checkout.
     *
     * This endpoint lets you Confirm checkout your order.
     * @authenticated
     *
     * @bodyParam quote_id integer required The id of quote. Example: 10
     * @bodyParam shipping_name string required Receiver name. Example: Woo.
     * @bodyParam shipping_city_id integer required The id of receiver's city address. Example: 15
     * @bodyParam shipping_district_id integer required The id of receiver's district address. Example: 16
     * @bodyParam shipping_ward_id integer The id of receiver's ward address. Example: 17
     * @bodyParam shipping_address string required Receiver address. Example: 324 đường Hoà Hưng
     * @bodyParam shipping_phone numeric required Receiver phone. Example: 0987654321
     * @bodyParam comment string If buyer want to note something. Example: Oke oke
     * @bodyParam payment_method_id integer required The id of payment method. Example: 2
     *
     * @param ApiQuoteCustomerUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function confirmCheckout(ApiQuoteCustomerUpdateRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $quote = $this->quoteRepository->find($data['quote_id']);
        if (empty($quote)) {
            return response()->json((new JsonResponse([], __('error.quote.empty_item'))), ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($quote->quoteDetails->isEmpty()) {
            return response()->json((new JsonResponse([], __('error.quote.empty_item'))), ResponseAlias::HTTP_NOT_FOUND);
        }

        if (!in_array($quote->status, [Quote::STT_DRAFT, Quote::STT_PENDING])) {
            return response()->json(new JsonResponse([], __('error.quote.completed')), ResponseAlias::HTTP_BAD_REQUEST);
        }

        if ($this->quoteRepository->update($quote, $data)) {
            //Update coupon code, discount to each quoteDetail belong to quote
            foreach ($quote->quoteDetails as $singleQuoteDetail) {
                $this->quoteDetailRepository->update($singleQuoteDetail, $data);
            }
            $quoteDetailArray = $quote->quoteDetails->toArray();
            $result = $this->orderService->create($quote->toArray(), $quoteDetailArray);
            // dd(123);

            if (!empty($result['error_message'])) {
                return response()->json(new JsonResponse([], __($result['error_message'])), ResponseAlias::HTTP_BAD_REQUEST);
            }
        }
        return response()->json((new JsonResponse(["message" => __("success.quote.store")])), ResponseAlias::HTTP_OK);
    }
}
