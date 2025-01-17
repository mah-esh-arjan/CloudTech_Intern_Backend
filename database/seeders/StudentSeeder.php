<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* $student = new Student;
        $student->name = "gita";
        $student->password = "gitasword";
        $student->age = 15;
        $student->gender = "F";
        $student->course = "Commerce";
        $student->status = true;
        $student->save(); */
        //the comment above creates seeder manually
        $faker = FAKER::create();
        for ($i = 0; $i < 10; $i++) {
            $student = new Student;
            $student->name = $faker->name;
            $student->password = $faker->password();
            $student->age = 16;
            $student->gender = "M";
            $student->course = "Commerce";
            $student->status = $faker->boolean();
            $student->save();
        }
    }
}
