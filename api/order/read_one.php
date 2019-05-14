<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
$order->userid = $data->userid;
$stmt = $order->read_one();
$num = $stmt->rowCount();

if($num>0){
    $orders_arr=array();
    $orders_arr["orders_list"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $order_item=array(
            "id" => $orderid,
            "status" => $orderstatus,
        );
        array_push($orders_arr["orders_list"], $order_item);
    }
    http_response_code(200);
    echo json_encode($orders_arr);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "No orders found."));
}
?>
