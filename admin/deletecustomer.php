<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$ic = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM customers WHERE ic=$ic");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>
