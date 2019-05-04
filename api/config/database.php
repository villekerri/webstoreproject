<?php
class Database{
    private $host = "localhost";
    private $db_name = "webstore";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=webstore", "root", "root");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        /*
        $this->conn = new mysqli($this->db_name, $this->username, $this->password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        */
        return $this->conn;
    }



}
?>
