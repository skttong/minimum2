<?php

include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '$HospitalID' AND qustype = '3'"; 

//$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '10697'";

$queryupdate = mysqli_query($con, $splupdate);
$resultupdate = mysqli_fetch_array($queryupdate);

/* if($resultupdate['numrow'] == 0 ){ */

$FID = $_GET['FID'] ;

$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus2_2, qus2_2_1, qus2_2_2, qus2_3, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5, qus4_1, qus4_2, qus5_1, number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal FROM serviceform  WHERE mhpsID = '$FID';"; 

//$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5,number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal  FROM serviceform WHERE HospitalID = '10697'; "; 	
    
$queryfcenter = mysqli_query($con, $sqlfcenter);
$resultfcenter = mysqli_fetch_array($queryfcenter);
    
$mhpsID = $resultfcenter['mhpsID'];	
$qus1_1 = preg_split ("/\,/", $resultfcenter['qus1_1']); 	
$qus1_2 = preg_split ("/\,/", $resultfcenter['qus1_2']);
$qus1_3 = preg_split ("/\,/", $resultfcenter['qus1_3']);
$qus1_4 = preg_split ("/\,/", $resultfcenter['qus1_4']);
$qus2_1 = preg_split ("/\,/", $resultfcenter['qus2_1']);
$qus2_2 = preg_split ("/\,/", $resultfcenter['qus2_2']);
$qus2_2_1 = preg_split ("/\,/", $resultfcenter['qus2_2_1']);
$qus2_2_2 = preg_split ("/\,/", $resultfcenter['qus2_2_2']);
$qus2_3 = preg_split ("/\,/", $resultfcenter['qus2_3']);	
$qus3_1 = preg_split ("/\,/", $resultfcenter['qus3_1']);
$qus3_2 = preg_split ("/\,/", $resultfcenter['qus3_2']);
$qus3_3 = preg_split ("/\,/", $resultfcenter['qus3_3']);
$qus3_4 = preg_split ("/\,/", $resultfcenter['qus3_4']);
$qus3_5 = preg_split ("/\,/", $resultfcenter['qus3_5']);
$qus4_1 = preg_split ("/\,/", $resultfcenter['qus4_1']);
$qus4_2 = preg_split ("/\,/", $resultfcenter['qus4_2']);
$qus5_1 = preg_split ("/\,/", $resultfcenter['qus5_1']);

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

