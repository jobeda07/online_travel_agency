<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AirTicketBooking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AirTicketBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AirTicketBooking::factory(15)->create();
    }
}
