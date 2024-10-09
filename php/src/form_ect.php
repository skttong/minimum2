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
			<h4>แบบฟอร์มบันทึกข้อมูลการรักษาด้วยไฟฟ้า (ECT/TMS) <br> <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>แบบฟอร์มบันทึกข้อมูลการรักษาด้วยไฟฟ้า (ECT/TMS) <br>  <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">แบบฟอร์ม</a></li>
              <li class="breadcrumb-item active"> การรักษาด้วยไฟฟ้า (ECT)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<form class="form-valide" action="ect_add_all.php" method="post" id="myform1" name="foml">
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

			  <!-- Default box -->
			  <div class="card card-success card-outline">
				<div class="card-header">
				  <h3 class="card-title" style="color: dimgray"> ข้อมูลการรักษาด้วยไฟฟ้า (ECT)</h3>

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
				<p><b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การรักษาด้วยไฟฟ้า (ECT) <span class="text-danger">*</span></b></p>
				  <div class="row">
					  
					  <div class="col-md-1" style="padding-left: 28px;">
						<span>
						  <input name="ECT_Y" type="radio" class="flat-red" value="มี" onclick="enableTxt();" required>&nbsp;
							มี 
						</span>
					  </div>
					  <!-- /.col -->
					  <div class="col-md-4" align="right">
						   <span for="count_PW">จำนวนเครื่อง</span>
					  </div>
					  <div class="col-md-2">
						   <input name="count_ECT" type="number" min="1" class="form-control" id="count_ECT" placeholder="โปรดระบุจำนวนเครื่อง" disabled required>
					  </div>
				   </div>
				   <!-- /.row -->
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input name="ECT_Y" type="radio" class="flat-red" value="ไม่มี" onclick="disableTxt();" required>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
				   <script>
						function disableTxt() {
						  document.getElementById("count_ECT").disabled = true;
						  document.getElementById("count_ECT").value = "";	
						}
						function enableTxt() {
						  document.getElementById("count_ECT").disabled = false;
						  document.getElementById("count_ECT").value = "1";	
						}
					</script> 
				<hr>	
				<p><b><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;การรักษาด้วย Transcranial Magnetic Stimulation (TMS) <span class="text-danger">*</span></b></p>
				  <div class="row">
					  
					  <div class="col-md-1" style="padding-left: 28px;">
						<span>
						  <input type="radio" name="TMS_Y" class="flat-red" value="มี" onclick="enableTxtTMS();" required>&nbsp;
							มี 
						</span>
					  </div>
					  <!-- /.col -->
					  <div class="col-md-4" align="right">
						   <span for="count_PU">จำนวนเครื่อง</span>
					  </div>
					  <div class="col-md-2">
						   <input name="count_TMS" type="number" min="1" class="form-control" id="count_TMS" placeholder="โปรดระบุจำนวนเครื่อง" disabled required>
					  </div>
				   </div>
				   <!-- /.row -->
				   
				  <div class="row"  style="padding-left: 20px;margin-bottom: 28px;">
					  
					  <div class="col-md-1">
						<span>
						  <input type="radio" name="TMS_Y" class="flat-red" value="ไม่มี" onclick="disableTxtTMS();" required>&nbsp;
							ไม่มี 
						</span>
					  </div>
					  <!-- /.col -->
				   </div>
				   <!-- /.row -->
					
				   <script>
						function disableTxtTMS() {
						  document.getElementById("count_TMS").disabled = true;
						  document.getElementById("count_TMS").value = "";	
						}
						function enableTxtTMS() {
						  document.getElementById("count_TMS").disabled = false;
						  document.getElementById("count_TMS").value = "1";	
						}
					</script> 
				
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
			  	  <a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
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
