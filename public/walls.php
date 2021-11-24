<?php

require '../vendor/autoload.php';

use App\modules\Auth;
use App\models\Question;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    Auth::guard();
    Question::getAll();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId =  Auth::guard();
    $body = json_decode(file_get_contents('php://input'), true);
    $title = $body['title'];
    $detail = $body['detail'];

    Question::create($title, $detail, $userId);
}
