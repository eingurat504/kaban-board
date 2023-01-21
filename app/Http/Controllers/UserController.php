<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function authenticate()
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
                $user_info = [
                    'token' => Auth::user()->createToken('MyApp')->accessToken,
                    'user' => Auth::user()->name
                ];
    
            return response()->json(['user' => $$user_info]);
        }

        return response()->json(['error' => 'Unauthorised'], 401);
    }

    /**
     * register user
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user_info = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $user = User::create($user_info);

        $user_details = [
            'token' => $user->createToken('MyApp')->accessToken,
            'user'  => $user
        ];

        return response()->json(['user' => $user_details]);
    }
}
