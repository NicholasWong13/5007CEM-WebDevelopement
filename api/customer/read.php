<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  

include_once '../config/database.php';
include_once '../objects/customer.php';
  

$database = new Database();
$db = $database->getConnection();
  
$customer = new Customer($db);
  
$stmt = $customer->read();
$num = $stmt->rowCount();
  

if($num>0){
  
    $customers_arr=array();
    $customers_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $customer=array(
            "ic" => $ic,
            "FirstName" => $FirstName,
            "LastName" => $LastName,
            "PhoneNumber" => $Phone,
            "CarModel" => html_entity_decode($CarModel)
        );
  
        array_push($customers_arr["records"], $customer);
    }

    http_response_code(200);
  
    echo json_encode($customers_arr);
}
  
else{
  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "No customer found.")
    );
}
?>
