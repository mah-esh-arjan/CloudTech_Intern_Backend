<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;
use App\Http\Requests\RegisterStudentRequest;
use App\Mail\RegisterSuccess;
use App\Traits\Create;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    use Create;

    public function viewStudentForm()
    {
        return view('/students.student_register');
    }

    public function registerStudent(RegisterStudentRequest $request)
    {

        $validatedData = $request->validated();

        // dd($validatedData);

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);

        Student::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age'],
            'gender' =>  $validatedData['gender'],
            'course' =>  $validatedData['course'],
            'image_path' => $newImageName

        ]);
        
        Mail::to('mah.dot98@gmail.com')->send(
            new RegisterSuccess()
        );

        return redirect('student-list');
    }

    public function viewStudents()
    {
        
        $students = $this->getAll(Student::class);
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

        // delete
        $fileName = $data->image_path;

        $filePath = public_path('images/' . $fileName);

        // dd($filePath);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $newImageName = time() . '-' . $request->name;
        $request->image->move(public_path('images'), $newImageName);

        $data->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'course' => $request->course,
            'image_path' => $newImageName
        ]);

        return redirect('student-list');
    }
}
