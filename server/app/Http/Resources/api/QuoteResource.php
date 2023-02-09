<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class QuoteResource extends JsonResource
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
            'quote_code' => $this->quote_code,
            'email' => $this->email,
            'customer' => $this->customer,
            'shipping_name' => $this->shipping_name,
            'shipping_address' => $this->shipping_address,
            'shipping_city' => $this->shippingCity ?? '',
            'shipping_district' => $this->shippingDistrict ?? '',
            'shipping_ward' => $this->shippingWard ?? '',
            'shipping_phone' => $this->shipping_phone,
            'payment_method' => $this->payment_metyhod,
            'payment_method_data' => $this->paymentMethod,
            'quote_detail' => QuoteDetailResource::collection(
                $this->whenLoaded('quoteDetails')
            ),
            'shipping_fee' => $this->shipping_fee ?? 0,
            'total_price' => $this->total_price,
            'total_discount' => $this->total_discount,
            'total_shipping' => $this->total_shipping,
            'total' => $this->total,
            'total_tax' => $this->total_tax,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        ];
    }
}
