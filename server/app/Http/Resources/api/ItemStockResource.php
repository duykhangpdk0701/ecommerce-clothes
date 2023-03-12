<?php

namespace App\Http\Resources\api;

use App\Http\Resources\api\ItemVariantResource;
use App\Http\Resources\api\ItemResource;
use App\Http\Resources\api\ItemSizeResource;
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
            'variant' => new ItemVariantResource($this->whenLoaded('itemVariant')),
            'item' => new ItemResource($this->whenLoaded('item')),
            'size' => new ItemSizeResource($this->whenLoaded('itemSize')),
            'stock_status' => $this->stock_status_id,
            'stock_status_id' => $this->stock_status_id,
//            'stock_status_name' => __('general.item_stock.status')[$this->stock_status_id]['name'],
            'code' => $this->code,
            'sku' => $this->sku,
            // 'thumbnail' => $this->item->thumbnail,
            'size_value' => $this->size_value,
            'color_name' => $this->color_name,
            'color_value' => $this->color_value,
            'condition_value' => $this->condition_value,
            'box_condition_value' => $this->box_condition_value,
            'price_in' => number_format($this->price_in),
            'price_out' => number_format($this->price_out),
            'price' => number_format($this->price),
            'stock_in_date' => $this->stock_in_date,
            'stock_in_note' => $this->stock_in_note,
            'stock_in_type' => $this->stock_in_type,
            'stock_out_date' => $this->stock_out_date,
            'stock_out_note' => $this->stock_out_note,
            'stock_out_type' => $this->stock_out_type,
            'status' => $this->status,
            // 'seller' => $orderItem->order->staff->name ?? '',
            'created_at' => $this->created_at
        ];
    }
}
