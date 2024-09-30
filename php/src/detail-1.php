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
    h4 {
    margin: 20px 0;
    text-align: justify;
}

p {
    margin: 10px 0;
}
p {
    margin: 10px 0; /* Add space between paragraphs */
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
		
		<!-- /.box-header -->
	   <div class="card-body">
      
     <?php 
     switch ($_SESSION["HosType"]) {
      case 'ศูนย์วิชาการ':
      case 'สำนักงานสาธารณสุขจังหวัด':
      case 'สำนักงานสาธารณสุขอำเภอ':
   
          // Code for all other HosTypes
          
           /* if(($_SESSION["HosType"] <> 'ศูนย์วิชาการ')||
							($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด')||
								($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ')){ */?>

<div class="row">

<div class="card-body">
            <div class="row justify-content-center align-self-center">
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/group.png" alt="doctor">
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/arrow.png" alt="doctor">
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/like2.png" alt="doctor">
                </div>
              </div>
              
            </div>

          </div>

<div class="row">
  
<h4>คำชี้แจง การลงข้อมูลทรัพยากร</h4>
    <br>

    <h4>
        1. แบบบันทึกข้อมูลทรัพยากรมีวัตถุประสงค์ เพื่อรวบรวมและวิเคราะห์ข้อมูลทรัพยากรด้านสุขภาพจิตเเละจิตเวชในเขตสุขภาพ รวมถึงสนับสนุนข้อมูลให้หน่วยงานที่เกี่ยวข้อง ในการวางแผนกำลังคนและพัฒนาระบบบริการสุขภาพจิตและจิตเวช
    </h4>
    <br>

    <h4>
        2. แบบบันทึกข้อมูลทรัพยากรมี 2 ส่วน ประกอบด้วย
    </h4>
    <br>

    <h4>
        <ul>
            <li>ส่วนที่ 1 แบบบันทึกข้อมูลทรัพยากรบุคลากรสุขภาพจิตและจิตเวช ในกรณีที่บุคลากรปฏิบัติงานด้านวิกฤตสุขภาพจิต (MCATT) จะมีการบันทึกข้อมูลการอบรมเฉพาะทางด้านวิกฤตสุขภาพจิตเพิ่มเติมโดยกรณีที่บันทึกข้อมูลผิดพลาดสามารถกดตรวจสอบเพื่อแก้ไขหรือลบข้อมูลของตนเองที่บันทึกได้</li>
           
            <li>ส่วนที่ 2 แบบประเมินความพึงพอใจ  ประกอบด้วย ข้อคำถามระดับพึงพอใจน้อยที่สุด-มากที่สุด และสอบถามความคิดเห็น</li>
        </ul>
    </h4>

		  
		</div>
		<!-- /.box-body -->
	  	<div class="card-footer">
          &nbsp;
        </div>
        <!-- /.card-footer-->
	  </div>
	  <!-- /.box -->


    <?php 
         // Code for these specific HosTypes
          // ...
          break;
      default: /*}else{*/ ?>
      <div class="row">

<div class="card-body">
            <div class="row justify-content-center align-self-center">
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/group.png" alt="doctor">
                </div>
              </div>
               <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/arrow.png" alt="doctor">
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/plus.png" alt="doctor">
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/arrow.png" alt="doctor">
                </div>
              </div>
              <div class="col-md-12 col-lg-6 col-xl-2">
                <div class="mb-2">
                <img class="card-img-top" src="images/like.png" alt="doctor">
                </div>
              </div>
              
            </div>

          </div>

<div class="row">
  
<h4>คำชี้แจง การลงข้อมูลทรัพยากร</h4>
    <br>

    <h4>
        1. แบบบันทึกข้อมูลทรัพยากรมีวัตถุประสงค์ เพื่อรวบรวมและวิเคราะห์ข้อมูลทรัพยากรด้านสุขภาพจิตเเละจิตเวชในเขตสุขภาพ รวมถึงสนับสนุนข้อมูลให้หน่วยงานที่เกี่ยวข้อง ในการวางแผนกำลังคนและพัฒนาระบบบริการสุขภาพจิตและจิตเวช
    </h4>
    <br>

    <h4>
        2. แบบบันทึกข้อมูลทรัพยากรมี 3 ส่วน ประกอบด้วย
    </h4>
    <br>

    <h4>
        <ul>
            <li>ส่วนที่ 1 แบบบันทึกข้อมูลทรัพยากรบุคลากรสุขภาพจิตและจิตเวช ในกรณีที่บุคลากรปฏิบัติงานด้านวิกฤตสุขภาพจิต (MCATT) จะมีการบันทึกข้อมูลการอบรมเฉพาะทางด้านวิกฤตสุขภาพจิตเพิ่มเติมโดยกรณีที่บันทึกข้อมูลผิดพลาดสามารถกดตรวจสอบเพื่อแก้ไขหรือลบข้อมูลของตนเองที่บันทึกได้</li>
            <li>ส่วนที่ 2 แบบบันทึกข้อมูลทรัพยากรบริการข้อคำถามจะแสดงขึ้นตามระดับสถานบริการ ให้บันทึกให้ครบถ้วนตามรายละเอียดที่เว็บไซต์กำหนด โดยสามารถกดบันทึกข้อมูลไว้ เพื่อบันทึกข้อมูลเพิ่มเติม หากบันทึกข้อมูลครบถ้วนจึง กดส่งออก</li>
            <li>ส่วนที่ 3 แบบประเมินความพึงพอใจ  ประกอบด้วย ข้อคำถามระดับพึงพอใจน้อยที่สุด-มากที่สุด และสอบถามความคิดเห็น</li>
        </ul>
    </h4>

		  
		</div>
		<!-- /.box-body -->
	  	<div class="card-footer">
          &nbsp;
        </div>
        <!-- /.card-footer-->
	  </div>
	  <!-- /.box -->

    

    <?php } ?>

    </section>
    <!-- /.content -->
    <div class="card-footer">
         <!-- <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>-->
		  <a href="detail-all.php" class="btn btn-primary"> ถัดไป &nbsp;<!--<i class="fa fas fa-undo"></i>--></a>
        </div>
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
