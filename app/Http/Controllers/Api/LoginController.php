<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if( !auth()->attempt( $data )) {
            return response(['message' => 'Invalid login credentials']);
        }

        $accessToken = auth()->user()->createToken('auth_token')->accessToken;

        return response([
            'status'        => 200,
            'user'          => auth()->user(), 
            'accessToken'   => $accessToken,
            'message'       => 'User logged in successfully'
        ]);
    }
}
