<?php

namespace Database\Seeders;

use App\Models\keyValue;
use App\Models\Language;
use Illuminate\Support\Str;
use App\Models\TranslateData;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create(['name' => 'English', 'lang_code' => 'en']);
        Language::create(['name' => 'Bangla', 'lang_code' => 'bn']);

        $key_Values = [
            [
                'description' => 'this is home page',
            ],
            [
                'description' => 'this is about page',
            ],
            [
                'description' => 'home',
            ],
            [
                'description' => 'about',
            ],
            [
                'description' => 'this is something',
            ],
        ];

        foreach ($key_Values as $value) {
            $words = explode(' ', $value['description']);
            $first_five_words = array_slice($words, 0, 5);
            $key = Str::slug(implode(' ', $first_five_words), '-');
            keyValue::create([
                'key' => $key,
                'description' => $value['description'],
            ]);
            TranslateData::updateOrCreate(
                ['lang_code' => 'en', 'key' => $key],
                ['description' => $value['description']]
            );
        }

    }
}
