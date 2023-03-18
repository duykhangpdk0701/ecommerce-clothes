<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ItemSizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            "item_category_id" => $this->item_category_id,
            "item_person_type_id" => $this->item_person_type_id,
            "value" => $this->value,
            "status" => $this->status,
            "order" => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            "item_category" => ($this->whenLoaded('itemCategory')),
            "item_person_type" => new ItemPersonTypeResource($this->whenLoaded('itemPersonType'))
        ];
    }
}
