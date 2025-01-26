<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i<15; $i++) {
            Country::create([
                'name_en' => $faker->country(),
                'name_bn' => $faker->country(),
                'phone_code' => $faker->randomElement(['008', '057', '017', '058']),
            ]);
        }
    }
}
