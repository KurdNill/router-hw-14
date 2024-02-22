<?php

function json_response(int $code = 200, array $data = []): string
{
    header_remove();
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    header("Content-Type: application/json", true, $code);

    $statuses = [
        200 => '200 OK',
        400 => '400 Bad Request',
        403 => '403 Forbidden',
        422 => '422 Unprocessable Entity',
        500 => '500 Internal Server Error'
    ];

    header("Status: $statuses[$code]");

    return json_encode(['code' => $code, 'status' => $statuses[$code], ...$data]);
}