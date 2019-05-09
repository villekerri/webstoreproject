<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
$order->userid = $data->userid;

if($order->read_cart()){
    if($order->submitOrder()){
        echo json_encode(array("message" => "Shopping cart submitted."));
        if($order->createShoppingCart()){
            echo json_encode(array("message" => "Shopping cart was created."));
        }else{
            echo json_encode(array("message" => "Unable to create shopping cart."));
        }
    }
    else{
        echo json_encode(array("message" => "Unable to submit."));
    }
}else{
    echo json_encode(array("message" => "Unable to create order."));
}
?>