<?php

namespace App\Http\Requests\Order;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ORDER_EDIT);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Shipping
            'shipping_name' => ['sometimes', 'max:255'],
            'shipping_address' => ['sometimes', 'max:255'],
            'shipping_city_id' => ['sometimes'],
            'shipping_district_id' => ['sometimes'],
            'shipping_ward_id' => ['sometimes'],
            'shipping_phone' => ['sometimes'],
            'shipping_provider_id' => ['sometimes'],
            'do_number' => ['sometimes'],

            // Billing
            'billing_name' => ['sometimes', 'max:255'],
            'billing_address' => ['sometimes', 'max:255'],
            'billing_city_id' => ['sometimes'],
            'billing_district_id' => ['sometimes'],
            'billing_ward_id' => ['sometimes'],
            'billing_phone' => ['sometimes'],

            // Notes
            'note' => ['sometimes', 'max:1000']
        ];
    }
}
