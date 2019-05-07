<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));
$order->orderid = $data->orderid;
/*
$poistettava->orderid = 3;
$order->orderid = $poistettava->orderid;
*/
if($order->delete()){
    echo json_encode(array("message" => "Order was deleted."));
}else{
    echo json_encode(array("message" => "Unable to delete order."));
}
?>