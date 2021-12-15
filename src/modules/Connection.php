<?php

namespace LaJoie\modules;

use Dotenv\Dotenv;
use PDO;
use PDOException;


class Connection
{
    private static $con;

    private static $instance = null;

    private function __construct() {
        if (file_exists(__DIR__ . '/.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
        }

        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $databaseName = $_ENV['DB_NAME'];
        
        try {
            self::$con = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return self::$con;
    }

}
