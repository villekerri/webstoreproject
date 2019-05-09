<?php
class Product{
    private $conn;
    public $productname;
    public $producttype;
    public $productprice;
    public $productquantity;

    public $productid;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function createProduct(){
        $query = "INSERT INTO products SET productname=:productname, producttype=:producttype, productprice=:productprice, productquantity=:productquantity";
        $stmt = $this->conn->prepare($query);
        $this->productname=htmlspecialchars(strip_tags($this->productname));
        $this->producttype=htmlspecialchars(strip_tags($this->producttype));
        $this->productprice=htmlspecialchars(strip_tags($this->productprice));
        $this->productquantity=htmlspecialchars(strip_tags($this->productquantity));
        $stmt->bindParam(":productname", $this->productname);
        $stmt->bindParam(":producttype", $this->producttype);
        $stmt->bindParam(":productprice", $this->productprice);
        $stmt->bindParam(":productquantity", $this->productquantity);
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
        $query = "DELETE FROM productorders WHERE productid=?";
        $stmt = $this->conn->prepare($query);
        $this->productid=htmlspecialchars(strip_tags($this->productid));
        $stmt->bindParam(1, $this->productid);
        $stmt->execute();
        $query = "DELETE FROM products WHERE productid=?";
        $stmt = $this->conn->prepare($query);
        $this->productid=htmlspecialchars(strip_tags($this->productid));
        $stmt->bindParam(1, $this->productid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>
