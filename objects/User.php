<?php

class User
{
    //user properties
    public $user_id;
    public $username;
    public $email;
    public $password;
    public $role;

    //database properties
    private $conn;
    private $table_name = 'user';

    //constructor with database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {
        $query = 'SELECT * FROM '.$this->table_name.' WHERE email=? AND password=?';
        $result = $this->conn->prepare($query);
        //sanitize inputs
        $this->email = htmlspecialchars($this->email);
        $this->password = htmlspecialchars($this->password);
        //execute the query
        $result->bindParam(1, $this->email);
        $result->bindParam(2, $this->password);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            //assign user object values
            session_start();
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['role'] = $data['role'];

            return true;
        }

        return false;
    }
}
