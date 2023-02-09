<?php

namespace App\Http\Requests\Quote;

use App\Acl\Acl;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class SaveQuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_QUOTE_MANAGE);;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'billing_name' => 'required',
            'email' => 'required|email',
            'billing_city_id' => 'required',
            'billing_district_id' => 'required',
            'billing_ward_id' => 'sometimes',
            'billing_address' => 'required',
            'billing_phone' => ['required', 'numeric', new PhoneNumber],
        ];
    }

    public function messages()
    {
        return [
            'billing_name.required' => 'Customer name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is wrong format',
            'billing_city_id.required' => 'City is required',
            'billing_district_id.required' => 'District is required',
            'billing_address.required' => 'Address is required',
            'billing_phone.required' => 'District is required'
        ];
    }
}
