<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\TypeBlood;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Section;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'عبدالمقصود', 'en' => 'Abdelmaksoud'];
        $students->email = 'abdelmaqsoudgomma@gmail.com';
        $students->password = Hash::make('12345678');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationality::all()->unique()->random()->id;
        $students->blood_id =TypeBlood::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Grade::all()->unique()->random()->id;
        $students->Classroom_id =ClassRoom::all()->unique()->random()->id;
        $students->section_id = Section::all()->unique()->random()->id;
        $students->parent_id = MyParent::all()->unique()->random()->id;
        $students->academic_year ='2021';
        $students->save();
    }
}
