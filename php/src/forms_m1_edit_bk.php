<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$FORMTYPE 	 = $_GET['type'];
$personnelID = $_GET['personnelID'];

$sql  = "SELECT personnelID,
				HospitalID, 
				positiontypeID, prename, firstname, lastname, birthday, age,
				r1, other_r1, r2, 
				training,
				other_training,
				cogratyear,
				UserID,
				personnelDate 
			FROM
				personnel 
			WHERE
				positiontypeID = 1
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
            <h4>แบบฟอร์มบันทึกข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h4>
          </div>
          <div class="col-sm-6">
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
		  
		<form class="form-valide" action="personnel_update.php" method="post" id="quickForm" name="myform1" novalidate> 
			<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
			<input type="hidden" value="<?php echo '1'; ?>" name="positiontypeid"> 
			<input type="hidden" value="<?php echo $personnelID; ?>" name="personnelID"> 
        
		<div class="card-body">
		<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>หน่วยบริการ</label><b><span style="color:red;">*</span></b>
					<select name="txtHospitalID" class="form-control select2" style="width: 100%;" required>
						<!--<option selected disabled value="">กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>-->
						<?php
							$HospitalID2 = $row1['HospitalID'];
							$query2 = $con->query("SELECT * FROM hospitalnew where CODE5 = '$HospitalID2'") or die(mysqli_error());
							$fetch2 = $query2->fetch_assoc();

							echo '<option value = "'.$fetch2['CODE5'].'">'.$fetch2['CODE5'].'-'.$fetch2['HOS_NAME'].'</option>';
							
						?>
						<?php
							$query = $con->query("SELECT * FROM hospitalnew") or die(mysqli_error());
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
                <select name="prename" class="form-control select2" style="width: 100%;" required>
                  <option selected value="<?php echo $row1['prename'] ;?>"><?php echo $row1['prename'] ;?></option>
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
			  </div>
          </div>
		</div>
		<!-- /.row --> 
		<div class="row"> 
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="firstname">ชื่อจริง</label><b><span style="color:red;">*</span></b>
				  <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $row1['firstname'] ;?>" placeholder="กรอกชื่อจริง" required>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="lastname">นามสกุล</label><b><span style="color:red;">*</span></b>
                  <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $row1['lastname'] ;?>" placeholder="กรอกนามสกุล" required>
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
				 <input type="text" class="form-control pull-right" id="p_birthday" name="p_birthday" value="<?php echo $Birthday ;?>"   onChange="calAge(this);" >
				 <!--<p><span class="text-danger">กรอกปีเกิดเป็น <b><u> ค.ศ.</u></b> เท่านั้น</span></p>-->
				  <p><span class="text-danger">กรอกปีเกิดเป็น <b><u> พ.ศ. (4 หลัก)</u></b> เท่านั้น</span></p>
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
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;แพทย์เฉพาะทางสาขา </label><label style="color:red;">*</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-1" name="r1" value="แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)" onclick="disableTxt();" required
						   <?php if($row1['r1'] == "แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r1-1"></label>แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-2" name="r1" value="จิตแพทย์ทั่วไป" onclick="disableTxt();" required 
						   <?php if($row1['r1'] == "จิตแพทย์ทั่วไป"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r1-2"></label>จิตแพทย์ทั่วไป
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-3" name="r1" value="จิตแพทย์เด็กและวัยรุ่น"  onclick="disableTxt();" required
						   <?php if($row1['r1'] == "จิตแพทย์เด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r1-3"></label>จิตแพทย์เด็กและวัยรุ่น
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r1-4" name="r1" value="แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น" onclick="enableTxt();" required
						   <?php if($row1['r1'] == "แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r1-4"></label>แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกแพทย์เฉพาะทาง</div>
			    </div>
				<div class="col-6" style="margin-top: 10px;">
                  <span for="other_r1">โปรดระบุ</span>
				  <?php if($row1['r1'] == "แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น"){?>
				  <input name="other_r1" type="text" class="form-control" id="other_r1" placeholder="โปรดระบุ" value="<?php echo $row1['other_r1']; ?>" required>
				  <?php }else{ ?>
				  <input name="other_r1" type="text" class="form-control" id="other_r1" placeholder="โปรดระบุ" disabled required>
				  <?php } ?>
                </div>
				 
				<script>
					function disableTxt() {
					  document.getElementById("other_r1").disabled = true;
					  document.getElementById("other_r1").value = "";	
					}
					function enableTxt() {
					  document.getElementById("other_r1").disabled = false;
					}
				</script>  
			  </div>
          </div>
		  <div class="col-md-8">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
		<div class="row"  style="padding-bottom: 5px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ปฏิบัติงานสุขภาพจิต</label><label style="color:red;">*</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="WorkTime1" name="r2" value="Full-Time" required 
						   <?php if($row1['r2'] == "Full-Time"){echo 'checked';} ?>>
					<label class="custom-control-label" for="WorkTime1"></label>แพทย์ประจำโรงพยาบาล (Full-Time)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="WorkTime2" name="r2" value="Part-Time" required 
						   <?php if($row1['r2'] == "Part-Time"){echo 'checked';} ?>>
					<label class="custom-control-label" for="WorkTime2"></label>แพทย์จ้างปฏิบัติงานบางช่วงเวลา (Part-Time)
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการปฏิบัติงานสุขภาพจิต</div>
			    </div>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
	    <div class="row"  style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;กำลังศึกษา (สถานะกำลังศึกษา)</label>
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
				 <select name="cogratyear" class="form-control select2" style="width: 100%;">
					  <option selected value="<?php echo $row1['cogratyear'] ;?>"><?php echo $row1['cogratyear'] ;?></option>
					  <?PHP for($i=0; $i<=10; $i++) {?>
						<option value="<?PHP echo date("Y")+$i+543?>"><?PHP echo date("Y")+$i+543?></option>
					  <?PHP }?>
				  </select>
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
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ท่านเป็นบุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) หรือไม่</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWorkTime1" name="Mcatt1" value="ใช่" required>
					<label class="custom-control-label" for="MWorkTime1"></label>ใช่
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWorkTime2" name="Mcatt1" value="ไม่ใช่" required>
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
		<!-- /.row --> 
		<div class="row"  style="padding-bottom: 5px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง (ตอบได้มากกว่า 1 ข้อ)</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="Mac1_1" name="Mac1_1" value="หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต สำหรับทีมช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)" required>
					<label class="custom-control-label" for="Mac1_1"></label>หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต สำหรับทีมช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWac1_2" name="MWac1_2" value="Psychotraumatology & Stabilization Techniques" required>
					<label class="custom-control-label" for="MWac1_2"></label>Psychotraumatology & Stabilization Techniques
			
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWac1_3" name="MWac1_3" value="การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)" required>
					<label class="custom-control-label" for="MWac1_3"></label>การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)
			
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWac1_4" name="MWac1_4" value="การเจรจาต่อรองในภาวะวิกฤต" required>
					<label class="custom-control-label" for="MWac1_4"></label>การเจรจาต่อรองในภาวะวิกฤต
			
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWac1_5" name="MWac1_5" value="หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand" required>
					<label class="custom-control-label" for="MWac1_5"></label>หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand
			
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="MWac1_6" name="MWac1_6" value="ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)" required>
					<label class="custom-control-label" for="MWac1_6"></label>ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)
			
			    </div>
				  
				<p></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
			
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
		  <a href="tables-maindetail.php" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
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
