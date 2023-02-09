<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\CityResource;
use App\Http\Resources\api\DistrictResource;
use App\Models\SysCity;


/**
 * @group Destination
 *
 * APIs for destination
 */
class SysCityController extends Controller
{
    /**
     * Get list of city
     *
     * This endpoint lets you get a list of cities.
     * @unauthenticated
     *
     * @return Resource
     */
    public function index()
    {
        return CityResource::collection(SysCity::all());
    }

    /**
     * Get a list of districts from city
     *
     * This endpoint lets you get a list of districts from city.
     *
     * @urlParam $city_id int required Get district after choose city.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistrictsFromCity(SysCity $city)
    {
        return DistrictResource::collection($city->districts);
    }
}
