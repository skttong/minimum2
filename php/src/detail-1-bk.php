<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/fonts-googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">

	<?php include "header_font.php"; ?>

  <style>
	
	  .divinfo{
		 /* background-color: #e7f3fe;*/
		  border-left: 3px solid #68AADF;
	  }
	  .top-right {
		  position: absolute;
		  top: 8px;
		  right: 16px;
	  }
	  .callout2
	  {
		  margin: 0 0 0 0 ;
		  padding: 15px 30px 7px 15px;
	  }
  </style>	
</head>
<body class="hold-transition sidebar-mini bodychange">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"><!--
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

     <div class="card card-outline card-primary">
	 	<div class="card-header">
          <h2 class="card-title">แบบฟอร์มบันทึกข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h2>
        </div>
		
		<!-- /.box-header -->
	   <div class="card-body">
		  <div class="row">
            <div class="col-md-6">
			  <div class="callout2 divinfo">
				<strong><i class="fa fa-file-text-o margin-r-5"></i> แพทย์เฉพาะทาง</strong>
			  </div>
				
			  <p class="text-muted">
			  <ul>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)</li>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เด็กและวัยรุ่น</li>
				<li>แพทย์สาขาอื่น ๆ</li>
			  </ul>
			  </p>
			  
			  <a href="forms_m1.php" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
			<div class="col-md-6">
			  <div class="callout2 divinfo">
				<strong><i class="fa fa-file-text-o margin-r-5"></i> พยาบาลเฉพาะทาง</strong>
			  </div>
				
				
			  <p class="text-muted">
			  <ul>
				<li>พยาบาลเฉพาะทางสุขภาพจิตและจิตเวช</li>
				<li>พยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ</li>
				<li>พยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น</li>
				<li>พยาบาลเฉพาะทางยาเสพติด</li>
				
			  </ul>
			  </p>

			  <a href="forms_m2.php" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>
		   
			</div>
		  
		  </div>
		  <!-- /.row -->
		
		  <div class="row">
            <div class="col-md-6">
			  <div class="callout2 divinfo">
				<strong><i class="fa fa-file-text-o margin-r-5"></i> เภสัชกร</strong>
			  </div>

			  <p class="text-muted">
				  
			  <!--แพทย์เฉพาะทาง
			  
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>

			  <a href="forms_m3.php" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
			<div class="col-md-6">
			  <div class="callout2 divinfo">
				 <!--<strong><i class="fa fa-file-text-o margin-r-5"></i> นักจิตวิทยาคลินิก/นักจิตวิทยา</strong>-->
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักจิตวิทยา</strong>
			  </div>
				
			  <p class="text-muted">
			  <!--
			  <ul>
				<li>นักจิตวิทยาคลินิก</li>
				<li>นักจิตวิทยา</li>
				
			  </ul>-->
			  </p>

			  <a href="forms_m4.php" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
		  
		  </div>
		 
		  <!-- /.row -->
		  <div class="row">
            <div class="col-md-6">
			  <div class="callout2 divinfo">
				 <!--<strong><i class="fa fa-file-text-o margin-r-5"></i> นักสังคมสงเคราะห์จิตเวช/<br>นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต</strong>-->
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักสังคมสงเคราะห์</strong>
			  </div>

			  <p class="text-muted">
			  <!--
			  <ul>
				<li>นักสังคมสงเคราะห์จิตเวช</li>
				<li>นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต</li>
				
			  </ul>-->
			  </p>

			  <a href="forms_m5.php" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
			<div class="col-md-6">
			  <div class="callout2 divinfo">
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักกิจกรรมบำบัด</strong>
			  </div>
				
			  <p class="text-muted">
			  <!--	แพทย์เฉพาะทาง
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>

			  <a href="forms_m6.php?type=6" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
		  
		  </div>
		  <!-- /.row -->
	
		  <div class="row">
            <div class="col-md-6">
			  <div class="callout2 divinfo">
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักเวชศาสตร์สื่อความหมาย</strong>
			  </div>
				
			  <p class="text-muted">
			  <!--	แพทย์เฉพาะทาง
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>

			  <a href="forms_m6.php?type=7" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
			<div class="col-md-6">
			  <div class="callout2 divinfo">
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักวิชาการศึกษาพิเศษ</strong>
			  </div>
				
			  <p class="text-muted">
			  <!--	แพทย์เฉพาะทาง
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>
			  <a href="forms_m6.php?type=8" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>
				
			</div>
		  
		  </div>
		  <!-- /.row -->
		
		  <div class="row">
            <div class="col-md-6">
			  <div class="callout2 divinfo">
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> นักวิชาการสาธารณสุข</strong>
				  <br>
				  <small><font color="red"> (ปฏิบัติงานสุขภาพจิต)</font></small>
			  </div>
				
			  <p class="text-muted">
			  <!--	แพทย์เฉพาะทาง
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>

			  <a href="forms_m6.php?type=9" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>

			</div>
			<div class="col-md-6">
			  <div class="callout2 divinfo">
				 <strong><i class="fa fa-file-text-o margin-r-5"></i> วิชาชีพอื่น ๆ </strong>
			  </div>
			  <br>
				
			  <p class="text-muted">
			  <!--	แพทย์เฉพาะทาง
			  <ul>
				<li>จิตแพทย์ทั่วไป</li>
				<li>จิตแพทย์เวชศาสตร์เด็กและวัยรุ่น</li>
				<li>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)</li>
			  </ul>-->
			  </p>
			  <a href="forms_m6.php?type=10" class="btn bg-olive margin top-right"> เพิ่มข้อมูล <i class="fa fas fa-plus"></i></a>
			  <hr>
				
			</div>
		  
		  </div>
		  <!-- /.row -->
		  
		</div>
		<!-- /.box-body -->
	  	<div class="card-footer">
          &nbsp;
        </div>
        <!-- /.card-footer-->
	  </div>
	  <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