print_r($qus2_3);
echo "<br>";
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
</script>	
	-->
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
			  ระบบบริการสุขภาพจิตและจิตเวช ระดับหน่วยบริการปฐมภูมิ
 			<span class="text-green"> (คลินิกหมอครอบครัว : PCU, โรงพยาบาลส่งเสริมสุขภาพตำบล)</span>
			</h3><br>
			<p class="text-muted">
			โปรดทำเครื่องหมาย <i class="fa fa-check margin-r-5"></i> ในช่องว่าง หากมีบริการดังกล่าว (ในกรณีที่โรงพยาบาลของท่าน “ไม่มี” ให้เว้นว่างไว้)
		    </p>
		  </div>
		  <div class="card-body">	
			
		  <h5><i class='fas fa-edit'></i> 1. บริการจิตเวชฉุกเฉิน</h5>
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
                    <?php if($qus1_1[0] == '0'){ ?> 
						  <input name="qus1_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  <!--<input type="checkbox" name="qus1_1_1" class="flat-red" value="1">&nbsp;--> 
					  บริการแจ้งเหตุด่วนกรณีเกิดความรุนแรงในชุมชน
					</span><br>
					<span>
                    <?php if($qus1_1[1] == '0'){ ?> 
						  <input name="qus1_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					
					  ประสานงานเพื่อดูแลแบบ On-scene care และส่งต่อผู้ป่วยจิตเวชไปยังสถานบริการทุติยภูมิ
					  </span><br>
					<span>
                    <?php if($qus1_1[2] == '0'){ ?> 
						  <input name="qus1_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus1_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  การฝึกซ้อมแผนเผชิญเหตุ
					</span>
						
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<h5><i class='fas fa-edit'></i> 2. งานสุขภาพจิตและจิตเวชผู้ใหญ่ และ ผู้สูงอายุ</h5>
			
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">2.1 งานบริการผู้ป่วยนอก (OPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
					  
					  บริการคัดกรอง/ประเมินและช่วยเหลือผู้มีปัญหาสุขภาพจิต (และยาเสพติด) เบื้องต้นในคลินิกโรคทางกาย ( NCD ,ANC ,Clinic ผู้สูงอายุ และอื่นๆ) 
					</span><br>
					<span>
                    <?php if($qus2_1[1] == '0'){ ?> 
						  <input name="qus2_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีคลินิกจิตเวชและยาเสพติด
					</span><br>
					<span>
                    <?php if($qus2_1[2] == '0'){ ?> 
						  <input name="qus2_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีบริการคัดกรองการใช้สารเสพติด
					</span><br>
					<span>
                    <?php if($qus2_1[3] == '0'){ ?> 
						  <input name="qus2_1_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีบริการให้การปรึกษาด้านสุขภาพจิตเบื้องต้น/ บริการให้คำปรึกษา (Mental Health Counseling/ Strength Based Counseling)
					</span><br>
					<span>
                    <?php if($qus2_1[4] == '0'){ ?> 
						  <input name="qus2_1_5" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  บริการสุขภาพจิตศึกษา (Psychoeducation)
					</span><br>
					<span>
                    <?php if($qus2_1[5] == '0'){ ?> 
						  <input name="qus2_1_6" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีให้คำแนะนำหรือบริการสนทนาสร้างแรงจูงใจเพื่อการปรับเปลี่ยนพฤติกรรมุขภาพ (MI)
					</span><br>
					<span>
                    <?php if($qus2_1[6] == '0'){ ?> 
						  <input name="qus2_1_7" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  บริการปรับเปลี่ยนพฤติกรรมเด็กและวัยรุ่น (Behavioral Modification)
					</span><br>
					<span>
                    <?php if($qus2_1[7] == '0'){ ?> 
						  <input name="qus2_1_8" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_8" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  มีบริการบำบัดผู้ป่วยยาเสพติด ( Motivation interview : MI )
					</span><br>
					<span>
                    <?php if($qus2_1[8] == '0'){ ?> 
						  <input name="qus2_1_9" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_9" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีบริการรับยาจิตเวชต่อเนื่องที่ รพ.สต.
					</span><br>
					<span>
                    <?php if($qus2_1[9] == '0'){ ?> 
						  <input name="qus2_1_10" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_10" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  มีบริการฉีดยาจิตเวชชนิดออกฤทธิ์ระยะยาว
					</span><br>
					<span>
                    <?php if($qus2_1[10] == '0'){ ?> 
						  <input name="qus2_1_11" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_11" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  บริการสนับสนุนการตรวจรักษาจิตเวชทางไกล (Telepsychiatry)
					</span><br>
					<span>
                    <?php if($qus2_1[11] == '0'){ ?> 
						  <input name="qus2_1_12" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_1_12" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีระบบส่งต่อผู้ป่วยจิตเวชในรายที่เกินขีดความสามารถไปยังโรงพยาบาลศักยภาพสูง
					</span><br>						  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">2.2 บุคคลากร</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span><!--(ถ้าไม่มีข้ามไปข้อ 1.3)-->
                    <?php if($qus2_2[0] == '0'){ ?> 
						  <input name="qus2_2_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					มีบุคลากรสาธารณสุข <b>ผู้รับผิดชอบหลัก</b>งานสุขภาพจิตและจิตเวชที่ผ่านการอบรมความรู้เบื้องต้น<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการคัดกรองผู้มีปัญหาสุขภาพจิตและจิตเวช <i>โดยถ้ามีโปรดระบุตำแหน่ง</i>
					</span><br>
				<div style="padding-left: 25px;">
					<span>
					  <input name="rqus2_2_1" type="radio" class="flat-red" value="พยาบาล" onclick="enablequs2_2_1();">&nbsp; 
						พยาบาล
					</span><br>
					<span>
					  <input name="rqus2_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข" onclick="enablequs2_2_1();">&nbsp; 
						นักวิชาการสาธารณสุข 
					</span><br>
					<span>
					  <input name="rqus2_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs2_2();">&nbsp; 
						อื่น ๆ
					</span><br>
					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_rqus2_2_1">โปรดระบุ 1 ตำแหน่งเท่านั้น</span><b><span style="color:red;">*</span></b>
					  <input name="other_rqus2_2_1" type="text" class="form-control" id="other_rqus2_2_1" placeholder="โปรดระบุ"  disabled required>
					</p> 
				</div>
				<span><!--(ถ้าไม่มีข้ามไปข้อ 1.3)-->
					<input type="checkbox" name="qus2_2_2" class="flat-red" value="1">&nbsp;  
					มีแพทย์ หรือจิตแพทย์ part time รักษาผู้ป่วยจิตเวชและยาเสพติด (ทั้งรูปแบบ onsite และ online)
					</span><br>
					<script>
						function enablequs2_2_1() {
							
						  
								document.getElementById("other_rqus2_2_1").disabled = true;
							

						}
						function enablequs2_2() {
						  var g = document.getElementById("other_rqus2_2_1").disabled;
							if( g ){
								document.getElementById("other_rqus2_2_1").disabled = false;
							}else{
								document.getElementById("other_rqus2_2_1").disabled = true;
							}

						}

					</script>  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->

			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">     2.2.1 บุคลากรสาธารณสุข : บุคลากรประจำหน่วยบริการปฐมภูมิอย่างน้อย 1 คน ได้รับการพัฒนาศักยภาพทุก 2 ปี หรือมีแผนพัฒนาศักยภาพบุคลากร</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
                    <?php if($qus2_2_1[0] == '0'){ ?> 
						  <input name="qus2_2_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					
					  การรับฟังเชิงลึก (Deep Listening)
					</span><br>
					<span>
                    <?php if($qus2_2_1[1] == '0'){ ?> 
						  <input name="qus2_2_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  การให้การปรึกษาด้านสุขภาพจิต (Mental Health Counseling/ Strength Based Counseling)
					</span><br>
					<span>
                    <?php if($qus2_2_1[2] == '0'){ ?> 
						  <input name="qus2_2_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  การสนทนาสร้างแรงจูงใจเพื่อการปรับเปลี่ยนพฤติกรรม (MI)
					</span><br>
					<span>
                    <?php if($qus2_2_1[3] == '0'){ ?> 
						  <input name="qus2_2_1_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  สุขภาพจิตศึกษา (Psychoeducation): ความรู้เบื้องต้นโรคจิตเวช เรื่องการค้นหา และการคัดกรองอาการ แนวทางการรักษาด้วยยา และการทำจิตสังคม (Psychosocial) เบื้องต้น
					</span><br>
					
			   
					  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">    2.2.2 อาสาสมัครสาธารณสุขประจำหมู่บ้าน (อสม.) : มีความรู้/ ทักษะ </h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
                    <?php if($qus2_2_2[0] == '0'){ ?> 
						  <input name="qus2_2_2_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_2_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  การรับฟังเชิงลึก (Deep Listening)
					</span><br>
					<span>
                    <?php if($qus2_2_2[1] == '0'){ ?> 
						  <input name="qus2_2_2_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_2_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					   
					  การค้นหา/ คัดกรองผู้มีปัญหาสุขภาพจิตและพัฒนาการ
					</span><br>
					<span>
                    <?php if($qus2_2_2[2] == '0'){ ?> 
						  <input name="qus2_2_2_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_2_2_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  อาการเบื้องต้นของโรคทางจิตเวช
					</span><br>
					
					
			   
					  
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">2.3 เครื่องมือ/อุปกรณ์/เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
                    <?php if($qus2_3[1] == '0'){ ?> 
						  <input name="qus2_3_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  มีแบบประเมิน/ คัดกรองสุขภาพจิต 2Q, 9Q, 8Q, 2Q+, RQ
					</span><br>
					<span>
                    <?php if($qus2_3[2] == '0'){ ?> 
						  <input name="qus2_3_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีแบบประเมิน Mini cog
					</span><br>
					<span>
                    <?php if($qus2_3[3] == '0'){ ?> 
						  <input name="qus2_3_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  แบบประเมินความเครียด (ST 5)
					</span><br>
					<span>
                         <?php if($qus2_3[4] == '0'){ ?> 
						  <input name="qus2_3_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  5 สัญญานเตือนการก่อความรุนแรง (SMI-V Scan)
					</span><br>
					<span>
                    <?php if($qus2_3[5] == '0'){ ?> 
						  <input name="qus2_3_5" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  แบบคัดกรองและส่งต่อผู้ป่วยที่ใช้ยาและสารเสพติดเพื่อรับการบำบัดรักษา (บคก.กสธ.) V.2
					</span><br>
					<span>
                    <?php if($qus2_3[6] == '0'){ ?> 
						  <input name="qus2_3_6" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  แบบคัดกรองสมรรถภาพสมอง (ภาวะสมองเสื่อม) (Abbreviated Mental Test: AMT)
					</span><br>
					<span>
                    <?php if($qus2_3[7] == '0'){ ?> 
						  <input name="qus2_3_7" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus2_3_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  แบบประเมินกิจวัตรประจําวัน ดัชนีบารเธลเอดีแอล (Barthel Activities of Daily Living: ADL)
					</span><br>
					<!--<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus1_3">โปรดระบุเครื่องมือที่ใช้</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus1_3" type="text" class="form-control" id="other_qus1_3" placeholder="โปรดระบุ" disabled required>
					</p> 
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
					-->
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			
			
			<h5><i class='fas fa-edit'></i> 3. งานบริการจิตเวชชุมชน</h5>
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
                    <?php if($qus3_1[0] == '0'){ ?> 
						  <input name="qus3_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
                       มีระบบบริการติดตามดูแลผู้ป่วยจิตเวชต่อเนื่องในชุมชน (มีบริการเยี่ยมบ้าน ค้นหาครอบครัวเสี่ยงต่อการก่อความรุนแรง (SMI-V Scan), มีบริการเยี่ยมบ้านติดตามดูแลต่อเนื่องในผู้ป่วยจิตเวชและจิตเวชยาเสพติด (V Care) )
					</span><br>
					<span>
                    <?php if($qus3_1[1] == '0'){ ?> 
						  <input name="qus3_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  การจัดการรายกรณี (Case Management) (ประสานความร่วมมือกับทีมจัดการรายกรณี (CaseManagement Team) ร่วมกับหน่วยงานด้านสังคมและความมั่นคง เพื่อการดูแลผู้ป่วยจิตเวชยาเสพติดและผู้ป่วย SMI-V)
					</span><br>
					<span>
                    <?php if($qus3_1[2] == '0'){ ?> 
						  <input name="qus3_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีระบบบริการคัดกรองสุขภาพจิตในชุมชน
					</span><br>
					<span>
                    <?php if($qus3_1[3] == '0'){ ?> 
						  <input name="qus3_1_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีระบบบริการคัดกรองสุขภาพจิตเด็กและวัยรุ่นในโรงเรียน หรือชุมชน
					</span><br>
					<span>
                    <?php if($qus3_1[4] == '0'){ ?> 
						  <input name="qus3_1_5" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_5" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีการจัดกิจกรรมส่งเสริมสุขภาพจิตในชุมชน ร่วมกับ เครือข่ายในพื้นที่ ( เช่น วัคซีนใจ)
					</span><br>
					<span>
                    <?php if($qus3_1[5] == '0'){ ?> 
						  <input name="qus3_1_6" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_6" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					
					  มีบริการปฐมพยาบาลทางใจในสถานการณ์วิกฤตได้
					</span><br>
					<span>
                    <?php if($qus3_1[6] == '0'){ ?> 
						  <input name="qus3_1_7" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus3_1_7" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  มีบริการเยียวยาจิตใจในภาวะวิกฤติ
					</span><br>
					
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<h5><i class='fas fa-edit'></i> 4. งานสุขภาพจิตและจิตเวชเด็กและวัยรุ่น</h5>
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">4.1 งานบริการผู้ป่วยนอก (OPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
                    <?php if($qus4_1[0] == '0'){ ?> 
						  <input name="qus4_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
						มีบริการคัดกรองผู้ป่วยเด็กปฐมวัยพัฒนาการล้าช้า ด้วยเครื่องมือ DSPM และ DAIM
					</span><br>
					<span>
                    <?php if($qus4_1[1] == '0'){ ?> 
						  <input name="qus4_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
					  มีระบบส่งต่อผู้ป่วยเด็กปฐมวัยพัฒนาการล้าช้า
					</span><br>
					<span>
                    <?php if($qus4_1[2] == '0'){ ?> 
						  <input name="qus4_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
						ส่งเสริมพัฒนาการและทักษะการเลี้ยงดูในเด็กปฐมวัย
					</span><br>
					<span>
                    <?php if($qus4_1[3] == '0'){ ?> 
						  <input name="qus4_1_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_1_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
						มีบริการให้คำแนะนำในการปรับพฤติกรรมเด็กและวัยรุ่น
					</span>
						
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			<?php /*  
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
					  <input type="checkbox" name="qus3_2_1" class="flat-red" value="1">&nbsp; 
						มีบุคคลากรสาธารณสุข<b>รับผิดชอบหลัก</b>งานสุขภาพจิตและจิตเวชเด็กและวัยรุ่นที่ผ่านการอบรมความรู้เบื้องต้น
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในการคัดกรองผู้มีปัญหาสุขภาพจิตและจิตเวช โปรดระบุตำแหน่ง
					</span><br>
					<div style="padding-left: 25px;">
						<span>
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="พยาบาล">&nbsp; 
							พยาบาล
						</span><br>
						<span>
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="นักวิชาการสาธารณสุข">&nbsp; 
							นักวิชาการสาธารณสุข 
						</span><br>
						<span>
						  <input name="rqus3_2_1" type="radio" class="flat-red" value="อื่นๆ" onclick="enablequs3_2();">&nbsp; 
							อื่น ๆ 
						</span><br>

						<p class="col-md-6" style="margin-top:7px;">
						  <span for="other_rqus3_2_1">โปรดระบุ</span><b><span style="color:red;">*</span></b>
						  <input name="other_rqus3_2_1" type="text" class="form-control" id="other_rqus3_2_1" placeholder="โปรดระบุ" disabled required>
						</p> 
					</div>
					<script>
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
					  <input type="radio" name="qus3_2_2" class="flat-red" value="1">&nbsp; 
						คนเดียวกับงานจิตเวชผู้ใหญ่
					</span><br>
					<span>
					  <input type="radio" name="qus3_2_3" class="flat-red" value="1">&nbsp; 
						คนละคนกับงานจิตเวชผู้ใหญ่
					</span>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  */ ?>
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">4.2 เครื่องมือ/อุปกรณ์/เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
                    <?php if($qus4_2[0] == '0'){ ?> 
						  <input name="qus4_2_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_2_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
						แบบบันทึก การเฝ้าระวังและส่งเสริมพัฒนาการ เด็กปฐมวัย DSPM
					</span><br>
					<span>
                    <?php if($qus4_2[1] == '0'){ ?> 
						  <input name="qus4_2_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_2_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					  
						แบบคัดกรอง DAIM
					</span><br>
					<span>
                    <?php if($qus4_2[2] == '0'){ ?> 
						  <input name="qus4_2_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_2_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  แบบประเมินความฉลาดทางด้านอารมณ์เด็กปฐมวัย 3-5 ปี ฉบับพ่อแม่ ผู้ปกครอง
					</span><br>

					<span>
                    <?php if($qus4_2[3] == '0'){ ?> 
						  <input name="qus4_2_4" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus4_2_4" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  บริการฝึกทักษะการเลี้ยงดูเด็กปฐมวัย
					</span><br>
					<?php /*
					<span>
					  <input type="checkbox" name="qus3_3_3" class="flat-red" value="1" onclick="enablequs3_3();">&nbsp; 
						อื่น ๆ
					</span><br>

					<p class="col-md-6" style="margin-top:7px;">
					  <span for="other_qus3_3">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_3" type="text" class="form-control" id="other_qus3_3" placeholder="โปรดระบุ" disabled required>
					</p> 
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
					*/ ?>  
					
					
					</div>
					
				
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->

			
			<h5><i class='fas fa-edit'></i> 5. เทคโนโลยีที่ใช้ในงานสุขภาพจิตและจิตเวช (พัฒนา วางแผน/แนวทาง การใช้เทคโนโลยีดังกล่าวในการให้บริการ)</h5>
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
                    <?php if($qus5_1[0] == '0'){ ?> 
						  <input name="qus5_1_1" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus5_1_1" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  Mental Health Check-in 
					</span><br>
					<span>
                    <?php if($qus5_1[1] == '0'){ ?> 
						  <input name="qus5_1_2" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus5_1_2" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
					 
					  Application คุณหมอพอดี D-Mind
					</span><br>
					<span>
                    <?php if($qus5_1[2] == '0'){ ?> 
						  <input name="qus5_1_3" type="checkbox" class="flat-red" value="1">&nbsp; 
						<?php }else{ ?>
						  <input name="qus5_1_3" type="checkbox" class="flat-red" value="1" checked="checked">&nbsp; 
						<?php } ?>
						Telepsychiatry บริการจิตเวชทางไกล
					</span><br>


						
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		    
		    <h5><i class='fas fa-edit'></i> จำนวนผู้ป่วย</h5>
		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title">จำนวนผู้รับบริการ ปีงบประมาณ <?php echo date("Y")+543-1 ;?>
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
									  <input name="number_patients_1" type="number" class="form-control" id="number_patients_1" value="<?php echo $number_patients[0]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่รับบริการ OPD</div>
								  <div class="col-md-3">
									  <input name="number_patients_2" type="number" class="form-control" id="number_patients_2" value="<?php echo $number_patients[1]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่รับบริการ IPD</div>
								  <div class="col-md-3">
									  <input name="number_patients_3" type="number" class="form-control" id="number_patients_3" value="<?php echo $number_patients[2]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่มารับบริการแผนก ER
									<?php /*<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">กระบวนการรับการส่งต่อผู้ป่วย <br>จากสถานพยาบาลอื่น (refer in)</span>
									</div> */ ?>
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_4" type="number" class="form-control" id="number_patients_4" value="<?php echo $number_patients[3]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<!--<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out
									<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">กระบวนการส่งต่อผู้ป่วย <br>ไปยังสถานพยาบาลอื่น (refer out)</span>
									</div>
								  </div>
								  <div class="col-md-3">
									  <input name="number_patients_5" type="number" class="form-control" id="number_patients_5" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
					-->
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer in</div>
								  <div class="col-md-3">
									  <input name="number_patients_5" type="text" class="form-control" id="number_patients_5" value="<?php echo $number_patients[4]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
						
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out ทั้งหมด</div>
								  <div class="col-md-3">
									  <input name="number_patients_6" type="text" class="form-control" id="number_patients_6" value="<?php echo $number_patients[5]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out สำหรับ admit</div>
								  <div class="col-md-3">
									  <input name="number_patients_7" type="text" class="form-control" id="number_patients_7" value="<?php echo $number_patients[6]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน</div>
								  <div class="col-md-3">
									  <input name="number_patients_8" type="text" class="form-control" id="number_patients_8" value="<?php echo $number_patients[7]; ?>"  placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<?php /*
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยเด็กสมาธิสั้น (F90)</div>
								  <div class="col-md-3">
									  <input name="number_patients_9" type="text" class="form-control" id="number_patients_9" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							*/ ?>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยคลินิกกระตุ้น</div>
								  <div class="col-md-3">
									  <input name="number_patients_9" type="number" class="form-control" id="number_patients_9" value="<?php echo $number_patients[8]; ?>"placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ได้รับผลกระทบจากสถานการณ์วิกฤต (MCATT)</div>
								  <div class="col-md-3">
									  <input name="number_patients_10" type="number" class="form-control" id="number_patients_10" value="<?php echo $number_patients[9]; ?>" placeholder="กรอกจำนวนผู้ป่วย (เฉพาะตัวเลขเท่านั้น)  " required>
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
						<textarea name="DevelopmentPlan" rows="3" class="form-control" id="DevelopmentPlan" placeholder="ถ้ามี"><?php echo $DevelopmentPlan; ?></textarea>
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
				 <!-- <div class="col-md-6" align="right">
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
