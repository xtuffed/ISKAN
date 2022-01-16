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
          <a class= "fa fa-user"> Admin </a>
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
        <li>
          <a href="home.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
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
        Manage Students
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Students</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
        
      </div>
      <!-- /.row -->
        <section class="content">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Students Data</h3>
              <button class="btn btn-info pull-right" type="button" data-toggle="modal" data-target="#modal-addstudent"><i class="fa fa-user-plus">Add Student</i></button>
            </div>
            

            <!-- /. modal add students -->
          <div class="modal fade" id="modal-addstudent">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Student</h4>
              </div>
              <div class="modal-body">
                  <form action="addStudent3.php" method="post">
                    <div class="form-group has-feedback">
                     <input type="text" class="form-control" placeholder="ID-Number" name="idnumber" required="required">
                     <span class="fa fa-credit-card form-control-feedback"></span>
                </div> 
                 <div class="form-group has-feedback">
               <input type="text" class="form-control" placeholder="First Name" name="firstname" required="required">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              <div class="form-group has-feedback">
               <input type="text" class="form-control" placeholder="Last Name" name="lastname" required="required">
               <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              <div class="form-group has-feedback">
               <input type="text" class="form-control" placeholder="Course" name="course" required="required">
               <span class="fa fa-institution form-control-feedback"></span>
                 </div>
                <div class="form-group has-feedback">
                  <label>Type:</label>
              <select class="form-control" name="yearlevel" required>   
                            <option value="Student"> Student </option>
                            <option value="Staff"> Staff </option>
                        </select>
                 </div> 
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Add</button>
              </div>  
                  </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID Number</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Type</th>
                  <th>Course</th>
                  <th>QR Code</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $studentquery = "SELECT * FROM students";
                    $studentresult = $conn->query($studentquery);

                    while ($studentq = $studentresult->fetch_assoc()) {
                      
                   ?>
                <tr>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['idnumber'];?></td>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['first_name'];?></td>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['last_name'];?></td>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['yearlevel'];?></td>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['course'];?></td>
                  <td window.location='studentsProfile.php?id=<?php echo $studentq['studentID']; ?>'><?php echo $studentq['course'];?></td>
                  <td>
                      <button type="button" class="btn btn-primary btn-blk" data-toggle="modal" data-target="#updatestudent" href="updatestudent1.php?id=<?php echo $studentq['studentID']; ?>"><span class="fa fa-edit"></span></button>
                      <button type="button" class="btn btn-danger btn-blk" data-toggle="modal" data-target="#deletestudent-modal" href="deletestudent.php?id=<?php echo $studentq['studentID']; ?>"><span class="fa fa-remove"></span></button>
                      <button type="button" class="btn btn-primary btn-blk" data-toggle="modal" data-target="#register-modal" href="registerStudent.php?id=<?php echo $studentq['studentID']; ?>">Register</button>

                  </td>
                </tr>
                <?php 
                  }
                ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>ID Number</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Type</th>
                  <th>Course</th>
                  <th>QR Code</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

     

    </section>
      <!-- /.row (main row) -->
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include('updatestudent_modal.php');
  include('register_modal.php');
  include('deletestudent_modal.php');

  ?>
  
</div>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
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
<!--page Script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
