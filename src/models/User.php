<?php
namespace LaJoie\models;

use LaJoie\modules\Response;
use LaJoie\modules\Connection;
use PDO;
use PDOException;

class User
{
    public static function getByEmail($email)
    {
        try {
            $con = new Connection();
            $query = "SELECT * FROM users WHERE email = :email";
            
            $stmt = $con->db->prepare($query);
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
            $con = new Connection();
            $query = "INSERT INTO users(name, username, email, password) VALUES(:name, :username, :email, :password)";
            $stmt = $con->db->prepare($query);
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
}
