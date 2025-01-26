<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for($i=0; $i<10; $i++) {
            Customer::create([
                'first_name' => $faker->name(),
                'last_name' => $faker->name(),
                'email' => $faker->email(),
                'phone' => '017'.$faker->numberBetween(10000000, 99999999),
                'password' => Hash::make('12345678'),
                'username' => $faker->username(),
                'address' => $faker->address(),
            ]);
        }
    }
}
