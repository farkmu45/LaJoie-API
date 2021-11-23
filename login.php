<?php

require_once('./modules/Auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents('php://input'),true);
    $email = $body['email'];
    $password = $body['password'];
    Auth::login($email, $password);
} else {
    new Response(["message" => "Not found"], 404);
}

