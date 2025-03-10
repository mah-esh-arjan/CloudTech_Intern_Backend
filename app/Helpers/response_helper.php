<?php

if (!function_exists('jsonResponse')) {

    function jsonResponse($data = null, $message = '', $status = 2000)
    {

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
