<?php

namespace Database\Seeders;

use App\Models\AccountHead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountHeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //title
        $headers = [
            [
                'title' => 'Airticket Sell',
            ],
            [
                'title' => 'HotelBooking Sell',
            ],
            [
                'title' => 'HotelBooking Purchase',
            ],
        ];
        foreach ($headers as $head) {
            AccountHead::create([
                'title' => $head['title'],
            ]);
        }
    }
}
