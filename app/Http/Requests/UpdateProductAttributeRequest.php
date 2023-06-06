<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'key' => [
                'required',
                'string',
                'max:255',
                Rule::unique('product_attributes', 'key')
                    ->where('product_id', $this->product->id)
                    ->whereNot('id', $this->attribute->id)
            ],
            'value' => 'string'
        ];
    }
}
