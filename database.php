<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pos_db';

try {
    $connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
