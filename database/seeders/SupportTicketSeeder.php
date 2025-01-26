<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i<3; $i++) {
            SupportTicket::create([
                'token' => $faker->country(),
                'send_by' => $faker->numberBetween(1, 10),
                'assigned_to' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
