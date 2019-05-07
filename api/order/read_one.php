<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$order->userid = 2; //isset($_GET['userid']) ? $_GET['userid'] : die();
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
            "productorderid" => $productorderid,
            "product" => $productname,
            "quantity" => $orderquantity,
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

<script type="text/javascript">an_obj = "<?php echo $json_data;?>";</script>
<script type="text/javascript" src="webPages.js"></script>
