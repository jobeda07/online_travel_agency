<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'first_name' => 'required|string|max:80',
            'last_name' => 'required|string|max:80',
            'phone' => 'required|digits:11|unique:customers',
            'email' => 'required|email|unique:customers',
            'username' => 'nullable|string|max:20|unique:customers',
            'password' => 'required|string|min:6|max:20',
            'address' => 'required|max:700',
        ];
    }
}
