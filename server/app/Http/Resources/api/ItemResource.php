<?php

namespace App\Http\Resources\api;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {

        $isSale = null;
        $stockOldPrice = null;
        $stockLowestPrice = null;

        if ($this->relationLoaded('stocks')) {
            $stock = $this->stocks
                ->where('stock_status_id', CONST_STOCK_IN_STOCK)
                ->sortBy('price')
                ->first();
            if ($stock) {
                $isSale = $stock->is_sale;
                $stockOldPrice = number_format($stock->old_price);
                $stockLowestPrice = number_format($stock->price);
            }
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'thumbnail_url' => $this->thumbnail,
            'brand_id' => $this->brand_id,
            'brand' =>  new BrandResource($this->whenLoaded('brand')),
            'categories' =>  ItemCategoryResource::collection($this->whenLoaded('activeCategories')),
            'sizes' =>  ItemSizeResource::collection($this->whenLoaded('sizes')),
            'colors' =>  ItemColorResource::collection($this->whenLoaded('colors')),
            'is_sale' => $this->whenLoaded('stocks', $isSale),
            'stock_old_price' => $this->whenLoaded('stocks', $stockOldPrice),
            'stock_lowest_price' => $this->whenLoaded('stocks', $stockLowestPrice),
            'views_count' => $this->views_count,
            'variants' => ItemVariantResource::collection($this->whenLoaded('itemVariants')),
            'media' => MediaResource::collection($this->when($this->whenLoaded('media'), $this->getMedia(ITEM_MEDIA_COLLECTION_DETAIL))),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
