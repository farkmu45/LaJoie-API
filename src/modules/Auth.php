<?php

namespace LaJoie\modules;

use LaJoie\models\User;
use PDO;
use PDOException;


class Auth
{
    public static function login($email, $password)
    {
        try {
            $stmt = User::getByEmail($email);
            if ($stmt->rowCount() == 0) {
                new Response(["message" => "User not found"], 401);
                return;
            }
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $data = $user['email'] . ":" . $password;
                new Response([
                    'token' => base64_encode($data)
                ]);
            } else {
                new Response(["message" => "User not found"], 401);
            }
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], 500);
            exit();
        }
    }

    public static function register($name, $username, $email, $password)
    {

        User::create($name, $username, $email, password_hash($password, PASSWORD_BCRYPT));
    }

    public static function guard()
    {
        try {
            $email = $_SERVER["PHP_AUTH_USER"] ?? null;
            $password = $_SERVER['PHP_AUTH_PW'] ?? null;
            $stmt = User::getByEmail($email);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user) {
                new Response(["message" => "Not authenticated"], 401);
                exit();
            }

            if (password_verify($password, $user['password'])) {
                return $user['id'];
            }
        } catch (PDOException $e) {
            new Response(["message" => "Internal server error"], 500);
            exit();
        }
    }
}
