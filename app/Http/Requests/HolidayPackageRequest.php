<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HolidayPackageRequest extends FormRequest
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
            'title' => 'required|string|max:120',
            'price' => 'required',
            'validaty_start' => 'required',
            'validaty_end' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'total_days' => 'required',
            'priority' => 'nullable',
            'description' => 'required',
            'thambnail_img' => 'required|image|mimes:png,jpg,jpeg,webp,jfif',
            'slider_img.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2000',
        ];
    }
}
