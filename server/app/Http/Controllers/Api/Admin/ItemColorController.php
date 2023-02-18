<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemColor\StoreItemColorRequest;
use App\Http\Requests\ItemColor\UpdateItemColorRequest;
use App\Http\Resources\api\ItemColorResource;
use App\Models\ItemColor;
use App\Repositories\ItemColor\ItemColorRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ItemColorController extends Controller
{
    protected ItemColorRepositoryInterface $itemColorRepository;

    public function __construct(ItemColorRepositoryInterface $itemColorRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_ITEM_COLOR_DELETE)->only("destroy");

        $this->itemColorRepository = $itemColorRepository;
    }

    /**
     * Get a list of item color.
     *
     * This endpoint lets you get a list of item color
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemColorRepository->all();
        return ItemColorResource::collection($result);
    }

    /**
     * Get item color detail.
     *
     * This endpoint lets you get item color detail
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemColorRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new ItemColorResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Create a new item color
     *
     * This endpoint lets you create an item color
     *
     * @param StoreItemColorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreItemColorRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemColorRepository->create($request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new ItemColorResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update Brand
     *
     * This endpoint lets you update brands
     *
     * @param UpdateItemColorRequest $request
     * @param ItemColor $itemColor
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateItemColorRequest $request, ItemColor $itemColor): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemColorRepository->update($itemColor, $request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new ItemColorResource($result)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Delete Item color
     *
     * This endpoint lets you delete item color
     *
     * @param ItemColor $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ItemColor $brand): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemColorRepository->destroy($brand);
        if ($result) {
            return response()->json(new JsonResponse(['message' => __('error.brand.store_brand')]), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);

    }
}
