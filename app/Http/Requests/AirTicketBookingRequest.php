<?php

namespace App\Http\Requests;

use App\Enums\RoomTypeEnum;
use Illuminate\Validation\Rule;
use App\Enums\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;

class AirTicketBookingRequest extends FormRequest
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
            'customer_id' => 'required',
            'booking_code' => 'required|max:255',
            'ticket_code' => 'required|max:255',
            'airline_code' => 'required|max:255',
            'pnr' => 'required|max:255',
            'travel_date' => 'required|date',
            'return_date' => 'nullable|date',
            'way_type' => 'nullable',
            'country_id' => 'required',
            'city_id' => 'required',
            'no_of_adult' => 'required',
            'no_of_child' => 'nullable',
            'adult_base_price' => 'required|numeric|min:0',
            'child_base_price' => 'nullable|numeric|min:0',
            'total_price' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'point_discount' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'extra_charge' => 'nullable|numeric|min:0',
            'extra_charge_details' => 'nullable|string|max:1200',
            'grand_total' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => 'nullable|integer|in:0,1',
            'payment_status' => 'nullable|integer|in:0,1',
            'payment_method' => ['nullable',Rule::enum(PaymentMethodEnum::class)],
            'payment_details' => 'nullable|string|max:1200',
        ];
    }
}
