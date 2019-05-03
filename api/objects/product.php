<?php
class Product{
    private $conn;
    public $id;
    public $name;
    public $type;
    public $price;
    public $quantity;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM products;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function create(){
        $query = "";
        $stmt = $this->conn->prepare($query);
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->type=htmlspecialchars(strip_tags($this->type));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":type", $this->type);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":quantity", $this->quantity);
        if($stmt->execute()){
            return true;
        }
        return false;
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
