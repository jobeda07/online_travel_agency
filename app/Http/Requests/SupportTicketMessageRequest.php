<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportTicketMessageRequest extends FormRequest
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
            'message' => 'required|max:1200',
            'support_ticket_id' => 'nullable',
            'created_by' => 'nullable',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2000',
            'attachment' => 'nullable|file|mimes:pdf|max:2000',
        ];
    }
}
