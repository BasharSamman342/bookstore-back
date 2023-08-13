<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {


            return $this->success('Login successfully', [
                'user'=> auth()->user(),
//                'user'=> new UserResource(auth()->user()),
                'token'=> auth()->user()->createToken('LaravelAuthApp')->plainTextToken
            ]);
        } else {
            return $this->failure('Unauthorised', Response::HTTP_UNAUTHORIZED);
        }
    }
}
