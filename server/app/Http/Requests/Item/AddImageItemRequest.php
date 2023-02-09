<?php

namespace App\Http\Requests\Item;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class AddImageItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ITEM_EDIT);
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'detail_images.*' => 'detail images'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'detail_images' => 'required',
            'detail_images.*' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:10000'],
        ];
    }
}
