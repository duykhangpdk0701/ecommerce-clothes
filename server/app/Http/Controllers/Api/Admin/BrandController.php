<?php

namespace App\Http\Controllers\Api\Admin;

use App\Acl\Acl;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\api\BrandResource;
use App\Models\Brand;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Admin Brand
 *
 * APIs for managing Brand
 */
class BrandController extends Controller
{
    protected BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_LIST)->only(['index', 'show']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_ADD)->only(['create', 'store']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_EDIT)->only(['edit', 'update']);
        $this->middleware('permission:' . Acl::PERMISSION_BRAND_DELETE)->only("destroy");

        $this->brandRepository = $brandRepository;
    }

    /**
     * Get a list of brands.
     *
     * This endpoint lets you get a list of brands
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->brandRepository->all();
        return BrandResource::collection($result);
    }

    /**
     * Create a new Brand
     *
     * This endpoint lets you create a brand
     *
     * @param StoreBrandRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBrandRequest $request): \Illuminate\Http\JsonResponse
    {
        $result = $this->brandRepository->create($request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new BrandResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update Brand
     *
     * This endpoint lets you update brands
     *
     * @param UpdateBrandRequest $request
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBrandRequest $request, Brand $brand): \Illuminate\Http\JsonResponse
    {
        $result = $this->brandRepository->update($brand, $request->validated());

        if ($result) {
            return response()->json(new JsonResponse(new BrandResource($result)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Delete Brand
     *
     * This endpoint lets you delete brands
     *
     * @param Brand $brand
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Brand $brand): \Illuminate\Http\JsonResponse
    {
        $result = $this->brandRepository->destroy($brand);
        if ($result) {
            return response()->json(new JsonResponse(['message' => __('error.brand.store_brand')]), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);

    }
}
