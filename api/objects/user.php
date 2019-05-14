<?php
class User{
    private $conn;
    public $id;
    public $username;
    public $address;
    public $password;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM users;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "INSERT INTO users SET username = :username, address = :address, password = :password";
        $stmt = $this->conn->prepare($query);
        $this->firstname=htmlspecialchars(strip_tags($this->username));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":password", $password_hash);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function userExists(){
        $query = "SELECT userid, username, password FROM users WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $this->username=htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(1, $this->username);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['userid'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            return true;
        } else {
            return false;
        }
    }

    function delete(){
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
