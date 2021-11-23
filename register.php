<?php

require_once('./modules/Auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents('php://input'),true);
    $name = $body['name'];
    $username = $body['username'];
    $email = $body['email'];
    $password = $body['password'];
    Auth::register($name, $username, $email, $password);
} else {
    new Response(["message" => "Not found"], 404);
}

