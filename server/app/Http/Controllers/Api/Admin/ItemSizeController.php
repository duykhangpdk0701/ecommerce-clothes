<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemSize\StoreItemSizeRequest;
use App\Http\Requests\ItemSize\UpdateItemSizeRequest;
use App\Http\Resources\api\ItemSizeResource;
use App\Models\ItemSize;
use App\Repositories\ItemSize\ItemSizeRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
/**
 * @group Admin Item Size
 *
 * @authenticated
 *
 *APIS for managing Item Size
 *
 */
class ItemSizeController extends Controller
{
    protected ItemSizeRepositoryInterface $itemSizeRepository;

    public function __construct(ItemSizeRepositoryInterface $itemSizeRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_SIZE_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_SIZE_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_SIZE_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_SIZE_DELETE)->only("destroy");

        $this->itemSizeRepository = $itemSizeRepository;
    }
    /**
     * Get a list of item size.
     *
     * This endpoint lets you get a list of item size
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemSizeRepository->serverFilteringFor($request->all());
//        $result = $this->itemSizeRepository->all();
        return ItemSizeResource::collection($result);
    }

    /**
     * Get item size detail.
     *
     * This endpoint lets you get item color size
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemSizeRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new ItemSizeResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item_size.item_size_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Create a new item size
     *
     * This endpoint lets you create an item size
     *
     * @param StoreItemSizeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreItemSizeRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemSizeRepository->create($request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new ItemSizeResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update Item size
     *
     * This endpoint lets you update item size
     *
     * @param UpdateItemSizeRequest $request
     * @param ItemSize $itemSize
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateItemSizeRequest $request, ItemSize $itemSize): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemSizeRepository->update($itemSize, $request->validated());

        if ($result) {
            $temp = $this -> itemSizeRepository->find($itemSize->id);
            return response()->json(new JsonResponse(new ItemSizeResource($temp)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Delete Item size
     *
     * This endpoint lets you delete an item size
     *
     * @param ItemSize $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ItemSize $brand): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemSizeRepository->destroy($brand);
        if ($result) {
            return response()->json(new JsonResponse(['message' => __('error.brand.store_brand')]), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);

    }
}
