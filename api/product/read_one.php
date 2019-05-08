<?php
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
*/

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$product->id = isset($_GET['id']);
$product->readOne();
echo($product->id);

if($product->name!=null){
    $product_arr = array(
        "quantity" =>  $product->quantity,
        "name" => $product->name,
        "type" => $product->type,
        "price" => $product->price,
    );
    http_response_code(200);
    echo json_encode($product_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "Product does not exist."));
}
?>
