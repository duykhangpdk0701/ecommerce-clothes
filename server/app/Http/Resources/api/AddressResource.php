<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name ?? '',
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'ward_id' => $this->ward_id,
            'address' => $this->address,
            'status' => $this->status,
            'parse_address_string' => $this->stringAddress()
        ];
    }
}
