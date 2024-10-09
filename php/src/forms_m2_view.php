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
		  
		<form class="needs-validation" action="#" method="post" id="quickForm" name="myform1" novalidate> 
			<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
			<input type="hidden" value="<?php echo '2'; ?>" name="positiontypeid"> 
        
		<div class="card-body">
		<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>หน่วยบริการ</label><b><span style="color:red;">*</span></b>
					<select name="txtHospitalID" class="form-control select2" style="width: 100%;" required>
						<option selected disabled value="">กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>
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
				  <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $row1['firstname'] ;?>" placeholder="กรอกชื่อจริง" required>
				  <div class="invalid-feedback" style="font-size: 100%">
					  โปรดกรอกชื่อจริง
				  </div>
			  </div>
          </div>
		  <div class="col-md-4">
			  <div class="form-group">
				  <label for="lastname">นามสกุล</label><b><span style="color:red;">*</span></b>
                  <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $row1['lastname'] ;?>" placeholder="กรอกนามสกุล" required>
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
				 <select name="p_birthday" class="form-control select2" style="width: 100%;" onChange="calAge(this);" required>
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
                  <input name="age" type="text" class="form-control" id="age" value="<?php echo $row1['age'] ;?>" placeholder="กรอกอายุ (เฉพาะตัวเลขเท่านั้น)" readonly>
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
					<input type="radio" class="custom-control-input" id="congrat1" name="congrat" value="ปริญญาตรี" onclick="enablecongrat_n();" 
                    <?php if($row1['congrat'] == "ปริญญาตรี"){echo 'checked';} ?> required>
					<label class="custom-control-label" for="congrat1"></label>ปริญญาตรี
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat2" name="congrat" value="ปริญญาโท สาขาจิตเวช" onclick="enablecongrat_n();"
                    <?php if($row1['congrat'] == "ปริญญาโท สาขาจิตเวช"){echo 'checked';} ?> required>
					<label class="custom-control-label" for="congrat2"></label>ปริญญาโท สาขาจิตเวช
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat3" name="congrat" value="ปริญญาโท สาขาอื่น" onclick="enablecongrat();" 
                    <?php if($row1['congrat'] == "ปริญญาโท สาขาอื่น"){echo 'checked';} ?> required>
					<label class="custom-control-label" for="congrat3"></label>ปริญญาโท สาขาอื่น 
			    </div>
						
				<?php if($congrat[0] == "ปริญญาโท สาขาอื่น"){?>	
					<input name="other_congrat" type="text" class="form-control" id="other_congrat" placeholder="โปรดระบุ"  style="width: 50%" value="<?php echo $congrat[1]; ?>" 
					required <?php if($row1['congrat'] == "วุฒิบัตรการพยาบาลขั้นสูง (APN)"){echo 'checked';} ?>>
				<? }else{?>
				  	<input name="other_congrat" type="hidden" class="form-control" id="other_congrat" placeholder="โปรดระบุ"  style="width: 50%" 
					required <?php if($row1['congrat'] == "ปริญญาเอก"){echo 'checked';} ?>>
				 <?php } ?>	

				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat4" name="congrat" value="วุฒิบัตรการพยาบาลขั้นสูง (APN)" onclick="enablecongrat_n();"  required
                    <?php if($row1['congrat'] == "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat4"></label>วุฒิบัตรการพยาบาลขั้นสูง (APN)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="congrat5" name="congrat" value="ปริญญาเอก" onclick="enablecongrat_n();"  required
                    <?php if($row1['congrat'] == "การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="congrat5"></label>ปริญญาเอก
					<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกวุฒิการศึกษา</div>
			    </div>
				
				  
				
					<script>
						function enablecongrat_n() {
							
						  
								document.getElementById("other_congrat").disabled = true;
							    document.getElementById('other_congrat').type = 'hidden';

						}
						function enablecongrat() {
						  var g = document.getElementById("other_congrat").disabled;
							if( g ){
								document.getElementById("other_congrat").disabled = false;
								document.getElementById('other_congrat').type = 'text';
							}else{
								document.getElementById("other_congrat").disabled = true;
								document.getElementById('other_congrat').type = 'hidden';
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
				
				<label><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การอบรมเฉพาะทาง</label><!--<span style="color:red;"> (หาก<u> ไม่มี </u>การอบรมเฉพาะทาง ข้ามไปข้อถัดไป)</span>-->
			    <span style="color: darkblue"><b>(ตอบได้มากกว่า 1 ข้อ)</b></span>
			  	<br>
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_1" name="training_1" value="ยังไม่ผ่านการอบรมเฉพาะทาง" onclick="checkCheckbox2();"
                    <?php if($training[0] == "ยังไม่ผ่านการอบรมเฉพาะทาง"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_1"></label>ยังไม่ผ่านการอบรมเฉพาะทาง
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_2" name="training_2" value="การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)" onclick="uncheckCheckbox2();"
                    <?php if($training[1] == "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_2"></label>การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_3" name="training_3" value="การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ" onclick="uncheckCheckbox2();"
                    <?php if($training[2] == "การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_3"></label>การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_4" name="training_4" value="การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น" onclick="uncheckCheckbox2();"
                    <?php if($training[3] == "การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_4"></label>การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_5" name="training_5" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด" onclick="uncheckCheckbox2();"
                    <?php if($training[4] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_5"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_6" name="training_6" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน" onclick="uncheckCheckbox2();"
                    <?php if($training[5] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_6"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="training_7" name="training_7" value="อื่น ๆ" onclick="enabletraining();"
                    <?php if($training[6] == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="training_7"></label>อื่น ๆ โปรดระบุ
					<!--<div class="invalid-feedback">Example invalid feedback text</div>-->
				</div>
				<div class="col-6" style="margin-top: 10px;" id="ditraining">
				<?php if($training[6] == "อื่น ๆ"){?>
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
								var training_1 = document.getElementById('training_1');
								training_1.checked = false;
								
							}else{
								document.getElementById("other_training").disabled = true;
								document.getElementById('other_training').type = 'hidden';
							}

						}

						function uncheckCheckbox2() {
							var training_1 = document.getElementById('training_1');
							training_1.checked = false;
						}	

						function checkCheckbox2() {
						// ดึง element ของ checkbox มา
						var training_1 = document.getElementById('training_1');
						var training_2 = document.getElementById('training_2');
						var training_3 = document.getElementById('training_3');
						var training_4 = document.getElementById('training_4');
						var training_5 = document.getElementById('training_5');
						var training_6 = document.getElementById('training_6');
						var training_7 = document.getElementById('training_7');

						

						// ตรวจสอบว่า checkbox มีการเลือกอยู่หรือไม่
						if (training_1.checked) {
							//alert('Checkbox is checked');
							training_2.checked = false;
							training_3.checked = false;
							training_4.checked = false;
							training_5.checked = false;
							training_6.checked = false;
							training_7.checked = false;
							document.getElementById("other_training").disabled = true;
							document.getElementById('other_training').type = 'hidden';
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
					<input type="radio" class="custom-control-input" id="statuscong0" name="statuscong" value="ไม่ได้กำลังศึกษา" checked onclick="disablestatuscong();" >
					<label class="custom-control-label" for="statuscong0"></label>ไม่ได้กำลังศึกษา
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong1" name="statuscong" value="การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)" onclick="disablestatuscong();" 
                    <?php if($statuscong[0] == "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong1"></label>การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong2" name="statuscong" value="การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้สูงอายุ)" onclick="disablestatuscong();" 
                    <?php if($statuscong[1] == "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้สูงอายุ)"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong2"></label>การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้สูงอายุ)
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong3" name="statuscong" value="การพยาบาลเฉพาะทางสุขภาพจิตและจิตเวชเด็กและวัยรุ่น" onclick="disablestatuscong();" 
                    <?php if($statuscong[2] == "การพยาบาลเฉพาะทางสุขภาพจิตและจิตเวชเด็กและวัยรุ่น"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong3"></label>การพยาบาลเฉพาะทางสุขภาพจิตและจิตเวชเด็กและวัยรุ่น
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong4" name="statuscong" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด" onclick="disablestatuscong();"
                    <?php if($statuscong[3] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong4"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong5" name="statuscong" value="การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน" onclick="disablestatuscong();"
                    <?php if($statuscong[4] == "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong5"></label>การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน
			    </div>
				<div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="statuscong6" name="statuscong" value="อื่น ๆ" onclick="enablestatuscong();"
                    <?php if($statuscong[5] == "อื่น ๆ"){echo 'checked';} ?>>
					<label class="custom-control-label" for="statuscong6"></label>อื่น ๆ โปรดระบุ
					<!--<div class="invalid-feedback" style="font-size: 100%">โปรดเลือกกำลังศึกษา (สถานะกำลังศึกษา)</div>-->
			    </div>
				
				<div class="col-6" style="margin-top: 10px;" id="ditraining">                  
				 
                  <?php if($training[5] == "อื่น ๆ"){?>
					
                    <input name="other_statuscong" type="hidden" class="form-control" id="other_statuscong" placeholder="โปรดระบุ" value="<?php echo $statuscong_radi[6]; ?>"  required>
				  <?php }else{?>
				    <input name="other_statuscong" type="hidden" class="form-control" id="other_statuscong" placeholder="โปรดระบุ" disabled required>
				  <?php }?>	
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
					  <option selected value="<?php echo $row1['cogratyear'];?>"><?php echo $row1['cogratyear'];?></option>
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
						<input type="checkbox" class="custom-control-input" id="MWac1_6" name="MWac1_6" value="Psychotraumatology & Stabilization Techniques" onclick="uncheckCheckbox();"
						<?php if($row1['MWac1_6'] == "Psychotraumatology & Stabilization Techniques"){echo 'checked';} ?>>
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
         <!-- <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>-->
		  <a href="tables-pre.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
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
