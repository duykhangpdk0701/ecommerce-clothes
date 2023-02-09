<?php

namespace App\Http\Requests\ItemStock;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ITEM_STOCK_ADD);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stock_status_id' => ['required'],
            'item_variant_id' => ['required'],
            'inbound_item' => ['required'],
            'inbound_item.*.price_in' => ['required', 'numeric', 'min:1000', 'max: 1000000000'],
            'inbound_item.*.price' => ['required', 'numeric', 'min:1000', 'max: 1000000000'],
            'inbound_item.*.stock_status_id' => ['sometimes'],
            'inbound_item.*.quantity' => ['sometimes']
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'inbound_item.*.price_in' => 'price in',
            'inbound_item.*.price' => 'price',
        ];
    }
}
