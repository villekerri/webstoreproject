<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));
$order->orderid = $data->orderid;

if($order->update()){
    echo json_encode(array("message" => "Status updated."));
}else{
    echo json_encode(array("message" => "Unable to update status."));
}
?>
