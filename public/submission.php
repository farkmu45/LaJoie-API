<?php

require '../vendor/autoload.php';

use LaJoie\modules\Auth;
use LaJoie\modules\Response;
use LaJoie\models\Submission;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = Auth::guard();
    $body = json_decode(file_get_contents('php://input'), true);

    $experience = $body['experience'];
    $document = $body['document'];


    // $fileExt = strtolower(pathinfo($docName, PATHINFO_EXTENSION));
    // $uploadPath = 'images/documents/';
    // $document = uniqid() .'.'. $fileExt;
    Submission::create($user, $experience, $document);
    // move_uploaded_file($docLocation, $uploadPath . $document);

} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
