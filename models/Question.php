<?php


require_once('./modules/Response.php');
require_once('./modules/Connection.php');

class Question
{
    public static function getAll()
    {
        try {
            $con = new Connection();
            $query = "SELECT questions.id, questions.created_at, questions.title, questions.detail, users.name, users.username FROM questions INNER JOIN users ON questions.user_id = users.id";
            $stmt = $con->db->prepare($query);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function create($title, $detail, $userId)
    {

        try {
            $con = new Connection();
            $query = "INSERT INTO questions(title, detail, user_id) VALUES(:title, :detail, :userId)";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('title', $title);
            $stmt->bindParam('detail', $detail);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
            new Response("Data Created", Response::$DATA_CREATED);
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function getOne($id)
    {
        try {
            $con = new Connection();
            $query = "SELECT * FROM questions WHERE id = :id";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function getDetails($id)
    {
        try {
            $con = new Connection();
            $query = "SELECT * FROM questions WHERE questions.id = :id INNER JOIN response ON response.question_id = questions.id";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (\Throwable $th) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
