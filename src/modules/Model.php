<?php

namespace LaJoie\modules;
use LaJoie\modules\Connection;

class Model extends Connection
{
    public static function prepare($sql)
    {
        return Connection::getInstance()->getConnection()->prepare($sql);
    }
}
