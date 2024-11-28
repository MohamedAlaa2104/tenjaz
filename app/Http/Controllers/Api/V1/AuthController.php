<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Models\SubscriptionType;
use App\Models\User;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HasApiResponse;
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'subscription_type_id' => SubscriptionType::first()->id,
            'avatar' => fake()->imageUrl
        ]);

        return $this->successResponse(
            data: [
                'message' => 'User created successfully',
            ],
            code: 201
        );
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return $this->errorResponse(
                errors: [
                    'message' => 'Invalid login credentials'
                ],
                code: 401
            );
        }

        $user = auth()->user();

        $token = $user->createToken('API Token')->plainTextToken;

        return $this->successResponse(
            data: [
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ],
        );
    }


}
