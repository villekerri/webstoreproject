<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$data = json_decode(file_get_contents("php://input"));
$order->userid = $data->userid;
$stmt = $order->read_cart();
$num = $stmt->rowCount();
if($num>0){

    $orders_arr=array();
    $orders_arr["orders_list"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $order_item=array(
            "id" => $orderid,
            "status" => $orderstatus,
            "productorderid" => $productorderid,
            "productname" => $productname,
            "orderquantity" => $orderquantity,
        );
        array_push($orders_arr["orders_list"], $order_item);
    }
    echo json_encode($orders_arr);
}else{
    $orders_arr=array();
    $orders_arr["orders_list"]=array();
    $order_item=array(
        "id" => "0",
        "status" => "Shopping cart",
        "productorderid" => "0",
        "productname" => "",
        "orderquantity" => "0",
        );
    array_push($orders_arr["orders_list"], $order_item);
    echo json_encode($orders_arr);
}
?>