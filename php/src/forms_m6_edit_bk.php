<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$FORMTYPE = $_GET['type'];
$personnelID = $_GET['personnelID'];

if($FORMTYPE == 6){
	$TYPENAME = "นักกิจกรรมบำบัด";
}elseif($FORMTYPE == 7){
	$TYPENAME =  "นักเวชศาสตร์สื่อความหมาย";
}elseif($FORMTYPE == 8){
	$TYPENAME =  "นักวิชาการศึกษาพิเศษ";
}elseif($FORMTYPE == 9){
	$TYPENAME =  "นักวิชาการสาธารณสุข";
}elseif($FORMTYPE == 10){
	$TYPENAME =  "วิชาชีพอื่น ๆ";
}
//-------------------DATA-------------------------/-END

$sql  = "SELECT personnelID,HospitalID, positiontypeID,position_other, prename, firstname, lastname, birthday, age,
				r2,
				training,
				other_training,
				UserID,
				personnelDate 
			FROM
				personnel 
			WHERE
				positiontypeID = '$FORMTYPE'
            AND    
                personnelID = '$personnelID'";

$query = mysqli_query($con, $sql);
$row1 = mysqli_fetch_array($query);

if($row1['birthday'] == '0000'){
	$Birthday = '';
}else{
	$Birthday = $row1['birthday']+543;
}

$R2WORK6	= $row1['r2'];
$TRAINING 	= $row1['training'];
$TRAINING_OTHER	=$row1['other_training'];

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
              <li class="breadcrumb-item active"><?php echo $TYPENAME; ?></li>
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
          <h3 class="card-title">ข้อมูล<?php echo $TYPENAME; ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
		  
		<form class="form-valide" action="personnel_update.php" method="post" id="quickForm" name="myform1"> 
			<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
			<input type="hidden" value="<?php echo $FORMTYPE; ?>" name="positiontypeid"> 
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
				 <input type="text" class="form-control pull-right" id="p_birthday" name="p_birthday" value="<?php echo $Birthday ;?>"  onChange="calAge(this);" >
				 <!--<p><span class="text-danger">กรอกปีเกิดเป็น <b><u> ค.ศ.</u></b> เท่านั้น</span></p>-->
				  <p><span class="text-danger">กรอกปีเกิดเป็น <b><u> พ.ศ. (4 หลัก)</u></b> เท่านั้น</span></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="age">อายุ</label>
                  <input name="age" type="text" class="form-control" id="age" value="<?php echo $row1['age'] ;?>" placeholder="กรอกอายุ (เฉพาะตัวเลขเท่านั้น)" readonly>
			  </div>
          </div>
		</div>
		<!-- /.row --> 
		<?php if($FORMTYPE == 10){ ?>
		<div class="row"> 
			<div class="col-md-4">
				<div class="form-group">
					<label for="position_other">ตำแหน่ง</label><b><span style="color:red;">*</span></b>
					<input name="position_other" type="text" class="form-control" id="position_other" value="<?php echo $row1['position_other'] ;?>" placeholder="กรอกตำแหน่ง" required>
					
				</div>
			</div>
			
		</div>
		<?php } ?>	
		<!-- /.row --> 
		<div class="row" style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;ปฏิบัติงานสุขภาพจิต</label><label style="color:red;">*</label>
				<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r2working_1" name="r2working" value="ปฏิบัติงานสุขภาพจิต" required
						   <?php if($R2WORK6 == "ปฏิบัติงานสุขภาพจิต"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r2working_1"></label>ปฏิบัติงานสุขภาพจิต
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="r2working_2" name="r2working" value="ไม่ได้ปฏิบัติงานสุขภาพจิต" required
						   <?php if($R2WORK6 == "ไม่ได้ปฏิบัติงานสุขภาพจิต"){echo 'checked';} ?>>
					<label class="custom-control-label" for="r2working_2"></label>ไม่ได้ปฏิบัติงานสุขภาพจิต
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการปฏิบัติงานสุขภาพจิต</div>
			    </div> 		
			  </div>
			  
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
		<?php if($FORMTYPE <> 9){ ?>
		<div class="row" style="padding-bottom: 10px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label>
				<br>
				<span>
				<?php if($TRAINING <> ''){?>
					<input name="training" type="text" class="form-control" id="training" placeholder="โปรดระบุ" value="<?php echo $TRAINING; ?>" >
				<?php }else{ ?>
					<input name="training" type="text" class="form-control" id="training" placeholder="โปรดระบุ" >
				<?php } ?>
				</span>
				<p></p>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
		<?php }elseif($FORMTYPE == 9){ ?>
		<div class="row" style="padding-bottom: 5px;"> 
		  <div class="col-md-8">
			  <div class="form-group">
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label>
			  	<br>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_1" name="training" value="ด้านสุขภาพจิตและจิตเวช" onclick="disableTxt();" required
						   <?php if($TRAINING == "ด้านสุขภาพจิตและจิตเวช"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1"></label>ด้านสุขภาพจิตและจิตเวช
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_2" name="training" value="ด้านยาเสพติด" onclick="disableTxt();"required
						   <?php if($TRAINING == "ด้านยาเสพติด"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_2"></label>ด้านยาเสพติด
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="training_3" name="training" value="อื่น ๆ" onclick="enableTxt();" required
						   <?php if($TRAINING == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_3"></label>อื่น ๆ
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกการอบรมเฉพาะทาง</div>
			    </div> 	
				<div class="col-6" style="margin-top: 10px;">
                  <span for="other_training">โปรดระบุ</span>
				<?php if($TRAINING == 'อื่น ๆ'){?> 
                	<input name="other2_training" type="text" class="form-control" id="other_training" placeholder="โปรดระบุ" value="<?php echo $TRAINING_OTHER;?>" required>
				<?php }else{?>
					<input name="other2_training" type="text" class="form-control" id="other_training" placeholder="โปรดระบุ" disabled required>
				<?php } ?>
                </div>
				
				<script>
					function disableTxt() {
					  document.getElementById("other_training").disabled = true;
					  document.getElementById("other_training").value = "";	
					}
					function enableTxt() {
					  document.getElementById("other_training").disabled = false;
					}
				</script>  
			  </div>
          </div>
		  <div class="col-md-8">
			  <div class="form-group"></div>
		  </div>
		</div>
		<!-- /.row --> 
			
		<?php } ?>
					
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
