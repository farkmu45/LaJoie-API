<?php
require_once('./modules/Auth.php');
require_once('./models/Question.php');

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
