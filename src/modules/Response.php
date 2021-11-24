<?php

namespace LaJoie\modules;

class Response
{
    public static $DATA_CREATED =  201;
    public static $DATA_UDPATED = 203;
    public static $DATA_DELETED = 205;
    public static $DATA_SENT = 200;
    public static $INTERNAL_SERVER_ERROR = 500;
    public static $NOT_AUTHENTICATED = 401;
    public static $NOT_AUTHORIZED = 403;

    public function __construct($data, $httpCode = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpCode);
        echo json_encode($data);
    }
}
