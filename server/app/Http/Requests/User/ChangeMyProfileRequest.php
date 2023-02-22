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
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'last_name' => [
                'string',
                'max:20',
                new AlphaSpaces
            ],
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => [
                'numeric',
                'unique:user_profiles,phone,' . auth()->user()->userProfile->id,
                new PhoneNumber
            ],
            'avatar' => [
                'sometimes',
                'image',
                'mimes:jpeg,jpg,png',
                'max:10000'
            ],
        ];
    }
}
