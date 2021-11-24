<?php

require '../vendor/autoload.php';

use LaJoie\modules\Response;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    new Response(["message" => "Welcome to LaJoie API!"]);
} else {
    new Response(["message" => "Not found"], 404);
}