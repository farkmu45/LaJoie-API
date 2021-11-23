<?php

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
            die();
        }
    }
}
