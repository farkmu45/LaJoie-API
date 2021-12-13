<?php

require '../vendor/autoload.php';

use LaJoie\models\Knowledge;
use LaJoie\modules\Response;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        Knowledge::getDetail($_GET['id']);
    } else {
        Knowledge::getAll();
    }
} else {
    new Response(["message" => "Not found"], Response::$NOT_FOUND);
}
