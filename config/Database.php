<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'pos_db';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect()
    // cannot use a constructor for this because of https://stackoverflow.com/questions/19622038/fatal-error-call-to-undefined-method-databaseprepare
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
            $this->conn->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Connection error: '.$exception->getMessage();
        }

        return $this->conn;
    }
}
