<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

$data = json_decode(file_get_contents("php://input"));
$order->productorderid = $data->productorderid;

if($order->delete_part()){
    echo json_encode(array("message" => "Prorder was deleted."));
}else{
    echo json_encode(array("message" => "Unable to delete prorder."));
}
?>
