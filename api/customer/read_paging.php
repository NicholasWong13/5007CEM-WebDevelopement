<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/service.php';
  

$utilities = new Utilities();
  
$database = new Database();
$db = $database->getConnection();
  
$service = new Service($db);
  
$stmt = $service->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
if($num>0){
  
    $service_arr=array();
    $service_arr["records"]=array();
    $service_arr["paging"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
  
        $service_item=array(
            "id" => $id,
            "servicename" => $servicename,
            "description" => html_entity_decode($description),
            "filename" => $filename,
        );
  
        array_push($service_arr["records"], $service_item);
    }
  

    $total_rows=$service->count();
    $page_url="{$home_url}service/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $service_arr["paging"]=$paging;

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
