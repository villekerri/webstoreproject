<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
$order->userid = $data->userid;
$stmt = $order->check_cart();
$num = $stmt->rowCount();
if($num>0){
    echo json_encode(array("message" => "Shopping cart found."));
}else{
    if($order->createShoppingCart()){
        echo json_encode(array("message" => "Shopping cart was created."));
    }else{
        echo json_encode(array("message" => "Unable to create shopping cart."));
    }
}
?>