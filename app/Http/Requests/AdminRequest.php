<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|string|max:80',
            'phone' => 'required|digits:11|unique:admins',
            'email' => 'required|email|unique:admins',
            'username' => 'nullable|string|max:20|unique:admins',
            'password' => 'required|string|min:6|max:20',
            'address' => 'required|max:700',
            'role' => 'required',
        ];
    }
}
