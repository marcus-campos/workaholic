<?php

function reply(array $data, int $httpStatusCode = 200) {
    return [
        'status' => $httpStatusCode,
        'data' => $data
    ];
}