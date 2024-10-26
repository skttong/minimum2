<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$FORMTYPE 	 = $_GET['type'];
$personnelID = $_GET['personnelID'];


$sql  = "SELECT *
			FROM
				personnel 
			WHERE
				positiontypeID = '$FORMTYPE'
            AND    
                personnelID = '$personnelID' ";

$query 	= mysqli_query($con, $sql);
$row1 	= mysqli_fetch_array($query);

if($row1['birthday'] == '0000'){
	$Birthday = '';
}else{
	$Birthday = $row1['birthday']+543;
}

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
  width: 500px;
  background-color: #5C7EAB;
  color: #fff;
  text-align: left;
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

.tooltip2 {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/
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
			<h4>แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">แบบฟอร์ม</a></li>
              <li class="breadcrumb-item active">แพทย์เฉพาะทาง</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">ข้อมูลแพทย์เฉพาะทาง</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
		
		<form class="needs-validation" action="#" method="post" id="quickForm" name="myform1" novalidate> 
			<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
			<input type="hidden" value="<?php echo '1'; ?>" name="positiontypeid"> 
        
		<div class="card-body">
			<p><span class="error">* จำเป็นต้องกรอก</span></p>  
		<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>หน่วยบริการ</label><b><span style="color:red;">*</span></b>
					<select name="txtHospitalID" class="form-control select2" style="width: 100%;" required>
						<!--<option selected disabled value="">กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>-->
						<?php
							$HospitalID = $row1['HospitalID'];
							$query = $con->query("SELECT * FROM hospitalnew where CODE5 = '".$HospitalID."' ") or die(mysqli_error());
							while($fetch = $query->fetch_assoc()){

							echo '<option value = "'.$fetch['CODE5'].'">'.$fetch['CODE5'].'-'.$fetch['HOS_NAME'].'</option>';
							}
						?>
					</select>
			   </div>
				<!-- /.form-group -->
			</div>
			<!-- /.col -->
		</div>
			<?php }else{ ?>
			  <input type="hidden" value="<?php echo $HospitalID; ?>" name="txtHospitalID">	
			  <?php } ?>
		<!-- /.row -->  
		<div class="row"> 
		  <div class="col-md-4">
			  <div class="form-group">
				<label>คำนำหน้า</label><b><span style="color:red;">*</span></b>
                <select name="prename" class="form-control select2" style="width: 100%;" required readonly >
                  <option selected value="<?php echo $row1['prename'] ;?>"><?php echo $row1['prename'] ;?></option>    
                 <!-- <option selected disabled value="">-- เลือกคำนำหน้าชื่อ --</option>-->
					<?php
					$sqlprefix = "SELECT * FROM prefix";
					$objprefix = mysqli_query($con, $sqlprefix);
					while($rowrefix = mysqli_fetch_array($objprefix))
					{
					?>
					<option value="<?php echo $rowrefix['prefixName'];?>"><?php echo $rowrefix['prefixName'];?></option>
					<?php
					 }
					?>
                </select>
				<div class="invalid-feedback" style="font-size: 100%">
					โปรดเลือกคำนำหน้าชื่อ
			    </div>
			  </div>
          </div>
		</div>
		<!-- /.row --> 
		<div class="row"> 
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="firstname">ชื่อจริง</label><b><span style="color:red;">*</span></b>
				  <input name="firstname" type="text" class="form-control" id="firstname" placeholder="กรอกชื่อจริง" value="<?php echo $row1['firstname'] ;?>"  readonly required>
				  <div class="invalid-feedback" style="font-size: 100%">
					  โปรดกรอกชื่อจริง
				  </div>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="lastname">นามสกุล</label><b><span style="color:red;">*</span></b>
                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="กรอกนามสกุล" value="<?php echo $row1['lastname'] ;?>" readonly required>
				  <div class="invalid-feedback" style="font-size: 100%">
					  โปรดกรอกนามสกุล
				  </div>
			  </div>
          </div>
		</div>
		<!-- /.row --> 
		<div class="row"> 
		  <div class="col-md-4">
			  <div class="form-group">
				 <!--<label for="p_birthday">วัน/เดือน/ปีเกิด</label>-->
				 <label for="p_birthday">ปีเกิด</label> 
				 <!--<input type="date" class="form-control pull-right" id="p_birthday" name="p_birthday"  onChange="calAge(this);" >-->
				 <!--<input type="text" class="form-control pull-right" id="p_birthday" name="p_birthday" value="" onChange="calAge(this);" required>-->
				 <select name="p_birthday" class="form-control select2" style="width: 100%;" onChange="calAge(this);" Readonly required>
                 <option selected value="<?php echo $Birthday;?>"><?php echo $Birthday ;?></option>
					  <?PHP for($i=0; $i<= ((date("Y")+563)-2500); $i++) {?>
						<option value="<?PHP echo 2500+$i?>"><?PHP echo 2500+$i?></option>
					  <?PHP }?>
				  </select>
				 <!--<p><span class="text-danger">กรอกปีเกิดเป็น <b><u> ค.ศ.</u></b> เท่านั้น</span></p>-->
				  <!--<p><span class="text-danger">กรอกปีเกิดเป็น <b><u> พ.ศ. (4 หลัก)</u></b> เท่านั้น</span></p>-->
				  <?php // echo "Today is " . (date("Y")+543)-2500 . "<br>";?>

			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="age">อายุ</label>
                  <input name="age" type="text" class="form-control" id="age" placeholder="กรอกอายุ (เฉพาะตัวเลขเท่านั้น)" value="<?php echo $row1['age'] ;?>" readonly>
			  </div>
          </div>
		</div>
		<!-- /.row --> 
		<div class="row" style="padding-bottom: 5px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;แพทย์เฉพาะทางสาขา </label><label style="color:red;">*</label><!--<label>เลือกแพทย์เฉพาะทางสาขา (เลือกสาขาสูงสุด)-
