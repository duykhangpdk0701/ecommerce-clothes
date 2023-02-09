<?php

namespace App\Http\Requests\CouponCode;

use Illuminate\Foundation\Http\FormRequest;

class CalculateDiscountPriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'coupon_code' => ['present'],
            'city_id' => ['present'],
            'price' => ['required', 'numeric']
        ];
    }

    /**
     * Generate documentation for APIs
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'coupon_code' => [
                'description' => 'The coupon code',
            ],
            'price' => [
                'description' => 'The price that is needed for calculation'
            ]
        ];
    }
}
