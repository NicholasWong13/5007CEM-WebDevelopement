<?php
session_start();

if(!isset($_SESSION['customersSession']))
{
 header("Location: customerdashboard.php");
}
else if(isset($_SESSION['customersSession'])!="")
{
 header("Location: ../index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['customersSession']);
 header("Location: ../index.php");
}
?>
