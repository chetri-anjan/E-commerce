<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' =>'required',
            'image' =>'image|max:2048|required',
            'product_name' =>'required',
            'description' =>'required|max:5000',
            'quantity' =>'required|numeric',
            'size' =>'nullable',
            'price' =>'required'
        ];
    }
}
