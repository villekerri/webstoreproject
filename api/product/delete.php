<?php
include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));
$product->productid = $data->productid;
/*
$poistettava->productid = 7;
$product->productid = $uusidata->productid;
*/
if($product->delete()){
    http_response_code(200);
    echo json_encode(array("message" => "Product was deleted."));
}
else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete product."));
}
?>
