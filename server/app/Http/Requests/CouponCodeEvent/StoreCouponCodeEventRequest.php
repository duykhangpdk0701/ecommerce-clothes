<?php

namespace App\Http\Requests\CouponCodeEvent;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponCodeEventRequest extends FormRequest
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
            'name' => 'required|unique:coupon_code_events|max:255',
            'description' =>'',
            'status' => 'integer',
            'type' => 'integer',
            'created_at' => 'integer',
            'created_by' => 'integer',
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
        ];
    }
}
