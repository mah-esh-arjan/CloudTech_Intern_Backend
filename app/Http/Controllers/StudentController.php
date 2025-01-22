<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    public function ViewStudentForm()
    {
        return view('/FormValidation.Student-Register');
    }

    public function registerStudent(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'age' => 'required|integer'
        ],[
            'name.required' => 'Please put your name',
            'password.min' => 'Sorry, your password must be more than 6 characters.',
            'age.integer' => 'Age must be a number.',
        ]);

        $path = $request->file('file')->store('public');

        // return $path;

        Student::create([
            'name' => $request->name,
            'password' => $request->password,
            'age' => $request->age,
            'gender' => $request->gender,
            'course' => $request->course

        ]);

        return redirect('student-list');
    }

    public function viewStudents()
    {
        $students = Student::all();
        return view('/Students.student-list', ['students' => $students]);
    }

    public function edit_student($student_id)
    {

        $data = Student::find($student_id);

        return view('FormValidation.Edit-Student-Form', compact('data'));
    }

    public function delete_student($student_id)
    {
        Student::destroy($student_id);
        return back();
    }

    public function update_data(Request $request,$student_id){

        $data = Student::find($student_id);

        $data->update([
            'name' => $request->name,
            'age' => $request->age
        ]);

        return redirect('student-list');
    }

}
