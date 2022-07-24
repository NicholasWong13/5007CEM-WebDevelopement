<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
include_once '../objects/service.php';
  
$database = new Database();
$db = $database->getConnection();
  
$service = new Service($db);
  
$data = json_decode(file_get_contents("php://input"));
  
if(
    !empty($data->servicename) &&
    !empty($data->filename) &&
    !empty($data->id) &&
    !empty($data->description) 
){
  
    $service->servicename = $data->servicename;
    $service->id = $data->id;
    $service->filename = $data->filename;
    $service->description = $data->description;
  
    if($service->create()){
  
        http_response_code(201);
  
        echo json_encode(array("message" => "Services was created."));
    }
  
    else{
  
        http_response_code(503);
  
        echo json_encode(array("message" => "Unable to create the services."));
    }
}
  
else{
  
    http_response_code(400);
  
    echo json_encode(array("message" => "Unable to create services. Data is incomplete."));
}
?>
