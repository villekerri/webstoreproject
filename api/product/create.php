<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->productname) && !empty($data->producttype) && !empty($data->productprice) && !empty($data->productquantity)){
    $product->productname = $data->productname;
    $product->productprice = $data->productprice;
    $product->producttype = $data->producttype;
    $product->productquantity = $data->productquantity;
    if($product->createProduct()){
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>
