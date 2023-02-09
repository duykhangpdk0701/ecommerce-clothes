<?php

namespace App\Http\Requests\Item;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ITEM_ADD);
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'detail_images.*' => 'detail images'
        ];
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
            'sku' => ['required', 'unique:items,sku'],
            'description' => 'required',
            'brand_id' => 'required',
            'item_categories' => 'required',
            'thumbnail_image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
            'detail_images' => 'required',
            'detail_images.*' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
            'item_person_type_id' => 'required',
            'item_stock_status_id' => 'required',
            'item_sizes' => 'required',
            'item_colors' => 'required'
        ];
    }
}
