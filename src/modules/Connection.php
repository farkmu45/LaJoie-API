<?php

namespace App\modules;

use PDO;
use PDOException;

class Connection
{
    public $db;
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $databaseName = 'lajoie';

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->databaseName", $this->username, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}
