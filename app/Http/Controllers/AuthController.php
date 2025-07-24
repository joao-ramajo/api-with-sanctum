<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // valida a requisição
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        // login
        $email = $request->input('email');
        $password = $request->input('password');
        $attempt = auth()->attempt(
            [
                'email' => $email,
                'password' => $password
            ]
        );

        if (!$attempt) {
            // return response()
            //     ->json(
            //         [
            //             'status' => 'ok',
            //             'error' => 'Unauthorized'
            //         ],
            //         401
            //     );

            return ApiResponse::unauthrized();
        }

        // authenticate user

        $user =  auth()->user();


        // verifica se o token é válido
        // $token = $user->createToken($user->name)->plainTextToken;

        // definindo tempo de expiração do token para uma hora após sua crição 
        $token =  $user->createToken($user->name, ['*'], now()->addHour())->plainTextToken;

        // retorna o token da api 

        // return response()
        //     ->json(
        //         [
        //             'token' => $token
        //         ],
        //         200
        //     );
        return ApiResponse::success(['user' => $user->name, 'email' => $user->email, 'token' => $token]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success('Logout with success');
    }
}
