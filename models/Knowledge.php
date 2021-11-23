<?php

require_once('./modules/Response.php');
require_once('./modules/Connection.php');

class Knowledge
{
    public static function getAll()
    {
        try {
            $con = new Connection();
            $query = "SELECT * FROM knowledges";
            $stmt = $con->db->prepare($query);
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
            $con = new Connection();
            $query = "SELECT * FROM knowledge_details WHERE knowledge_id = :id";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
