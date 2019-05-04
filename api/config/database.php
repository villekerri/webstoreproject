<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database{
    public $conn;

    public function getConnection(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=webstore','root','root');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully<br>";
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
}
?>
