<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $token = $user->createToken('User')->plainTextToken;

        return response()->json(['token' => $token, 'message' => 'Token created sucessfully']);
    }

    public function getUser(Request $request)
    {
        $data = User::all();

        return response()->json($data);
    }

    public function deleteUser(Request $request, $id)
    {

        $data = User::find($id);
        $data->delete();

        return jsonResponse($data, 'It has been soft deleted', 200);
    }

    public function restore($id)
    {
        $data = USER::withTrashed()->find($id);
        $data->restore();
        return jsonResponse($data, 'Data has been restored successfully', 200);
    }
}
