<?php

namespace Database\Seeders;

use App\Models\Currency;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i<15; $i++) {
            Currency::create([
                'name' => $faker->name(),
                'country_id' => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
