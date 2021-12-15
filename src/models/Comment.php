<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use LaJoie\modules\Response;
use PDOException;

class Comment extends Model
{
    public static function create($questionId, $userId, $comment)
    {
        try {
            $query = "INSERT INTO responses(user_id, question_id, comment) VALUES(:userId, :questionId, :comment)";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->bindParam('questionId', $questionId);
            $stmt->bindParam('comment', $comment);
            $stmt->execute();
            new Response(["message" => "Data Created"], Response::$DATA_CREATED);
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