*ตัวเลือก*</label>-->

			  	<br>
				
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-1" name="r1" value="แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)" onclick="disableTxt2(false);" 
                    <?php if($row1['r1'] == "แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)"){echo 'checked';} ?> readonly >
					<label class="custom-control-label" for="r1-1"></label>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-2" name="r1" value="จิตแพทย์ทั่วไป" onclick="disableTxt2(false);" 
                    <?php if($row1['r1'] == "จิตแพทย์ทั่วไป"){echo 'checked';} ?> readonly >
					<label class="custom-control-label" for="r1-2"></label>จิตแพทย์ทั่วไป
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-3" name="r1" value="จิตแพทย์เด็กและวัยรุ่น"  onclick="disableTxt2(false);" 
                    <?php if($row1['r1'] == "จิตแพทย์เด็กและวัยรุ่น"){echo 'checked';} ?> readonly >
					<label class="custom-control-label" for="r1-3"></label>จิตแพทย์เด็กและวัยรุ่น
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-4" name="r1" value="แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น" onclick="enableTxt2();"
                    <?php if($row1['r1'] == "แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?> readonly >
					<label class="custom-control-label" for="r1-4"></label>แพทย์สาขาอื่น <!--ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น-->
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกแพทย์เฉพาะทาง</div>
			    </div>
				<div class="col-6" style="margin-top: 10px;">
                  <span for="other_r1">โปรดระบุ</span>
                  <?php if($row1['r1'] == "แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น"){?>
				  <input name="other_r1" type="text" class="form-control" id="other_r1" placeholder="โปรดระบุ" value="<?php echo $row1['other_r1']; ?>" readonly required>
				  <?php }else{ ?>
				  <input name="other_r1" type="text" class="form-control" id="other_r1" placeholder="โปรดระบุ" disabled readonly required>
				  <?php } ?>
                </div>
				<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-5" name="r1" value="กำลังศึกษา" onclick="disableTxt2(true);" 
                    <?php if($row1['r1'] == "กำลังศึกษา"){echo 'checked';} ?> readonly required>
					<label class="custom-control-label" for="r1-5"></label>กำลังศึกษา <!--ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น-->
					<div class="invalid-feedback" style="font-size: 100%">กำลังศึกษา</div>
			    </div>
				
				<script>
					function disableTxt2(disable) {

					 const div = document.getElementById('myMctt3');

					  if(disable){
						div.classList.remove('disabled');
						document.getElementById("other_r1").disabled = true;
					  	document.getElementById("other_r1").value = "";

					  }else{
						 div.classList.add('disabled');
						 document.getElementById("other_r1").disabled = true;
					 	 document.getElementById("other_r1").value = "";
					  }

					
			
					  	
					}

					function enableTxt2() {
					  const div = document.getElementById('myMctt3');
					  div.classList.add('disabled');
					  document.getElementById("other_r1").disabled = false;
					}

					
				</script>  
	<?php if($row1['r1'] == "กำลังศึกษา") { ?>
	<div id="myMctt3" >
		<?php }else{?>
			<div id="myMctt3" class="disabled">
<?php } ?>
		<div class="row"   style="padding-bottom: 10px;"> 
		
		  <div class="col-md-8">
			  <div class="form-group">
				
				<!--<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;กำลังศึกษา (สถานะกำลังศึกษา)</label>-->
			    <!--<h6 style="padding-left: 20px;">เลือกได้มากกว่า 1 ข้อ</h6>-->
			  	<br>

				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training1" name="training" value="จิตเวชศาสตร์/จิตแพทย์ทั่วไป" onclick="disabletraining();" 
					<?php if($row1['training'] == "จิตเวชศาสตร์/จิตแพทย์ทั่วไป"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training1"></label>จิตเวชศาสตร์/จิตแพทย์ทั่วไป
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training2" name="training" value="จิตแพทย์เด็กและวัยรุ่น" onclick="disabletraining();" 
					<?php if($row1['training'] == "จิตแพทย์เด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training2"></label>จิตแพทย์เด็กและวัยรุ่น
			    </div> 
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training3" name="training" value="แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)" onclick="disabletraining();" 
					<?php if($row1['training'] == "แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training3"></label>แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training4" name="training" value="อื่น ๆ" onclick="enabletraining();" 
					<?php if($row1['training'] == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training4"></label>อื่น ๆ
					<div class="invalid-feedback">โปรดเลือกกำลังศึกษา (สถานะกำลังศึกษา)</div>
			    </div>
				
				
				<div class="col-6" style="margin-top: 10px;">
                  <span for="other_training">โปรดระบุ</span>
				  <?php if($row1['training'] == "อื่น ๆ"){ ?>
                  <input name="other_training" type="text" class="form-control" id="other_training" placeholder="โปรดระบุ"  required 
						 value="<?php echo $row1['other_training']; ?>">
				  <?php }else{?>
				  <input name="other_training" type="text" class="form-control" id="other_training" placeholder="โปรดระบุ" disabled required>
				  <?php } ?>
                </div> 
				<script>
					function disabletraining() {
					  document.getElementById("other_training").disabled = true;
					  document.getElementById("other_training").value = "";	
					}
					function enabletraining() {
					  document.getElementById("other_training").disabled = false;
					}
				</script>  
				
				<p></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
		
		<div class="row"> 
		  <div class="col-md-4">
			  <div class="form-group">
				 <label for="cogratyear">ปีที่คาดว่าจะจบ</label>
				 <select name="cogratyear" class="form-control select2" style="width: 100%;" >
				 		<option selected value="<?php echo $row1['cogratyear'] ;?>"><?php echo $row1['cogratyear'] ;?></option>
					  <?PHP for($i=0; $i<=10; $i++) {?>
						<option value="<?PHP echo date("Y")+$i+563?>"><?PHP echo date("Y")+$i+563?></option>
					  <?PHP }?>
				  </select>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
          </div>
		</div>
		<!-- /.row --> 
			
				
				<div class="invalid-feedback" style="font-size: 100%">
					  โปรดเลือกแพทย์เฉพาะทาง
				  </div>
			  </div>
          </div>
		  
		  <div class="col-md-8">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
		</div>
		<div class="row"  style="padding-bottom: 5px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ปฏิบัติงานสุขภาพจิต</label><label style="color:red;">*</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="WorkTime1" name="r2" value="Full-Time" 
					required  <?php if($row1['r2'] == "Full-Time"){echo 'checked';} ?>>
					<label class="custom-control-label" for="WorkTime1"></label>แพทย์ประจำโรงพยาบาล (Full-Time)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="WorkTime2" name="r2" value="Part-Time" 
					required  <?php if($row1['r2'] == "Part-Time"){echo 'checked';} ?>>
					<label class="custom-control-label" for="WorkTime2"></label>แพทย์จ้างปฏิบัติงานบางช่วงเวลา (Part-Time)
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการปฏิบัติงานสุขภาพจิต</div>
			    </div>
				  
				<p></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
	  

		<div class="row"  style="padding-bottom: 5px;"> 
		
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ท่านปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) หรือไม่</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWorkTime1" name="Mcatt1" value="ใช่" onclick="toggleDiv(false)"  
					required <?php if($row1['Mcatt1'] == "ใช่"){echo 'checked';} ?>>
					<label class="custom-control-label" for="MWorkTime1"></label>ใช่
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWorkTime2" name="Mcatt1" value="ไม่ใช่" onclick="toggleDiv(true)"  
					required <?php if($row1['Mcatt1'] == "ไม่ใช่"){echo 'checked';} ?>>
					<label class="custom-control-label" for="MWorkTime2"></label>ไม่ใช่
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการปฏิบัติงานสุขภาพจิต</div>
			    </div>
				  
				<p></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>


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
			var checkbox = document.getElementById('MWac1_9');
			var MWac1_1 = document.getElementById('MWac1_1');
			var MWac1_2 = document.getElementById('MWac1_2');
			var MWac1_3 = document.getElementById('MWac1_3');
			var MWac1_4 = document.getElementById('MWac1_4');
			var MWac1_5 = document.getElementById('MWac1_5');
			var MWac1_6 = document.getElementById('MWac1_6');
			var MWac1_7 = document.getElementById('MWac1_7');
			var MWac1_8 = document.getElementById('MWac1_8');
            if (disable) {
                div.classList.add('disabled');
				checkbox.checked = false;
				MWac1_1.checked = false;
				MWac1_2.checked = false;
				MWac1_3.checked = false;
				MWac1_4.checked = false;
				MWac1_5.checked = false;
				MWac1_6.checked = false;
				MWac1_7.checked = false;
				MWac1_8.checked = false;
				document.getElementById("other2_mcatt").disabled = true;
				document.getElementById("other2_mcatt").value = "";
            } else {
                div.classList.remove('disabled');
            }
        }
    </script>
		<!-- /.row --> 
		<div  class="row"  style="padding-bottom: 5px; "> 

		<?php if($row1['Mcatt1'] == "ใช่"){ ?>
			<div id="myMctt" >

		<?php }else{?>
			<div id="myMctt" class="disabled">	
		<?php } ?>
		  <div class="col-md-12">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง (ตอบได้มากกว่า 1 ข้อ)</label>
			  	<br>
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="MWac1_9" name="MWac1_9" value="ไม่ผ่านการอบรม" onclick="checkCheckbox();" 
					<?php if($row1['MWac1_9'] == "ไม่ผ่านการอบรม"){echo 'checked';} ?>>
					<label class="custom-control-label" for="MWac1_9"></label>ไม่ผ่านการอบรม
			
			    </div>
				
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="MWac1_10" name="MWac1_10" value="ผ่านการอบรม" onclick="uncheckCheckbox();" 
					<?php if($row1['MWac1_9'] == "ผ่านการอบรม"){echo 'checked';} ?>>
					<label class="custom-control-label" for="MWac1_10"></label>ผ่านการอบรม
			
			    </div>
				<?php if($row1['MWac1_9'] == "ผ่านการอบรม"){ ?>
					<div id="myMctt2" >

				<?php }else{?>
					<div id="myMctt2" class="disabled">	
				<?php } ?>
			
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_1" name="MWac1_1" value="หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)" onclick="uncheckCheckbox();" 
						<?php if($row1['MWac1_1'] == "หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)"){ echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_1"></label>หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_2" name="MWac1_2" value="Psychotraumatology & Stabilization Techniques" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_2'] == "Psychotraumatology & Stabilization Techniques"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_2"></label>Psychotraumatology & Stabilization Techniques
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext">เทคนิคการสร้างความมั่นคงภายใน</span>
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_3" name="MWac1_3" value="การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_3'] == "การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_3"></label>การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)
				
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_4" name="MWac1_4" value="การเจรจาต่อรองในภาวะวิกฤต" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_4'] == "การเจรจาต่อรองในภาวะวิกฤต"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_4"></label>การเจรจาต่อรองในภาวะวิกฤต
				
					</div>
					
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_5" name="MWac1_5" value="ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_5'] == "ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_5"></label>ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)
				
					</div>
					
					
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_7" name="MWac1_7" value="หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_7'] == "หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_7"></label>หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand
				
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_6" name="MWac1_6" value="หลักสูตร ICS100" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_6'] == "หลักสูตร ICS100"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_6"></label>หลักสูตร ICS100
						<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext">หลักสูตรการจัดการภาวะฉุกเฉินทางสาธารณสุข (Public health emergency management, PHEM) ระบบบัญชาการเหตุการณ์ (Incident Command System, ICS) และศูนย์ปฏิบัติการภาวะฉุกเฉิน (Emergency Operations Center, EOC)</span>
						</div>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="MWac1_8" name="MWac1_8" value="อื่น ๆ" onclick="enableTxt();" 
						<?php if($row1['MWac1_8'] == "อื่น ๆ"){echo 'checked';} ?>>
						<label class="custom-control-label" for="MWac1_8"></label>อื่น ๆ
						<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการอบรมเฉพาะทาง</div>
					</div> 	
					
					<div class="col-6" style="margin-top: 10px;">
					<span for="other_training">โปรดระบุ</span>
					<?php if($row1['MWac1_8'] == "อื่น ๆ"){ ?>
                    <input name="other2_mcatt" type="text" class="form-control" id="other2_mcatt" placeholder="โปรดระบุ" 
						 value="<?php echo $row1['other2_mcatt']; ?>">
				  <?php }else{?>
                    <input name="other2_mcatt" type="text" class="form-control" id="other2_mcatt" placeholder="โปรดระบุ" disabled >
				  <?php } ?>
					</div>
			</div>
				
				<script>
				
					function enableTxt() {
						var checkbox2 = document.getElementById('MWac1_8');
					  	if (checkbox2.checked) {
					  		document.getElementById("other2_mcatt").disabled = false;
					  		var checkbox = document.getElementById('MWac1_9');
					  		checkbox.checked = false;
						}else{
							checkbox2.checked = false;
							document.getElementById("other2_mcatt").disabled = true;
					  		document.getElementById("other2_mcatt").value = "";	
						}
					}
					function uncheckCheckbox() {
						var checkbox = document.getElementById('MWac1_9');
						const div2 = document.getElementById('myMctt2');
						checkbox.checked = false;
						div2.classList.remove('disabled');
					}	
				
					function checkCheckbox() {
						// ดึง element ของ checkbox มา
						const div2 = document.getElementById('myMctt2');
						var checkbox = document.getElementById('MWac1_9');
						var MWac1_1 = document.getElementById('MWac1_1');
						var MWac1_2 = document.getElementById('MWac1_2');
						var MWac1_3 = document.getElementById('MWac1_3');
						var MWac1_4 = document.getElementById('MWac1_4');
						var MWac1_5 = document.getElementById('MWac1_5');
						var MWac1_6 = document.getElementById('MWac1_6');
						var MWac1_7 = document.getElementById('MWac1_7');
						var MWac1_8 = document.getElementById('MWac1_8');
						var MWac1_10 = document.getElementById('MWac1_10');
						

						// ตรวจสอบว่า checkbox มีการเลือกอยู่หรือไม่
						if (checkbox.checked) {
							//alert('Checkbox is checked');
							div2.classList.add('disabled');
							MWac1_1.checked = false;
							MWac1_2.checked = false;
							MWac1_3.checked = false;
							MWac1_4.checked = false;
							MWac1_5.checked = false;
							MWac1_6.checked = false;
							MWac1_7.checked = false;
							MWac1_8.checked = false;
							MWac1_10.checked = false;
							document.getElementById("other2_mcatt").disabled = true;
							document.getElementById("other2_mcatt").value = "";
						}
					 else {
							div2.classList.remove('disabled');
						}
						/* else {
							//alert('Checkbox is not checked');
							// ตั้งค่า checked เป็น true เพื่อเลือก checkbox
							//checkbox.checked = true;
						}*/
					}
			</script>
				

				  
				<p></p>
				</div>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
			
        </div>
        <!-- /.card-body -->
        <div class="card-footer" align="right">
          <!--<button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>-->
		  <?php if($row1['HospitalID'] <> $HospitalID ){ ?>
		  		<!--<a href="tables-pre.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>-->
				<a href="tables-prealldetail.php?code=<?php echo $row1['HospitalID'];?>" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
		  <?php }else	if($_SESSION["TypeUser"] == "Admin"){	?>
				<a href="tables-prealldetail.php?code=<?php echo $row1['HospitalID'];?>" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
		  <?php }else{ ?>
				<a href="tables-prealldetail2.php?code=<?php echo $row1['HospitalID'];?>" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
		  <?php } ?>
        </div>
        <!-- /.card-footer-->
		</form>
      </div>
      <!-- /.card -->

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
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
	
<!-- Page specific script -->
<script>
function calAge(o){
     //var tmp = o.value.split("-");
	 var tmp = o.value - 543;
     var current = new Date();
     var current_year = current.getFullYear();
	 //document.getElementById("age").value = current_year - tmp[0];
	 document.getElementById("age").value = current_year - tmp;
 }
 

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>
