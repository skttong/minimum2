<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '$HospitalID' AND qustype = '1'"; 

//$splupdate = "SELECT count(*) as 'numrow' FROM serviceform WHERE HospitalID = '10676'";

$queryupdate = mysqli_query($con, $splupdate);
$resultupdate = mysqli_fetch_array($queryupdate);


/*if($resultupdate['numrow'] == 0 ){*/
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
  <?php if($resultupdate['numrow'] <> '0'){ ?>
	<meta http-equiv="Refresh" content="0;URL=tables-sys.php">
 <?php } ?>

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
              <li class="breadcrumb-item active">ระดับโรงพยาบาลศูนย์ โรงพยาบาลทั่วไป</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="ServiceForm_center.php">
		<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID">
		<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>หน่วยบริการ</label><b><span style="color:red;">*</span></b>
					<select name="txtHospitalID" class="form-control select2" style="width: 100%;" required>
						<option selected disabled value="">กรุณากรอกรหัสหน่วยบริการ 5 หลักหรือชื่อหน่วยบริการ</option>
						<?php
							$query = $con->query("SELECT * FROM hospitalnew WHERE hospitalnew.HOS_TYPE = 'โรงพยาบาลศูนย์' OR hospitalnew.HOS_TYPE = 'โรงพยาบาลทั่วไป' order by hospitalnew.CODE5") or die(mysqli_error());
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
      <div class="card card-info card-outline">
		  <div class="card-header">
			<h3 class="card-title">
			  <i class="fas fa-file-alt"></i>&nbsp;
			 <!-- ระบบบริการสุขภาพจิตและจิตเวช--> <span class="text-green"> สำหรับ โรงพยาบาลศูนย์/ โรงพยาบาลทั่วไป สังกัดสำนักงานปลัดกระทรวงสาธารณสุข สถาบัน/
			  โรงพยาบาล สังกัดกรมสุขภาพจิต สถาบัน/ โรงพยาบาล สังกัดกรมการแพทย์</span>
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
					  <input type="checkbox" name="qus1_1_1" class="flat-red" value="1">&nbsp; 
					  มีการจัดตั้งกลุ่มงานสุขภาพจิตและยาเสพติด
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_2" class="flat-red" value="1">&nbsp; 
					  มีบริการ/คลินิกเฉพาะทางจิตเวชและยาเสพติดที่แยกเป็นสัดส่วนเพื่อให้บริการตรวจวินิจฉัยบำบัดรักษา ส่งเสริมป้องกันและฟื้นฟูโรคจิตเวชทั่วไป
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_3" class="flat-red" value="1">&nbsp; 
					  มีบริการจิตบำบัด/ พฤติกรรมบำบัด
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_4" class="flat-red" value="1">&nbsp; 
					  มีบริการบำบัดผู้ป่วยยาเสพติด ( Motivation interview : MI )
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_5" class="flat-red" value="1">&nbsp; 
					  มีบริการคัดกรอง ป้องกัน ส่งเสริม ปัญหาสุขภาพจิตในผู้ป่วยที่เข้ามารับบริการ OPD ทุกแผนก
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_6" class="flat-red" value="1">&nbsp; 
					  มีบริการตรวจรักษาทางไกล (Telepsychiatry)
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_7" class="flat-red" value="1">&nbsp; 
					  มีบริการตรวจวินิจฉัยและบำบัดรักษาผู้ป่วยกลุ่มเสี่ยง ได้แก่ ผู้ป่วยในทัณฑสถาน สถานพินิจและคุ้มครองเด็ก
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_8" class="flat-red" value="1">&nbsp; 
					  มีระบบการส่งต่อยาทางไปรษณีย์ (Inter-hospital)
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_9" class="flat-red" value="1">&nbsp; 
					  มีระบบรับยาใกล้บ้าน
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_1_10" class="flat-red" value="1">&nbsp; 
					  มีบริการนิติจิตเวช
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus1_1_11" class="flat-red" value="1">&nbsp; 
						มีบริการนิติจิตเวช
					</span>-->
						  
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
					<span><!--(ถ้าไม่มีข้ามไปข้อ 1.3)-->
					 <input type="checkbox" name="qus1_2_1" class="flat-red" value="1">&nbsp;  
					 มีบริการให้คำปรึกษาด้านสุขภาพจิตแก่แผนกอื่น (consultation laison)
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
					<span>
					  <input type="checkbox" name="qus1_3_1" class="flat-red" value="1">&nbsp; 
					  มีบริการดูแลผู้ป่วยจิตเวชและยาเสพติดระยะฉุกเฉิน (Acute Care) ในการวินิจฉัยและบำบัดรักษาผู้ป่วยจิตเวชเบื้องต้นตาม พรบ.สุขภาพจิต
					</span><br>
					
					<span>
					  <input type="checkbox" name="qus1_3_2" class="flat-red" value="1">&nbsp; 
					  การฝึกซ้อมแผนเผชิญเหตุ
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_3_3" class="flat-red" value="1">&nbsp; 
					  มีบริการเยียวยาจิตใจประชาชนทั่วไปในภาวะวิกฤติ
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_3_4" class="flat-red" value="1">&nbsp; 
					  มีบริการผู้ป่วยจิตเวชฉุกเฉินก่อนนำส่งโรงพยาบาล (Pre-hospital and inter hospital refer)
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_3_5" class="flat-red" value="1">&nbsp; 
					  มีบริการ OSCC เคส Abuse ร่วมกับแผนกอื่น (ใน รพ.ระดับจังหวัด)
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_3_6" class="flat-red" value="1">&nbsp; 
					  มีระบบการรับ-ส่งต่อผู้ป่วยที่มีปัญหายุ่งยากซับซ้อน
					</span><br>

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
					<!--<span>
					  <input type="checkbox" name="qus1_4_5" class="flat-red" value="1">&nbsp;  
						 Long acting 2nd gen antipsychotics ได้แก่ Aripiprazole long-acting injection, Paliperidone long-acting injection
					</span><br>-->
					<span>
					  <input type="checkbox" name="qus1_4_1" class="flat-red" value="1">&nbsp; 
					  แบบทดสอบทางจิตวิทยาคลินิกที่สามารถตรวจวินิจฉัยทางจิตวิทยาคลินิกเกี่ยวกับเชาว์ปัญญา บุคลิกภาพ และประสาทจิตวิทยา
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_4_2" class="flat-red" value="1">&nbsp; 
					  การตรวจทดสอบทางห้องปฏิบัติการและรังสีวิทยาที่เกี่ยวข้องทางด้านจิตเวช
					</span><br>
					<span>
					  <input type="checkbox" name="qus1_4_3" class="flat-red" value="1">&nbsp; 
					  ผ้าผูกยึด/ เครื่องมือ/ อุปกรณ์ในการจำกัดพฤติกรรมผู้ป่วย
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus1_4_4" class="flat-red" value="1" onclick="enablequs1_4();">&nbsp; 
						นวัตกรรมและเทคโนโลยีอื่นๆ ที่ช่วยดูแลและส่งเสริมสุขภาพจิต 
					</span><br>
					<p class="col-md-6" style="margin-top:5px;">
					  <span for="other_qus1_4_4">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus1_4_4" type="text" class="form-control" id="other_qus1_4_4" placeholder="โปรดระบุ"  disabled required>
					</p> 
					<script>
						function enablequs1_4() {
						  var g = document.getElementById("other_qus1_4_4").disabled;
							if( g ){
								document.getElementById("other_qus1_4_4").disabled = false;
							}else{
								document.getElementById("other_qus1_4_4").disabled = true;
							}

						}

					</script>  -->
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
					  <input type="checkbox" name="qus2_1_1" class="flat-red" value="1">&nbsp; 
					  มีบริการส่งเสริมป้องกันและคัดกรองโรคจิตเวชทั่วไปในชุมชน
					</span><br>
					<span>
					  <input type="checkbox" name="qus2_1_2" class="flat-red" value="1">&nbsp; 
					  มีบริการส่งเสริมป้องกันและคัดกรองโรคจิตเวชเด็กและวัยรุ่นในชุมชน
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus2_1_3" class="flat-red" value="1">&nbsp; 
						มีบริการส่งเสริมป้องกัน และคัดกรองสุขภาพจิตและจิตเวชผู้สูงอายุในชุมชน
					</span><br>-->
					<span>
					  <input type="checkbox" name="qus2_1_4" class="flat-red" value="1">&nbsp; 
					  มีการติดตาม/ดูแลต่อเนื่องผู้ป่วยจิตเวชและยาเสพติดในชุมชน
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus2_1_5" class="flat-red" value="1">&nbsp; 
					  มีทีม มีบริการเยียวยาจิตใจเด็กและเยาวชนในภาวะวิกฤติ
					</span><br>
					<span>
					  <input type="checkbox" name="qus2_1_6" class="flat-red" value="1">&nbsp; 
					  มีทีม มีบริการเยียวยาจิตใจประชาชนทั่วไปในภาวะวิกฤติ
					</span><br>-->
				
					<span>
					  <input type="checkbox" name="qus2_1_7" class="flat-red" value="1">&nbsp; 
					  เป็นแม่ข่ายในการบริการ/ให้คำปรึกษา แก่เครือข่าย
					</span>
						
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
					  <input type="checkbox" name="qus3_1_1" class="flat-red" value="1">&nbsp; 
					  มีบริการจิตเวชเด็กวินิจฉัย และดูแลรักษาต่อเนื่องโรคจิตเวชเด็กที่ยุ่งยากซับซ้อนได้
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_1_2" class="flat-red" value="1">&nbsp; 
					  มีบริการกระตุ้นพัฒนาการสามารถวินิจฉัยและกระตุ้นเด็กที่มีพัฒนาการล่าช้า
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_1_3" class="flat-red" value="1">&nbsp; 
					  มีบริการแก้ไขการพูด/ วจีบำบัด
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_1_4" class="flat-red" value="1">&nbsp; 
					  มีบริการกิจกรรมบำบัด
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_1_5" class="flat-red" value="1">&nbsp; 
					  มีบริการจิตบำบัด/พฤติกรรมบำบัด
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus3_1_6" class="flat-red" value="1" onclick="enablequs3_1();">&nbsp; 
						อื่นๆ (โปรดระบุ)
					</span><br>
					<p class="col-md-6" style="margin-top:5px;">
					  <span for="other_qus3_1_6">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_1_6" type="text" class="form-control" id="other_qus3_1_6" placeholder="โปรดระบุ"  disabled required>
					</p> 
					<script>
						function enablequs3_1() {
						  var g = document.getElementById("other_qus3_1_6").disabled;
							if( g ){
								document.getElementById("other_qus3_1_6").disabled = false;
							}else{
								document.getElementById("other_qus3_1_6").disabled = true;
							}

						}

					</script>     
					-->
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.2 งานบริการผู้ป่วยใน(IPD)</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
						  <input type="checkbox" name="qus3_2_1" class="flat-red" value="1">&nbsp; 
						  มีบริการให้คำปรึกษาด้านสุขภาพจิตเด็กและวัยรุ่นแก่แผนกอื่น (consultation laison)
						</span><br>
						<!--<span>
						  <input type="checkbox" name="qus3_2_2" class="flat-red" value="1">&nbsp; 
							มีบริการผู้ป่วยจิตเวชเด็กฉุกเฉินก่อนนำส่งโรงพยาบาล (Pre-hospital care)
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_2_3" class="flat-red" value="1">&nbsp; 
							มีศูนย์บริการช่วยเหลือเด็กและสตรีที่ถูกกระทำรุนแรง (One Stop Crisis Center, OSCC)
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_2_4" class="flat-red" value="1">&nbsp; 
							มีระบบการรับ-ส่งต่อผู้ป่วยเด็กและวัยรุ่นที่มีปัญหายุ่งยากซับซ้อน (Inter Hospital Refer)
						</span>
					-->
					
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->

			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.3 งานบริการผู้ป่วยฉุกเฉิน</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="card-body">
					<span>
						  <input type="checkbox" name="qus3_3_1" class="flat-red" value="1">&nbsp; 
						  มีบริการดูแลผู้ป่วยจิตเวชเด็กและวัยรุ่นระยะฉุกเฉิน (Acute Care) ในการวินิจฉัยและบำบัดรักษาผู้ป่วยจิตเวชเบื้องต้นตาม พรบ.สุขภาพจิต
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_3_2" class="flat-red" value="1">&nbsp; 
						  มีบริการผู้ป่วยจิตเวชเด็กฉุกเฉินก่อนนำส่งโรงพยาบาล (Pre-hospital and inter hospital refer)
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_3_3" class="flat-red" value="1">&nbsp; 
						  มีบริการ OSCC เคส Abuse(เด็กและวัยรุ่น) ร่วมกับแผนกอื่น (ในรพ.ระดับจังหวัด)
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_3_4" class="flat-red" value="1">&nbsp; 
						  มีระบบการรับ-ส่งต่อผู้ป่วยเด็กและวัยรุ่นที่มีปัญหายุ่งยากซับซ้อน
						</span><br>
						<span>
						  <input type="checkbox" name="qus3_3_5" class="flat-red" value="1">&nbsp; 
						  มีบริการเยียวยาจิตใจเด็กและเยาวชนในภาวะวิกฤติ
						</span>

					
					
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title">3.4 เครื่องมือ/อุปกรณ์/เทคโนโลยี</h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
						<i class="fas fa-minus"></i>
						</button>
					</div>
				</div>

				<div class="card-body">
					<span>
					  <input type="checkbox" name="qus3_4_1" class="flat-red" value="1">&nbsp; 
					  มียา methylphenidate (Short acting)
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_2" class="flat-red" value="1">&nbsp; 
					  มียา methylphenidate (long acting)
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_3" class="flat-red" value="1">&nbsp; 
					  มียา Clonidine
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_4" class="flat-red" value="1">&nbsp; 
					  มียา Aripripazole
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_5" class="flat-red" value="1">&nbsp; 
					  มียา Risperidone solution
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_6" class="flat-red" value="1">&nbsp; 
					  แบบประเมินระดับสติปัญญา WISC III/IV
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_7" class="flat-red" value="1">&nbsp; 
					  การวัดผลสัมฤทธิ์ทางการเรียน Wide Range Achievement Test หรือ WRAT-Thai
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_8" class="flat-red" value="1">&nbsp; 
					  ห้อง Seclusion room (อย่างน้อย1ห้อง)
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_9" class="flat-red" value="1">&nbsp; 
					  ห้องกระตุ้นพัฒนาการที่ได้สัดส่วนถาวร (อย่างน้อย 1ห้อง)
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_10" class="flat-red" value="1">&nbsp; 
					  TEDA4I
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_11" class="flat-red" value="1">&nbsp; 
					  แบบบันทึก การเฝ้าระวังและส่งเสริมพัฒนาการ เด็กปฐมวัย DSPM
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_12" class="flat-red" value="1">&nbsp; 
					  แบบคัดกรองDAIM
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_13" class="flat-red" value="1">&nbsp; 
					  แบบประเมินพฤติกรรม  SNAP-IV
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_14" class="flat-red" value="1">&nbsp; 
					  แบบประเมินจุดแข็งและจุดอ่อน SDQ
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_15" class="flat-red" value="1">&nbsp; 
					  แบบคัดกรองโรคในกลุ่มพัฒนาการผิดปกติอย่างรอบด้าน PDDSQ
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_16" class="flat-red" value="1">&nbsp; 
					  แบบประเมินภาวะซึมเศร้าในวัยรุ่น PHQ-A
					</span><br>
					<span>
					  <input type="checkbox" name="qus3_4_17" class="flat-red" value="1">&nbsp; 
					  แบบคัดกรองภาวะซึมเศร้าในเด็ก CDI
					</span><br>
					<!--<span>
					  <input type="checkbox" name="qus3_4_9" class="flat-red" value="1" onclick="enablequs3();">&nbsp; 
						อื่นๆ (โปรดระบุ)
					</span><br>
					<p class="col-md-6" style="margin-top:5px;">
					  <span for="other_qus3_4_9">โปรดระบุ</span><b><span style="color:red;">*</span></b>
					  <input name="other_qus3_4_9" type="text" class="form-control" id="other_qus3_4_9" placeholder="โปรดระบุ"  disabled required>
					</p> 
					<script>
						function enablequs3() {
						  var g = document.getElementById("other_qus3_4_9").disabled;
							if( g ){
								document.getElementById("other_qus3_4_9").disabled = false;
							}else{
								document.getElementById("other_qus3_4_9").disabled = true;
							}

						}

					</script>  
					--> 
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
		     
		    <!--<h5><i class='fas fa-edit'></i> จำนวนผู้ป่วย</h5>-->

			<?php
				if (date("m") == '10' || date("m") == '11' || date("m") == '12'){

					$YEAR = date("Y")+543+1 ;
				   }else{
				   
					 $YEAR = date("Y")+543 ;
				   }

			?>

		    <div class="card card-outline card-dark">
				<div class="card-header">
					<h3 class="card-title">จำนวนผู้รับบริการ ปีงบประมาณ <?php echo $YEAR-1 ;?></h3><br>
					<h3 class="card-title">(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)</h3>
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
								  <div class="col-md-5">
									  <input name="number_patients_1" type="text" class="form-control" id="number_patients_1" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<!--<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชเด็กและวัยรุ่น (ต่ำกว่า 18 ปีบริบูรณ์)</div>
								  <div class="col-md-3">
									  <input name="number_patients_2" type="text" class="form-control" id="number_patients_2" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชรายใหม่ (2565)</div>
								  <div class="col-md-3">
									  <input name="number_patients_3" type="text" class="form-control" id="number_patients_3" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วย SMI-V</div>
								  <div class="col-md-3">
									  <input name="number_patients_4" type="text" class="form-control" id="number_patients_4" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>-->
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่รับบริการ OPD</div>
								  <div class="col-md-5">
									  <input name="number_patients_5" type="text" class="form-control" id="number_patients_5" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่รับบริการ IPD</div>
								  <div class="col-md-5">
									  <input name="number_patients_6" type="text" class="form-control" id="number_patients_6" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวชที่มารับบริการแผนก ER</div>
								  <div class="col-md-5">
									  <input name="number_patients_7" type="text" class="form-control" id="number_patients_7" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer in</div>
								  <div class="col-md-5">
									  <input name="number_patients_8" type="text" class="form-control" id="number_patients_8" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out ทั้งหมด
									 <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">กระบวนการรับการส่งต่อผู้ป่วย <br>จากสถานพยาบาลอื่น (refer in)</span>
									</div>
								  </div>
								  <div class="col-md-5">
									  <input name="number_patients_9" type="text" class="form-control" id="number_patients_9"" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)"  required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช refer out สำหรับ admit
								  	<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">จำนวนผู้ป่วยจิตเวช refer out สำหรับ admit</span>
									</div>
								  </div>
								  <div class="col-md-5">
									  <input name="number_patients_10" type="text" class="form-control" id="number_patients_10" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน
									<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
									  <span class="tooltiptext">จำนวนผู้ป่วยจิตเวช เยี่ยมบ้าน</span>
									</div>
								  </div>
								  <div class="col-md-5">
									  <input name="number_patients_11" type="text" class="form-control" id="number_patients_11" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>
							
						
							<!--
							<div class="row" style="padding-bottom: 5px;">							  
								  <div class="col-md-5">จำนวนผู้ป่วยซึมเศร้า (F32.0-F32.9, F33.0-F33.9, F34.1)</div>
								  <div class="col-md-3">
									  <input name="number_patients_13" type="text" class="form-control" id="number_patients_13" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคสุราและสารเสพติด (F10-F19)</div>
								  <div class="col-md-3">
									  <input name="number_patients_14" type="text" class="form-control" id="number_patients_14" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคสมาธิสั้น (F90)</div>
								  <div class="col-md-3">
									  <input name="number_patients_15" type="text" class="form-control" id="number_patients_15" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
							<div class="row" style="padding-bottom: 5px;">						  
								  <div class="col-md-5">จำนวนผู้ป่วยโรคออทิสติก (F84.0-F84.9)</div>
								  <div class="col-md-3">
									  <input name="number_patients_16" type="text" class="form-control" id="number_patients_16" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0) ถ้าไม่มีใหีใส่ 0 " required>
								  </div>
								  <div class="col-md-3">คน</div>
							</div>
					-->
							<div class="row" style="padding-bottom: 5px;">	
								  <div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ป่วยคลินิกกระตุ้น
								  </div>
								  <div class="col-md-5">
									  <input name="number_patients_17" type="text" class="form-control" id="number_patients_17" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0)" required>
								  </div>
								  <div class="col-md-2">คน</div>
							</div>

							<div class="row" style="padding-bottom: 5px;">							  
							<div class="col-md-5"><i class='fas fa-caret-right' style='font-size:14px'></i>&nbsp;&nbsp;จำนวนผู้ได้รับผลกระทบจากสถานการณ์วิกฤต (MCATT)</div>
							<div class="col-md-5">
									  <input name="number_patients_18" type="text" class="form-control" id="number_patients_18" placeholder="(ถ้าไม่มีข้อมูลให้ใส่ NA ถ้าไม่มีจำนวนผู้ป่วยให้ใส่ 0) " required>
								  </div>
								  <div class="col-md-2">คน</div>
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
						<textarea name="problems_obstacles" rows="3" class="form-control" id="problems_obstacles" placeholder="ถ้ามี" required></textarea>
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
						<textarea name="feedback" rows="3" class="form-control" id="feedback" placeholder="ถ้ามี" required></textarea>
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
						<textarea name="DevelopmentPlan" rows="3" class="form-control" id="DevelopmentPlan" placeholder="ถ้ามี" required></textarea>
					</div>
				</div>
				<!-- / card-body-->
			</div>
			<!-- / card card-outline card-primary-->
			  
			<div class="text-muted mt-3">
			  <div class="row">
				  <div class="col-md-6">
					  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
					  <a href="detail-all.php" class="btn btn-default"> ปิด &nbsp;<i class="fa fas fa-undo"></i></a>
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
