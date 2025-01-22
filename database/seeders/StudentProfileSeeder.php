<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Profile;
use App\Models\Subject;

class StudentProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /* $student = new Student;
        $student->name = "sita";
        $student->password = "sitasword";
        $student->age = 15;
        $student->gender = "F";
        $student->course = "Science";
        $student->status = true;
        $student->save();

        $profile = new Profile;
        $profile->bio = "sword";
        $student->profile()->save($profile); */
        
        $student = new Student;
        $student->name = "john";
        $student->password = "john";
        $student->age = 15;
        $student->gender = "F";
        $student->course = "Science";
        $student->status = true;
        $student->save();

        $subject = new Subject;
        $subject->name = "Maths";
        $student->subject()->save($subject); 

    }
}
