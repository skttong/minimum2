<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');


$bedID = $_GET['bedID'];
$sqlbed = "SELECT bedID, hospitalCode5, Wardall, Ward_no, Unit, Unit_no, 
            Integrate, Integrate_no, bedDate, EY1, EY, TN2, MM1, MM2, MM3, MM4, MM5 
            FROM `bed` WHERE bedID = '$bedID';";
$query 	= mysqli_query($con, $sqlbed);
$row1 	= mysqli_fetch_array($query);

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
	
<style>
	.error {color: #FF0000;}
</style>

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

.disabledspan {
	opacity: 0.5;          /* Make it look disabled */
}
</style>	
	
<style>
	.error {color: #FF0000;}
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
		<div class="col-sm-9">
            <!--<h4>แบบฟอร์มบันทึกข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h4>-->
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
			<h4>แบบบันทึกข้อมูลเตียง  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>แบบบันทึกข้อมูลเตียง   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">แบบฟอร์ม</a></li>
              <li class="breadcrumb-item active"> เตียงจิตเวช</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<form class="form-valide" action="bed_add_all_edit.php" method="post" id="myform1" name="foml">
			<input type="hidden" name="txtHospitalID" value="<?php echo $HospitalID; ?>"> 
			<input type="hidden" name="bedID" value="<?php echo $bedID; ?>"> 


	 

	 <!-- Default box -->
	 <div class="card card-success card-outline">
				<div class="card-header">
				  <h3 class="card-title" style="color: dimgray"> การบันทึกข้อมูลเตียงจิตเวช </h3>

				  <div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					  <i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
					  <i class="fas fa-times"></i>
					</button>
				  </div>
				</div>


				<div class="card-body">
					<?php /*
				<p>
					<b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;Psychiatric Ward <span class="text-danger">*</span></b>
					<br>
					<span style="padding-left: 18px;color: darkblue;">(หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหาร)</span>
				</p>
				
				  <div class="row">
					  
					  <div class="col-md-1" style="padding-left: 28px;">
						<span>
						  <input name="PW_Y" type="radio" class="flat-red" value="มี" onclick="enableTxt();" required>&nbsp;
							มี 
						</span>
					  </div>
					  <!-- /.col -->
					  <div class="col-md-4" align="right">
						   <span for="count_PW">จำนวนเตียง</span>
					  </div>
					  <div class="col-md-2">
						   <input name="count_PW" type="text" class="form-control" id="count_PW" placeholder="โปรดระบุจำนวนเตียง" disabled required>
					  </div>
				   </div>
				   <!-- /.row -->
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input name="PW_Y" type="radio" class="flat-red" value="ไม่มี" onclick="disableTxt();" required>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
				   <script>
						function disableTxt() {
						  document.getElementById("count_PW").disabled = true;
						  document.getElementById("count_PW").value = "";	
						}
						function enableTxt() {
						  document.getElementById("count_PW").disabled = false;
						}
					</script> 
				<hr>	
				<p>
					<b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;Psychiatric Unit <span class="text-danger">*</span></b>
					<br>
					<span style="padding-left: 18px;color: darkblue;">(เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน)</span>
				</p>
				  <div class="row">
					  
					  <div class="col-md-1" style="padding-left: 28px;">
						<span>
						  <input name="PU_Y" type="radio" class="flat-red" value="มี" onclick="enableTxtPU();" required>&nbsp;
							มี 
						</span>
					  </div>
					  <!-- /.col -->
					  <div class="col-md-4" align="right">
						   <span for="count_PU">จำนวนเตียง</span>
					  </div>
					  <div class="col-md-2">
						   <input name="count_PU" type="text" class="form-control" id="count_PU" placeholder="โปรดระบุจำนวนเตียง" disabled required>
					  </div>
				   </div>
				   <!-- /.row -->
				   
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input name="PU_Y" type="radio" class="flat-red" value="ไม่มี" onclick="disableTxtPU();" required>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
				   <script>
						function disableTxtPU() {
						  document.getElementById("count_PU").disabled = true;
						  document.getElementById("count_PU").value = "";	
						}
						function enableTxtPU() {
						  document.getElementById("count_PU").disabled = false;
						}
					</script> 
					
				<hr>	
				<p>
					<b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;Integrated Bed<span class="text-danger">*</span></b>
					<br>
					<span style="padding-left: 18px;color: darkblue;">(การยืมเตียงชั่วคราวจากเตียงผู้ป่วยในแผนกอื่น หรือ ใช้เตียงร่วม โดยไม่ได้ระบุพื้นที่แยกสำหรับผู้ป่วยจิตเวช)</span>
				</p> 
				  <div class="row">
					  <div class="col-md-1" style="padding-left: 28px;">
						<span>
						  <input name="IB_Y" type="radio" class="flat-red" value="มี" onclick="enableTxtIB();" required>&nbsp;
							มี 
						</span>
					  </div>
					  <!-- /.col -->
					  <div class="col-md-4" align="right" >
						   <span for="count_IB">จำนวนเตียง</span>
					  </div>
					  <div class="col-md-2">
						   <input name="count_IB" type="text" class="form-control" id="count_IB" placeholder="โปรดระบุจำนวนเตียง" disabled required >
					  </div>
				   </div>
				   <!-- /.row -->
				   
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  <div class="col-md-1">
						<span>
						  <input name="IB_Y" type="radio" class="flat-red" value="ไม่มี" onclick="disableTxtIB();" required>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
			   <script>
					function disableTxtIB() {
					  document.getElementById("count_IB").disabled = true;
					  document.getElementById("count_IB").value = "";	
					}
					function enableTxtIB() {
					  document.getElementById("count_IB").disabled = false;
					}
				</script> 
					
				<p></p>
				*/?>

<div class="row"  style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				
				<!--<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label><!--<span style="color:red;"> (หาก<u> ไม่มี </u>การอบรมเฉพาะทาง ข้ามไปข้อถัดไป)</span>-->
			   <!-- <span style="color: darkblue"><b>(ตอบได้มากกว่า 1 ข้อ)</b></span>
			  	<br>-->
				  <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_1_1" name="training_1" value="Psychiatric Ward" onclick="toggleDiv2(false);"
                    <?php if($row1['Wardall'] == "Psychiatric Ward"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1_1"></label>Psychiatric Ward 
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหารแยกจากหอผู้ป่วยอื่น</span>
					</div>-->
					<span class="tooltiptext">(หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหารแยกจากหอผู้ป่วยอื่น)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_1_2" name="training_1" value="Psychiatric Unit/ Co-Ward" onclick="toggleDiv2(false);"
                    <?php if($row1['Wardall'] == "Psychiatric Unit/ Co-Ward"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1_2"></label>Psychiatric Unit/ Co-Ward
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน</span>
					</div>-->
					<span class="tooltiptext">(เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_1_3" name="training_1" value="Integrated Bed" onclick="toggleDiv2(false);"
                    <?php if($row1['Wardall'] == "Integrated Bed"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1_3"></label>Integrated Bed 
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">การยืมเตียงชั่วคราวจากเตียงผู้ป่วยในแผนกอื่น หรือ ใช้เตียงร่วม โดยไม่ได้ระบุพื้นที่แยกสำหรับผู้ป่วยจิตเวช</span>
					</div>-->
					<span class="tooltiptext">(การยืมเตียงชั่วคราวจากเตียงผู้ป่วยในแผนกอื่น หรือ ใช้เตียงร่วม โดยไม่ได้ระบุพื้นที่แยกสำหรับผู้ป่วยจิตเวช)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio ">
					<input type="radio" class="custom-control-input" id="training_1_4" name="training_1" value="ไม่มี" onclick="toggleDiv2(true);"
                    <?php if($row1['Wardall'] == "ไม่มี"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1_4"></label>ไม่มี
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน</span>
					</div>-->
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<script>
					function toggleDiv2(disable) {
						const div = document.getElementById('myMctt2');
						if (disable) {
							div.classList.add('disabled');
						} else {
							div.classList.remove('disabled');
						}
					}
				</script>
        <?php if($row1['Wardall'] == "ไม่มี"){ ?>        
		    <div id="myMctt2" class="disabled">	
        <?php }else{?> 
            <div id="myMctt2">	  
        <?php }?>    
			<div class="custom-control custom-checkbox">

				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;จำนวนเตียงจิตเวช <span class="disabledspan"></span>
						</div>
						<div class="col-md-4">
							<input name="number_patients_1" min="1" type="number" class="form-control" id="number_patients_1" value="<?php echo $row1['Ward_no'];?>" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal()>
						</div>
						<div class="col-md-2">เตียง</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;เตียงผู้หญิง 
						</div>
						<div class="col-md-4">
							<input name="number_patients_2" min="1" type="number" class="form-control" id="number_patients_2" value="<?php echo $row1['Unit'];?>" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal()>
						</div>
						<div class="col-md-2">เตียง</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;เตียงผู้ชาย 
						</div>
						<div class="col-md-4">
							<input name="number_patients_3" min="1" type="number" class="form-control" id="number_patients_3" value="<?php echo $row1['Unit_no'];?>" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal() >
						</div>
						<div class="col-md-2">เตียง</div>
				</div>

				<!--<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผู้ป่วยในโรคจิตเวชและยาเสพติดที่เข้ารับบริการในโรงพยาบาล PDx : F00.xx-F99 หรือ
OTHER, External Cause : X60-X84</span>
					</div>
						</div>
						<div class="col-md-3">
							<input name="number_patients_4" type="number" class="form-control" id="number_patients_4"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " required>
						</div>
						<div class="col-md-3">ราย <span class="disabledspan"></span></div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;ผลรวมจํานวนวันนอนผู้ป่วยใน 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผลรวมจำนวนวันนอนของผู้ป่วยจิตเวชและยาเสพติด ทั้งหมดที่จำหน่ายในเดือนนั้น (วัน)
นับจาก 1 ตุลาคม ปีงบประมาณปัจจุบัน จนถึงวันที่ลงข้อมูล)
สูตรการคำนวณวันนอน = (DATETIME_DISCH - DATETIME_ADMIT) หากได้ 0 ให้บวก 1</span>
					</div>
						</div>
						
						<div class="col-md-3">
							<input name="number_patients_5" type="number" class="form-control" id="number_patients_5"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " required>
						</div>
						<div class="col-md-3">วัน <span class="disabledspan"></span></div>
				</div>
				<!--<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;วันนอนเฉลี่ยผู้ป่วยใน 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผลรวมจำนวนวันนอนของผู้ป่วยจิตเวชและยาเสพติด หารด้วยจำนวนผู้ป่วยจิตเวช
และยาเสพติดจำหน่ายทั้งหมด</span>
					</div>
						</div>
						
						<div class="col-md-3">
							<input name="number_patients_22" type="text" class="form-control" id="number_patients_22" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " readonly>
						</div>
						<div class="col-md-3">วัน</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;อัตราการครองเตียง 
						</div>
						
						<div class="col-md-3">
							<input name="number_patients_23" type="number" class="form-control" id="number_patients_23" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  ">
						</div>
						<div class="col-md-3">% <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">คำนวณให้อัตโนมัติโดยใช้ สูตร B*100/A*จำนวนวันตั้งแต่ตุลาคม ปีงบประมาณปัจจุบัน
จนถึงวันที่ลงข้อมูล</span>
					</div></div>
				</div>-->

				
			  </div>
			  </div>
				</div>

				<script>
			
			function calculateTotal() {

				const number_patients_1 = parseFloat(document.getElementById('number_patients_1').value) || 0;
				const number_patients_2 = parseFloat(document.getElementById('number_patients_2').value) || 0; // แก้ไข id เป็น 'number_patients_17'
				const number_patients_3 = parseFloat(document.getElementById('number_patients_3').value) || 0;

				result1 = number_patients_2 + number_patients_3;
				//alert(number_patients_2);
				//alert(number_patients_3);

				//document.getElementById('number_patients_22').value = result2;
				document.getElementById('number_patients_1').value = result1;

			}
		</script>

		<div class="card-body">
				<p><b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ปัจจุบัน สถานบริการของท่าน มีการเปิด มินิธัญญารักษ์ หรือ ไม่ <span class="text-danger">*</span></b></p>
				  <div class="row">
					  
					  <div class="col-md-2" style="padding-left: 28px;">
						<span>
						  <input name="ECT_Y1" type="radio" class="flat-red" value="มี" onclick="enableTxt();" required
                          <?php if($row1['EY1'] == "มี"){echo 'checked';} ?>>&nbsp;
							มี 
						</span>
					  </div>
				   </div>
				   <!-- /.row -->
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input name="ECT_Y1" type="radio" class="flat-red" value="ไม่มี" onclick="disableTxt();" required
                          <?php if($row1['EY1'] == "ไม่มี"){echo 'checked';} ?>>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
				<hr>
				</div>
				<div class="card-body">
				<p><b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ปัจจุบัน สถานบริการของท่าน มีการใช้เตียงร่วมกัน ระหว่าง ผู้ป่วยจิตเวช และ มินิธัญญารักษ์ หรือ ไม่ <span class="text-danger">*</span></b></p>
				  <div class="row">
					  
					  <div class="col-md-2" style="padding-left: 28px;">
						<span>
						  <input name="ECT_Y" type="radio" class="flat-red" value="มี" onclick="toggleDiv(true);" required
                          <?php if($row1['EY'] == "มี"){echo 'checked';} ?>>&nbsp;
						  ใช่
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input name="ECT_Y" type="radio" class="flat-red" value="ไม่มี" onclick="toggleDiv(false);" required
                          <?php if($row1['EY'] == "ไม่มี"){echo 'checked';} ?>>&nbsp;
						  ไม่ใช่
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
				   <style>
					.disabled {
						display: none;
						pointer-events: none;  /* Prevent any mouse events */
						opacity: 0.1;          /* Make it look disabled */
					}
				</style>

				<script>
					function toggleDiv(disable) {
						const div = document.getElementById('myMctt');
						if (disable) {
							div.classList.add('disabled');
						} else {
							div.classList.remove('disabled');
						}
					}
				</script>
				<hr>
			
            <?php if($row1['EY'] == "มี"){ ?>        
		    <div id="myMctt" class="disabled">	
        <?php }else{?> 
            <div id="myMctt">	  
        <?php }?>  

			<div class="row"  style="padding-bottom: 10px;"> 
		  <div class="col-md-12">
			  <div class="form-group">
				
				<!--<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label><!--<span style="color:red;"> (หาก<u> ไม่มี </u>การอบรมเฉพาะทาง ข้ามไปข้อถัดไป)</span>-->
			   <!-- <span style="color: darkblue"><b>(ตอบได้มากกว่า 1 ข้อ)</b></span>
			  	<br>-->
				  <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_2_1" name="training_2" value="Psychiatric Ward"
                    <?php if($row1['TN2'] == "Psychiatric Ward"){echo 'checked';} ?> onclick="toggleDiv3(false);">
					<label class="custom-control-label" for="training_2_1"></label>Psychiatric Ward 
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหารแยกจากหอผู้ป่วยอื่น</span>
					</div>-->
					<span class="tooltiptext">(หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหารแยกจากหอผู้ป่วยอื่น)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_2_2" name="training_2" value="Psychiatric Unit/ Co-Ward"
                    <?php if($row1['TN2'] == "Psychiatric Unit/ Co-Ward"){echo 'checked';} ?> onclick="toggleDiv3(false);">
					<label class="custom-control-label" for="training_2_2"></label>Psychiatric Unit/ Co-Ward
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน</span>
					</div>-->
					<span class="tooltiptext">(เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_2_3" name="training_2" value="Integrated Bed "
                    <?php if($row1['TN2'] == "Integrated Bed "){echo 'checked';} ?> onclick="toggleDiv3(false);">
					<label class="custom-control-label" for="training_2_3"></label>Integrated Bed 
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">การยืมเตียงชั่วคราวจากเตียงผู้ป่วยในแผนกอื่น หรือ ใช้เตียงร่วม โดยไม่ได้ระบุพื้นที่แยกสำหรับผู้ป่วยจิตเวช</span>
					</div>-->
					<span class="tooltiptext">(การยืมเตียงชั่วคราวจากเตียงผู้ป่วยในแผนกอื่น หรือ ใช้เตียงร่วม โดยไม่ได้ระบุพื้นที่แยกสำหรับผู้ป่วยจิตเวช)</span>
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-radio ">
					<input type="radio" class="custom-control-input" id="training_2_4" name="training_2" value="ไม่มี"
                    <?php if($row1['TN2'] == "ไม่มี"){echo 'checked';} ?> onclick="toggleDiv3(true);">
					<label class="custom-control-label" for="training_2_4"></label>ไม่มี
					<!--<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่น ๆ หรือใช้บุคลากรร่วมกัน</span>
					</div>-->
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>

				<script>
					function toggleDiv3(disable) {
						const div = document.getElementById('myMctt3');
						if (disable) {
							div.classList.add('disabled');
						} else {
							div.classList.remove('disabled');
						}
					}
				</script>
		<?php if($row1['TN2'] == "ไม่มี"){ ?>
			<div id="myMctt3" class="disabled">	
		<?php }else{ ?>
			<div id="myMctt3" >
		<?php } ?>
		
			<div class="custom-control custom-checkbox">

				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-4">&nbsp;&nbsp;จำนวนเตียงจิตเวช <span class="disabledspan"></span>
						</div>
						<div class="col-md-4">
							<input name="number_p1tients_2_1" min="1" type="number" class="form-control" id="number_p1tients_2_1" value="<?php echo $row1['MM1'];?>"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal3()" >
						</div>
						<div class="col-md-4">เตียง</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-4">&nbsp;&nbsp;เตียงผู้หญิง 
						</div>
						<div class="col-md-4">
							<input name="number_p1tients_2_2" min="1" type="number" class="form-control" id="number_p1tients_2_2" value="<?php echo $row1['MM2'];?>" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal3()" >
						</div>
						<div class="col-md-2">เตียง</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-4">&nbsp;&nbsp;เตียงผู้ชาย 
						</div>
						<div class="col-md-4">
							<input name="number_p1tients_2_3" min="1" type="number" class="form-control" id="number_p1tients_2_3" value="<?php echo $row1['MM3'];?>"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " onchange="calculateTotal3()" >
						</div>
						<div class="col-md-2">เตียง</div>
				</div>
				
				<!--<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผู้ป่วยในโรคจิตเวชและยาเสพติดที่เข้ารับบริการในโรงพยาบาล PDx : F00.xx-F99 หรือ
OTHER, External Cause : X60-X84</span>
					</div>
						</div>
						<div class="col-md-3">
							<input name="number_p1tients_2_4" type="number" class="form-control" id="number_p1tients_2_4"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " >
						</div>
						<div class="col-md-3">ราย <span class="disabledspan"></span></div>
				</div>
				<!--<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;ผลรวมจํานวนวันนอนผู้ป่วยใน 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผลรวมจำนวนวันนอนของผู้ป่วยจิตเวชและยาเสพติด ทั้งหมดที่จำหน่ายในเดือนนั้น (วัน)
นับจาก 1 ตุลาคม ปีงบประมาณปัจจุบัน จนถึงวันที่ลงข้อมูล)
สูตรการคำนวณวันนอน = (DATETIME_DISCH - DATETIME_ADMIT) หากได้ 0 ให้บวก 1</span>
					</div>
						</div>
						
						<div class="col-md-3">
							<input name="number_p1tients_2_5" type="number" class="form-control" id="number_p1tients_2_5"  placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " >
						</div>
						<div class="col-md-3">วัน <span class="disabledspan"></span></div>
				</div>
				<!--<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;วันนอนเฉลี่ยผู้ป่วยใน 
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">ผลรวมจำนวนวันนอนของผู้ป่วยจิตเวชและยาเสพติด หารด้วยจำนวนผู้ป่วยจิตเวช
และยาเสพติดจำหน่ายทั้งหมด</span>
					</div>
						</div>
						
						<div class="col-md-3">
							<input name="number_patients_22" type="number" class="form-control" id="number_patients_22" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  " readonly>
						</div>
						<div class="col-md-3">วัน</div>
				</div>
				<div class="row" style="padding-bottom: 5px;">	
						<div class="col-md-5">&nbsp;&nbsp;อัตราการครองเตียง 
						</div>
						
						<div class="col-md-3">
							<input name="number_patients_23" type="number" class="form-control" id="number_patients_23" placeholder="กรอกจำนวน (เฉพาะตัวเลขเท่านั้น)  ">
						</div>
						<div class="col-md-3">% <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
						<span class="tooltiptext">คำนวณให้อัตโนมัติโดยใช้ สูตร B*100/A*จำนวนวันตั้งแต่ตุลาคม ปีงบประมาณปัจจุบัน
จนถึงวันที่ลงข้อมูล</span>
					</div></div>-->
				
					</div>
			  </div>
          </div>
		  <script>
			
			function calculateTotal3() {

				const number_p1tients_2_1 = parseFloat(document.getElementById('number_p1tients_2_1').value) || 0;
				const number_p1tients_2_2 = parseFloat(document.getElementById('number_p1tients_2_2').value) || 0; // แก้ไข id เป็น 'number_patients_17'
				const number_p1tients_2_3 = parseFloat(document.getElementById('number_p1tients_2_3').value) || 0;

				result1 = number_p1tients_2_2 + number_p1tients_2_3;
				//alert(number_patients_2);
				//alert(number_patients_3);

				//document.getElementById('number_patients_22').value = result2;
				document.getElementById('number_p1tients_2_1').value = result1;
			}
		</script>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
        </div>
        </div>
        
					  
				</div>
				</div>
				<!-- /.card-body -->


				
				<div class="card-footer" align="right">
				  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
                  <a href="bed_del.php?id=<?php echo $row1['bedID'];?>" class="btn btn-danger" onclick="showAlert()" > ลบ &nbsp;<i class="fa fas fa-del"></i></a>
			  	  <a href="tables-bed.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-close"></i></a>
				</div>
				<!-- /.card-footer-->
			  </div>
			  <!-- /.card -->
              <script>
        function showAlert() {
           if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) {
                alert("ข้อมูลถูก ลบแล้ว");
            } else {
                alert("การลบข้อมูลถูกยกเลิก");
            }
        }
    </script>
			
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
