<?php
class Customer{
  
    private $conn;
    private $table_name = "customers";

    public $ic;
    public $FirstName;
    public $LastName;
    public $CarModel;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    public function readAll(){
        //select all data
        $query = "SELECT
                    ic, FirstName,LastName, Phone, CarModel
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
    
public function read(){
  
    //select all data
    $query = "SELECT
                ic,  FirstName, LastName,Phone, CarModel
            FROM
                " . $this->table_name . "
            ORDER BY
                FirstName";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    return $stmt;
}

function create(){
  
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                FirstName=:FirstName, LastName=:LastName, ic=:ic, CarModel=:CarModel";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->FirstName=htmlspecialchars(strip_tags($this->FirstName));
    $this->LastName=htmlspecialchars(strip_tags($this->LastName));
    $this->ic=htmlspecialchars(strip_tags($this->ic));
    $this->Phone=htmlspecialchars(strip_tags($this->Phone));
    $this->CarModel=htmlspecialchars(strip_tags($this->CarModel));
  
    // bind values
    $stmt->bindParam(":FirstName", $this->FirstName);
    $stmt->bindParam(":LastName", $this->LastName);
    $stmt->bindParam(":ic", $this->ic);
    $stmt->bindParam(":Phone", $this->Phone);
    $stmt->bindParam(":CarModel", $this->CarModel);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}

function readOne(){
  
    // query to read single record
    $query = "SELECT
                c.customername as customer_name, p.ic, p.servicename, p.description, p.filename
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    servicedata c
                        ON p.id = c.id
            WHERE
                p.id = ?
            LIMIT
                0,1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->servicename = $row['servicename'];
    $this->description = $row['description'];
    $this->filename = $row['filename'];
}

function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE ic = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->ic=htmlspecialchars(strip_tags($this->ic));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->ic);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
}
?>
