<?php

require '../vendor/autoload.php';

use LaJoie\modules\Auth;
use LaJoie\modules\Response;
use LaJoie\models\Submission;
use LaJoie\models\User;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = Auth::guard();

    $experience = $_POST['experience'];
    $docName = $_FILES['document']['name'];
    $docLocation = $_FILES['document']['tmp_name'];
    $docSize = $_FILES['document']['size'];

    $fileExt = strtolower(pathinfo($docName, PATHINFO_EXTENSION));
    $uploadPath = 'images/documents/';
    $document = uniqid() .'.'. $fileExt;
    Submission::create($user, $experience, $uploadPath.$document);
    move_uploaded_file($docLocation, $uploadPath . $document);

} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
