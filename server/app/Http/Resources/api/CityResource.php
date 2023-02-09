<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array | JsonSerializable | Arrayable
     */
    public function toArray($request): array|JsonResource|Arrayable
    {
        return parent::toArray($request);
    }
}
