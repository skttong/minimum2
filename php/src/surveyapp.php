<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HospitalID = $_SESSION['HospitalID'];

$sql  = "SELECT count(*) as total FROM surveyapp WHERE hospID = '$HospitalID'; ";

$query 	= mysqli_query($con, $sql);
$row1 	= mysqli_fetch_array($query);

if($row1['total']>0){
	echo "<script type='text/javascript'>";
	//echo "alert('ขอบคุณค่ะ สำหรับการทำแบบประเมินความพึงพอใจ');";
	//echo "window.location = 'surveyapp.php'; ";
	echo "window.location = 'surveyappview.php'; ";
	echo "</script>";
}
/*else{
	echo "<script type='text/javascript'>";
	echo "alert('ไม่สามารถทำแบบประเมินไ้ด้ กรุณาติดต่อเจ้าหน้าที่');";
	echo "</script>";
}*/



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
            <h4>แบบประเมินความพึงพอใจต่อ "เว็บไซต์ทรัพยากรสุขภาพจิตและจิตเวช"</h4>
			
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
	<form method="post" enctype="multipart/form-data" name="form1" id="form1" action="surveyappsave.php">
		<input type="hidden" value="<?php echo $_SESSION['UserID']; ?>" name="txtUserID"> 
		<input type="hidden" value="<?php echo $HospitalID; ?>" name="hosID">
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;
				<b>ส่วนที่ 1 : </b>ด้านการออกแบบและการจัดการรูปแบบ
			</h3>
			</div>
			<div class="card-body col-md-10">
			  <table class="table table-bordered">
				<tbody>
					<tr bgcolor="#FFC0CB">
					  <th style="width: 1%"><center>#</center></th>
					  <th style="width: 15%"><center>ข้อคำถาม</center></th>
					  <th style="width: 2%"><center>มากที่สุด</center></th>
					  <th style="width: 2%"><center>มาก</center></th>
					  <th style="width: 2%"><center>ปานกลาง</center></th>
					  <th style="width: 2%"><center>น้อย</center></th>
					  <th style="width: 2%"><center>น้อยที่สุด</center></th>
					</tr>
				<div class="form-group"> 
					<tr>
					  <td align="center">1</td>
					  <td>Dashboard มีความสวยงาม ทันสมัย น่าสนใจ</td>
					  <td align="center">
						 <input name="qunaire11" type="radio" class="flat-red" value="4" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire11" type="radio" class="flat-red" value="3" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire11" type="radio" class="flat-red" value="2" required>  
					  </td>
					  <td  align="center">
						 <input name="qunaire11" type="radio" class="flat-red" value="1" required>
					  </td>
					  <td  align="center">
						<input name="qunaire11" type="radio" class="flat-red" value="0" required>
					  </td>
					</tr>
					<tr>
					  <td align="center">2</td>
					  <td>การจัดรูปแบบในเว็บไซต์ง่ายต่อการอ่านและการใช้งาน</td>
					  <td align="center">
						 <input name="qunaire12" type="radio" class="flat-red" value="4" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire12" type="radio" class="flat-red" value="3" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire12" type="radio" class="flat-red" value="2" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire12" type="radio" class="flat-red" value="1" required>
					  </td>
					  <td  align="center">
						<input name="qunaire12" type="radio" class="flat-red" value="0" required>
					  </td>
					</tr>
					<tr>
					  <td align="center">3</td>
					  <td>สีสันในการออกแบบเว็บไซต์มีความเหมาะสม</td>
					  <td align="center">
						 <input name="qunaire13" type="radio" class="flat-red" value="4" required>
					  </td>
					  <td  align="center">
						 <input name="qunaire13" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire13" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire13" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire13" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">4</td>
					  <td>เมนูง่ายต่อการใช้งาน</td>
					  <td align="center">
						 <input name="qunaire14" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire14" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire14" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire14" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire14" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">5</td>
					  <td>สีพื้นหลังกับสีตัวหนังสือมีความเหมาะสมต่อการอ่าน</td>
					  <td align="center">
						 <input name="qunaire15" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire15" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire15" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire15" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire15" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">6</td>
					  <td>ขนาด และรูปแบบตัวอักษรชัดเจน อ่านง่ายและสวยงาม</td>
					  <td align="center">
						 <input name="qunaire16" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire16" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire16" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire16" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire16" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">7</td>
					  <td>ภาพที่ใช้สามารถสื่อความหมายได้</td> 
					  <td align="center">
						 <input name="qunaire17" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire17" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire17" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire17" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire17" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">8</td>
					  <td>โดยภาพรวมท่านมีความพึงพอใจในการออกแบบเว็บไซต์ในระดับใด</td>
					  <td align="center">
						 <input name="qunaire18" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire18" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire18" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire18" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire18" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
				</div>
				</tbody>
			  </table>
				<br>
			</div>
		</div>
		
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;
				<b>ส่วนที่ 2 : </b>ด้านคุณภาพของเนื้อหา
			</h3>
			</div>
			<div class="card-body col-md-10">
			  <table class="table table-bordered">
				<tbody>
					<tr bgcolor="#FFC0CB">
					  <th style="width: 1%"><center>#</center></th>
					  <th style="width: 15%"><center>ข้อคำถาม</center></th>
					  <th style="width: 2%"><center>มากที่สุด</center></th>
					  <th style="width: 2%"><center>มาก</center></th>
					  <th style="width: 2%"><center>ปานกลาง</center></th>
					  <th style="width: 2%"><center>น้อย</center></th>
					  <th style="width: 2%"><center>น้อยที่สุด</center></th>
					</tr>
				<div class="form-group"> 
					<tr>
					  <td align="center">1</td>
					  <td>การเชื่อมโยงข้อมูลภายในเว็บไซต์ถูกต้อง และสะดวกในการใช้งาน</td>
					  <td align="center">
						 <input name="qunaire21" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire21" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire21" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire21" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire21" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">2</td>
					  <td>ข้อมูลมีการปรับปรุงอยู่เสมอ ถูกต้องและน่าเชื่อถือ</td>
					  <td align="center">
						 <input name="qunaire22" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire22" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire22" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire22" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire22" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">3</td>
					  <td>ภาษาเข้าใจง่าย กระชับ อธิบายชี้แจงข้อมูลได้ชัดเจน</td>
					  <td align="center">
						 <input name="qunaire23" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire23" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire23" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire23" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire23" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">4</td>
					  <td>ข้อความในเว็บไซต์ถูกต้องตามหลักภาษาและไวยากรณ์</td>
					  <td align="center">
						 <input name="qunaire24" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire24" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire24" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire24" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire24" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">5</td>
					  <td>เนื้อหาเพียงพอกับความต้องการในการนำไปใช้</td>
					  <td align="center">
						 <input name="qunaire25" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire25" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire25" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire25" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire25" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">6</td>
					  <td>การจัดลำดับเนื้อหาเป็นขั้นตอน มีความต่อเนื่อง เข้าใจง่าย</td>
					  <td align="center">
						 <input name="qunaire26" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire26" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire26" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire26" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire26" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">7</td>
					  <td>มีการจัดหมวดหมู่ให้ง่ายต่อการค้นหาและทำความเข้าใจ</td>
					  <td align="center">
						 <input name="qunaire27" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire27" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire27" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire27" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire27" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">8</td>
					  <td>ความเหมาะสมของข้อมูลภายในเว็บไซต์</td>
					  <td align="center">
						 <input name="qunaire28" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire28" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire28" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire28" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire28" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">9</td>
					  <td>ความรวดเร็วในการดาวน์โหลดข้อมูล</td>
					  <td align="center">
						 <input name="qunaire29" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire29" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire29" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire29" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire29" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">10</td>
					  <td>โดยภาพรวมท่านมีความพึงพอใจในคุณภาพของเนื้อหาระดับใด</td>
					  <td align="center">
						 <input name="qunaire210" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire210" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire210" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire210" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire210" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
				</div>
				</tbody>
			  </table>
				<br>
			</div>
		</div>
		
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;
				<b>ส่วนที่ 3 : </b>ด้านประโยชน์และการนำไปใช้
			</h3>
			</div>
			<div class="card-body col-md-10">
			  <table class="table table-bordered">
				<tbody>
					<tr bgcolor="#FFC0CB">
					  <th style="width: 1%"><center>#</center></th>
					  <th style="width: 15%"><center>ข้อคำถาม</center></th>
					  <th style="width: 2%"><center>มากที่สุด</center></th>
					  <th style="width: 2%"><center>มาก</center></th>
					  <th style="width: 2%"><center>ปานกลาง</center></th>
					  <th style="width: 2%"><center>น้อย</center></th>
					  <th style="width: 2%"><center>น้อยที่สุด</center></th>
					</tr>
				<div class="form-group"> 
					<tr>
					  <td align="center">1</td>
					  <td>เนื้อหามีประโยชน์ต่อผู้ใช้งาน และสามารถนำไปประยุกต์ใช้ได้ </td>
					  <td align="center">
						 <input name="qunaire31" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire31" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire31" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire31" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire31" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">2</td>
					  <td>เป็นสื่อในการเผยแพร่ข้อมูล ประชาสัมพันธ์ และงานวิจัย</td>
					  <td align="center">
						 <input name="qunaire32" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire32" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire32" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire32" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire32" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">3</td>
					  <td>สามารถเป็นแหล่งความรู้ได้ </td>
					  <td align="center">
						 <input name="qunaire33" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire33" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire33" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire33" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire33" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
					<tr>
					  <td align="center">4</td>
					  <td>เป็นแหล่งข้อมูลที่ตรงกับความต้องการของผู้ใช้งาน</td>
					  <td align="center">
						 <input name="qunaire34" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire34" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire34" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire34" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire34" type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
				</div>
				</tbody>
			  </table>
				<br>
			</div>
		</div>
			
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;
				<b>ส่วนที่ 4 : </b>ความพึงพอใจโดยภาพรวมเว็บไซต์ทรัพยากรสุขภาพจิตและจิตเวช
			</h3>
			</div>
			<div class="card-body col-md-10">
			  <table class="table table-bordered">
				<tbody>
					<tr bgcolor="#FFC0CB">
					  <!--<th style="width: 1%"><center>#</center></th>
					  <th style="width: 15%"><center>ข้อคำถาม</center></th>-->
					  <th style="width: 2%"><center>มากที่สุด</center></th>
					  <th style="width: 2%"><center>มาก</center></th>
					  <th style="width: 2%"><center>ปานกลาง</center></th>
					  <th style="width: 2%"><center>น้อย</center></th>
					  <th style="width: 2%"><center>น้อยที่สุด</center></th>
					</tr>
				<div class="form-group"> 
					<tr>
					  <!--<td>1</td>
					  <td>ความพึงพอใจโดยภาพรวม</td>-->
					  <td align="center">
						 <input name="qunaire4" type="radio" class="flat-red" value="4" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire4" type="radio" class="flat-red" value="3" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire4" type="radio" class="flat-red" value="2" required >
					  </td>
					  <td  align="center">
						 <input name="qunaire4" type="radio" class="flat-red" value="1" required >
					  </td>
					  <td  align="center">
						<input name="qunaire4"  type="radio" class="flat-red" value="0" required >
					  </td>
					</tr>
				</div>
				</tbody>
			  </table>
				<br>
			</div>
		</div>
		
		<div class="card card-success card-outline">
			<div class="card-header">
			<h3 class="card-title">
				<h3 class="card-title"><i class="fas fa-edit"></i>&nbsp;
				<b>ส่วนที่ 5 : </b>ข้อเสนอแนะอื่น ๆ ที่ต้องการให้มีการปรับปรุงและพัฒนา
			</h3>
			</div>
			<div class="card-body">
			  <div class="col-md-8 form-group">
			  	<textarea name="qunaire5_other" rows="5" class="form-control" id="otherms" placeholder="ถ้ามี"></textarea>
			  </div>
			</div>
			<div class="card-footer">
			  <center>
				  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
				  <a href="detail-all.php" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
			  </center>
			</div>
			<!-- /.card-footer-->
		</div>
		
        <!-- /.card-body -->	     
	  
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
