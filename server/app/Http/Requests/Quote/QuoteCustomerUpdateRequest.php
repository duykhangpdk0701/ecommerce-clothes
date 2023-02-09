<?php

namespace App\Http\Requests\Quote;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class QuoteCustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping_name' => 'required',
            'email' => 'required|email',
            'shipping_city_id' => 'required',
            'shipping_district_id' => 'required',
            'shipping_ward_id' => 'sometimes',
            'shipping_address' => 'required',
            'shipping_phone' => ['required', 'numeric', new PhoneNumber],
            'comment' => 'sometimes',
            'payment_method_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'shipping_name.required' => 'Customer name is required',
            'shipping_city_id.required' => 'City is required',
            'shipping_district_id.required' => 'District is required',
            'shipping_address.required' => 'Address is required',
            'shipping_phone.required' => 'Phone number is required',
            'payment_method_id.required' => __('error.quote.require_payment')
        ];
    }
}
