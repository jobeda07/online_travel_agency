<?php

namespace Database\Seeders;

use App\Models\HotelBooking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HotelBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HotelBooking::factory(15)->create();
    }
}
