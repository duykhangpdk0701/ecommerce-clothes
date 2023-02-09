<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\WardResource;
use App\Models\SysDistrict;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @group Destination
 *
 * APIs for destination
 */
class SysDistrictController extends Controller
{
    /**
     * Get a list of wards from district
     *
     * This endpoint lets you get a list of districts from city.
     *
     * @urlParam $district_id int required Get ward after choose district.
     *
     * @param SysDistrict $district
     * @return AnonymousResourceCollection
     */
    public function getWardsFromDistrict(SysDistrict $district): AnonymousResourceCollection
    {
        return WardResource::collection($district->ward);
    }
}
