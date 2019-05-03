<?php
class Database{
    private $host = "localhost";
    private $db_name = "webstoredatabase";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection(){
        $this->conn = new mysqli($this->db_name, $this->username, $this->password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $this->conn;
    }
}
?>