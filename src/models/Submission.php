<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use LaJoie\modules\Response;
use PDOException;

class Submission extends Model
{
    public static function create($user, $experience, $document)
    {
        if ($user['status'] == 'SUSPENDED') {
            new Response(["message" => "This user is suspended"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }


        try {
            $query = "INSERT INTO submissions(user_id, experience, document) VALUES(:userId, :experience, :document)";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $user['id']);
            $stmt->bindParam('experience', $experience);
            $stmt->bindParam('document', $document);
            $stmt->execute();
            User::changeStatusToSuspend($user['id']);
            new Response(["message" => "Submission sent"], Response::$DATA_CREATED);
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
