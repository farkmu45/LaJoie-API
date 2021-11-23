<?php

require_once('./models/Knowledge.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {
        Knowledge::getDetail($_GET['id']);
    } else {
        Knowledge::getAll();
    }
    
} else {
    new Response(["message" => "Not found"], 404);
}
