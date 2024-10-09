<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');


$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '$HospitalID' AND qustype = '2'"; 

//$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '11159'";


$queryupdate = mysqli_query($con, $splupdate);
$resultupdate = mysqli_fetch_array($queryupdate);

/* if($resultupdate['numrow'] == 0 ){ */


$FID = $_GET['FID'] ;
$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5, number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal  FROM serviceform WHERE mhpsID = '$FID'; "; 

//$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5,number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal  FROM serviceform WHERE HospitalID = '11159'; "; 	
		
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
	$feedback	= $resultfcenter['feedback'];
	$DevelopmentPlan = $resultfcenter['DevelopmentPlan'];
	$statusfinal 	= $resultfcenter['statusfinal'];
	

	
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
	<?php include "header_font.php"; ?>
<style>
.tooltip2 {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/
}

.tooltip2 .tooltiptext {
  visibility: hidden;
  width: 250px;
  background-color: #5C7EAB;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: -5px;
  left: 105%;
}

.tooltip2:hover .tooltiptext {
  visibility: visible;
}
</style>	
<!--	
<script type="text/javascript">
    window.onload=function(){
        var auto = setTimeout(function(){ autoRefresh(); }, 100);

        function submitform(){
          //alert('test');
          document.forms["form1"].submit();
        }

        function autoRefresh(){
           clearTimeout(auto);
           auto = setTimeout(function(){ submitform(); autoRefresh(); }, 10000);
        }
    }
