<?php

class Connection
{
    public $db;
    private $host = 'sql310.unaux.com';
    private $username = 'unaux_30438663';
    private $password = 'maulana123';
    private $databaseName = 'unaux_30438663_lajoie';

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->databaseName", $this->username, $this->password);
        } catch (PDOException $e) {
            die();
        }
    }
}
