<?php

function reply($data, int $httpStatusCode = 200) {
    if(!is_array($data)) {
        $data = array($data);
    }

    if(array_key_exists('headers', $data) && array_key_exists('data', $data)) {
        return response()->json([
            'status' => $httpStatusCode,
            'data' => $data['data']
        ], $httpStatusCode)->withHeaders($data['headers']);
    }

    return response()->json([
        'status' => $httpStatusCode,
        'data' => $data
    ], $httpStatusCode);
}