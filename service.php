<?php

$user = 'root';
$password = '';
$database = 'nickcarwash';
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,$password, $database);
				
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM servicedata ORDER BY id ASC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Our Services </title>
        <link rel="shortcut icon" type="image/jpg" href="assets/img/favicon.jpg"/>
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/style1.css" rel="stylesheet">
        <link href="assets/css/blocks.css" rel="stylesheet">
        <link href="assets/css/footer.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
        <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
        <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

        <!--Font Awesome (added because you use icons in your prepend/append)-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <link href="assets/css/material.css" rel="stylesheet">
        <link href="assets/css/style3.css" rel="stylesheet">
    </head>
    <body>
          <?php include 'header.php';?>
        
         <h1>Our Services</h1>
    <br><br>
      <div class="container">
      <div class="details">
        <p>Our car wash offer the <b>best services</b> in Town.</p>
      </div> 
        <div class="main-box">
                    <?php
				while($rows=$result->fetch_assoc())
				{
			?>
    
        <div class="box box-grey">
            <img src="assets/img/<?php echo $rows['filename']; ?>" alt="" height="100" width="150">
            <h1><?php echo $rows['servicename'];?></h1>
          <hr>
          <p style="text-align:justify-all;"><?php echo $rows['description'];?></p>
          <a href="index.php">Read More</a>
        </div>
          
          <?php
				}
			?>
            
         <?php
				while($rows=$result->fetch_assoc())
				{
			?>
    
        <div class="box box-red">
            <img src="img/<?php echo $rows['filename']; ?>" alt="" height="100" width="150">
            <h2><?php echo $rows['servicename'];?></h2>
          <hr>
          <p style="text-align:justify-all;"><?php echo $rows['description'];?></p>
          <a href="service.html"  class="white-border">Read More</a>
        </div>
          
          <?php
				}
			?>
                    
      </div>
      </div>
    
    <?php include 'footer.html';?>
    
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
    })
    </script>
    <!-- date start -->
  
<script>
    $(document).ready(function(){
        var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })

    })

</script>
</body>

</html>

