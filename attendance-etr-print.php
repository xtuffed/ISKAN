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
  <title>Student's ETR</title>
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
          <?php 
          $orgIDs = $_SESSION['orgID'];

          $orquery = "SELECT orgCode FROM organization WHERE orgID = '$orgIDs'";
          $orresult = $conn->query($orquery);
          $ordata = $orresult->fetch_assoc();
          ?>
          <img src="dist/img/nsm.png" width="55" height="50"> <?php echo $ordata['orgCode']?> - Student's Events Time Record 
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      
      <?php 
           $studID = $_GET['id'];
           $attorgq = "SELECT * FROM students WHERE studentID = '$studID'";
           $attorgr = $conn->query($attorgq);
           $attorgdata = $attorgr->fetch_assoc();

            $atteventq = "SELECT * FROM events WHERE eventID = '$eventID'";
           $atteventr = $conn->query($atteventq);
           $atteventdata = $atteventr->fetch_assoc();
      ?>
      <div class="col-sm-4 invoice-col" style="font-size: 120%">
        <b>ID Number: </b> <?php echo $attorgdata['idnumber'];?><br>
        <b>Name:</b> <?php echo $attorgdata['first_name'] . " " . $attorgdata['last_name']; ?> <br>
        <b>Course:</b> <?php echo $attorgdata['course']; ?><br>
        <b>Year Level:</b> <?php echo $attorgdata['yearlevel'];?>
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
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Remarks</th>
          </tr>
          </thead>
          <tbody>
             <?php
                $orgIDsession = $_SESSION['orgID'];
                $studnumber = $attorgdata['idnumber'];
                
                  $attq = "SELECT DISTINCT(attendance_view.eventID) as eveID, eventname, eventdate, attendance_view.timein as timein, attendance_view.timeout as timeout FROM attendance_view, events, organization WHERE idnumber = '$studnumber' and attendance_view.eventID in (SELECT events.eventID FROM events WHERE events.orgID in (SELECT organization.orgID from organization WHERE organization.orgID = '$orgIDsession')) and attendance_view.eventID = events.eventID";
                  $attr = $conn->query($attq);

                  while ($attdata = $attr->fetch_assoc()) {
                   ?>
                   <tr>
                     <td><?php echo $attdata['eveID'];?></td>
                     <td><?php echo $attdata['eventname'];?></td>
                     <td><?php echo $attdata['eventdate'];?></td>
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

              $sqlcount = "SELECT COUNT(*) FROM events WHERE orgID = '$orgIDsession'";
              $sqlcountresult = $conn->query($sqlcount);
              $sqldata = $sqlcountresult->fetch_assoc();

              ?>
              <th>Number of Events of the Organization:</th>
              <td><?php echo $sqldata['COUNT(*)']; ?></td>
            </tr>
            <tr>
              <?php 
                  $presentsql = "SELECT COUNT(DISTINCT(attendance_view.eventID)) as evecount FROM attendance_view, events, organization WHERE idnumber = '$studnumber' and attendance_view.eventID in (SELECT events.eventID FROM events WHERE events.orgID in (SELECT organization.orgID from organization WHERE organization.orgID = '$orgIDsession')) and attendance_view.eventID = events.eventID";
                  $presentresult = $conn->query($presentsql);
                  $presentdata = $presentresult->fetch_assoc();


                  $absent = $sqldata['COUNT(*)'] - $presentdata['evecount'];

                  $latesql = "SELECT COUNT(DISTINCT(attendance_view.eventID)) as latecount FROM attendance_view, events, organization WHERE idnumber = '$studnumber' and attendance_view.eventID in (SELECT events.eventID FROM events WHERE events.orgID in (SELECT organization.orgID from organization WHERE organization.orgID = '$orgIDsession')) and attendance_view.eventID = events.eventID and timein > CAST('8:00:00' AS time)";
                  $lateresult = $conn->query($latesql);
                  $latedata = $lateresult->fetch_assoc();
               ?>
              <th>Number of Events Attended:</th>
              <td><?php echo $presentdata['evecount']; ?></td>
            </tr>
            <tr>
              <th>Number of Absent Events:</th>
              <td><?php echo $absent; ?></td>
            </tr>
            <tr>
              <th>Number of Late Events:</th>
              <td><?php echo $latedata['latecount']?></td>
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
