<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HasApiResponse
{

    public function successResponse(array $data, int $code = 200): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'data'      => $data,
            'code'      => $code
        ], $code);
    }

    public function errorResponse(array $errors = [], int $code = 400): JsonResponse
    {
        return response()->json([
            'success'   => false,
            'errors'    => $errors,
            'code'      => $code
        ]);
    }

}
