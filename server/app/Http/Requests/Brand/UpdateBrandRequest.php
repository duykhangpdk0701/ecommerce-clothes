<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'present|unique:brands,slug,' . $this->brand->id,
            'order' => 'present',
            'status' => "required",
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Contents of the post',
            ],
            'slug' => [
                'description' => 'The title of the post.',
                'example' => 'aaa',
            ],
            'order' => [
                'description' => 'Date to be used as the publication date.',
                'example' => 2,
            ],
            'status' => [
                'description' => 'Category the post belongs to.',
                'example' => 1,
            ],

        ];
    }

}
