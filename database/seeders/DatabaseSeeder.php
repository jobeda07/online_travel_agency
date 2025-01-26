<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //

        $this->call([
            RolePermissionSeeder::class,
            CustomerSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            CurrencySeeder::class,
            AirTicketBookingSeeder::class,
            HotelBookingSeeder::class,
            SupportTicketSeeder::class,
            SupportTicketMessageSeeder::class,
            KeyValueSeeder::class,
            AccountHeadSeeder::class,
        ]);
        Admin::factory(5)->create()->each(function ($admin) {
            $admin->assignRole('manager');
        });
        Artisan::call('cache:translations');
    }
}
