<?php

namespace App\Http\Requests\ItemStock;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemStockPriceRequest extends FormRequest
{
    protected $minPrice = 0;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Acl::PERMISSION_ITEM_STOCK_EDIT;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => ['required', 'numeric', 'min:' . $this->minPrice]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'price.min' => __('validation.min.numeric', ['min' => number_format($this->minPrice)])
        ];
    }
}
