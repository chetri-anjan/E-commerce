<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'country' =>'required',
            'state' =>'required',
            'city' =>'required',
            'postal_code' =>'required',
            'street_no' =>'required|numeric',
            'house_no' =>'required',
            'location' =>'required'
        ];
    }
}
