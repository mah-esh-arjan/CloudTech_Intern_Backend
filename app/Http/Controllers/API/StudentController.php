<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
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

        $token = $student->createToken('Student')->plainTextToken;

        return jsonResponse($token, 'Token has been created successfully', 201);
    }



    public function getStudents()
    {

        $data = Student::all();

        if ($data->isEmpty()) {
            return jsonResponse(null, 'No students found in Database ', 404);
        }

        return jsonResponse($data, 'Students sucessfully retrieved', 200);
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
    public function showStudent(Request $request, $student_id)
    {
        $data = Student::find($student_id);

        if (!$data) {
            return jsonResponse(null, 'Student was not found', 404);
        }
        return jsonResponse($data, 'Student was found', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudent(Request $request, $student_id)
    {
        $data = Student::find($student_id);

        if (!$data) {
            return jsonResponse(null, 'Student was not found', 404);
        }
        if ($request->hasFile('image')) {
            if ($data->image_path) {
                $filePath = public_path('images/' . $data->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Upload new image
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);

            $data->image_path = $newImageName;
        }

        // Update other fields
        $data->update([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'course' => $request->course,
            'image_path' => $data->image_path ?? null
        ]);

        return jsonResponse($data, 'Student has been updated successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteStudent($student_id)
    {
        $data = Student::find($student_id);
        if (!$data) {
            return jsonResponse(null, 'Student was not found', 404);
        }
        Student::destroy($student_id);
        return jsonResponse($data, 'Student has been deleted', 200);
    }
}
