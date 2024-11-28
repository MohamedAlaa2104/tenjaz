<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Requests\Api\V1\User\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasApiResponse;

    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return $this->successResponse(
            data: $this->userRepository->getAll()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $this->userRepository->create($request->validated());

        return $this->successResponse(
            data: [
                'message' => 'User created successfully'
            ],
            code: 201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userRepository->getById($id);

        return $this->successResponse(
            data: [
                'user' => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {
            $user = $this->userRepository->update(
                attributes: $request->validated(),
                id: $id
            );
        }catch (\Exception $exception){
            return $this->errorResponse(
                errors: [
                    'message' => $exception->getMessage(),
                ],
                code: $exception->getCode()
            );
        }

        return $this->successResponse(
            data: [
                'message' => 'User updated successfully',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->userRepository->delete($id);
        }catch (\Exception $exception){
            return $this->errorResponse(
                errors: [
                    'message' => $exception->getMessage(),
                ],
                code: $exception->getCode()
            );
        }

        return $this->successResponse(
            data: [],
            code: 204
        );
    }
}
