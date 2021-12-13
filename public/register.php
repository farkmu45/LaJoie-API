<?php

require '../vendor/autoload.php';

use LaJoie\modules\Response;
use LaJoie\modules\Auth;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents('php://input'),true);
    $name = $body['name'];
    $username = $body['username'];
    $email = $body['email'];
    $password = $body['password'];
    Auth::register($name, $username, $email, $password);
} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}

