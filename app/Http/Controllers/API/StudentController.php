<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\GetOne;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    use GetOne;

    /**
     * Display a listing of the resource.
     */

    public function loginStudent(Request $request)
    {

        $student = Student::where('name', $request->name)->first();

        if (!$student) {
            return jsonResponse(null, 'No Stundent Was Found', 404);
        }

        if ($student->password !== $request->password) {
            return jsonResponse(null, 'Password does not match', 401);
        }

        $token = $student->createToken('Student', ['student-access'])->plainTextToken;

        return jsonResponse($token, 'Token has been created successfully', 201);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function registerStudent(RegisterStudentRequest $request)
    {
        $name = $request->name;
        $old_name = Student::where('name', $name)->first();
        if ($old_name) {
            return jsonResponse($old_name, 'student already exists', 409);
        }

        $validatedData = $request->validated();


        if ($request->image) {
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }
        $data =  Student::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'course' => $validatedData['course'],
            'image_path' => $newImageName ?? null

        ]);

        return jsonResponse($data, 'Student has been created succesfully', 201);
    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
 

    public function rentBook(Request $request, $student_id)
    {

        $data = $this->GetOne(Student::class, $student_id);

        $data->books()->sync($request->arrayId);

        return jsonResponse($data, 'Books have been rented sucessfully', 201);
    }

    public function getRentBooks($student_id)
    {
        // below is a lazy loading

        // $student = Student::findOrFail($student_id);
        // return jsonResponse($student,'Sucess',200);

        // bellow is eager loading
        // $student = Student::with('books')->findOrFail($student_id);

        $student = Student::findOrFail($student_id);
        return response()->json([
            'student' => $student,
            'Count' => count($student->books)

        ]);
    }
}
