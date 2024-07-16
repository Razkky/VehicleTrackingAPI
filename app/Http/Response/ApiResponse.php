<?php
namespace App\Http\Response;
use Illuminate\Http\JsonResponse;


class ApiResponse {
    /**
     * Generate a standardized API response.
     *
     * @param string $status
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @param string $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function json(string $status, int $code, string $message='', $data = [], string $error = '')
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'error' => $error,
        ], $code);
    }
}
