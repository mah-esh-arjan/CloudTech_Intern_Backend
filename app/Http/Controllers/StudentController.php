<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;
use App\Http\Requests\RegisterStudentRequest;


class StudentController extends Controller
{
    public function viewStudentForm()
    {
        return view('/students.student_register');
    }

    public function registerStudent(RegisterStudentRequest $request)
    {
        
        $validatedData = $request->validated();

        // $path = $request->file('file')->store('public');

        // return $path;

        Student::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age'],
            'gender' =>  $validatedData['gender'],
            'course' =>  $validatedData['course']

        ]);

        return redirect('student-list');
    }

    public function viewStudents()
    {
        $students = Student::all();
        return view('/students.student_list', ['students' => $students]);
    }

    public function editStudent($student_id)
    {

        $data = Student::find($student_id);

        return view('/students.edit_student', compact('data'));
    }

    public function deleteStudent($student_id)
    {
        Student::destroy($student_id);
        return back();
    }

    public function updateStudent(Request $request, $student_id)
    {
        $data = Student::find($student_id);

        if (!$data) {
            return 'Data was not found';
        }

        $data->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'course' => $request->course
        ]);

        return redirect('student-list');
    }
}
