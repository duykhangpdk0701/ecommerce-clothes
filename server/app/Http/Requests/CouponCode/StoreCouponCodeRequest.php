<?php

namespace App\Http\Requests\CouponCode;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponCodeRequest extends FormRequest
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
        $amt_tp= $this->request->get('amount_type');
        $rules = [
            'code' => 'required|unique:coupon_codes,code|max:32',
            'coupon_code_events_id' => '',
            'limit'=>'required|integer|gte:0',
            'amount'=>'required|numeric|gte:0',
            'amount_type'=>'',
            'status' =>'',
        ];

        if ($amt_tp == STATUS_COUPON_AMOUNT_TYPE_PERCENT) {
            $rules['amount'] = 'required|numeric|between:0,100';
        }

        return $rules;
    }
}
