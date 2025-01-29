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
            'image_path' => $newImageName

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
    public function updateStudent(Request $request, $student_id)
    {
        $data = Student::find($student_id);
    
        if (!$data) {
            return response()->json(['error' => 'Student was not found'], 404);
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
            // 'image_path' => $data->image_path 
        ]);
    
        return response()->json(['message' => 'Data has been updated', 'data' => $data], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function deleteStudent($student_id)
    {
        $data = Student::find($student_id);
        if(!$data){
            return jsonResponse(null,'Student was not found',404);
        }
        Student::destroy($student_id);
        return jsonResponse(null,'Student has been deleted',200);

    }
}
