<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    /**
     * @param int $statusCode
     * @param array|Model $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(int $statusCode = 200, $data = [], $message = '')
    {
        return response()->json([
            'success' => $statusCode == 200,
            'message' => $statusCode == 200 && !$message ? 'Success' : $message,
            'data' => $data,
        ], $statusCode);
    }
}
