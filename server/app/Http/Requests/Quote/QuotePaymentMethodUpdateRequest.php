<?php

namespace App\Http\Requests\Quote;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class QuotePaymentMethodUpdateRequest extends FormRequest
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
            'payment_method_id' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'payment_method_id.required' => __('error.quote.require_payment')
        ];
    }
}
