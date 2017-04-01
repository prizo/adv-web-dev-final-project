<?php
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'login';
try{
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    // print("yadayda");
} catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
