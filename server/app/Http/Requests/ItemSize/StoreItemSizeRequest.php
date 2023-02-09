<?php

namespace App\Http\Requests\ItemSize;

use App\Acl\Acl;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return checkPermission(Acl::PERMISSION_ITEM_SIZE_ADD);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'item_category_id' => 'required',
            'item_person_type_id' => 'required',
            'value' => 'required',
            'order' => 'present'
        ];
    }
}
