<?php

namespace Database\Seeders;

use App\Models\SupportTicketMessage;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupportTicketMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 8; $i++) {
            SupportTicketMessage::create([
                'support_ticket_id' => $faker->numberBetween(1, 3),
                'send_by_customer' => ($i % 2 == 0) ? $faker->numberBetween(1, 10) : null,
                'send_by_adminUser' => ($i % 2 == 1) ? $faker->numberBetween(1, 3) : null,
                'message' => $faker->text(250),
            ]);
        }

    }
}
