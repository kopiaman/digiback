<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'    => 'required| email|unique:users',
            'password' => 'required|alpha_num|min:8',
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            return
            response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name'     => $request->name,
            'password' => Hash::make($request->password),
        ]);

        try {
            if ($user) {
                return ['status' => 'success', 'user' => $user];
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return ['status' => 'success', 'user' => Auth::user()];
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()]);
        }

    }

    public function me()
    {
        return Auth::user();

    }

}
