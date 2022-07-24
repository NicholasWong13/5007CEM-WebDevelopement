<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session= $_SESSION['customersSession'];
$appid=null;
$appdate=null;
if (isset($_GET['ScheduleDate']) && isset($_GET['appid'])) {
	$appdate =$_GET['ScheduleDate'];
	$appid = $_GET['appid'];
}
$res = mysqli_query($con,"SELECT a.*, b.* FROM carwashschedule a INNER JOIN customers b
WHERE a.ScheduleDate='$appdate' AND ScheduleId=$appid AND b.ic=$session");
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);


//INSERT
if (isset($_POST['appointment'])) {
$carNo = mysqli_real_escape_string($con,$userRow['ic']);
$ScheduleId = mysqli_real_escape_string($con,$appid);
$services = mysqli_real_escape_string($con,$_POST['services']);
$Comment = mysqli_real_escape_string($con,$_POST['Comment']);
$bookAvail = "notavail";


$query = "INSERT INTO appointment (  customerIc , ScheduleId , services , Comment  )
VALUES ( '$carNo', '$ScheduleId', '$services', '$Comment') ";

//update table appointment schedule
$sql = "UPDATE carwashschedule SET bookAvail = '$bookAvail' WHERE ScheduleId = $scheduleId" ;
$scheduleres=mysqli_query($con,$sql);
if ($scheduleres) {
	$btn= "disable";
} 


$result = mysqli_query($con,$query);
echo $result;
if( $result )
{
?>
<script type="text/javascript">
alert('Appointment made successfully.');
</script>
<?php
header("Location: customerapplist.php");
}
else
{
	echo mysqli_error($con);
?>
<script type="text/javascript">
alert('Appointment booking fail. Please try again.');
</script>
<?php
header("Location: customer.php");
}

}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Make Appointment</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/default/style.css" rel="stylesheet">
		<link href="assets/css/default/blocks.css" rcel="stylesheet">


		<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

	</head>
	<body>
		<!-- navigation -->
		<nav class="navbar navbar-default " role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="customer.php"><img alt="Brand" src="assets/img/logo.png" width="50px"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<ul class="nav navbar-nav">
							<li><a href="customer.php">Customer's Home</a></li>
							<li><a href="profile.php?customerId=<?php echo $userRow['ic']; ?>" >Profile</a></li>
							<li><a href="customerapplist.php?customerId=<?php echo $userRow['ic']; ?>">Appointment</a></li>
						</ul>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['FirstName']; ?> <?php echo $userRow['LastName']; ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									<a href="profile.php?customerId=<?php echo $userRow['ic']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
								</li>
								<li>
									<a href="customerapplist.php?customerId=<?php echo $userRow['ic']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="customerlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- navigation -->
		<div class="container">
			<section style="padding-bottom: 50px; padding-top: 50px;">
				<div class="row">
					<!-- start -->
					<!-- USER PROFILE ROW STARTS-->
					<div class="row">
						<div class="col-md-3 col-sm-3">
							
							<div class="user-wrapper">
								<img src="assets/img/1.jpg" class="img-responsive" />
								<div class="description">
									<h4><?php echo $userRow['FirstName']; ?> <?php echo $userRow['LastName']; ?></h4>
									<h5> <strong> Customer </strong></h5>
		
									<hr />
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-9 col-sm-9  user-wrapper">
							<div class="description">
								
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										
										<form class="form" role="form" method="POST" accept-charset="UTF-8">
											<div class="panel panel-default">
												<div class="panel-heading">Customer's Information</div>
												<div class="panel-body">
													
													Customers Name: <?php echo $userRow['FirstName'] ?> <?php echo $userRow['LastName'] ?><br>
													Customers IC: <?php echo $userRow['ic'] ?><br>
													Contact Number: <?php echo $userRow['Phone'] ?><br>
													Address: <?php echo $userRow['Address'] ?>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">Appointment Information</div>
												<div class="panel-body">
													Day: <?php echo $userRow['ScheduleDay'] ?><br>
													Date: <?php echo $userRow['ScheduleDate'] ?><br>
													Time: <?php echo $userRow['StartTime'] ?> - <?php echo $userRow['EndTime'] ?><br>
												</div>
											</div>
											
											<div class="form-group">
												<label for="services" class="control-label">Services:</label>
                                                                                                <select name="services" class = "form-control" required>
                                                                                                <option value="">Services</option>
                                                                                                <option value="Snow Wash With Vacuum">Snow Wash With Vacuum</option>
                                                                                                <option value="Full Car Detailing">Full Car Detailing</option>
                                                                                                <option value="Interior Car Detailing">Interior Car Detailing</option>
                                                                                                <option value="Exterior Car Detailing">Exterior Car Detailing</option>
                                                                                                <option value="Car Polish & Wax">Car Polish & Wax</option>
                                                                                                <option value="Car Ceramic Coating 9H">Car Ceramic Coating 9H</option>
                                                                                                <option value="Car Seat Cleaning">Car Seat Cleaning</option>
                                                                                                <option value="Windscreen & Window Coating">Windscreen & Window Coating</option>
                                                                                                <option value="Headlamp Restoration & Polishing">Headlamp Restoration & Polishing</option>
                                                                                                <option value="Rim & Wheel Coating">Rim & Wheel Coating</option>
                                                                                                <option value="Car Disinfection & Sanitizing">Car Disinfection & Sanitizing</option>
                                                                                                </select>
											</div>
											<div class="form-group">
												<label for="message-text" class="control-label">Comment:</label>
												<textarea class="form-control" name="Comment" required></textarea>
											</div>
											<div class="form-group">
												<input type="submit" name="appointment" id="submit" class="btn btn-primary" value="Make Appointment">
											</div>
										</form>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>

		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
	</body>
</html>
