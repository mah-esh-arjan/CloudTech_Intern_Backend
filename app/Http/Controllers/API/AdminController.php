<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\GetOne;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use GetOne;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registerAdmin(Request $request)
    {

        $old_email = Admin::where('email', $request->email)->first();

        if ($old_email) {
            return jsonResponse($old_email, "$old_email->email already exists", 401);
        }

        $data = Admin::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return jsonResponse($data, 'Admin was created', 201);
    }

    public function adminLogin(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return jsonResponse(null, 'No admin Was Found', 400);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return jsonResponse(null, 'Password is not correct', 401);
        }

        $token = $admin->createToken('Admin', ['admin-access', 'student-access'])->plainTextToken;

        return jsonResponse(['token'=>$token, 'role' => 'admin'], 'Token has been created successfully', 201);
    }


    public function getStudents()
    {

        $data = Student::all();

        if ($data->isEmpty()) {
            return jsonResponse(null, 'No students found in Database ', 404);
        }

        return jsonResponse($data, 'Students sucessfully retrieved', 200);
    }

    public function showStudent(Request $request, $student_id)
    {
        $data = Student::find($student_id);

        if (!$data) {
            return jsonResponse(null, 'Student was not found', 404);
        }
        return jsonResponse($data, 'Student was found', 200);
    }


    public function updateStudent(Request $request, $student_id)
    {
        Log::info($request->all());
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


    public function deleteStudent($student_id)
    {
        $data = Student::find($student_id);
        if (!$data) {
            return jsonResponse(null, 'Student was not found', 404);
        }

        if ($data->image_path) {
            $filePath = public_path('images/' . $data->image_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        Student::destroy($student_id);
        return jsonResponse($data, 'Student has been deleted', 200);
    }
}
