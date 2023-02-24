<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStock\StoreItemStockRequest;
use App\Http\Requests\ItemStock\UpdateItemStockPriceRequest;
use App\Http\Resources\api\ItemStockResource;
use App\Models\ItemStock;
use App\Repositories\ItemStock\ItemStockRepositoryInterface;
use App\Responses\JsonResponse;
use App\Services\ItemStockService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;


/**
 * @group Admin Item Stock
 *
 * @authenticated
 *
 * APIs for managing Item Stock
 */
class ItemStockController extends Controller
{
    private ItemStockService $itemStockService;
    private ItemStockRepositoryInterface $itemStockRepository;

    public function __construct(ItemStockService $itemStockService, ItemStockRepositoryInterface $itemStockRepository)
    {
        $this->itemStockRepository = $itemStockRepository;
        $this->itemStockService = $itemStockService;
    }

    /**
     * Return list of Item Price
     *
     * @param UpdateItemStockPriceRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemStockRepository->serverPaginationFilteringFor($request->all());
        return ItemStockResource::collection($result);
    }

    /**
     * Update the price of the specified resource in storage.
     *
     * @param StoreItemStockRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function store(StoreItemStockRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemStockService->create($request->validated());
        if ($result) {
            return response()->json(new JsonResponse(new ItemStockResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }


    /**
     * Update the price of the specified resource in storage.
     *
     * @param UpdateItemStockPriceRequest $request
     * @param ItemStock $itemStock
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePrice(UpdateItemStockPriceRequest $request, ItemStock $itemStock): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemStockService->updatePrice($itemStock, $request->validated());
        if ($result) {
            return response()->json(new JsonResponse(new ItemStockResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

}
