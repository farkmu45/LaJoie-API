<?php

namespace App\modules;

use Dotenv\Dotenv;
use PDO;
use PDOException;


class Connection
{
    public $db;


    public function __construct()
    {
        if (file_exists(__DIR__ . '/.env')) {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();
        }

        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $databaseName = $_ENV['DB_NAME'];
        
        try {
            $this->db = new PDO("mysql:host=$host;dbname=$databaseName", $username, $password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
