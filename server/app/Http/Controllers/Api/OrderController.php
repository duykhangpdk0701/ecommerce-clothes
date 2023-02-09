<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\OrderResource;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Order Endpoints
 *
 * APIs for managing orders
 */
class OrderController extends Controller
{
    protected OrderRepositoryInterface $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get a list of orders.
     *
     * This endpoint lets you get a list of orders
     * @authenticated
     *
     * @queryParam is_show boolean True will return active orders and False will return inactive orders. Example: true
     * @queryParam with_items boolean True order with items. No-example
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     * @queryParam order_status integer The value to get order by status. Example: 1
     *
     * <p>For 1: pending</p>
     * <p>For 4: completed </p>
     * <p>For 5: canceled </p>
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->orderRepository->serverPaginationFilterForApi($request->all());
        return OrderResource::collection($result);
    }


    /**
     * Get the order detail.
     *
     * This endpoint lets you get the order detail of the user by its order code.
     * @authenticated
     *
     * @urlParam order_code string required The order_code of the order of the user. Example: HKPM-20221125-0009
     *
     * @apiResource App\Http\Resources\Api\OrderResource
     * @apiResourceModel App\Models\Order
     *
     * @param $orderCode
     * @return \Illuminate\Http\JsonResponse |  OrderResource
     */
    public function show($orderCode): \Illuminate\Http\JsonResponse|OrderResource
    {
        $order = $this->orderRepository->getOrderDetailForApi($orderCode);
        if ($order) {
            return new OrderResource($order);
        }
        return response()->json(new JsonResponse([], __('errors.item_not_found')), ResponseAlias::HTTP_NOT_FOUND);
    }

}
