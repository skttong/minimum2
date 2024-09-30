<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

	$FID = $_GET['FID'] ;

	$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal FROM serviceform  WHERE mhpsID = '$FID';"; 

	//$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5,number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal  FROM serviceform WHERE HospitalID = '10697'; "; 	
		
	$queryfcenter = mysqli_query($con, $sqlfcenter);
	$resultfcenter = mysqli_fetch_array($queryfcenter);
		
	$mhpsID = $resultfcenter['mhpsID'];	
	$qus1_1 = preg_split ("/\,/", $resultfcenter['qus1_1']); 	
	$qus1_2 = preg_split ("/\,/", $resultfcenter['qus1_2']);
	$qus1_3 = preg_split ("/\,/", $resultfcenter['qus1_3']);
	$qus1_4 = preg_split ("/\,/", $resultfcenter['qus1_4']);
	$qus2_1 = preg_split ("/\,/", $resultfcenter['qus2_1']);	
	$qus3_1 = preg_split ("/\,/", $resultfcenter['qus3_1']);
	$qus3_2 = preg_split ("/\,/", $resultfcenter['qus3_2']);
	$qus3_3 = preg_split ("/\,/", $resultfcenter['qus3_3']);
	$qus3_4 = preg_split ("/\,/", $resultfcenter['qus3_4']);
	$qus3_5 = preg_split ("/\,/", $resultfcenter['qus3_5']);	
	$number_patients = preg_split ("/\,/", $resultfcenter['number_patients']);
	$problems_obstacles = $resultfcenter['problems_obstacles'];
	$feedback			= $resultfcenter['feedback'];
	$DevelopmentPlan 	= $resultfcenter['DevelopmentPlan'];
	$statusfinal 		= $resultfcenter['statusfinal'];
	
	
	/*	
	print_r($qus1_1);
	echo "<br>";	
	print_r($qus1_2);
	echo "<br>";
	print_r($qus1_3);
	echo "<br>";
	print_r($qus1_4);
	echo "<br>";
	print_r($qus2_1);
	echo "<br>";
	print_r($qus3_1);
	echo "<br>";
	print_r($qus3_2);
	echo "<br>";
	print_r($qus3_3);
	echo "<br>";	
	print_r($number_patients);
	echo "<br>";
	*/	
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
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">
	
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
			<h4>ข้อมูลระบบบริการจิตเวช  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลระบบบริการจิตเวช  <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"> บริการสุขภาพจิตและจิตเวช</a></li>
              <li class="breadcrumb-item active">ระดับโรงพยาบาลส่งเสริมสุขภาพตำบล</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="ServiceForm_tambon_update.php">
		<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
		<input type="hidden" value="<?php echo $HospitalID; ?>" name="txtHospitalID">  
		<input type="hidden" value="<?php echo $mhpsID; ?>" name="txtmhpsID">  
      <!-- Default box -->
      <div class="card card-info card-outline">
		  <div class="card-header">
			<h3 class="card-title">
			  <i class="fas fa-file-alt"></i>&nbsp;
			  ระบบบริการสุขภาพจิตและจิตเวช <span class="text-green"> ระดับโรงพยาบาลส่งเสริมสุขภาพตำบล</span>
			</h3><br>
			<p class="text-muted">
			โปรดทำเครื่องหมาย <i class="fa fa-check margin-r-5"></i> ในช่องว่าง หากมีบริการดังกล่าว (ในกรณีที่โรงพยาบาลของท่าน “ไม่มี” ให้เว้นว่างไว้)
		    </p>
		  </div>
		  <div class="card-body">			  
			
			<h5><i class='fas fa-edit'></i> 1. งานสุขภาพจิตและจิตเวชผู้ใหญ่ และ ผู้สูงอายุ</h5>
			
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.1 งานบริการผู้ป่วยนอก (OPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
					    <?php if($qus1_1[0] == '0'){ ?> 
						  <input name="qus1_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>	
						บริการคัดกรอง/ประเมินและช่วยเหลือผู้มีปัญหาสุขภาพจิต (และยาเสพติด) เบื้องต้นและส่งต่อในรายที่เกินขีดความสามารถ
					</span><br>
					<span>
					    <?php if($qus1_1[1] == '0'){ ?> 
						  <input name="qus1_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
						มีบริการให้การปรึกษาด้านสุขภาพจิตเบื้องต้น
					</span><br>
					<span>
					    <?php if($qus1_1[2] == '0'){ ?> 
						  <input name="qus1_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>	 
						มีบริการฉีดยาจิตเวชชนิดออกฤทธิ์ระยะยาว
					</span><br>
					<span>
					    <?php if($qus1_1[3] == '0'){ ?> 
						  <input name="qus1_1_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>	
						มีระบบการส่งต่อผู้ป่วยที่มีปัญหาสุขภาพจิตและจิตเวช
					</span>
						  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.2 บุคคลากร</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span><!--(ถ้าไม่มีข้ามไปข้อ 1.3)-->
					<?php 
	
					if($qus1_2[0] == '1'){ ?> 	
					 <input type="checkbox" checked name="qus1_2_1" class="flat-red" value="1">&nbsp;  
					มีบุคลากรสาธารณสุข <b>ผู้รับผิดชอบหลัก</b>งานสุขภาพจิตและจิตเวชที่ผ่านการอบรมความรู้เบื้องต้น<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการคัดกรองผู้มีปัญหาสุขภาพจิตและจิตเวช <i>โดยถ้ามีโปรดระบุตำแหน่ง</i>
					<?php }else{ ?>	
						<input type="checkbox"  name="qus1_2_1" class="flat-red" value="1">&nbsp;  
					มีบุคลากรสาธารณสุข <b>ผู้รับผิดชอบหลัก</b>งานสุขภาพจิตและจิตเวชที่ผ่านการอบรมความรู้เบื้องต้น<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการคัดกรองผู้มีปัญหาสุขภาพจิตและจิตเวช <i>โดยถ้ามีโปรดระบุตำแหน่ง</i>
					<?php } ?>	
					</span><br>
				<div style="padding-left: 25px;">
					<span>
					<?php 
	
					if($qus1_2[1] == 'พยาบาล'){ ?> 
					  <input name="rqus1_2_1" type="radio" class="flat-red" value="พยาบาล"  checked="checked" onclick="enablequs1_2_1();">&nbsp; 
					<?php }else{ ?>
					  <input name="rqus1_2_1" type="radio" class="flat-red" value="พยาบาล" onclick="enablequs1_2_1();" >&nbsp; 
					<?php } ?>	
						พยาบาล
					</span><br>
					<span>
					<?php if($qus1_2[1] == 'นักวิชาการสาธารณสุข'){ ?> 
					  <input name="rqus1_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข" onclick="enablequs1_2_1();" checked="checked">&nbsp; 
					<?php }else{ ?>
					  <input name="rqus1_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข" onclick="enablequs1_2_1();">&nbsp; 
					<?php } ?>
						นักวิชาการสาธารณสุข 
					</span><br>
					<span>
					<?php if($qus1_2[1] == 'อื่นๆ'){ ?> 
						
					  <input name="rqus1_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs1_2();" checked="checked">&nbsp; 
						อื่น ๆ
					</span><br>
					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_rqus1_2_1">โปรดระบุ 1 ตำแหน่งเท่านั้น</span><b><span style="color:red;">*</span></b>
					  <input name="other_rqus1_2_1" type="text" class="form-control" id="other_rqus1_2_1" value="<?PHP echo $qus1_2[2]; ?>" placeholder="โปรดระบุ"  required>
					</p> 	
						
					
					<?php }else{ ?>
						  <input name="rqus1_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs1_2();" >&nbsp; 
						อื่น ๆ
					</span><br>
					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_rqus1_2_1">โปรดระบุ 1 ตำแหน่งเท่านั้น</span><b><span style="color:red;">*</span></b>
					  <input name="other_rqus1_2_1" type="text" class="form-control" id="other_rqus1_2_1" placeholder="โปรดระบุ"  disabled required>
					</p> 
					
					<?php } ?>	
				</div>		  
					<script>
						function enablequs1_2_1() {
							
						  
								document.getElementById("other_rqus1_2_1").disabled = true;
							

						}
						
						function enablequs1_2() {
						  var g = document.getElementById("other_rqus1_2_1").disabled;
							if( g ){
								document.getElementById("other_rqus1_2_1").disabled = false;
							}else{
								document.getElementById("other_rqus1_2_1").disabled = true;
							}

						}

					</script>  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.3 เครื่องมือ/อุปกรณ์/เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
					<?php if($qus1_3[0] == '0'){ ?> 
					  <input name="qus1_3_1" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
						มีแบบประเมิน/ คัดกรองโรคจิตและสุขภาพจิต 2Q, 9Q, 8Q 
					</span><br>
					<span>
					<?php if($qus1_3[1] == '0'){ ?> 
					  <input name="qus1_3_2" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
						แบบประเมินความเครียด (ST 5)
					</span><br>
					<span>
					<?php if($qus1_3[2] == '0'){ ?> 
					  <input name="qus1_3_3" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	 
						แบบสังเกตอาการด้านจิตใจ (Mind6)
					</span><br>
					<?php if($qus1_3[3] == '0'){ ?> 
					<span>
					  <input type="checkbox" name="qus1_3_4" class="flat-red" value="1" onclick="enablequs1_3();">&nbsp; 
						แบบสังเกตผู้ป่วยจิตเวชที่มีความเสี่ยงต่อการก่อความรุนแรง (Mind7)
					</span><br>
					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus1_3">โปรดระบุเครื่องมือที่ใช้</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus1_3" type="text" class="form-control" id="other_qus1_3" placeholder="โปรดระบุ" disabled required>
					</p> 
					<?php }else{ ?>
					<span>
					  <input type="checkbox" name="qus1_3_4" class="flat-red" value="1"  checked="checked" onclick="enablequs1_3();">&nbsp; 
						แบบสังเกตผู้ป่วยจิตเวชที่มีความเสี่ยงต่อการก่อความรุนแรง (Mind7)
					</span><br>
					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus1_3">โปรดระบุเครื่องมือที่ใช้</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus1_3" type="text" class="form-control" id="other_qus1_3" value="<?PHP echo $qus1_3[4] ; ?>" placeholder="โปรดระบุ" required>
					</p> 
					<?php } ?>		
				  
					<script>
						
						function enablequs1_3() {
						  var g = document.getElementById("other_qus1_3").disabled;
							if( g ){
								document.getElementById("other_qus1_3").disabled = false;
							}else{
								document.getElementById("other_qus1_3").disabled = true;
							}

						}

					</script>     
					  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<h5><i class='fas fa-edit'></i> 2. งานบริการจิตเวชชุมชน</h5>
			<div class="card card-outline card-warning">
				<div class="card-header">
					<h3 class="card-title"></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
					<?php if($qus2_1[0] == '0'){ ?> 
					  <input name="qus2_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
						มีระบบบริการติดตามดูแลผู้ป่วยจิตเวชต่อเนื่องในชุมชน
					</span><br>
					<span>
					<?php if($qus2_1[1] == '0'){ ?> 
					  <input name="qus2_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
					 
						มีบริการปฐมพยาบาลทางใจในสถานการณ์วิกฤตได้
					</span>
						
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<h5><i class='fas fa-edit'></i> 3. งานสุขภาพจิตและจิตเวชเด็กและวัยรุ่น</h5>
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.1 งานบริการผู้ป่วยนอก (OPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
					<?php if($qus3_1[0] == '0'){ ?> 
					  <input name="qus3_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>		
						มีบริการคัดกรองผู้ป่วยเด็กปฐมวัยพัฒนาการล้าช้า ด้วยเครื่องมือ DSPM และ DAIM
					</span><br>
					<span>
					<?php if($qus3_1[1] == '0'){ ?> 
					  <input name="qus3_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
						ส่งเสริมพัฒนาการและทักษะการเลี้ยงดูในเด็กปฐมวัย
					</span><br>
					<span>
					<?php if($qus3_1[2] == '0'){ ?> 
					  <input name="qus3_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
					  
						มีบริการให้คำแนะนำในการปรับพฤติกรรมเด็กและวัยรุ่น
					</span>
						
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.2 บุคลากร</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
					<?php if($qus3_2[0] == '0'){ ?> 
					   <input type="checkbox" name="qus3_2_1" class="flat-red" value="0">&nbsp; 
					<?php }else{ ?>
					   <input type="checkbox" name="qus3_2_1" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
						  
						มีบุคคลากรสาธารณสุข<b>รับผิดชอบหลัก</b>งานสุขภาพจิตและจิตเวชเด็กและวัยรุ่นที่ผ่านการอบรมความรู้เบื้องต้น
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการคัดกรองผู้มีปัญหาสุขภาพจิตและจิตเวช โปรดระบุตำแหน่ง
					</span><br>
					<div style="padding-left: 25px;">
						<span>
						<?php if($qus3_2[1] == 'พยาบาล'){ ?> 
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="พยาบาล" checked="checked" onclick="enablequs3_2_1();">&nbsp; 
						<?php }else{ ?>
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="พยาบาล" onclick="enablequs3_2_1();" >&nbsp; 
						<?php } ?>
							พยาบาล
						</span><br>
						<span>
						<?php if($qus3_2[1] == 'นักวิชาการสาธารณสุข'){ ?> 
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข" checked="checked" onclick="enablequs3_2_1();">&nbsp; 
						<?php }else{ ?>
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข" onclick="enablequs3_2_1();">&nbsp; 
						<?php } ?>	
							นักวิชาการสาธารณสุข 
						</span><br>
						<span>
						<?php if($qus3_2[1] == 'อื่นๆ'){ ?> 
							<input name="rqus3_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs3_2();" checked="checked">&nbsp; 
							อื่น ๆ 
						</span><br>

						<p class="col-md-6" style="margin-top:7px;">
						  <span for="other_rqus3_2_1">โปรดระบุ</span><b><span style="color:red;">*</span></b>
						  <input name="other_rqus3_2_1" type="text" class="form-control" id="other_rqus3_2_1" value="<?PHP echo $qus3_2[2]; ?>" placeholder="โปรดระบุ" disabled required>
						</p> 

						<?php }else{ ?>


						<input name="rqus3_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs3_2();">&nbsp; 
								อื่น ๆ 
							</span><br>

							<p class="col-md-6" style="margin-top:7px;">
							  <span for="other_rqus3_2_1">โปรดระบุ</span><b><span style="color:red;">*</span></b>
							  <input name="other_rqus3_2_1" type="text" class="form-control" id="other_rqus3_2_1" placeholder="โปรดระบุ" disabled required>
						</p> 

						<?php } ?>
					</div>
					<script>
						function enablequs3_2_1() {
						 
								document.getElementById("other_rqus3_2_1").disabled = true;
							
						}
						function enablequs3_2() {
						  var g = document.getElementById("other_rqus3_2_1").disabled;
							if( g ){
								document.getElementById("other_rqus3_2_1").disabled = false;
							}else{
								document.getElementById("other_rqus3_2_1").disabled = true;
							}

						}

					</script>     
										
					<span>
					<?php if($qus3_3[0] == 'คนเดียวกับงานจิตเวชผู้ใหญ่'){ ?> 
					   <input type="radio" name="qus3_2_2" class="flat-red" value="คนเดียวกับงานจิตเวชผู้ใหญ่"  checked="checked">&nbsp; 
					<?php }else{ ?>
					   <input type="radio" name="qus3_2_2" class="flat-red" value="คนเดียวกับงานจิตเวชผู้ใหญ่">&nbsp; 
					<?php } ?>	 
						คนเดียวกับงานจิตเวชผู้ใหญ่
					</span><br>
					<span> 
					<?php if($qus3_3[0] == 'คนละคนกับงานจิตเวชผู้ใหญ่'){ ?> 
					   <input type="radio" name="qus3_2_2" class="flat-red" value="คนละคนกับงานจิตเวชผู้ใหญ่" checked="checked">&nbsp; 
					<?php }else{ ?>
					   <input type="radio" name="qus3_2_2" class="flat-red" value="คนละคนกับงานจิตเวชผู้ใหญ่" >&nbsp; 
					<?php } ?>	
						คนละคนกับงานจิตเวชผู้ใหญ่
					</span>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.3 เครื่องมือ/อุปกรณ์/เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
					<?php if($qus3_5[0] == '0'){ ?> 
					  <input name="qus3_3_1" type="checkbox" class="flat-red" value="0">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_3_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
						แบบบันทึก การเฝ้าระวังและส่งเสริมพัฒนาการ เด็กปฐมวัย DSPM
					</span><br>
					<span>
					<?php if($qus3_5[1] == '0'){ ?> 
					  <input name="qus3_3_2" type="checkbox" class="flat-red" value="0">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_3_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>		
						แบบคัดกรอง DAIM
					</span><br>
					<?php if($qus3_5[2] == '0'){ ?> 
					<span>
					  <input type="checkbox" name="qus3_3_3" class="flat-red" value="0" onclick="enablequs3_3();">&nbsp; 
						อื่น ๆ
					</span><br>

					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus3_3">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_3" type="text" class="form-control" id="other_qus3_3" placeholder="โปรดระบุ" disabled required>
					</p>
					<?php }else{ ?>
					<span>
					  <input type="checkbox" name="qus3_3_3" class="flat-red" value="1" onclick="enablequs3_3();" checked="checked">&nbsp; 
						อื่น ๆ
					</span><br>

					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus3_3">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_3" type="text" class="form-control" id="other_qus3_3" value="<?PHP echo $qus3_5[3] ;?>" placeholder="โปรดระบุ"  required>
					</p>
					<?php } ?>
					
					<script>
						function enablequs3_3() {
						  var g = document.getElementById("other_qus3_3").disabled;
							if( g ){
								document.getElementById("other_qus3_3").disabled = false;
							}else{
								document.getElementById("other_qus3_3").disabled = true;
							}

						}

					</script>     
					</p> 
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		    
		    <h5><i class='fas fa-edit'></i> จำนวนผู้ป่วย</h5>
		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title">จำนวนผู้ป่วยมีงบประมาณ 2566</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-9">
							<div class="row" style="padding-bottom: 5px;">				  
								  <div class="col-md-5">จำนวนผู้ป่วยจิตเวชทั้งหมด</div>
								  <div class="col-md-3">
									  <input name="number_patients_1" type="text" class="form-control" id="number_patients_1" value="<?php echo $number_patients[0]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน</div>
								  <div class="col-md-3">
									  <input name="number_patients_2" type="text" class="form-control" id="number_patients_2" value="<?php echo $number_patients[1]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยจิตเวช refer in</div>
								  <div class="col-md-3">
									  <input name="number_patients_3" type="text" class="form-control" id="number_patients_3" value="<?php echo $number_patients[2]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยจิตเวช refer out</div>
								  <div class="col-md-3">
									  <input name="number_patients_4" type="text" class="form-control" id="number_patients_4" value="<?php echo $number_patients[3]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยโรคจิต (F20-F29)</div>
								  <div class="col-md-3">
									  <input name="number_patients_5" type="text" class="form-control" id="number_patients_5" value="<?php echo $number_patients[4]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยซึมเศร้า (F32.0-F32.9, F33.0-F33.9, F34.1)</div>
								  <div class="col-md-3">
									  <input name="number_patients_6" type="text" class="form-control" id="number_patients_6" value="<?php echo $number_patients[5]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยสุราและสารเสพติด (F10-F19)</div>
								  <div class="col-md-3">
									  <input name="number_patients_7" type="text" class="form-control" id="number_patients_7" value="<?php echo $number_patients[6]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยเด็กออทิสติก (F84.0-F84.9)</div>
								  <div class="col-md-3">
									  <input name="number_patients_8" type="text" class="form-control" id="number_patients_8" value="<?php echo $number_patients[7]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยเด็กสมาธิสั้น (F90)</div>
								  <div class="col-md-3">
									  <input name="number_patients_9" type="text" class="form-control" id="number_patients_9" value="<?php echo $number_patients[8]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนเด็กได้รับบริการคัดกรองด้วยเครื่องมือ DSPM และ DAIM</div>
								  <div class="col-md-3">
									  <input name="number_patients_10" type="text" class="form-control" id="number_patients_10" value="<?php echo $number_patients[9]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5">จำนวนผู้ป่วยคลินิกกระตุ้นพัฒนาการ</div>
								  <div class="col-md-3">
									  <input name="number_patients_11" type="text" class="form-control" id="number_patients_11" value="<?php echo $number_patients[10]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  ถ้าไม่มีให้ใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>

						</div>

						<div class="col-md-3">
							<p class="text-danger"><i class='fas fa-exclamation-circle'></i>&nbsp;&nbsp;<u>หากไม่มีข้อมูลให้กรอกเลข 0 เท่านั้น</u></p>
						</div>
					</div>
					
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		  
		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title"><i class='far fa-hand-point-right'></i> ปัญหาและอุปสรรคที่ทำให้ไม่สามารถจัดบริการได้ตามคุณภาพดังกล่าว</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<div class="col-md-6 form-group">
						<textarea name="problems_obstacles" rows="3" class="form-control" id="problems_obstacles" placeholder="ถ้ามี"><?php echo $problems_obstacles; ?></textarea>
					</div>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		  
		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title"><i class='far fa-hand-point-right'></i> ข้อเสนอแนะ</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<div class="col-md-6 form-group">
						<textarea name="feedback" rows="3" class="form-control" id="feedback" placeholder="ถ้ามี"><?php echo $feedback; ?></textarea>
					</div>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		  
		     <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title"><i class='far fa-hand-point-right'></i> แผนการพัฒนางานระบบบริการสุขภาพจิตและจิตเวช</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<div class="col-md-6 form-group">
						<textarea name="DevelopmentPlan" rows="3" class="form-control" id="DevelopmentPlan" placeholder="ถ้ามี"><?php echo $DevelopmentPlan; ?></textarea>
					</div>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="text-muted mt-3">
			  <?PHP if($statusfinal <> '1'){ ?>	
			  <div class="row">
				  <div class="col-md-6">
					 <!-- <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>-->
					  <a href="detail-1.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
				  </div>
				  <div class="col-md-6" align="right">
					  <input type="hidden" value="0" name="statusfinal" id="statusfinal">  
					  <button type="submit" class="btn btn-success"> ส่งข้อมูล &nbsp;<i class="fa fas fa-paper-plane"></i></button>
					  
					  <script>
						function savefinal() {
							document.getElementById("statusfinal").value = "1";
							document.getElementById('formupdate').submit();
						}

					</script> 
					  
				  </div>
			  </div>
			<?PHP  } ?>	
			</div>
			  
		  </div>
	  </div>

      <!-- /.card -->
	</form>
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
