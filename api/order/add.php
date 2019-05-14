<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->productid) && !empty($data->orderquantity) && !empty($data->orderid)){
    $order->productid = $data->productid;
    $order->orderquantity = $data->orderquantity;
    $order->orderid = $data->orderid;
    if($order->addProrder()){
        echo json_encode(array("message" => "Productorder added to an order."));
    }else{
        echo json_encode(array("message" => "Unable to add productorder to an order."));
    }
}else{
    echo json_encode(array("message" => "Unable to add productorder to an order. Data is incomplete."));
}
?>
