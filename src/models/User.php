<?php
namespace LaJoie\models;

use LaJoie\modules\Response;
use LaJoie\modules\Model;
use PDOException;

class User extends Model
{
    public static function getByEmail($email)
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            
            $stmt = self::prepare($query);
            $stmt->bindParam('email', $email);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            new Response(["message" => "User not found"], 500);
        }
    }

    public static function create($name, $username, $email, $password)
    {
        try {
            $query = "INSERT INTO users(name, username, email, password) VALUES(:name, :username, :email, :password)";
            $stmt = self::prepare($query);
            $stmt->bindParam('name', $name);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('email', $email);
            $stmt->bindParam('password', $password);
            $stmt->execute();
            new Response(["message" => "User Created"]);
        } catch (PDOException $e) {
            new Response($e->getMessage(), 500);
            exit();
        }
    }

    public static function changeStatusToSuspend($userId)
    {
        try {
            $query = "UPDATE users SET status='SUSPENDED' WHERE id = :userId";
            $stmt = self::prepare($query);
            $stmt->bindParam('userId', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            new Response($e->getMessage(), 500);
            exit();
        }
    }
}
