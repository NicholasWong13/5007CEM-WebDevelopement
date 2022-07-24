<?php

include_once 'assets/conn/dbconnect.php';
$q = $_GET['q'];
//echo $q;
$res = mysqli_query($con,"SELECT * FROM carwashschedule WHERE ScheduleDate='$q'");

if (!$res) {
die("Error running $sql: " . mysqli_error());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
     <?php 

        if (mysqli_num_rows($res)==0) {

            echo "<div class='alert alert-danger' role='alert'>Nick's Car Wash Services is not available at the moment. Please try again later.</div>";
                
            } else {
             echo "   <table class='table table-hover'>";
        echo " <thead>";
            echo " <tr>";
                echo " <th>Day</th>";
                echo " <th>Date</th>";
               echo "  <th>Start</th>";
               echo "  <th>End</th>";
                echo " <th>Availability</th>";
            echo " </tr>";
       echo "  </thead>";
       echo "  <tbody>";

         while($row = mysqli_fetch_array($res)) { 

            ?>

            <tr>
                <?php

                // $avail=null;
                if ($row['bookavail']!='available') {
                $avail="danger";
                } else {
                $avail="primary";
                
            }
                echo "<td>" . $row['ScheduleDay'] . "</td>";
                echo "<td>" . $row['ScheduleDate'] . "</td>";
                echo "<td>" . $row['StartTime'] . "</td>";
                echo "<td>" . $row['EndTime'] . "</td>";
                echo "<td> <span class='label label-".$avail."'>". $row['bookavail'] ."</span></td>";
                ?>
            </tr>
        <?php
    }
}
    ?>
        </tbody>
    </body>
</html>
