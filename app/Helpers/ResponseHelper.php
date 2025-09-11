<?php

use Illuminate\Http\Exceptions\HttpResponseException;

if (!function_exists('successResponse')) {
    function successResponse(string $message = 'OK', $data = null, int $statusCode = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse(string $message, int $statusCode = 400, bool $throw = true)
    {
        $response = response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode);

        if ($throw) {
            throw new HttpResponseException($response);
        }

        return $response;
    }
}
