<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemColorResource;
use App\Repositories\ItemColor\ItemColorRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Item
 *
 * APIs for managing item
 */
class ItemColorController extends Controller
{
    protected ItemColorRepositoryInterface $itemColorRepository;

    public function __construct(ItemColorRepositoryInterface $itemColorRepository)
    {
        $this->itemColorRepository = $itemColorRepository;
    }

    /**
     * Get a list of Colors
     *
     * This endpoint lets you get a list of Colors for the items
     * @unauthenticated
     *
     * @queryParam limit integer The number of resource that will show and then paginate. Example: 50
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $result = $this->itemColorRepository->serverPaginationFilterForApi($request->all());
        return ItemColorResource::collection($result);
    }

}
