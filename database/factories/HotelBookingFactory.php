<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelBooking>
 */
class HotelBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $no_of_adult = $this->faker->numberBetween(1, 5);
        $no_of_child = $this->faker->numberBetween(0, 3);
        $adult_base_price = $this->faker->randomFloat(2, 100, 500);
        $child_base_price = $this->faker->randomFloat(2, 50, 300);
        $discount_amount = $this->faker->randomFloat(2, 0, 50);
        $vat = $this->faker->randomFloat(2, 5, 20);
        $extra_charge = $this->faker->randomFloat(2, 0, 30);
        $total_price = ($adult_base_price * $no_of_adult) + ($child_base_price * $no_of_child);
        $grand_total = $total_price + $vat + $extra_charge - $discount_amount;

        return [
            'customer_id' => $this->faker->numberBetween(1, 10),
            'booking_code' => $this->faker->uuid(),
            'hotel_code' => $this->faker->bothify('HOTEL###'),
            'checkin_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'checkout_date' => $this->faker->dateTimeBetween('+1 day', '+2 years'),
            'room_no' => $this->faker->numberBetween(100, 999),
            'room_type' => $this->faker->randomElement(['single_room', 'multiple_room',]),
            'country_id' => $this->faker->numberBetween(1, 200),
            'city_id' => $this->faker->numberBetween(1, 1000),
            'no_of_adult' => $no_of_adult,
            'no_of_child' => $no_of_child,
            'adult_base_price' => $adult_base_price,
            'child_base_price' => $child_base_price,
            'total_price' => $total_price,
            'discount_amount' => $discount_amount,
            'vat' => $vat,
            'extra_charge' => $extra_charge,
            'extra_charge_details' => $this->faker->sentence(),
            'grand_total' => $grand_total,
            'paid_amount' => $this->faker->randomFloat(2, 0, $grand_total),
            'status' => 1,
            'payment_status' => 0,
            'payment_method' => $this->faker->randomElement(['bkash', 'cash', 'rocket']),
            'payment_details' => $this->faker->text(200),
        ];
    }
}
