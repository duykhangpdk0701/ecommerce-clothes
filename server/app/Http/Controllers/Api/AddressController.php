<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Resources\api\AddressResource;
use App\Http\Resources\api\UserResource;
use App\Models\Address;
use App\Repositories\Address\AddressRepositoryInterface;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


/**
 * @group Address
 *
 * @authenticated
 *
 * APIs for managing addresses
 */
class AddressController extends Controller
{

    private AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAddressRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAddressRequest $request): \Illuminate\Http\JsonResponse
    {
        if ($this->addressRepository->create($request->validated())) {
            return response()->json(new JsonResponse(new UserResource(auth()->user())), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.store_address')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * get address by auth user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByAuthUser(): \Illuminate\Http\JsonResponse
    {
//        dd(auth()->user()->id);
        $result = $this->addressRepository->findByUserId(auth()->user()->id);
        if ($result) {
            return response()->json(new JsonResponse(AddressResource::collection($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.store_address')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Display the specified Address.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $result= $this->addressRepository->find($id);
        if ($result) {
            return response()->json(new JsonResponse(new AddressResource($result)), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.address.address_detail')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddressRequest $request
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAddressRequest $request, Address $address): \Illuminate\Http\JsonResponse
    {
        $result = $this->addressRepository->update($address, $request->validated());
        if ($result) {
            $temp = $this->addressRepository->find($address->id);
            return response()->json(new JsonResponse(new AddressResource($temp)), ResponseAlias::HTTP_OK);
        }

        return response()->json(new JsonResponse([], __('error.brand.store_brand')), ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Remove specific address from current customer.
     * @authencicated
     * @param Address $address
     * @urlParam address_id integer required The ID of the address.
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Address $address): \Illuminate\Http\JsonResponse
    {
        if ($this->addressRepository->destroy($address)) {
            return response()->json(new JsonResponse(['message' => __('success.user_change_profile.delete_address')]), ResponseAlias::HTTP_OK);
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.store_address')), ResponseAlias::HTTP_NOT_FOUND);

    }

    /**
     *Set default address of the current customer
     *
     * @urlParam address_id integer required The ID of the address.
     * @param Address $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefaultAddress(Address $address): \Illuminate\Http\JsonResponse
    {
        if ($this->addressRepository->setAsDefault($address)) {
            return response()->json(new JsonResponse(new UserResource(auth()->user())));
        }
        return response()->json(new JsonResponse([], __('error.user_change_profile.store_address')), ResponseAlias::HTTP_NOT_FOUND);
    }
}
