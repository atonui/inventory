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

    public function createUser()
    {
        if (!$this->checkUser()) {
            $query = 'INSERT INTO ' . $this->table_name . ' (`username`, `email`, `password`, `role`) VALUES (?,?,?,?)';
            $result = $this->conn->prepare($query);
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->role = htmlspecialchars(strip_tags($this->role));

            if ($result->execute([$this->username, $this->email, $this->password, $this->role])) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function checkUser()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE email=? LIMIT 1';
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function login()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE email=? AND password=?';
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

    //function to check passwords match, to return boolean
    public function check_passwords_match($Password)
    {
        $query = 'SELECT `password` FROM ' . $this->table_name . ' WHERE user_id=?';
        $result = $this->conn->prepare($query);
        $result->bindParam(1, $this->user_id);
        $result->execute();
        $dbPassword = $result->fetch();
        $dbPassword = $dbPassword['password'];
        if ($Password == $dbPassword) {
            return true;
        }

        return false;
    }

    public function update_password($newPassword)
    {
        $query = 'UPDATE ' . $this->table_name . ' SET `password`=? WHERE user_id=?';
        $result = $this->conn->prepare($query);
        // sanitize inputs
        $newPassword = htmlspecialchars($newPassword);
        $result->bindParam(1, $newPassword);
        $result->bindParam(2, $this->user_id);
        if ($result->execute()) {
            return true;
        }

        return false;
    }

    //function to change passwords

    // function to hash passwords

    // function to check password rules
}
