<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name_en' => 'required|string|max:80',
            'name_bn' => 'required|string|max:80',
            'phone_code' => 'required|max:80|unique:countries',
            'flag_img' => 'required|image|mimes:jpeg,png,jpg,webp|max:2000',
        ];
    }
}
