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
    <title>ISKAN | Dashboard</title>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="home.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SKN</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ISKAN</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/kk.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo ($_SESSION['firstname']); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="dist/img/kk.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> - Web Developer
                    <small>Member since 2021</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/kk.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></p>
            <a class= "fa fa-user"> Admin</a>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="active treeview">
            <a href="home.php">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li>
            <?php
             $esccount = "SELECT count(idnumber) as coco FROM students WHERE NOT EXISTS(SELECT studentID from orgstudent WHERE orgstudent.studentID = students.studentID)";
                $esccountresult = $conn->query($esccount);
                $escdata = $esccountresult->fetch_assoc();


             ?>
             <!-- ManageStudents-->
  <a href="managestudents.php">
              <i class="fa fa-users"></i> <span>Manage Students</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-red"><?php echo $escdata['coco']; ?></small>
              </span>
            </a>
          </li>
          <li>
            <a href="eventshandled.php">
              <i class="fa fa-institution"></i> <span>Manage Buildings</span>
            </a>
          </li>
          <li>
            <a href="manageOrg.php">
              <i class="fa fa-graduation-cap"></i> <span>Colleges</span>
            </a>
          </li>
          <li><a href="manageUsers.php"><i class="fa fa-user"></i> <span>Manage Users</span></a></li>
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php 
              $sqlcount = "SELECT COUNT(first_name) FROM students";
              $sqlcountresult = $conn->query($sqlcount);
              $sqldata = $sqlcountresult->fetch_assoc();

              ?>
              <h3><?php echo $sqldata['COUNT(first_name)']; ?></h3>

              <p>Number of Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="managestudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!--Number of Staff-->
        <div class="row">
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php 
              $sqlcount = "SELECT COUNT(first_name) FROM students";
              $sqlcountresult = $conn->query($sqlcount);
              $sqldata = $sqlcountresult->fetch_assoc();

              ?>
              <h3><?php echo $sqldata['COUNT(first_name)']; ?></h3>

              <p>Number of Staffs</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="managestudents.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
               <?php 
              $sqlcount2 = "SELECT COUNT(eventname) FROM events";
              $sqlcountresult2 = $conn->query($sqlcount2);
              $sqldata2 = $sqlcountresult2->fetch_assoc();

              ?>
              <h3><?php echo $sqldata2['COUNT(eventname)']; ?></h3>

              <p>Number of Buildings</p>
            </div>
            <div class="icon">
              <i class="fa fa-institution"></i>
            </div>
            <a href="eventshandled.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
              $sqlcount1 = "SELECT COUNT(username) FROM users";
              $sqlcountresult1 = $conn->query($sqlcount1);
              $sqldata1 = $sqlcountresult1->fetch_assoc();
               ?>
              <h3><?php echo $sqldata1['COUNT(username)'];?></h3>

              <p>Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="manageUsers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-2
         col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
               <?php
              $sqlcounts = "SELECT COUNT(orgCode) as orc FROM organization";
              $sqlcountresults = $conn->query($sqlcounts);
              $sqldatas = $sqlcountresults->fetch_assoc();
               ?>
              <h3><?php echo $sqldatas['orc']; ?></h3>

              <p>Colleges</p>
            </div>
            <div class="icon">
              <i class="fa fa-institution"></i>
            </div>
            <a href="manageOrg.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
        <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Welcome to the Attendance Monitoring System</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <p>
            An attendance monitoring system maintains a daily record of a student attendance in an event. This is the modern-day equivalen of the paper time. It automate the event attendance per event of the students and calculating accrued benefits , providing valuabe information and making the organizations more efficient.
          </p>

        </div>
        <!-- /.box-body -->
      </div>

      <!-- /.box -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Semestral Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
               
                <!-- /.col -->
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Attendance per Building</strong>
                  </p>
                  <?php 
                  $omansscount = "SELECT count(studentID) as omanss from orgstudent where orgID = 1";
                  $omanssresult = $conn->query($omansscount);
                  $omanssdata = $omanssresult->fetch_assoc();

                  $omansscount1 = "SELECT COUNT(*) as omanss1 from attendance_view, events where attendance_view.eventID = events.eventID and events.orgID = 1";
                  $omanssresult1 = $conn->query($omansscount1);
                  $omanssdata1 = $omanssresult1->fetch_assoc();

                   $omansscount2 = "SELECT COUNT(*) as omanss2 from events where orgID =1";
                  $omanssresult2 = $conn->query($omansscount2);
                  $omanssdata2 = $omanssresult2->fetch_assoc();

                  $omanssf = $omanssdata1['omanss1'] / $omanssdata2['omanss2'];

                  ?>
                  <div class="progress-group">
                    <span class="progress-text">MAIN GATE</span>
                    <span class="progress-number"><b><?php echo $omanssf; ?></b>/<?php echo $omanssdata['omanss']; ?></span>

                    <?php
                    $omanssp = $omanssf / $omanssdata['omanss'];
                    $omansspi = $omanssp * 100;

                     ?>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: <?php echo $omansspi; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <?php 
                  $jitscount = "SELECT count(studentID) as jits from orgstudent where orgID = 2";
                  $jitsresult = $conn->query($jitscount);
                  $jitsdata = $jitsresult->fetch_assoc();

                  $jitscount1 = "SELECT COUNT(*) as jits1 from attendance_view, events where attendance_view.eventID = events.eventID and events.orgID = 2";
                  $jitsresult1 = $conn->query($jitscount1);
                  $jitsdata1 = $jitsresult1->fetch_assoc();

                  $jitscount2 = "SELECT COUNT(*) as jits2 from events where orgID =2";
                  $jitsresult2 = $conn->query($jitscount2);
                  $jitsdata2 = $jitsresult2->fetch_assoc();

                  $jitsf = $jitsdata1['jits1'] / $jitsdata2['jits2'];

                  ?>
                  <div class="progress-group">
                    <span class="progress-text">Y BUILDING</span>
                    <span class="progress-number"><b><?php echo $jitsf; ?></b>/<?php echo $jitsdata['jits']; ?></span>

                      <?php
                    $jitsp = $jitsf / $jitsdata['jits'];
                    $jitspi = $jitsp * 100;

                     ?>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: <?php echo $jitspi; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <?php 
                  $smscount = "SELECT count(studentID) as sms from orgstudent where orgID = 3";
                  $smsresult = $conn->query($smscount);
                  $smsdata = $smsresult->fetch_assoc();

                  $smscount1 = "SELECT COUNT(*) as sms1 from attendance_view, events where attendance_view.eventID = events.eventID and events.orgID = 3";
                  $smsresult1 = $conn->query($smscount1);
                  $smsdata1 = $smsresult1->fetch_assoc();

                  $smscount2 = "SELECT COUNT(*) as sms2 from events where orgID =3";
                  $smsresult2 = $conn->query($smscount2);
                  $smsdata2 = $smsresult2->fetch_assoc();

                  $smsf = $smsdata1['sms1'] / $smsdata2['sms2'];
                  ?>
                  <div class="progress-group">
                    <span class="progress-text">OSSA</span>
                    <span class="progress-number"><b><?php echo $smsf; ?></b>/<?php echo $smsdata['sms']; ?></span>
                      <?php
                    $smsp = $smsf / $smsdata['sms'];
                    $smspi = $smsp * 100;

                     ?>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $smspi; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                   <?php 
                  $nassacount = "SELECT count(studentID) as nassa from orgstudent where orgID = 4";
                  $nassaresult = $conn->query($nassacount);
                  $nassadata = $nassaresult->fetch_assoc();

                  $nassacount1 = "SELECT COUNT(*) as nassa1 from attendance_view, events where attendance_view.eventID = events.eventID and events.orgID = 4";
                  $nassaresult1 = $conn->query($nassacount1);
                  $nassadata1 = $nassaresult1->fetch_assoc();

                  $nassacount2 = "SELECT COUNT(*) as nassa2 from events where orgID =4";
                  $nassaresult2 = $conn->query($nassacount2);
                  $nassadata2 = $nassaresult2->fetch_assoc();

                  $nassaf = $nassadata1['nassa1'] / $nassadata2['nassa2'];
                  ?>
                  <div class="progress-group">
                    <span class="progress-text">GYMNASIUM</span>
                    <span class="progress-number"><b><?php echo $nassaf; ?></b>/<?php echo $nassadata['nassa']; ?></span>
                    <?php
                    $nassap = $nassaf / $nassadata['nassa'];
                    $nassapi = $nassap * 100;

                     ?>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: <?php echo $nassapi; ?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    </section>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Jquery -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/Chart.min.js"></script>
