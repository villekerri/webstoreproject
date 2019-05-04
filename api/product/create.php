<?php
include_once '../config/database.php';
include_once '../objects/product.php';
 
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
 
$data = json_decode(file_get_contents("php://input"));
 
if(!empty($data->name) && !empty($data->type) && !empty($data->price) && !empty($data->quantity)){
    $product->name = $data->name;
    $product->price = $data->price;
    $product->type = $data->type;
    $product->quantity = $data->quantity;
    if($product->create()){
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
