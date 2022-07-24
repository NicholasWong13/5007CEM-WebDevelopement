<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/service.php';
  
$database = new Database();
$db = $database->getConnection();
  

$service = new Service($db);
  
$service->id = isset($_GET['id']) ? $_GET['id'] : die();
  
$service->readOne();
  
if($service->servicename!=null){
    // create array
    $service_arr = array(
        "id" =>  $service->id,
        "name" => $service->servicename,
        "description" => $service->description,
        "filename" => $service->filename,
    );
  
   
    http_response_code(200);
 
    echo json_encode($service_arr);
}
  
else{
    http_response_code(404);
  
    echo json_encode(array("message" => "Service does not exist."));
}
?>
