<?php

use LaJoie\models\Question;
use LaJoie\modules\Auth;
use LaJoie\modules\Response;

require '../vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $user = Auth::guard();
    $userId =  $user['id'];
    Question::getHistory($userId);
} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
