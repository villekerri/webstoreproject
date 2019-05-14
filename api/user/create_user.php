<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

if (!$data->username) {
	http_response_code(500);
	echo json_encode(array("message" => "php://input was empty"));
}

$user->username = $data->username;
$user->address = $data->address;
$user->password = $data->password;

if($user->create()){
    http_response_code(200);
    echo json_encode(array("message" => "User was created."));
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create user."));
}
?>
