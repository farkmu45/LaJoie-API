<?php

namespace LaJoie\models;

use LaJoie\modules\Response;
use LaJoie\modules\Connection;
use PDO;
use PDOException;

class Question
{
    public static function getAll()
    {
        try {
            $con = new Connection();
            $query = "SELECT questions.id, questions.created_at, questions.title, questions.detail, users.name, users.username FROM questions INNER JOIN users ON questions.user_id = users.id WHERE questions.status = 'APPROVED'";
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
            new Response(["message" => "Question sent"], Response::$DATA_CREATED);
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function isIdValid($id)
    {
        try {
            $con = new Connection();
            $query = "SELECT id FROM questions WHERE id = :id";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function getResponse($id)
    {
        try {
            $con = new Connection();
            $query = "SELECT responses.*, users.username, users.user_type_id FROM responses INNER JOIN users ON responses.user_id = users.id WHERE question_id = :id";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                new Response(["message" => "Not found"], Response::$NOT_FOUND);
                exit();
            } else {
                new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
            }
        } catch (PDOException $e) {
            new Response(["message" => $e->getMessage()], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }

    public static function getHistory($userId)
    {
        try {
            $con = new Connection();
            $query = "SELECT * FROM questions WHERE user_id = :userId";
            $stmt = $con->db->prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
