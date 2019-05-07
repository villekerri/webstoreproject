<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

//$data = json_decode(file_get_contents("php://input"));
//$product->id = $data->id;
$poistettava->orderid = 3;
$poistettavajson = json_encode($poistettava);
$uusidata = json_decode($poistettavajson);
$order->orderid = $uusidata->orderid;

if($order->delete()){
    echo json_encode(array("message" => "Order was deleted."));
}else{
    echo json_encode(array("message" => "Unable to delete order."));
}
?>