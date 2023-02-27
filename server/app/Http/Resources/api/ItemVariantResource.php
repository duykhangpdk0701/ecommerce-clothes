<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use function MongoDB\BSON\toJSON;

class ItemVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        $lowestPrice = null;

        if ($this->relationLoaded('itemStocks')) {
            $lowestPrice = $this->itemStocks->first() ? number_format($this->itemStocks->first()->price) : null;
        }

        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'item_id' => $this->item_id,
            'item' => new ItemResource($this->item),
            'size_id' => $this->size_id,
            'size' => new ItemSizeResource($this->size),
            'color_id' => $this->color_id,
            'color' => new ItemColorResource($this->color),
            'lowest_price' => $this->when($this->whenLoaded('itemStocks'), $lowestPrice),
            'lowest_in_stock_item_stock' => new ItemStockResource($this->lowestPriceInStockItemStock),
            'status' => $this->status
        ];

    }
}