</script>-->	
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
              <li class="breadcrumb-item active">ระดับโรงพยาบาลชุมชน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="ServiceForm_community_update.php">
		<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
		<input type="hidden" value="<?php echo $HospitalID; ?>" name="txtHospitalID">  
		<input type="hidden" value="<?php echo $mhpsID; ?>" name="txtmhpsID"> 
      <!-- Default box -->
      <div class="card card-info card-outline">
		  <div class="card-header">
			<h3 class="card-title">
			  <i class="fas fa-file-alt"></i>&nbsp;
			  ระบบบริการสุขภาพจิตและจิตเวช <span class="text-green"> ระดับโรงพยาบาลชุมชน</span>
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
                    <input type="checkbox" name="qus1_1_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>	
					  
					  มีการจัดตั้งกลุ่มงานสุขภาพจิตและยาเสพติด
						<!--<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="text-danger">**<u>อย่างน้อย 3 โรค คือ โรคจิต,โรคซึมเศร้า,สุราและสารเสพติด</u></i>-->
					</span><br>
					<span>
                    <?php 
					if($qus1_1[1] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_2" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
					
					  มีบริการ/ คลินิกสุขภาพจิตและจิตเวชที่สามารถให้การบำบัด รักษา ส่งเสริมป้องกันโรคจิตเวชทั่วไป และจิตเวชเด็กและวัยรุ่นที่ไม่ซับซ้อน แบบครบวงจร** อย่างน้อย 3 โรค โรคจิต,โรคซึมเศร้า,สุราและสารเสพติด
						<!--มีบริการ/ คลินิกสุขภาพจิตและจิตเวชที่สามารถให้การบำบัด รักษา ส่งเสริมป้องกันโรคจิตเวชที่ไม่ซับซ้อน แบบครบวงจร
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="text-danger">**<u>อย่างน้อย 3 โรค คือ โรคจิต,โรคซึมเศร้า,สุราและสารเสพติด</u></i>-->
					</span><br>
					<span>
                    <?php if($qus1_1[2] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_3" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
					  
					  มีบริการบำบัดผู้ป่วยยาเสพติด ( Motivation interview : MI )
						<!--<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="text-danger">**<u>อย่างน้อย 3 โรค คือ โรคจิต,โรคซึมเศร้า,สุราและสารเสพติด</u></i>-->
					</span><br>
					<span>
                    <?php if($qus1_1[3] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_4" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
			
						มีระบบการรับ-ส่งต่อผู้ป่วยที่มีปัญหายุ่งยากซับซ้อน
					</span><br>
					<span>
                    <?php if($qus1_1[4] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_5" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
					 
						มีระบบการติดตามผู้ป่วยจิตเวชให้มาตามนัด
					</span><br>
					<span>
                    <?php if($qus1_1[5] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_6" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>
					  
						มีระบบปรึกษา (Consult) กับแม่ข่าย
					</span><br>
					<span>
                    <?php if($qus1_1[6] == '0'){ ?> 
                    <input type="checkbox" name="qus1_1_7" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_1_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>

					  มีระบบการส่งต่อยาทางไปรษณีย์ (Inter-hospital)
					</span>
						  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.2 งานบริการผู้ป่วยใน (IPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<!--<span>
					  <input type="checkbox" name="qus1_2_1" class="flat-red" value="1">&nbsp; 
						มีบริการบำบัดรักษาโรคทางจิตเวชแบบผู้ป่วยในจิตเวชฉุกเฉิน  ในรูปแบบ Integrated bed เพื่อคัดกรองภาวะผิดปกติทางกาย 
					</span><br>-->
					<span>
                    <?php if($qus1_2[0] == '0'){ ?> 
                    <input type="checkbox" name="qus1_2_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_2_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   

						มีการทำเงื่อนไขการ Admit เพื่อสังเกตอาการในระยะสั้น (สามารถดูแลไว้ได้ภายใน 24 - 72 ชม. กรณี Case ที่ยังไม่สามารถส่งต่อไปทันที) 
					</span><br>
					<span>
                    <?php if($qus1_2[1] == '0'){ ?> 
                    <input type="checkbox" name="qus1_2_2" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_2_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>  
					  
						มีระบบปรึกษา (Consult) กับแม่ข่าย
					</span>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.3 งานบริการผู้ป่วยฉุกเฉิน</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<!--<label>มีบริการดูแลผู้ป่วยจิตเวชและยาเสพติดระยะฉุกเฉิน (Acute Care) <br>ในการวินิจฉัยและบำบัดรักษาผู้ป่วยจิตเวชเบื้องต้น ตาม พรบ.สุขภาพจิต ดังนี้ </label>
					<span class="text-danger">(ถ้ามี เลือกได้มากกว่า 1 ข้อ)</span><br>-->
					<span>
                    <?php if($qus1_3[0] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>  
					 
					  มีบริการดูแลผู้ป่วยจิตเวชและยาเสพติดระยะฉุกเฉิน (Acute Care) ในการวินิจฉัยและบำบัดรักษาผู้ป่วยจิตเวชเบื้องต้น ตาม พรบ.สุขภาพจิต ดังนี้
					</span><br>
					<span>
                    <?php if($qus1_3[1] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_2" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>  
					
					  มีการคัดแยก Case ผู้ป่วยจิตเวช
					</span><br>
					<span>
                    <?php if($qus1_3[2] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_3" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>  
					มีการใช้ยาผู้ป่วยจิตเวช
					</span><br>
					<span>
                    <?php if($qus1_3[3] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_4" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>  

					  มีการให้การปรึกษาผู้ป่วยจิตเวชญาติ
					</span><br>
					<span>
                    <?php if($qus1_3[4] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_5" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   
					 
					  มีการส่งต่อผู้ป่วยจิตเวช
					</span><br>
					<span>
                    <?php if($qus1_3[5] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_6" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   

					  การฝึกซ้อมแผนเผชิญเหตุ
					</span><br>
					<span>
                    <?php if($qus1_3[6] == '0'){ ?> 
                    <input type="checkbox" name="qus1_3_7" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_3_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   
					
					  มีบริการเยียวยาจิตใจในภาวะวิกฤติ
					</span>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">1.4 เครื่องมือ/ อุปกรณ์/ เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
                    <?php if($qus1_4[0] == '0'){ ?> 
                    <input type="checkbox" name="qus1_4_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_4_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>     
					 
						ยาทางจิตเวชที่จำเป็นของโรงพยาบาลตามบัญชียาสำคัญทางจิตเวช
					</span><br>
					<span>
                    <?php if($qus1_4[1] == '0'){ ?> 
                    <input type="checkbox" name="qus1_4_2" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_4_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    
					  
						ผ้าผูกยึด/ เครื่องมือ/ อุปกรณ์ในการจำกัดพฤติกรรมผู้ป่วย
					</span><br>
					<span>
                    <?php if($qus1_4[2] == '0'){ ?> 
                    <input type="checkbox" name="qus1_4_3" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_4_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    
					 
						มีระบบการยืมยา – แลกยากันระหว่างโรงพยาบาล
					</span><br>
					<span>
                    <?php if($qus1_4[3] == '0'){ ?> 
                    <input type="checkbox" name="qus1_4_4" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus1_4_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    
					 
						มีสื่อในการสื่อสาร/ ให้ความรู้กับผู้ป่วยจิตเวช
					</span>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<h5><i class='fas fa-edit'></i> 2. งานบริการจิตเวชชุมชน</h5>
			<div class="card card-outline card-warning">
				<!--<div class="card-header">
					<h3 class="card-title"></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>-->

				<div class="card-body">
					<span>
                    <?php if($qus2_1[0] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    

						มีบริการส่งเสริมป้องกัน และคัดกรองสุขภาพจิตและจิตเวชทั่วไปในชุมชน
					</span><br>
					<span>
                    <?php if($qus2_1[1] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_2" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>     
					  
						มีบริการส่งเสริมป้องกัน และคัดกรองสุขภาพจิตและจิตเวชเด็กและวัยรุ่นในชุมชน
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus2_1_3" class="flat-red" value="1">&nbsp; 
						มีบริการส่งเสริมป้องกัน และคัดกรองสุขภาพจิตและจิตเวชผู้สูงอายุในชุมชน
					</span><br>-->
					<span>
                    <?php if($qus2_1[2] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_4" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   
					 
						มีระบบการรับ-ส่งต่อผู้ป่วยจิตเวช
					</span><br>
					<span>
                    <?php if($qus2_1[3] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_5" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>   
					
						มีการติดตาม/ดูแลต่อเนื่องผู้ป่วยจิตเวชและยาเสพติดในชุมชน
					</span><br>
					<?php /*
					<span>
                    <?php if($qus2_1[4] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_6" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    
					 
					  มีทีม มีบริการเยียวยาจิตใจเด็กและเยาวชนในภาวะวิกฤติ
					  </span><br>
					<span>
                    <?php if($qus2_1[5] == '0'){ ?> 
                    <input type="checkbox" name="qus2_1_7" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus2_1_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>     
					  
					  มีทีม มีบริการเยียวยาจิตใจประชาชนทั่วไปในภาวะวิกฤติ
					</span>

					*/?>


				

						
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
                    <input type="checkbox" name="qus3_1_1" class="flat-red" value="1">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
					<?php } ?>    
				
					  มีบริการ/ คลินิกสุขภาพจิตและจิตเวชที่สามารถให้การบำบัด รักษา ส่งเสริมป้องกันโรคจิตเวชเด็กและวัยรุ่นที่ไม่ซับซ้อน แบบครบวงจร** อย่างน้อย 4 โรค โรคซึมเศร้า,โรคออทิสติก,โรคสมาธิสั้น, โรคพัฒนาการ/สติปัญญาบกพร่อง
						<!--มีบริการ/ คลินิกสุขภาพจิตและจิตเวชที่สามารถให้การบำบัด รักษา ส่งเสริมป้องกันโรคจิตเวชเด็กและวัยรุ่นที่ไม่ซับซ้อน แบบครบวงจร
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="text-danger">** <u>อย่างน้อย 4 โรค คือ โรคซึมเศร้า,โรคออทิสติก,โรคพัฒนาการ/ สติปัญญาบกพร่อง และโรคสมาธิสั้น</u></i>-->
					</span><br>
					<span>
                    <?php if($qus3_1[1] == '0'){ ?> 
                    <input type="checkbox" name="qus3_1_2" class="flat-red" value="1"  onclick="enablequs3_1();">&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_1_2" type="checkbox" class="flat-red" value="1" checked="checked"  onclick="enablequs3_1();">&nbsp; 
					<?php } ?>   
					 
						มีบริการคัดกรอง และกระตุ้นพัฒนาการเด็กที่มีพัฒนาการล่าช้าโปรดระบุเครื่องมือที่ใช้
					</span><br>

					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus3_1_2">โปรดระบุเครื่องมือที่ใช้</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_1_2" type="text" class="form-control" id="other_qus3_1_2" placeholder="โปรดระบุ"  disabled required>
					</p> 
					<script>
						function enablequs3_1() {
						  var g = document.getElementById("other_qus3_1_2").disabled;
							if( g ){
								document.getElementById("other_qus3_1_2").disabled = false;
							}else{
								document.getElementById("other_qus3_1_2").disabled = true;
							}

						}

					</script> 

				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.2 เครื่องมือ/ อุปกรณ์/ เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
                    <?php if($qus3_2[0] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_1" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_1" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>   
					 
						มียา Methylphenidate
					</span><br>
					<span>
                    <?php if($qus3_2[1] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_2" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_2" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>     
					  
						มียา Risperidone solution
					</span><br>
					<span>
                    <?php if($qus3_2[2] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_3" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_3" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>    
					
						แบบประเมินความสามารถทางเชาว์ปัญญาเด็กอายุ 2-15 ปี (เชาวน์เล็ก) 
					</span><br>
					<span>
                    <?php if($qus3_2[3] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_4" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_4" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>    
					  
						มีสถานที่และอุปกรณ์สำหรับกระตุ้นพัฒนาการ
					</span><br>
					<span>
                    <?php if($qus3_2[4] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_5" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_5" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>     
					 
						TEDA4I
					</span><br>
					<span>
                    <?php if($qus3_2[5] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_6" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_6" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>   
					
						แบบบันทึก การเฝ้าระวังและส่งเสริมพัฒนาการ เด็กปฐมวัย DSPM
					</span><br>
					<span>
                    <?php if($qus3_2[6] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_7" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_7" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>    
					
						แบบคัดกรอง DAIM
					</span><br>
					<span>
                    <?php if($qus3_2[7] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_8" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_8" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>      
					  
					  แบบประเมินพฤติกรรม  SNAP-IV
					</span><br>
					<span>
                    <?php if($qus3_2[8] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_9" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_9" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>     
					
					  แบบประเมินจุดแข็งและจุดอ่อน SDQ
					</span><br><span>
                    <?php if($qus3_2[9] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_10" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_10" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>    
					 
					  แบบคัดกรองโรคในกลุ่มพัฒนาการผิดปกติอย่างรอบด้าน PDDSQ
					</span><br><span>
                    <?php if($qus3_2[10] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_11" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_11" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>   
					
					  แบบประเมินภาวะซึมเศร้าในวัยรุ่น PHQ-A
					</span><br>
					<span>
                    <?php if($qus3_2[11] == '0'){ ?> 
                    <input type="checkbox" name="qus3_2_12" class="flat-red" value="1"  >&nbsp; 
					<?php }else{ ?>
					  <input name="qus3_2_12" type="checkbox" class="flat-red" value="1" checked="checked" >&nbsp; 
					<?php } ?>    
					 
					  แบบคัดกรองภาวะซึมเศร้าในเด็ก CDI
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus3_2_8" class="flat-red" value="1" onclick="enablequs3_2();">&nbsp; 
						อื่น ๆ
					</span><br>

					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus3_2_8">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_2_8" type="text" class="form-control" id="other_qus3_2_8" placeholder="โปรดระบุ"  disabled required>
					</p> 
					<script>
						function enablequs3_2() {
						  var g = document.getElementById("other_qus3_2_8").disabled;
							if( g ){
								document.getElementById("other_qus3_2_8").disabled = false;
							}else{
								document.getElementById("other_qus3_2_8").disabled = true;
							}

						}

					</script>  
					-->
					
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			 
		   <!-- <h5><i class='fas fa-edit'></i> จำนวนผู้ป่วย</h5>-->
		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title">จำนวนผู้รับบริการ ปีงบประมาณ 2566 <br>
					(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)</h3>
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
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชทั้งหมด</div>
								  <div class="col-md-3">
									  <input name="number_patients_1" type="number" class="form-control" id="number_patients_1" value="<?php echo $number_patients[0]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<!--<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชเด็กและวัยรุ่น (ต่ำกว่า 18 ปีบริบูรณ์)</div>
								  <div class="col-md-3">
									  <input name="number_patients_2" type="text" class="form-control" id="number_patients_2" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชรายใหม่ (2565)</div>
								  <div class="col-md-3">
									  <input name="number_patients_3" type="text" class="form-control" id="number_patients_3" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วย SMI-V</div>
								  <div class="col-md-3">
									  <input name="number_patients_4" type="text" class="form-control" id="number_patients_4" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
					-->
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่มารับบริการแผนก ER</div>
								  <div class="col-md-3">
									  <input name="number_patients_5" type="number" class="form-control" id="number_patients_5" value="<?php echo $number_patients[1]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่รับบริการ IPD</div>
								  <div class="col-md-3">
									  <input name="number_patients_6" type="number" class="form-control" id="number_patients_6" value="<?php echo $number_patients[2]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่มารับบริการแผนก ER</div>
								  <div class="col-md-3">
									  <input name="number_patients_7" type="number" class="form-control" id="number_patients_7" value="<?php echo $number_patients[3]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer in</div>
								  <div class="col-md-3">
									  <input name="number_patients_8" type="number" class="form-control" id="number_patients_8" value="<?php echo $number_patients[4]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5 "><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จจำนวนผู้ป่วยจิตเวช refer out ทั้งหมด
									<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">จำนวนผู้ป่วยจิตเวช refer out ทั้งหมด</span>
									</div>-->
								
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_9" type="number" class="form-control" id="number_patients_9" value="<?php echo $number_patients[5]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
									  
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out สำหรับ admit
								   <!-- <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">จำนวนผู้ป่วยจิตเวช refer out สำหรับ admit</span>
									</div>-->
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_10" type="number" class="form-control" id="number_patients_10" value="<?php echo $number_patients[6]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน
								 <!-- <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน</span>
									</div>-->
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_11" type="number" class="form-control" id="number_patients_11" value="<?php echo $number_patients[7]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<!--
							<div class="row" style="padding-bottom: 5px;">							  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคจิต (F20-F29)</div>
								  <div class="col-md-3">
									  <input name="number_patients_12" type="text" class="form-control" id="number_patients_12" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">							  
								  <div class="col-md-5">จำนวนผู้ป่วยซึมเศร้า (F32.0-F32.9, F33.0-F33.9, F34.1)</div>
								  <div class="col-md-3">
									  <input name="number_patients_13" type="text" class="form-control" id="number_patients_13" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคสุราและสารเสพติด (F10-F19)</div>
								  <div class="col-md-3">
									  <input name="number_patients_14" type="text" class="form-control" id="number_patients_14" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคสมาธิสั้น (F90)</div>
								  <div class="col-md-3">
									  <input name="number_patients_15" type="text" class="form-control" id="number_patients_15" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคออทิสติก (F84.0-F84.9)</div>
								  <div class="col-md-3">
									  <input name="number_patients_16" type="text" class="form-control" id="number_patients_16" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
					-->
					<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยคลินิกกระตุ้น
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_17" type="number" class="form-control" id="number_patients_17" value="<?php echo $number_patients[8]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ได้รับผลกระทบจากสถานการณ์วิกฤต (MCATT)
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_18" type="number" class="form-control" id="number_patients_18" value="<?php echo $number_patients[9]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
						
						</div>

						<!--<div class="col-md-3">
							<p class="text-danger"><i class='fas fa-exclamation-circle'></i>&nbsp;&nbsp;<u>หากไม่มีข้อมูลให้กรอกเลข 0 เท่านั้น</u></p>
						</div>-->
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
						<textarea name="problems_obstacles" rows="3" class="form-control" id="problems_obstacles" placeholder="ถ้ามี" required><?php echo $problems_obstacles; ?></textarea>
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
						<textarea name="feedback" rows="3" class="form-control" id="feedback" placeholder="ถ้ามี" required><?php echo $feedback; ?></textarea>
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
						<textarea name="DevelopmentPlan" rows="3" class="form-control" id="DevelopmentPlan" placeholder="ถ้ามี" required><?php echo $DevelopmentPlan; ?></textarea>
					</div>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="text-muted mt-3">
			  <div class="row">
				  <div class="col-md-6">
				  <?php if($statusfinal == '1'){ ?>
						<button type="submit" class="btn btn-primary" disabled> 
							เพิ่มปรับปรุงข้อมูล &nbsp;<i class="fa fas fa-plus"></i>
						</button>
					
					<?php	
					}else{
					?>
						 <button type="submit" class="btn btn-primary"> เพิ่มปรับปรุงข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
					<?php	
					}
					?>
					  <a href="tables-sys.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
				  </div>
				  <!--<div class="col-md-6" align="right">
					  <button type="submit" class="btn btn-success"> ส่งข้อมูล &nbsp;<i class="fa fas fa-paper-plane"></i></button>
				  </div>-->
			  </div>
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
