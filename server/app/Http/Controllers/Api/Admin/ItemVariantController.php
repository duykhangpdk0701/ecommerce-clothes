<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemVariantResource;
use App\Models\ItemVariant;
use App\Repositories\ItemVariant\ItemVariantRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @group Admin Item Variant
 *
 * @authenticated
 *
 * APIs for managing Item Variant
 */
class ItemVariantController extends Controller
{
    private ItemVariantRepositoryInterface $itemVariantRepository;

    public function __construct(
        ItemVariantRepositoryInterface $itemVariantRepository,
    )
    {
        $this->itemVariantRepository = $itemVariantRepository;
    }


    /**
     * Get a list of item variant.
     *
     * This endpoint lets you get a list of brands
     * @authencicated
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemVariantRepository->serverFilteringFor($request);
        return ItemVariantResource::collection(($result));
    }


    /**
     * Show Item Variant by id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->itemVariantRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new ItemVariantResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Show Item Variant by Item id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByItemId(int $id)
    {
        $result = $this->itemVariantRepository->findByItemId($id);
        if ($result) {
            return response()->json(new JsonResponse(ItemVariantResource::collection($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }
}
