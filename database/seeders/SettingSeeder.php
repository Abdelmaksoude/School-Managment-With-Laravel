<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->delete();
        $data = [
            ['key' => 'current_session', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'Abdelmaksoud School'],
            ['key' => 'school_name', 'value' => 'Abdelmaksoud School International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-03-2022'],
            ['key' => 'phone', 'value' => '01015864793'],
            ['key' => 'address', 'value' => 'المنوفيه'],
            ['key' => 'school_email', 'value' => 'abdelmaqsoudgomma@gmail.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];
        DB::table('settings')->insert($data);
    }
}
