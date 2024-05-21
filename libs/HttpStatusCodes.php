<?php

namespace app\libs;

class HttpStatusCodes
{
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_BAD_PARAM = 422;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_OK = 200;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    const HEADER_STATUS_STRINGS = [
        '405' => 'HTTP/1.1 405 Method Not Allowed',
        '400' => 'HTTP/1.1 400 Bad Request',
        '408' => 'HTTP/1.1 408 Request Timeout',
        '404' => 'HTTP/1.1 404 Not Found',
        '402' => 'HTTP/1.1 402 Payment Required',
        '422' => 'HTTP/1.1 422 Unprocessable Entity',
        '401' => 'HTTP/1.1 401 Unauthorized',
        '200' => 'HTTP/1.1 200 OK',
        '500' => 'HTTP/1.1 500 Internal Server Error',

    ];


    public static function getHeaderStatusString(int $http_code){

        return self::HEADER_STATUS_STRINGS[$http_code];

    }


}