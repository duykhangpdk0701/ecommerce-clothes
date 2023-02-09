<?php

namespace App\Http\Requests\User;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PhoneNumber;

class ChangeMyProfileRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'last_name' => [
                'required',
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => [
                'required',
                'numeric',
                'unique:user_profile,phone,' . auth()->user()->userProfile->id,
                new PhoneNumber
            ],
            'avatar' => [
                'sometimes',
                'image',
                'mimes:jpeg,jpg,png',
                'max:10000'
            ],
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'sometimes|required',
            'address' => 'required|string',
        ];
    }
}
