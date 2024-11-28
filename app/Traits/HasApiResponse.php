<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait HasApiResponse
{

    public function successResponse(array|Collection|AnonymousResourceCollection $data, int $code = 200): JsonResponse
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
