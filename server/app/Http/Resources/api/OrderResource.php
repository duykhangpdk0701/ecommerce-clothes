<?php

namespace App\Http\Resources\api;

use App\Models\OrderStatus;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderResource extends JsonResource
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
            'order_code' => $this->order_code ?? '',
            'customer' => new UserResource($this->whenLoaded('customer')),
            'shipping_name' => $this->shipping_name,
            'shipping_address' => $this->shipping_address,
            'shipping_country_id' => $this->shipping_country_id,
            'shipping_city_id' => $this->shipping_city_id,
            'shipping_district_id' => $this->shipping_district_id,
            'shipping_ward_id' => $this->shipping_ward_id,
            'shipping_phone' => $this->shipping_phone,
            'payment_method' => $this->paymentMethod->name ?? '',
            'payment_code' => $this->payment_code,
            'total_price' => number_format($this->total_price),
            'total_discount' => number_format($this->total_discount),
            'total_tax' => number_format($this->total_tax),
            'total_shipping' => number_format($this->total_shipping),
            'total_payment_fee' => number_format($this->total_payment_fee),
            'total' => number_format($this->total),
            'order_status_id' => $this->order_status_id,
            'order_status_value' => collect(OrderStatus::$orderStatusList)->where('id', $this->order_status_id)->first()['name'],
            'number_order_items' => $this->number_order_items,
            'coupon' => $this->couponCode,
            'order_items' => OrderDetailResource::collection($this->whenLoaded('orderDetails')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
