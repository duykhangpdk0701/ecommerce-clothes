<?php

namespace App\Http\Requests\ItemCategory;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemCategoryRequest extends FormRequest
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
        $rules = [
            'description' => ['string', 'present', 'nullable'],
            'parent_id' => 'present',
            'order' => 'required'
        ];
        foreach (config('app.locales') as $key => $value) {
            $rules['name.' . $value] = ['required', 'string', 'max:255'];
        }
        return $rules;
    }
}
