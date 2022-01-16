<?php 
session_start();
require_once 'conn.php';
if ($_SESSION['auth'] != "yes") {
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Attendance Data</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->

    <div class="row">
      <div class="col-xs-12" style="text-align: center">
        <h2 class="page-header" style="font-size: 200%">
          <img src="dist/img/nsm.png" width="55" height="50"> Attendance Monitoring System
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      
      <?php 
           $eventID = $_GET['id'];
           $attorgq = "SELECT * FROM organization WHERE orgID in (SELECT orgID from events WHERE eventID = $eventID)";
           $attorgr = $conn->query($attorgq);
           $attorgdata = $attorgr->fetch_assoc();

           $atteventq = "SELECT * FROM events WHERE eventID = '$eventID'";
           $atteventr = $conn->query($atteventq);
           $atteventdata = $atteventr->fetch_assoc();
      ?>
      <div class="col-sm-4 invoice-col">
        <b>Type of Report: </b> Late Students<br>
        <b>Event ID Number: </b> <?php echo $eventID;?><br>
        <b>Name of Event:</b> <?php echo $atteventdata['eventname']; ?> <br>
        <b>Date of Event:</b> <?php echo $atteventdata['eventdate']; ?><br>
        <b>Organization:</b> <?php echo $attorgdata['orgCode'];?>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br></br>

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>ID Number</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Remarks</th>
          </tr>
          </thead>
          <tbody>
             <?php

                
                  $attq = "SELECT * FROM `attendance_view` WHERE timein > CAST('8:00:00' AS time) and eventID = '$eventID'";
                  $attr = $conn->query($attq);

                  while ($attdata = $attr->fetch_assoc()) {
                   ?>
                   <tr>
                     <td><?php echo $attdata['idnumber'];?></td>
                     <td><?php echo $attdata['first_name'];?></td>
                     <td><?php echo $attdata['last_name'];?></td>
                     <td><?php echo $attdata['timein'];?></td>
                     <td><?php echo $attdata['timeout'];?></td>
                     <td></td>
                   </tr>
                   <?php }?>         
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br></br>
    <div class="row">
      <!-- Summary column -->
      <div class="col-xs-6">
        <p class="lead">Summary</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <?php 
              $orgIDsession = $_SESSION['orgID'];

              $sqlcount = "SELECT COUNT(first_name) FROM students WHERE studentID in(SELECT studentID FROM orgstudent WHERE orgID = '$orgIDsession')";
              $sqlcountresult = $conn->query($sqlcount);
              $sqldata = $sqlcountresult->fetch_assoc();

              ?>
              <th>Number of Registered Students:</th>
              <td><?php echo $sqldata['COUNT(first_name)']; ?></td>
            </tr>
            <tr>
              <?php 
                  $presentsql = "SELECT COUNT(*) FROM attendance_view WHERE eventID = '$eventID'";
                  $presentresult = $conn->query($presentsql);
                  $presentdata = $presentresult->fetch_assoc();


                  $absent = $sqldata['COUNT(first_name)'] - $presentdata['COUNT(*)'];

                  $latesql = "SELECT COUNT(*) as late FROM attendance_view WHERE timein > CAST('8:00:00' AS time) and eventID = '$eventID'";
                  $lateresult = $conn->query($latesql);
                  $latedata = $lateresult->fetch_assoc();
               ?>
              <th>Number of Present Students:</th>
              <td><?php echo $presentdata['COUNT(*)']; ?></td>
            </tr>
            <tr>
              <th>Number of Late:</th>
              <td><?php echo $latedata['late']?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div>
      <hr align="center" width="45%">
      <center style = "font-style: 200% "> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> - Secretary</center>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
