<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/database.php';
include_once '../objects/service.php';
  
$database = new Database();
$db = $database->getConnection();
  
$service = new Service($db);
  

$stmt = $service->read();
$num = $stmt->rowCount();
  

if($num>0){
  
    $service_arr=array();
    $service_arr["records"]=array();
  
   
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
  
        $service_item=array(
            "id" => $id,
            "servicename" => $servicename,
            "description" => html_entity_decode($description),
            "filename" => $filename
        );
  
        array_push($service_arr["records"], $service_item);
    }
  
    http_response_code(200);
  
    echo json_encode($service_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No services found.")
    );
}
?>
