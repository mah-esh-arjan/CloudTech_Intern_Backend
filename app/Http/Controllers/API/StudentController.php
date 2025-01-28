<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        $validatedData = $request->validated();

        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $newImageName);




        $data =  Student::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'course' => $validatedData['course'],
            'image' => $newImageName

        ]);

        return jsonResponse($data, 'Student has been created succesfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
