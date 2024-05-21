<?php
namespace app\core;


use app\libs\HttpStatusCodes;
use JsonException;

/**
 * Class Response
 *
 * @author  sdfarshid
 * @package app\core
 */
class Response
{
    protected array $return_other_data = [];

    /**
     * @throws JsonException
     */
    public function ApiResponse($data = NULL, $http_code = NULL): void
    {
        ob_start();
        header('content-type:application/json; charset=UTF-8');

        header( HttpStatusCodes::getHeaderStatusString($http_code), true, $http_code);

        print_r(json_encode(array_merge($data, $this->return_other_data), JSON_THROW_ON_ERROR));

        ob_end_flush();
        die();
    }


}