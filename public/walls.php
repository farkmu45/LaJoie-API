<?php

require '../vendor/autoload.php';

use LaJoie\models\Comment;
use LaJoie\modules\Auth;
use LaJoie\models\Question;
use LaJoie\modules\Response;

$body = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    Auth::guard();
    if (isset($_GET['id'])) {
        Question::getResponse($_GET['id']);
    } else {
        Question::getAll();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = Auth::guard();
    $userId =  $user['id'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (!Question::isIdValid($id)) {
            new Response(["message" => "Not found"], Response::$NOT_FOUND);
            exit();
        }
        $comment = $body['comment'];
        Comment::create($id, $userId, $comment);
    } else {
        $title = $body['title'];
        $detail = $body['detail'];
        Question::create($title, $detail, $userId);
    }
} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
