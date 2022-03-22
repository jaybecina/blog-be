<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests;

use App\Http\Requests\RegisterRequest;

use App\Models\User;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    /**
     * Registration Req
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'updated_at' => NULL
        ]);
  
        $token = $user->createToken('myAccount')->accessToken;
  
        return response()->json([
            'status' => 200,
            'data' => $user,
            'token' => $token
        ]);
    }
}
