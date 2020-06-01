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
            'password' => 'required|alpha_num',
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
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
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            $login = Auth::attempt($credentials);
            // Authentication passed...
            if ($login) {
                return [
                    'status' => 'success',
                    'user'   => Auth::user(),
                    'token'  => $this->token($request),
                ];
            } else {
                return response()->json(['status' => 'failed', 'error' => 'Fail to login'], 400);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'error' => $e->getMessage()], 400);
        }

    }

    protected function token(Request $request)
    {
        return base64_encode($request->email . ":" . $request->password);

    }

    public function me()
    {
        return Auth::user();

    }

}
