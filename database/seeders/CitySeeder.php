<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 15; $i++) {
            City::create([
                'name_en' => $faker->city(),
                'name_bn' => $faker->city(),
                'country_id' => $faker->numberBetween(1, 10),
                'description_en' => $faker->text(200),
                'description_bn' => $faker->text(200),
            ]);
        }
    }
}
