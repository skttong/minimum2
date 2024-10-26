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
            <h4>ความพึงพอใจและความต้องการของโรงพยาบาลท่าน</h4>
			<p>ที่มีต่อโรงพยาบาลจิตเวชในกรมสุขภาพจิต</p>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
              <li class="breadcrumb-item active">แบบประเมินความพึงพอใจ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="satissurvey.php">
		<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID"> 
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<i class="fa fa-tasks"></i>&nbsp;
				โปรดระบุ สถาบัน/ โรงพยาบาลสังกัดกรมสุขภาพจิต ที่ท่านได้ประสานงานด้วย โดยเรียงตามลำดับความถี่ ที่ส่งผู้ป่วยไปจากมากไปน้อย
			</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
					  <div class="form-group">
						<label><b>ลำดับที่ 1 </b>สถาบัน/ โรงพยาบาลสังกัดกรมสุขภาพจิต </label>
						<select name="txtHospitalID1" class="form-control select2" style="width: 100%;">
							<option>กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>
							<?php
								$query = $con->query("SELECT * FROM hospitalnew WHERE TYPE_SERVICE = 'DMH' ORDER BY hospitalnew.id_hos ASC") or die(mysqli_error());
								while($fetch = $query->fetch_assoc()){

								echo '<option value = "'.$fetch['CODE5'].'">'.$fetch['CODE5'].'-'.$fetch['HOS_NAME'].'</option>';
								}
							?>
						</select>
					  </div>
					  <!-- /.form-group -->

					</div>
					<!-- /.col -->
					<div class="col-md-6">
					  <div class="form-group">
						<label><b>ลำดับที่ 2 </b>สถาบัน/ โรงพยาบาลสังกัดกรมสุขภาพจิต </label>
						<select name="txtHospitalID2" class="form-control select2" style="width: 100%;">
							<option>กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>
							<?php
								$query = $con->query("SELECT * FROM hospitalnew WHERE TYPE_SERVICE = 'DMH' ORDER BY hospitalnew.id_hos ASC") or die(mysqli_error());
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
				  <!-- /.row -->


				<div class="text-muted mt-3" align="center">
				 <p class="text-red">หากมีการประสานงานกับสถาบัน/โรงพยาบาล สังกัดกรมสุขภาพจิตมากกว่า 1 โรงพยาบาล ให้ตอบโรงพยาบาลที่ส่งคนไข้มากที่สุด<br>
						 ** (อยากให้มี 1 กับ 2 อยู่ แต่ที่ประเมิน คือ ประเมิน รพจ.อันดับ 1) **</p>
				</div>
			</div>
		</div>
	
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;ท่านพึงพอใจต่อการประสานงานกับโรงพยาบาลจิตเวช หรือไม่ตามหัวข้อดังต่อไปนี้</h3>
		  <br>
		  <p>(<b>4</b> = พึงพอใจมาก, <b>3</b> = พึงพอใจ, <b>2</b> = ไม่พึงพอใจ, <b>1</b> = ควรปรับปรุง, <b>0</b> = ไม่มีการประสานงานเรื่องดังกล่าว)</p>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
			<tbody>
				<tr>
				  <th style="width: 2%">#</th>
				  <th style="width: 15%">ข้อคำถาม</th>
				  <th style="width: 2%"><center>4</center></th>
				  <th style="width: 2%"><center>3</center></th>
				  <th style="width: 2%"><center>2</center></th>
				  <th style="width: 2%"><center>1</center></th>
				  <th style="width: 2%"><center>0</center></th>
				  <th style="width: 10%"><center>ขอเสนอแนะ/ความต้องการ<br>เพิ่มเติม</center></th>
				</tr>
			<div class="form-group"> 
				<tr>
				  <td>1</td>
				  <td>ส่งตัวผู้ป่วยจิตเวชยุ่งยากซับซ้อนเข้ารับการรักษาแบบผู้ป่วยใน <br>(Refer out ; IPD)</td>
				  <td align="center">
					 <input name="roipd" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					 <input name="roipd" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					 <input name="roipd" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="roipd" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					<input name="roipd" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_roipd" type="text" class="form-control" id="other_roipd" placeholder=""></td>
				</tr>
				<tr>
				  <td>2</td>
				  <td>ส่งตัวผู้ป่วยจิตเวชยุ่งยากซับซ้อนรับการรักษาแบบผู้ป่วยนอก <br>(Refer out ; OPD)</td>
				  <td align="center">
					 <input name="roopd" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="roopd" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="roopd" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					  <input name="roopd" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="roopd" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_roopd" type="text" class="form-control" id="other_roopd" placeholder=""></td>
				</tr>
				<tr>
				  <td>3</td>
				  <td>ส่งตัวผู้ป่วยจิตเวชยุ่งยากซับซ้อนมาเพื่อขอรับการบำบัดกับสหวิชาชีพผู้เชี่ยวชาญ</td>
				  <td align="center">
					 <input name="msexpert" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="msexpert" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="msexpert" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="msexpert" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="msexpert" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_msexpert" type="text" class="form-control" id="other_msexpert" placeholder=""></td>
				</tr>
				<tr>
				  <td>4</td>
				  <td>รับผู้ป่วยจิตเวชมารักษาต่อใกล้บ้านหรือเพื่อรักษาตามสิทธิแบบผู้ป่วยนอก <br>(Refer in ; OPD)</td>
				  <td align="center">
					 <input name="riopd" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="riopd" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="riopd" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					  <input name="riopd" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="riopd" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_riopd" type="text" class="form-control" id="other_riopd" placeholder=""></td>
				</tr>
				<tr>
				  <td>5</td>
				  <td>รับผู้ป่วยจิตเวชมาเพื่อตรวจแยกโรคฝ่ายกาย <br>(Refer in ; R/O Organic cause)</td>
				  <td align="center">
					 <input name="rirooc" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="rirooc" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="rirooc" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					  <input name="rirooc" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="rirooc" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_rirooc" type="text" class="form-control" id="other_rirooc" placeholder=""></td>
				</tr>
				<tr>
				  <td>6</td>
				  <td>ขอรับคำปรึกษาในการดูแลผู้ป่วยจิตเวชจากแพทย์และสหวิชาชีพผู้เชี่ยวชาญ</td>
				   <td align="center">
					 <input name="dcmsexpert" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="dcmsexpert" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="dcmsexpert" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="dcmsexpert" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="dcmsexpert" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_dcmsexpert" type="text" class="form-control" id="other_dcmsexpert" placeholder=""></td>
				</tr>
				<tr>
				  <td>7</td>
				  <td>ระบบแพทย์พี่เลี้ยง หรือ ออกหน่วยตรวจจิตเวช</td>
				  <td align="center">
					 <input name="mms" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="mms" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="mms" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="mms" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="mms" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_mms" type="text" class="form-control" id="other_mms" placeholder=""></td>
				</tr>
				<tr>
				  <td>8</td>
				  <td>ได้รับสนับสนุนยาจิตเวช/ทรัพยากร จากโรงพยาบาลจิตเวช</td>
				  <td align="center">
					 <input name="hospitalms" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="hospitalms" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="hospitalms" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="hospitalms" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="hospitalms" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_hospitalms" type="text" class="form-control" id="other_hospitalms" placeholder=""></td>
				</tr>
				<tr>
				  <td>9</td>
				  <td>ภาพรวมการประสานงานทั้งหมด</td>
				  <td align="center">
					 <input name="coordination" type="radio" class="flat-red" value="4">
				  </td>
				  <td  align="center">
					  <input name="coordination" type="radio" class="flat-red" value="3">
				  </td>
				  <td  align="center">
					  <input name="coordination" type="radio" class="flat-red" value="2">
				  </td>
				  <td  align="center">
					 <input name="coordination" type="radio" class="flat-red" value="1">
				  </td>
				  <td  align="center">
					  <input name="coordination" type="radio" class="flat-red" value="0">
				  </td>
				  <td><input name="other_coordination" type="text" class="form-control" id="other_coordination" placeholder=""></td>
				</tr>
			</div>
			</tbody>
		  </table>
        </div>
        <!-- /.card-body -->
		  
		<div class="card-header">
          <h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;อื่น ๆ</h3>
        </div>
		<div class="card-body">
		  <div class="col-md-6 form-group">
          <textarea name="otherms" rows="3" class="form-control" id="otherms" placeholder="ถ้ามี" ></textarea>
		  </div>
        </div>
        <!-- /.card-body -->
		
        <div class="card-footer">
          <center>
			  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
			  <a href="detail-1.php" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
		  </center>
        </div>
        <!-- /.card-footer-->
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
