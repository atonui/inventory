<?php

class Category
{
    public $cat_id;
    public $cat_name;

    private $conn;
    private $table_name = 'category';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createCategory()
    {
        $query = 'INSERT INTO ' . $this->table_name . ' (`cat_name`) VALUES (?)';
        $result = $this->conn->prepare($query);
        $this->cat_name = htmlspecialchars(strip_tags($this->cat_name));

        if ($result->execute([$this->cat_name])) {
            return true;
        } else {
            return false;
        }
    }

    public function checkCategory()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE cat_name LIKE ?';
        $result = $this->conn->prepare($query);
        $this->cat_name = htmlspecialchars(strip_tags($this->cat_name));
        $cat_name = "%{$this->cat_name}%";
        $result->bindParam(1, $cat_name);
        $result->execute();
        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllCategories()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getCartegory()
    {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE cat_id=' . $this->cat_id;
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function updateCategory()
    {
        $query = 'UPDATE ' . $this->table_name . ' SET cat_name=? WHERE cat_id=' . $this->cat_id;
        $result = $this->conn->prepare($query);
        $this->cat_name = htmlspecialchars(strip_tags($this->cat_name));
        if ($result->execute([$this->cat_name])) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE cat_id=?';
        $result = $this->conn->prepare($query);
        if ($result->execute(array($this->cat_id))) {
            return true;
        } else {
            return false;
        }
    }
}
