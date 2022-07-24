<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (isset($_GET['appId'])) {
$appid=$_GET['appId'];
}
$res=mysqli_query($con, "SELECT a.*, b.*,c.* FROM customer a
JOIN appointment b
On a.ic = b.customerIc
JOIN carwashschedule c
On b.ScheduleId=c.ScheduleId
WHERE b.appId  =".$appid);

$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Nick's Car Wash Invoice</title>
        
        <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
    </head>
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="assets/img/logo.png" style="width:100%; max-width:300px;">
                                </td>
                                
                                <td>
                                    Invoice #: <?php echo $userRow['appId'];?><br>
                                    Created: <?php echo date("d-m-Y");?><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                    <?php echo $userRow['Address'];?>
                                </td>
                                
                                <td><?php echo $userRow['Ic'];?><br>
                                    <?php echo $userRow['FirstName'];?> <?php echo $userRow['LastName'];?><br>
                                    <?php echo $userRow['Email'];?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                
                
                <tr class="heading">
                    <td>
                        Appointment Details
                    </td>
                    
                    <td>
                        #
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        Appointment ID
                    </td>
                    
                    <td>
                       <?php echo $userRow['appId'];?>
                    </td>
                </tr>
                
                <tr class="item">
                    <td>
                        Schedule ID
                    </td>
                    
                    <td>
                        <?php echo $userRow['ScheduleId'];?>
                    </td>
                </tr>

                <tr class="item">
                    <td>
                        Appointment Day
                    </td>
                    
                    <td>
                        <?php echo $userRow['ScheduleDay'];?>
                    </td>
                </tr>
                

                 <tr class="item">
                    <td>
                        Appointment Date
                    </td>
                    
                    <td>
                        <?php echo $userRow['ScheduleDate'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Appointment Time
                    </td>
                    
                    <td>
                        <?php echo $userRow['StartTime'];?> until <?php echo $userRow['EndTime'];?>
                    </td>
                </tr>

                 <tr class="item">
                    <td>
                        Services:
                    </td>
                    
                    <td>
                        <?php echo $userRow['services'];?> 
                    </td>
                </tr>
                
                
                
            </table>
        </div>
        <div class="print">
        <button onclick="myFunction()">Print this page</button>
</div>
    <script>
    function myFunction() {
        window.print();
    }
    </script>
    </body>
</html>