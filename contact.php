<?php
if (! empty($_POST["send"])) {
    $txtName = $_POST["txtName"];
    $txtEmail = $_POST["txtEmail"];
    $txtPhone = $_POST["txtPhone"];
    $txtSubject = $_POST["txtSubject"];
    $content = $_POST["content"];
    $conn = mysqli_connect("localhost", "root", "", "nickcarwash") or die("Connection Error: " . mysqli_error($conn));
    $stmt = $conn->prepare("INSERT INTO contactdata (txtName, txtEmail, txtPhone, txtSubject, content) VALUES (?, ?, ?, ?, ?)");
    $result=$stmt->bind_param($txtName, $txtEmail, $txtPhone, $txtSubject, $content);
    $stmt->execute();
    $message = "Your contact information is saved successfully.";
    $type = "success";
    $stmt->close();
    $conn->close();
}
require_once "contact.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Us </title>
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
        <style>

.form-container {
    background: #f1ecdf;
    border: #e2ddd2 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-bottom: 20px;
}

.input-row label {
    color: #75726c;
}

.input-field {
    width: 100%;
    border-radius: 2px;
    padding: 10px;
    border: #e0dfdf 1px solid;
    box-sizing: border-box;
    margin-top: 2px;
}

.span-field {
    font: Arial;
    font-size: small;
    text-decoration: none;
}

.btn-submit {
    padding: 10px 60px;
    background: #9e9a91;
    border: #8c8880 1px solid;
    color: #ffffff;
    font-size: 0.9em;
    border-radius: 2px;
    cursor: pointer;
}

.errorMessage {
    background-color: #e66262;
    border: #AA4502 1px solid;
    padding: 5px 10px;
    color: #FFFFFF;
    border-radius: 3px;
}

.successMessage {
    background-color: #9fd2a1;
    border: #91bf93 1px solid;
    padding: 5px 10px;
    color: #3d503d;
    border-radius: 3px;
    cursor: pointer;
    font-size: 0.9em;
}

.info {
    font-size: .8em;
    color: #e66262;
    letter-spacing: 2px;
    padding-left: 5px;
}</style>
    </head>
    <body>
         <?php include 'header.php';?>
          <form name="frmContact" id="" frmContact"" method="post"
            action="" enctype="multipart/form-data"
            onsubmit="return validateContactForm()">
        <div class="container my-4">

    <section class="my-5">

      <h2 class="h1-responsive font-weight-bold text-center my-5">Contact Us</h2>

      <p class="text-center w-responsive mx-auto pb-5">We love feedback. Fill out the form below and we'll get back to you as soon as possible.</p>

      <div class="row">

        <div class="col-lg-5 mb-lg-0 mb-4">

          <div class="card">
            <div class="card-body">
           
 
              <div class="form-header blue accent-1">
                <h3 class="mt-2"><i class="fas fa-envelope"></i> Send Us a Message:</h3>
              </div>
             
            <fieldset>
      <div class="input-row">
                <label style="padding-top: 20px;">Name</label> <span id="txtName" class="info"></span><br /> <input
                    type="text" class="input-field" name="txtName"
                    id="txtName" />
            </div>
            <div class="input-row">
                <label>Email</label> <span id="txtEmail"
                    class="info"></span><br /> <input type="text"
                    class="input-field" name="txtEmail" id="txtEmail" />
            </div>
                <div class="input-row">
                <label>Phone</label> <span id="txtPhone"
                    class="info"></span><br /> <input type="text"
                    class="input-field" name="txtPhone" id="txtPhone" />
            </div>
            <div class="input-row">
                <label>Subject</label> <span id="txtSubject"
                    class="info"></span><br /> <input type="text"
                    class="input-field" name="txtSubject" id="txtSubject" />
            </div>
            <div class="input-row">
                <label>Message</label> <span id="content"
                    class="info"></span><br />
                <textarea name="content" id="content"
                    class="input-field" cols="60" rows="6"></textarea>
            </div>
            <div>
                <input type="submit" name="send" class="btn-submit"
                    value="Send" />
      <div id="statusMessage"> 
                        <?php
                        if (! empty($message)) {
                            ?>
                            <p class='<?php echo $type; ?>Message'><?php echo $message; ?></p>
                        <?php
                        }
                        ?>
                    </div>
  </fieldset>
            </div>
          </div>
</form>
        </div>
          
            <br><br><br> <div class="col-lg-7">

          <div id="map-container-section" class="z-depth-1-half map-container-section mb-4" style="height: 400px">
            <iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=14, Jalan Aziz Ibrahim, Kampung Sungai Nibong, 11900 Bayan Lepas Penang, Malaysia&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
         <style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
          <!-- Buttons-->
          <div class="row text-center">
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-map-marker-alt"></i>
              </a>
              <p>14, Jalan Aziz Ibrahim, Kampung Sungai Nibong, 11900 Bayan Lepas Penang,Malaysia</p>
              
            </div>
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-phone"></i>
              </a>
              <p>+04-6444888</p>
              <p>+04-6222999</p>
              <p class="mb-md-0">Mon - Sun, 09:00-22:00</p>
            </div>
            <div class="col-md-4">
              <a class="btn-floating blue accent-1">
                <i class="fas fa-envelope"></i>
              </a>
                <p><a href="mailto:nickcarwash@gmail.com">nickcarwash@gmail.com</a></p>
                <p class="mb-0"><a href="mailto:admin@gmail.com">admin@gmail.com</a></p>
            </div>
          </div>

        </div>
      </div>

    </section>
        </div>
        
              <?php include 'footer.html';?>
                <!-- /.row -->

            <!-- /.container -->
        
    </div>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
        type="text/javascript"></script>
  

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
