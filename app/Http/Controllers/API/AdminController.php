<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
            return jsonResponse(null, 'No admin Was Found', 404);
        }

        if (!Hash::check($request->password, $admin->password)) {
            return jsonResponse(null, 'Password is not correct', 401);
        }

        $token = $admin->createToken('Admin')->plainTextToken;

        return jsonResponse($token, 'Token has been created successfully', 201);
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
