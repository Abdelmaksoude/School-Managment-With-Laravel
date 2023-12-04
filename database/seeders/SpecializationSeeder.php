<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'English', 'ar'=> 'انجليزي'],
            ['en'=> 'Math', 'ar'=> 'رياضه'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Social Studies', 'ar'=> 'دراسات اجتماعيه'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'Religious Education', 'ar'=> 'التربيه الدينيه'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}
