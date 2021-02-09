<?php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success(string $message, $data=[], int $status = 200)
    {
        return response()->json([
            'message' => $message,
            'errors' => [],
            'data' => $data,
        ], $status);
    }

    public static function error(string $message, array $errors=[], int $status = 400, $data=[])
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ], $status);
    }
}
