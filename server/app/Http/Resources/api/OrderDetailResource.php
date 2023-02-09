<?php

namespace App\Http\Resources\api;

use App\Models\OrderStatus;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderDetailResource extends JsonResource
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
            'variants' => new ItemVariantResource($this->whenLoaded('itemVariant')),
            'item_name' => $this->item->name ?? '',
            'size_id' => $this->size_id ?? '',
            'size_value' => $this->size_value ?? '',
            'color_id' => $this->color_id ?? '',
            'color_name' => $this->color_name ?? '',
            'color_value' => $this->color_value ?? '',
            'price' => $this->price ?? '',
            'order_code' => $this->order->order_code ?? '',
            'quantity' => $this->quantity,
            'coupon_code' => $this->coupon_code,
            'discount' => $this->getDiscountPrice($this->couponCode->amount ?? 0, $this->couponCode->amount_type ?? '') ?? '',
            'order_status_value' => collect(OrderStatus::$orderStatusList)->where('id', $this->order->order_status_id)->first()['name'],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'uuid' => $this->order->uuid,
        ];
    }
}
