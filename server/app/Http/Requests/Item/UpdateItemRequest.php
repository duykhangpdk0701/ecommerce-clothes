<?php

namespace App\Http\Requests\Item;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ITEM_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'sku' => ['required', 'unique:items,sku,' . $this->item->id],
            'description' => 'required',
            'thumbnail_image' => ['sometimes', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
            'brand_id' => 'required',
            'item_categories' => 'required',
            'item_stock_status_id' => 'required'
        ];
    }
}
