<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\TypeBlood;
use App\Models\Religions;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_parents')->delete();
            $my_parents = new MyParent();
            $my_parents->email = 'gomma@gmail.com';
            $my_parents->password = Hash::make('12345678');
            $my_parents->Name_Father = ['en' => 'Gomaa', 'ar' => 'جمعه'];
            $my_parents->National_ID_Father = '30012051701758';
            $my_parents->Passport_ID_Father = '30012051701758';
            $my_parents->Phone_Father = '01015864793';
            $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
            $my_parents->Nationality_Father_id = Nationality::all()->unique()->random()->id;
            $my_parents->Blood_Type_Father_id =TypeBlood::all()->unique()->random()->id;
            $my_parents->Religion_Father_id = Religions::all()->unique()->random()->id;
            $my_parents->Address_Father ='المنوفيه';
            $my_parents->Name_Mother = ['en' => 'SS', 'ar' => 'سس'];
            $my_parents->National_ID_Mother = '30012051701759';
            $my_parents->Passport_ID_Mother = '30012051701759';
            $my_parents->Phone_Mother = '01062645447';
            $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
            $my_parents->Nationality_Mother_id = Nationality::all()->unique()->random()->id;
            $my_parents->Blood_Type_Mother_id =TypeBlood::all()->unique()->random()->id;
            $my_parents->Religion_Mother_id = Religions::all()->unique()->random()->id;
            $my_parents->Address_Mother ='المنوفيه';
            $my_parents->save();
    }
}
