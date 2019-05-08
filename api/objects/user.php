<?php
class User{
    private $conn;
    public $id;
    public $username;
    public $address;

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
        $query = "";
        $stmt = $this->conn->prepare($query);
        $this->firstname=htmlspecialchars(strip_tags($this->username));
        $this->email=htmlspecialchars(strip_tags($this->address));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam('sss', $this->firstname,$this->address,$password_hash);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }

    function emailExists(){
        $query = "";
        $stmt = $this->conn->prepare( $query );
        $this->email=htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->address = $row['address'];
            $this->password = $row['password'];
            return true;
        } else {
            return false;
        }
    }

    function readOne(){
        $query = "";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->name = $row['name'];
        $this->type = $row['type'];
        $this->price = $row['price'];
        $this->quantity = $row['quantity'];
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
