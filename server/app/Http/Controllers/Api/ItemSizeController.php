<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemSizeResource;
use App\Repositories\ItemSize\ItemSizeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Item Size
 *
 * APIs for managing Item Size
 */
class ItemSizeController extends Controller
{
    protected ItemSizeRepositoryInterface $itemSizeRepository;

    public function __construct(ItemSizeRepositoryInterface $itemSizeRepository)
    {
        $this->itemSizeRepository = $itemSizeRepository;
    }


    /**
     * Get a list of Sizes
     *
     * This endpoint lets you get a list of Sizes for the items
     * @unauthenticated
     *
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     * @queryParam item_category_id integer the id of the category for filter the sizes. No-example
     * @queryParam item_person_type_id integer the id of the person type for filter the sizes by gender. No-example
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemSizeRepository->serverPaginationFilterForApi($request->all());
        return ItemSizeResource::collection($result);
    }

}