<script>
  $(document).ready(function() {

  /**
   * call the data.php file to fetch the result from db table.
   */
  $.ajax({
    url : "http://localhost/capstone/api/koko.php",
    type : "GET",
    success : function(data){
      console.log(data);

      var present = [];
      var late = [];
      var eventname = [];

      for (var i in data) {
        present.push(data[i].present);
        late.push(data[i].late);
        eventname.push(data[i].eventname);

      }

      //get canvas
      var ctx = $("#line-chartcanvas");

      var data = {
        labels : eventname,
        datasets : [
          {
            label : "Present",
            data : present,
            backgroundColor : "blue",
            borderColor : "lightblue",
            fill : false,
            lineTension : 0,
            pointRadius : 5
          },
          {
            label : "Late",
            data : late,
            backgroundColor : "green",
            borderColor : "lightgreen",
            fill : false,
            lineTension : 0,
            pointRadius : 5
          }
        ]
      };

      var options = {
        title : {
          display : true,
          position : "top",
          fontSize : 18,
          fontColor : "#111"
        },
        legend : {
          display : true,
          position : "bottom"
        }
      };

      var chart = new Chart( ctx, {
        type : "bar",
        data : data,
        options : options
      } );

    },
    error : function(data) {
      console.log(data);
    }
  });

});
</script>
</body>
</html>
