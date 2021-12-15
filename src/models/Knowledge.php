<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use LaJoie\modules\Response;
use PDO;
use PDOException;

class Knowledge extends Model
{
    public static function getAll()
    {
        try {
            $query = "SELECT * FROM knowledges";
            $stmt = self::prepare($query);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function getDetail($id)
    {
        try {
            $query = "SELECT * FROM knowledge_details WHERE knowledge_id = :id";
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
