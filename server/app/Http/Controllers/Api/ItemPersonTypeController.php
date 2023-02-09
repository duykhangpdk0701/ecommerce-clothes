<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\ItemPersonTypeResource;
use App\Models\ItemPersonType;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Person Type
 *
 * APIs for Person Type
 */
class ItemPersonTypeController extends Controller
{
    /**
     * Get a list of Person Types for the items.
     *
     * This endpoint lets you get a list of person types for the items
     * @unauthenticated
     *
     * @return AnonymousResourceCollection
     */

    public function index(): AnonymousResourceCollection
    {
        return ItemPersonTypeResource::collection(ItemPersonType::all());
    }
}
