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
    public function index (): AnonymousResourceCollection
    {
        $result = $this->itemVariantRepository->all();
        return ItemVariantResource::collection(($result));
    }


    /**
     * Show Item Variant by id
     *
     * @param ItemVariant $itemVariant
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ItemVariant $itemVariant): \Illuminate\Http\JsonResponse
    {
        $result = $itemVariant->load('item', 'size');
        if ($result) {
            return response()->json(new JsonResponse(new ItemVariantResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.brand.brand_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }
}
