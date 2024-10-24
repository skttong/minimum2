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
  <link rel="stylesheet" href="dist/css/custom.css">
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
    .btn-circle.btn-xl {
  width: 150%;
  height: 150%;
  padding: 10px 5px;
  font-size: 2px;
  line-height: 1;
  border-radius: 35px;
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

<?php
if($_SESSION["TypeUser"] == "Admin"){
 //echo 'แอดมินส่วนกลาง';
}else{
 $sql_u 		= "SELECT HOS_NAME FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
 $query_u 	= mysqli_query($con, $sql_u);
 $result_u 	= mysqli_fetch_array($query_u);
 $HOS_NAME = $result_u['HOS_NAME']; 
 $TypeService = $_SESSION["TypeService"];
}
?>
    <?php /* <h2 class="card-title">แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2> */ ?>
    <?php if($TypeService <> ''){?>
          <h2>แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2>
          <?php }else{ ?>
            <h2>แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ;?>  </h2>
         <?php } ?> 
   </div>
		
       <!-- <div class="card card-success">-->
          <div class="card-body">
            <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
               <h3 class="text-center">แบบบันทึกทรัพยากรบริการ</h3>  
            </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m1.php" ><img class="card-img-top" src="images/doctor.png" alt="doctor"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m2.php" ><img class="card-img-top" src="images/nurse.png" alt="nurse"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m3.php" > <img class="card-img-top" src="images/medicine.png" alt="medicine"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m4.php" ><img class="card-img-top" src="images/social.png" alt="social"></a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m5.php" ><img class="card-img-top" src="images/physical-therapy.png" alt="physical-therapy"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m6.php?type=6" ><img class="card-img-top" src="images/translation.png" alt="translation"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m6.php?type=7" > <img class="card-img-top" src="images/ours.png" alt="ours"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m6.php?type=8" ><img class="card-img-top" src="images/education.png" alt="education"></a>
                </div>
              </div>
            </div>
            <div class="row justify-content-center align-self-center">
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m6.php?type=9" ><img class="card-img-top" src="images/health.png" alt="health"></a>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-3">
                <div class="mb-2">
                <a href="forms_m6.php?type=10" ><img class="card-img-top" src="images/other.png" alt="other"></a>
                </div>
              </div>
              
            </div>
    <?php if($_SESSION["HosType"] <> 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){
						if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){
							if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){ 
                if($_SESSION["HosType"] <> 'ศูนย์วิชาการ'){ 
								  if($_SESSION["HosType"] <> 'ศูนย์บริการสาธารณสุข อปท.'){?>
          <div class="row justify-content-center align-self-center">
          <div class="col-md-12 col-lg-12 col-xl-12">
          <h3 class="text-center">แบบบันทึกทรัพยากรบริการ</h3>  
          </div>
          <div class="col-md-12 col-lg-6 col-xl-3">
              <div class="mb-2">
                    <a href="form_bed.php" ><img class="card-img-top" width= "30%"  src="images/bed.png" alt="bed"></a>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="mb-2">
                    <a href="form_ect.php" ><img class="card-img-top" width= "30%"  src="images/electric.png" alt="electric"></a>
                    </div>
                  </div>
          </div>
          <?php }}}}} ?>
       <!-- </div>-->

       <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
          <div class="row justify-content-center align-self-center">
          <div class="col-md-12 col-lg-12 col-xl-12">
          <h3 class="text-center">แบบบันทึกทรัพยากรบริการ</h3>  
          </div>
          <div class="col-md-12 col-lg-6 col-xl-3">
              <div class="mb-2">
                    <a href="form_bed.php" ><img class="card-img-top" width= "30%"  src="images/bed.png" alt="bed"></a>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6 col-xl-3">
                    <div class="mb-2">
                    <a href="form_ect.php" ><img class="card-img-top" width= "30%"  src="images/electric.png" alt="electric"></a>
                    </div>
                  </div>
          </div>
          <?php }?>
       <!-- </div>-->

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
