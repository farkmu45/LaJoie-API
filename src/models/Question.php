<?php

namespace LaJoie\models;

use LaJoie\modules\Model;
use LaJoie\modules\Response;
use PDO;
use PDOException;

class Question extends Model
{
    public static function getAll()
    {
        try {
            $query = "SELECT questions.id, CONVERT_TZ(questions.created_at, '+00:00','+7:00') AS created_at, questions.title, questions.detail, users.name, users.username, users.picture 
                        FROM questions 
                        INNER JOIN users ON questions.user_id = users.id 
                        WHERE questions.status = 'APPROVED'
                        ORDER BY created_at DESC";
            $stmt = self::prepare($query);
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
            $query = "INSERT INTO questions(title, detail, user_id) VALUES(:title, :detail, :userId)";
            $stmt = self::prepare($query);
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
            $query = "SELECT id FROM questions WHERE id = :id";
            $stmt = self::prepare($query);
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
            $query = "SELECT responses.*, users.picture, users.username, users.user_type_id 
            FROM responses 
            INNER JOIN users ON responses.user_id = users.id 
            WHERE question_id = :id ORDER BY users.user_type_id DESC, responses.created_at ASC";
            
            $stmt = self::prepare($query);
            $stmt->bindParam('id', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                new Response([], Response::$DATA_SENT);
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
            $query = "SELECT * FROM questions WHERE user_id = :userId";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
            new Response($stmt->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], Response::$INTERNAL_SERVER_ERROR);
            exit();
        }
    }
}
