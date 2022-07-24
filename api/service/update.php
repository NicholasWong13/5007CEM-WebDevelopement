<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/service.php';
  
$database = new Database();
$db = $database->getConnection();
  
$service = new Service($db);

$data = json_decode(file_get_contents("php://input"));
  
$service->id = $data->id;

$service->servicename = $data->servicename;
$service->filename = $data->filename;
$service->description = $data->description;
  
if($service->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Service was updated."));
}
  
else{
  
    http_response_code(503);
  
    echo json_encode(array("message" => "Unable to update the service."));
}
?>
