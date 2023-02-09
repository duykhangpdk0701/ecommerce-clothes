<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemCategoryResource;
use App\Repositories\ItemCategory\ItemCategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Item Category
 *
 * APIs for Item Category
 */
class ItemCategoryController extends Controller
{
    protected ItemCategoryRepositoryInterface $itemCategoryRepository;

    public function __construct(ItemCategoryRepositoryInterface $itemCategoryRepository)
    {
        $this->itemCategoryRepository = $itemCategoryRepository;
    }

    /**
     * Get a list of categories of the items.
     *
     * This endpoint lets you get a list of categories of the items
     * @unauthenticated
     *
     * @queryParam is_show boolean True will return active brands and False will return inactive brands. Example: true
     * @queryParam with_children boolean True categories with subcategories No-example
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemCategoryRepository->serverPaginationFilterForApi($request->all());
        return ItemCategoryResource::collection($result);
    }

}
