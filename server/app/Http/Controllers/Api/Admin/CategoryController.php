<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCategory\StoreItemCategoryRequest;
use App\Http\Requests\ItemCategory\UpdateItemCategoryRequest;
use App\Http\Resources\api\ItemCategoryResource;
use App\Models\ItemCategory;
use App\Repositories\ItemCategory\ItemCategoryRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Admin ItemCategory
 *
 * APIs for managing ItemCategory
 */
class CategoryController extends Controller
{
    protected ItemCategoryRepositoryInterface $itemCategoryRepository;

    public function __construct(ItemCategoryRepositoryInterface $itemCategoryRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_DELETE)->only("destroy");

        $this->itemCategoryRepository = $itemCategoryRepository;
    }

    /**
     * Get a list of Item Category.
     *
     * This endpoint lets you get a list of item-category
     *
     * @return AnonymousResourceCollection
     */

    public function index(): AnonymousResourceCollection
    {
        $result = $this->itemCategoryRepository->all();
        return ItemCategoryResource::collection($result);
    }

    /**
     * Update an Item Category
     *
     * This endpoint lets you update an Item Category
     *
     * @param StoreItemCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreItemCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemCategoryRepository->create($request->validated());
        if ($result) {
            return response()->json(new JsonResponse(new ItemCategoryResource($result)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.item_category.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }


    /**
     * Get itemCategory detail.
     *
     * This endpoint lets you get  itemCategory detail
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemCategoryRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new ItemCategoryResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item_category.item_category_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update an Item Category
     *
     * This endpoint lets you update an Item Category
     *
     * @param UpdateItemCategoryRequest $request
     * @param ItemCategory $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateItemCategoryRequest $request, ItemCategory $category): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemCategoryRepository->update($category, $request->validated());
        if ($result) {
            return response()->json(new JsonResponse(new JsonResponse($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item_category.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Delete Category
     *
     * This endpoint lets you delete Item Category
     *
     * @param ItemCategory $itemCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ItemCategory $itemCategory): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemCategoryRepository->destroy($itemCategory);
        if ($result) {
            return response()->json(new JsonResponse(new JsonResponse(['message' => __('error.item_category.store_brand')])), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.item_category.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }
}
