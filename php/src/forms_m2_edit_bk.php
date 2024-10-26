<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$FORMTYPE = $_GET['type'];
$personnelID = $_GET['personnelID'];

$sql  = "SELECT personnelID,HospitalID, positiontypeID, prename, firstname, lastname, birthday, age,
				congrat,
				training,
				statuscong,
				cogratyear,
				UserID,
				personnelDate 
			FROM
				personnel 
			WHERE
				positiontypeID = 2
            AND personnelID = '$personnelID'";

$query = mysqli_query($con, $sql);
$row1 = mysqli_fetch_array($query);

if($row1['birthday'] == '0000'){
	$Birthday = '';
}else{
	$Birthday = $row1['birthday']+543;
}

$congrat_redi	= $row1['congrat'];
$congrat		= explode(",",$congrat_redi);

$training_chk 	= $row1['training'];
$training		= explode(",",$training_chk);
//print_r($training);


$statuscong_radi	= $row1['statuscong'];
$statuscong			= explode(",",$statuscong_radi);
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
              <li class="breadcrumb-item active">พยาบาลเฉพาะทาง</li>
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
          <h3 class="card-title">ข้อมูลพยาบาลเฉพาะทาง</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
		  
		<form class="needs-validation" action="personnel_update.php" method="post" id="quickForm" name="myform2" novalidate> 
			<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
			<input type="hidden" value="<?php echo '2'; ?>" name="positiontypeid"> 
			<input type="hidden" value="<?php echo $personnelID; ?>" name="personnelID"> 
        
		<div class="card-body">
		<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>หน่วยบริการ</label><b><span style="color:red;">*</span></b>
					<select name="txtHospitalID" class="form-control select2" style="width: 100%;" required>
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
				 <input type="text" class="form-control pull-right" id="p_birthday" name="p_birthday" value="<?php echo $Birthday ;?>"  onChange="calAge(this);" >
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
		<div class="row" style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;วุฒิการศึกษา</label><label style="color:red;">*</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat1" name="congrat" value="ปริญญาตรี" onclick="enablecongrat_n();" required
						    <?php if($row1['congrat'] == "ปริญญาตรี"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat1"></label>ปริญญาตรี
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat2" name="congrat" value="ปริญญาโท สาขาจิตเวช" onclick="enablecongrat_n();" required
						   <?php if($row1['congrat'] == "ปริญญาโท สาขาจิตเวช"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat2"></label>ปริญญาโท สาขาจิตเวช
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat3" name="congrat" value="ปริญญาโท สาขาอื่น" onclick="enablecongrat();" required
						   <?php if($congrat[0] == "ปริญญาโท สาขาอื่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat3"></label>ปริญญาโท สาขาอื่น 
			    </div>
				<?php if($congrat[0] == "ปริญญาโท สาขาอื่น"){?>	
					<input name="other_congrat" type="text" class="form-control" id="other_congrat" placeholder="โปรดระบุ"  style="width: 50%" value="<?php echo $congrat[1]; ?>" required>
				<? }else{?>
				  	<input name="other_congrat" type="hidden" class="form-control" id="other_congrat" placeholder="โปรดระบุ"  style="width: 50%" required>
				 <?php } ?>		 
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat4" name="congrat" value="วุฒิบัตรการพยาบาลขั้นสูง (APN)" onclick="enablecongrat_n();"  required
						   <?php if($row1['congrat'] == "วุฒิบัตรการพยาบาลขั้นสูง (APN)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat4"></label>วุฒิบัตรการพยาบาลขั้นสูง (APN)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat5" name="congrat" value="ปริญญาเอก" onclick="enablecongrat_n();"  required
						   <?php if($row1['congrat'] == "ปริญญาเอก"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat5"></label>ปริญญาเอก
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกวุฒิการศึกษา</div>
			    </div>
				  
					<script>
						
						function enablecongrat_n() {
						  
								document.getElementById("other_congrat").disabled = true;
								document.getElementById("other_congrat").value = "";
							    document.getElementById('other_congrat').type = 'hidden';
						}
						function enablecongrat() {
							
								document.getElementById("other_congrat").disabled = false;
								document.getElementById('other_congrat').type = 'text';
						}
					</script>  
				
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
				
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label><!--<span style="color:red;"> (หาก<u> ไม่มี </u>การอบรมเฉพาะทาง ข้ามไปข้อถัดไป)</span>-->
			    <span style="color: darkblue"><b>(ตอบได้มากกว่า 1 ข้อ)</b></span>
			  	<br>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_1" name="training_1" value="การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"
						   <?php if($training[0] == "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1"></label>การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_2" name="training_2" value="การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ"
						   <?php if($training[1] == "การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_2"></label>การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_3" name="training_3" value="การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น"
						   <?php if($training[2] == "การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_3"></label>การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_4" name="training_4" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด"
						   <?php if($training[3] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_4"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_5" name="training_5" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน"
						   <?php if($training[4] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_5"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_6" name="training_6" value="อื่น ๆ" onclick="enabletraining();"
						   <?php if($training[5] == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_6"></label>อื่น ๆ โปรดระบุ
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="col-6" style="margin-top: 10px;" id="ditraining">
                  <?php if($training[5] == "อื่น ๆ"){?>
					<input name="other_training" type="text" class="form-control" id="other_training" placeholder="โปรดระบุ" value="<?php echo $training[6]; ?>" required>
				  <?php }else{?>
				    <input name="other_training" type="hidden" class="form-control" id="other_training" placeholder="โปรดระบุ" disabled required>
				  <?php }?>
                </div> 
			
				<script>
				  function enabletraining() {
						  var g = document.getElementById("other_training").disabled;
							if( g ){
								document.getElementById("other_training").disabled = false;
								document.getElementById('other_training').type = 'text';
								
							}else{
								document.getElementById("other_training").disabled = true;
								document.getElementById('other_training').type = 'hidden';
							}

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
		<div class="row"  style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;กำลังศึกษา (สถานะกำลังศึกษา)</label><!--<span style="color:red;"> (กรณี<u> ไม่ได้กำลังศึกษา </u>กดปุ่มบันทึกข้อมูล)</span>--> 
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong1" name="statuscong" value="ปริญญาโทการพยาบาลสุขภาพจิตและจิตเวช" onclick="disablestatuscong();" 
						   <?php if($row1['statuscong']  == "ปริญญาโทการพยาบาลสุขภาพจิตและจิตเวช"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong1"></label>ปริญญาโทการพยาบาลสุขภาพจิตและจิตเวช
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong2" name="statuscong" value="กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)" onclick="disablestatuscong();" 
						   <?php if($row1['statuscong'] == "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong2"></label>กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong3" name="statuscong" value="กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น" onclick="disablestatuscong();" 
						   <?php if($row1['statuscong'] == "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong3"></label>กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong4" name="statuscong" value="กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด" onclick="disablestatuscong();"
						   <?php if($row1['statuscong']== "กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong4"></label>กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong5" name="statuscong" value="อื่น ๆ" onclick="enablestatuscong();"
						   <?php if($statuscong[0] == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong5"></label>อื่น ๆ โปรดระบุ
					<!--<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกกำลังศึกษา (สถานะกำลังศึกษา)</div>-->
			    </div>
				
				<div class="col-6" style="margin-top: 10px;" id="ditraining">
				<?php if($statuscong[0] == "อื่น ๆ"){?>
					<input name="other_statuscong" type="text" class="form-control" id="other_statuscong" placeholder="โปรดระบุ" value="<?php echo $statuscong[0]; ?>" required>
				<?php }else{?>
				  <input name="other_statuscong" type="hidden" class="form-control" id="other_statuscong" placeholder="โปรดระบุ" disabled required>
				<?php } ?>
                </div>  
				  
				<script>
				function disablestatuscong() {
					  document.getElementById("other_statuscong").disabled = true;
					  document.getElementById("other_statuscong").value = "";	
					  document.getElementById('other_statuscong').type = 'hidden';
					}
				function enablestatuscong() {					 
					  document.getElementById("other_statuscong").disabled = false;
					  document.getElementById('other_statuscong').type = 'text';
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
					  <!--<option selected disabled value="">-- เลือกปี พ.ศ. --</option>-->
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
