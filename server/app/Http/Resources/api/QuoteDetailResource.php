<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class QuoteDetailResource extends JsonResource
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
            'item' => new ItemResource($this->whenLoaded('item')),
            // 'item_variant' => new ItemVariantResource($this->whenLoaded('itemVariant')),
            'size_id' => $this->size_id,
            'size_value' => $this->size_value,
            'color_id' => $this->color_id,
            'color_name' => $this->color_name,
            'color_value' => $this->color_value,
            'item_price' => $this->price,
            'total_price' => number_format($this->price * $this->quantity),
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
            'coupon_code' => $this->coupon_code,
            'discount' => $this->getDiscountPrice($this->couponCode->amount ?? 0, $this->couponCode->amount_type ?? ''),
        ];
    }
}
