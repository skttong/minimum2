<?php
session_start();
$timeout = 600; // Number of seconds until it times out.
 
// Check if the timeout field exists.
if(isset($_SESSION['timeout'])) {
    // See if the number of seconds since the last
    // visit is larger than the timeout period.
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout) {
        // Destroy the session and restart it.
        session_destroy();
        session_start();
    }
}
 
// Update the timout field with the current time.
$_SESSION['timeout'] = time();
if($_SESSION['UserID'] == "")
	{
		Header("Location: form_login.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 
		exit();
	}
	$_SESSION["UserID"];
	$_SESSION["TypeUser"];

include('connect/conn.php');

	$splsetting = "SELECT * FROM settings WHERE id = '1'";
	$querysetting = mysqli_query($con, $splsetting);
	$resultsetting = mysqli_fetch_array($querysetting);

	$spluser = "SELECT * FROM userhospital WHERE UserID = '".$_SESSION['UserID']."'";
	$queryuser = mysqli_query($con, $spluser);
	$resultuser = mysqli_fetch_array($queryuser);
	$Username = $resultuser['Username'];
	$Name = $resultuser['Name']." ".$resultuser['Lname'];
	$position = $resultuser['position'];
	$HospitalID = $resultuser['HospitalID'];
	$TypeUser = $resultuser['TypeUser'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>
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
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
	  .bodychange{
		  font-size: 16px;
	  }	
	  .divinfo{
		 /* background-color: #e7f3fe;*/
		  border-left: 3px solid #68AADF;
	  }
	  .top-right {
		  position: absolute;
		  top: 8px;
		  right: 16px;
	  }
  </style>	
</head>
<body class="hold-transition skin-blue sidebar-mini bodychange">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <?php include "menu.php";?>
	  
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include "aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
	<section class="content-header">
      <h1>
        Dashboard
        <!--<small>Preview page</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

	<!-- Main content -->
	<section class="content">
	  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section>
    <!-- /.content -->
	
    <!-- Main content -->
    <section class="content">
     
      <!-- =========================================================== -->
<?php /*?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
			
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>แพทย์<br>&nbsp;</h4>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="fa fas fa-user-md"></i>
            </div>
            <a href="#" class="small-box-footer">
              เพิ่มข้อมูล <i class="fa fas fa-plus"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4>พยาบาลเฉพาะทาง<br>สุขภาพจิตและจิตเวช</h4>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="fa fas fa-user-md"></i>
            </div>
            <a href="#" class="small-box-footer">
              เพิ่มข้อมูล <i class="fa fas fa-plus"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h4>เภสัชกรที่ปฏิบัติงาน<br>สุขภาพจิตและจิจเวช</h4>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="fa fas fa-user-md"></i>
            </div>
            <a href="#" class="small-box-footer">
              เพิ่มข้อมูล <i class="fa fas fa-plus"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>นักจิตวิทยา</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row --><?php */?>
	<!-- =========================================================== -->
		
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "footer.php";?>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
