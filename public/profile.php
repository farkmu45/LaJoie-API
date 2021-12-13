<?php

use LaJoie\modules\Auth;
use LaJoie\modules\Response;

require '../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = Auth::guard();
    new Response($user, Response::$DATA_SENT);
} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
