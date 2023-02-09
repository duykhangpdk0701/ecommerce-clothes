<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ItemStockResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price_in' => number_format($this->price_in),
            'price_out' => number_format($this->price_out),
            'price' => number_format($this->price),
            'is_sale' => $this->is_sale,
            'old_price' => number_format($this->old_price),

            'stock_status' => $this->stock_status_id,
        ];
    }
}
