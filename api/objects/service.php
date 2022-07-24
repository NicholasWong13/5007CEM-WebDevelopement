<?php
class Service{
  
    // database connection and table name
    private $conn;
    private $table_name = "servicedata";
  
    // object properties
    public $id;
    public $servicename;
    public $description;
    public $filename;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
  
    // select query
    $query = "SELECT
                s.servicename, s.id, s.description, s.filename
            FROM
                " . $this->table_name . " s
                LEFT JOIN
                    servicedata s
                        ON s.id
            ORDER BY s.filename DESC
            LIMIT ?, ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
  
    // execute query
    $stmt->execute();
  
    // return values from database
    return $stmt;
}
// used for paging products
public function count(){
    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}

// read products
function read(){
  
    // select all query
    $query = "SELECT
                c.servicename as customer_name, p.id, p.servicename, p.description, p.filename
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    servicedata c
                        ON p.id = c.id
            ORDER BY
                p.filename DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
// create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                servicename=:servicename, description=:description, id=:id, filename=:filename";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->servicename=htmlspecialchars(strip_tags($this->servicename));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->filename=htmlspecialchars(strip_tags($this->filename));
  
    // bind values
    $stmt->bindParam(":servicename", $this->servicename);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":filename", $this->filename);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}
// used when filling up the update product form
function readOne(){
  
    // query to read single record
    $query = "SELECT
                c.servicename as customer_name, p.id, p.servicename, p.description, p.filename
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

// update the product
function update(){
  
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                servicename = :servicename,
                description = :description,
                filename = :filename
            WHERE
                id = :id";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->servicename=htmlspecialchars(strip_tags($this->servicename));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->filename=htmlspecialchars(strip_tags($this->filename));
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':customer_id', $this->filename);
    $stmt->bindParam(':id', $this->id);
  
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
// delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}
// search products
function search($keywords){
  
    // select all query
     $query = "SELECT
                c.servicename, p.id, p.servicename, p.description, p.filename
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    servicedata c
                        ON p.id = c.id
            ORDER BY
                p.filename DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $keywords=htmlspecialchars(strip_tags($keywords));
    $keywords = "%{$keywords}%";
  
    // bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
}


?>