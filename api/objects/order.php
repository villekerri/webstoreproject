<?php
class Order{
    private $conn;
    public $userid;
    public $productid;
    public $orderquantity;
    public $orderid;
    public $productorderid;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "select orders.orderid, orders.orderstatus, productorders.productorderid, products.productname, 
                  productorders.orderquantity, users.userid, users.address from users inner join orders on users.userid=orders.userid inner join productorders on 
                  orders.orderid=productorders.orderid inner join products on 
                  productorders.productid=products.productid order by orders.orderid, productorders.productorderid";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function read_one(){
        $query = "select orderid, orderstatus from orders where userid=:userid order by orderid desc";
        $stmt = $this->conn->prepare($query);
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $stmt->bindParam(":userid", $this->userid);
        $stmt->execute();
        return $stmt;
    }

    function read_cart(){
        $query = "select orders.orderid, orders.orderstatus, productorders.productorderid, products.productname, 
                  productorders.orderquantity from orders inner join productorders on 
                  orders.orderid=productorders.orderid inner join 
                  products on productorders.productid=products.productid where orders.userid=:userid and orders.orderstatus='Shopping cart'";
        $stmt = $this->conn->prepare($query);
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $stmt->bindParam(":userid", $this->userid);
        $stmt->execute();
        return $stmt;
    }

    function check_cart(){
        $query = "select orderid from orders where orderstatus='Shopping cart' and userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $stmt->bindParam(":userid", $this->userid);
        $stmt->execute();
        return $stmt;
    }

    function createShoppingCart(){
        $query = "INSERT INTO orders SET orderstatus='Shopping cart', userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $stmt->bindParam(":userid", $this->userid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function submitOrder(){
        $query = "update orders set orderstatus='Send' where orderstatus='Shopping cart' and userid=:userid";
        $stmt = $this->conn->prepare($query);
        $this->userid=htmlspecialchars(strip_tags($this->userid));
        $stmt->bindParam(":userid", $this->userid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function addProrder(){
        $query = "insert into productorders set productid=:productid, orderquantity=:orderquantity, orderid=:orderid";
        $stmt = $this->conn->prepare($query);
        $this->productid=$this->productid;
        $this->orderquantity=htmlspecialchars(strip_tags($this->orderquantity));
        $this->orderid=$this->orderid;
        $stmt->bindParam(":productid", $this->productid);
        $stmt->bindParam(":orderquantity", $this->orderquantity);
        $stmt->bindParam(":orderid", $this->orderid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function update(){
        $query = "update orders set orderstatus='Confirmed' where orderstatus='Send' and orderid=:orderid";
        $stmt = $this->conn->prepare($query);
        $this->orderid=htmlspecialchars(strip_tags($this->orderid));
        $stmt->bindParam(":orderid", $this->orderid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query = "DELETE FROM productorders WHERE orderid=:orderid";
        $stmt = $this->conn->prepare($query);
        $this->orderid=htmlspecialchars(strip_tags($this->orderid));
        $stmt->bindParam(":orderid", $this->orderid);
        if($stmt->execute()){
            $query = "DELETE FROM orders WHERE orderid=:orderid";
            $stmt = $this->conn->prepare($query);
            $this->orderid=htmlspecialchars(strip_tags($this->orderid));
            $stmt->bindParam(":orderid", $this->orderid);
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        return false;
    }

    function delete_part(){
        $query = "DELETE FROM productorders WHERE productorderid=:productorderid";
        $stmt = $this->conn->prepare($query);
        $this->productorderid=htmlspecialchars(strip_tags($this->productorderid));
        $stmt->bindParam(":productorderid", $this->productorderid);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>
