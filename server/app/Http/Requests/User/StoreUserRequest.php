<?php

namespace App\Http\Requests\User;

use App\Rules\AlphaSpaces;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'role' => 'required',
            'phone' => [
                'required', 'numeric', new PhoneNumber, 'unique:user_profile'
            ],
            'city_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'sometimes|required',
            'address' => 'required|string'
        ];
    }
}
