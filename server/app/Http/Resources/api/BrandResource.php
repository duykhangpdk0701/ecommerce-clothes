<?php

namespace App\Http\Resources\api;

use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class BrandResource extends JsonResource
{

    /**
     * @param $request
     * @return JsonSerializable | array
     */
    public function toArray($request): array|JsonSerializable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
//            'qty_items' => number_format($this->items->count())
        ];
    }
}
