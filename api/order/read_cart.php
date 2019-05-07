<?php
include_once '../config/database.php';
include_once '../objects/order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);
$order->userid = isset($_GET['userid']) ? $_GET['userid'] : die();
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
        );
        array_push($orders_arr["orders_list"], $order_item);
    }
    echo json_encode($orders_arr);
}else{
    echo json_encode(array("message" => "Shopping cart is empty."));
}
?>

<script type="text/javascript">an_obj = "<?php echo $json_data;?>";</script>
<script type="text/javascript" src="webPages.js"></script>