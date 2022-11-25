<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->validate($data)) // check if the email and password exists in the database
        {
            $user = User::where('email', $data['email'])->first();

            return ['message' => 'logged in successfully', 'token'=> $user->createToken('apiLoginToken')->accessToken];
        }

        return ['message' => __('auth.failed')];

    }
}
