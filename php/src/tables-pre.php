<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];
$codeprovince	= $_SESSION["codeprovince"];

if (isset($_POST["positiontypeID"])) {
	$positiontypeID		= $_POST["positiontypeID"];
}


//$PersonnelType	= $_GET['t'];
/*

$sqlt 		= "SELECT PtypeID, Ptypename ,Ptype FROM personneltype WHERE PtypeStatus = 1 AND Ptype = $PersonnelType";
$objptype 	= mysqli_query($con, $sqlt);
$rowptype   = mysqli_fetch_array($objptype);*/
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">
	<?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-preall.php">
	<?php }else if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-preall.php">
	<?php }else if($_SESSION["HosType"] == 'ศูนย์วิชาการ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-preall.php">
	<?php }else if($_SESSION["HosType"] == 'กรมสุขภาพจิต'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-preall2.php">
		<?php }else if($_SESSION["TypeUser"] == "Admin"){ ?>
      <meta http-equiv="Refresh" content="0;URL=tables-preall2.php">
	<?php } ?>

</head>
<body class="hold-transition sidebar-mini bodychange">
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
			$sql_u 		= "SELECT * FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
			$query_u 	= mysqli_query($con, $sql_u);
			$result_u 	= mysqli_fetch_array($query_u);
		    $HOS_NAME = $result_u['HOS_NAME']; 
      	    $TypeService = $_SESSION["TypeService"];
			$CODE_DISTRICT = $result_u['CODE_DISTRICT'];
		}
		?>
         <?php /* <h2 class="card-title">แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2> */ ?>
		 <?php if($TypeService <> ''){?>
			<h4>ข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลทรัพยากร   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-maindetail.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">บุคลากรสุขภาพจิตและจิตเวช</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	 
    <section class="content">
      <div class="container-fluid">
	  <?php /* ?>
		<div class="card-body">
			<form class="form-valide" action="tables_memberall2.php" method="post" id="myform1" name="foml">  
            <div class="row">
              
              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2"  style="width: 100%;">
                    <option selected="selected"  value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="ในสังกัด">ในสังกัด</option>
                    <option value="นอกสังกัด">นอกสังกัด</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
			   <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>เขตพื้นที่/Service Plan</label>
                  <select class="form-control select2" style="width: 100%;" id="mySelect" onChange="myFunction()">
                    <option selected="selected" value="ทั้งหมด"> ทั้งหมด</option>
                    <option value="เขตพื้นที่">เขตพื้นที่</option>
                    <option value="ServicePlan">Service Plan</option>
                    <option value="รายโรงพยาบาล">รายโรงพยาบาล</option>
                  </select>
				   
				<script>
					function myFunction() {
						let elementarea 		= document.getElementById("area");
						let elementlabelarea 	= document.getElementById("labelarea");
						let elementservice 		= document.getElementById("service");
						let elementlabelservice = document.getElementById("labelservice");
						
						selectElement = document.querySelector('#mySelect');	
        				output = selectElement.value;
						
						if(output === "ServicePlan"){
							//alert(output);
							elementservice.removeAttribute("hidden");
							elementlabelservice.removeAttribute("hidden");
							
							elementarea.setAttribute("hidden", "hidden");
							elementlabelarea.setAttribute("hidden", "hidden");
							
						}else{
							elementarea.removeAttribute("hidden");
							elementlabelarea.removeAttribute("hidden");
							
							elementservice.setAttribute("hidden", "hidden");
							elementlabelservice.setAttribute("hidden", "hidden");
						
							//alert("tong");
						}
						
					}
				</script> 
				   
                </div>
              </div>
              <!-- /.col -->	
			 <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="เขต 01">เขต1</option>
                    <option value="เขต 02">เขต2</option>
                    <option value="เขต 03">เขต3</option>
					<option value="เขต 04">เขต4</option>
                    <option value="เขต 05">เขต5</option>
                    <option value="เขต 06">เขต6</option>
					<option value="เขต 07">เขต7</option>
                    <option value="เขต 08">เขต8</option>
                    <option value="เขต 09">เขต9</option>
					<option value="เขต 10">เขต10</option>
                    <option value="เขต 11">เขต11</option>
                    <option value="เขต 12">เขต12</option>
					<option value="เขต 13">เขต13</option>
                   </select>
                </div>
				<!-- /.form-group -->
                <div class="form-group" id="labelservice" hidden="none">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" hidden="none">
                     <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					<option value="F2">F2</option>
					<option value="F3">F3</option>  
                  </select>
                </div>
                <!-- /.form-group -->  
              </div>
              <!-- /.col -->
			  <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT PROVINCE_ID, PROVINCE_CODE, PROVINCE_NAME FROM province ;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["PROVINCE_CODE"];?>" ><?PHP echo $rowprovince["PROVINCE_NAME"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->		
            </div>
            <!-- /.row -->
		
			<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
				   <button type="reset" class="btn btn-default"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>
        </div>
        <!-- /.card -->	 
		<?php */ ?>
        <div class="row">
          <div class="col-12">
            <div class="card">

             <div class="card-header">
			 <!--<input name="btnExport" type="button" value="Exportpdf" onClick="JavaScript:window.location='preexprotexcel2.php';">-->
				 <!-- <a class="dropdown-item" href="preexprotexcel.php" target="_blank"><input name="btnExport" type="button" value="Exportexcel"></a>-->
                <!--<h3 class="card-title">ข้อมูลจำนวนบุคลากรสุขภาพจิตและจิตเวช</h3>-->
				<form id="myForm" method="post" action="tables-pre.php">
				<?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
					<a href="detail-1.php" class="btn btn-default" onclick="showAlert()" > เพิ่มข้อมูลในกรณีที่มีบุคลากรด้าน MCATT ที่สสจ. เพิ่มเติม &nbsp;<i class="fa fas fa-del"></i></a>
				<?php }else if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){ ?>
					<a href="detail-1.php" class="btn btn-default" onclick="showAlert()" > เพิ่มข้อมูลในกรณีที่มีบุคลากรด้าน MCATT ที่สสอ. เพิ่มเติม &nbsp;<i class="fa fas fa-del"></i></a>	
				<?php } ?>
				<?php if (isset($_POST["positiontypeID"])) { ?>	
				<select id="positiontypeID" name="positiontypeID" class="form-control select2 float-sm-right" style="width: 20%;" >
					<option value="1" <?php if($positiontypeID=='1'){?> selected <?php } ?> >แพทย์</option>
					<option value="2" <?php if($positiontypeID=='2'){?> selected <?php } ?> >พยาบาล</option>
					<option value="3" <?php if($positiontypeID=='3'){?> selected <?php } ?> >เภสัชกร</option>
					<option value="4" <?php if($positiontypeID=='4'){?> selected <?php } ?> >นักจิตวิทยา</option>
					<option value="5" <?php if($positiontypeID=='5'){?> selected <?php } ?> >นักสังคมสงเคราะห์</option>
					<option value="6" <?php if($positiontypeID=='6'){?> selected <?php } ?> >นักกิจกรรมบำบัด</option>
					<option value="7" <?php if($positiontypeID=='7'){?> selected <?php } ?> >เวชศาสตร์สื่อความหมาย</option>
					<option value="8" <?php if($positiontypeID=='8'){?> selected <?php } ?> >นักวิชาการศึกษาพิเศษ</option>
					<option value="9" <?php if($positiontypeID=='9'){?> selected <?php } ?> >นักวิชาการสาธารณสุข</option>
					<option value="10" <?php if($positiontypeID=='10'){?> selected <?php } ?> >วิชาชีพอื่นๆ</option>
				  </select>
				  <?php }else{ ?>
					<select id="positiontypeID" name="positiontypeID" class="form-control select2 float-sm-right" style="width: 20%;" >
					<option value="1" >แพทย์</option>
					<option value="2" >พยาบาล</option>
					<option value="3" >เภสัชกร</option>
					<option value="4" >นักจิตวิทยา</option>
					<option value="5" >นักสังคมสงเคราะห์</option>
					<option value="6" >นักกิจกรรมบำบัด</option>
					<option value="7" >เวชศาสตร์สื่อความหมาย</option>
					<option value="8" >นักวิชาการศึกษาพิเศษ</option>
					<option value="9" >นักวิชาการสาธารณสุข</option>
					<option value="10" >วิชาชีพอื่นๆ</option>
				  </select>
					<?php } ?>

				</form>

				
              </div>
              <!-- /.card-header -->

			  

			  <script>
				const dropdown = document.getElementById('positiontypeID');
				const form = document.getElementById('myForm');
	
				dropdown.addEventListener('change', function() {
				form.submit();
				});

			</script>



			  
              <div class="card-body">
				<?php   
		if($_SESSION["TypeUser"] == "Admin"){
			$sqlpersonnel = "SELECT 
											personnel.personnelID, 
											personnel.positiontypeID,
											personnel.prename, 
											personnel.firstname, 
											personnel.lastname,  
											personnel.age,
											personnel.r1 as 'positionAllName', 
											personnel.r2 as 'fixpositionAllName', 
											hospitalnew.HOS_NAME,
											personnel.positionrole, 
											personnel.congrat, 
											personnel.training, 
											personnel.cogratyear, 
											personnel.statuscong,
											personnel.regislaw,
                                            personneltype.Ptypename,
											personnel.positiontypeID,
											personnel.Mcatt1,
											personnel.HospitalID,
											personnel.position_other,
											personnel.birthday,
											personnel.other_r1,
											personnel.other_training,
											personnel.MWac1_1,
											personnel.MWac1_2,
											personnel.MWac1_3,
											personnel.MWac1_4,
											personnel.MWac1_5,
											personnel.MWac1_6,
											personnel.MWac1_7,
											personnel.MWac1_8,
											personnel.MWac1_9,
											personnel.other2_mcatt,
											personnel.opdipd,
											personnel.ipd
										FROM 
											personnel 
                                        JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
                                        JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
										WHERE 
											1
										ORDER BY 
											personnelID DESC; ";
				$sqlpersonnel2 = $sqlpersonnel; 

		}elseif (isset($_POST["positiontypeID"])) {
				           $sqlpersonnel = "SELECT 
											personnel.personnelID, 
											personnel.positiontypeID,
											personnel.prename, 
											personnel.firstname, 
											personnel.lastname,  
											personnel.age,
											personnel.r1 as 'positionAllName', 
											personnel.r2 as 'fixpositionAllName', 
											hospitalnew.HOS_NAME,
											personnel.positionrole, 
											personnel.congrat, 
											personnel.training, 
											personnel.cogratyear, 
											personnel.statuscong,
											personnel.regislaw,
                                            personneltype.Ptypename,
											personnel.positiontypeID,
											personnel.Mcatt1,
											personnel.HospitalID,
											personnel.position_other,
											personnel.birthday,
											personnel.other_r1,
											personnel.other_training,
											personnel.MWac1_1,
											personnel.MWac1_2,
											personnel.MWac1_3,
											personnel.MWac1_4,
											personnel.MWac1_5,
											personnel.MWac1_6,
											personnel.MWac1_7,
											personnel.MWac1_8,
											personnel.MWac1_9,
											personnel.other2_mcatt,
											personnel.opdipd,
											personnel.ipd
										FROM 
											personnel 
                                        JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
                                        JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
										WHERE 
											hospitalnew.CODE5 = '$HospitalID' 
										AND setdel = '1'
										AND personnel.positiontypeID = '$positiontypeID'
										ORDER BY 
											personnelID DESC; ";
						$sqlpersonnel2 = $sqlpersonnel; 
		}else{

		    $sqlpersonnel = "SELECT 
			personnel.personnelID, 
			personnel.positiontypeID,
			personnel.prename, 
			personnel.firstname, 
			personnel.lastname,  
			personnel.age,
			personnel.r1 as 'positionAllName', 
			personnel.r2 as 'fixpositionAllName', 
			hospitalnew.HOS_NAME,
			personnel.positionrole, 
			personnel.congrat, 
			personnel.training, 
			personnel.cogratyear, 
			personnel.statuscong,
			personnel.regislaw,
			personneltype.Ptypename,
			personnel.positiontypeID,
			personnel.Mcatt1,
			personnel.HospitalID,
			personnel.position_other,
			personnel.birthday,
			personnel.other_r1,
			personnel.other_training,
			personnel.MWac1_1,
			personnel.MWac1_2,
			personnel.MWac1_3,
			personnel.MWac1_4,
			personnel.MWac1_5,
			personnel.MWac1_6,
			personnel.MWac1_7,
			personnel.MWac1_8,
			personnel.MWac1_9,
			personnel.other2_mcatt,
			personnel.opdipd,
			personnel.ipd
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
		JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
		WHERE 
			hospitalnew.CODE_PROVINCE  = '$codeprovince'";
		 if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){
			$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_DISTRICT = '$CODE_DISTRICT'";
		 }
		 $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE5 = '$HospitalID'";
		 $sqlpersonnel = $sqlpersonnel."AND setdel = '1' ORDER BY personnelID DESC; ";

		 $sqlpersonnel2 = $sqlpersonnel; 

		}
		//echo $sqlpersonnel2;
					//echo $sqlpersonnel = "SELECT * FROM personnel JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID WHERE hospitalnew.CODE5 = '$HospitalID' ";

				
		
				$objpersonnel2 = mysqli_query($con, $sqlpersonnel2);
				$j = 1;
				//echo $PersonnelType; 
	
				/*if($PersonnelType == 1){*/?>
				 <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
					  <!--<th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  <th width="10%">วิชาชีพ</th>
					  <th width="10%">ปฏิบัติงานวิกฤตสุขภาพจิต (MCATT)</th>
					  <th width="10%">age</th>
					  <th width="15%">positionAllName</th>
					  <th width="15%">fixpositionAllName</th>
					  <th width="10%">HOS_NAME</th>
					  <th width="15%">positionrole</th>
					  <th width="15%">congrat</th>
					  <th width="10%">training</th>
					  <th width="15%">cogratyear</th>
					  <th width="15%">statuscong</th>
					  <th width="15%">regislaw</th>
					  <th width="15%">positiontypeID</th>
					  <th width="15%">HospitalID</th>
					  <th width="15%">position_other</th>
					  <th width="15%">birthday</th>
					  <th width="15%">other_r1</th>
					  <th width="15%">other_training</th>
					  <th width="15%">MWac1_1</th>
					  <th width="15%">MWac1_2</th>
					  <th width="15%">MWac1_3</th>
					  <th width="15%">MWac1_4</th>
					  <th width="15%">MWac1_5</th>
					  <th width="15%">MWac1_6</th>
					  <th width="15%">MWac1_7</th>
					  <th width="15%">MWac1_8</th>
					  <th width="15%">MWac1_9</th>
					  <th width="15%">other2_mcatt</th>-->
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  <th width="10%">วิชาชีพ</th>
					  <th width="10%">ปฏิบัติงานวิกฤตสุขภาพจิต (MCATT)</th>
					  <th width="10%">อายุ</th>
					  <th width="15%">แพททย์จิตเวช</th>
					  <th width="15%">การปฏิบัติงาน</th>
					  <th width="10%">ชื่อโรงพยาบาล</th>
					  <th width="15%">วิชาชีพ</th>
					  <th width="15%">ปริญญา</th>
					  <th width="10%">จบหลักสูตร</th>
					  <th width="15%">ปีที่จบ</th>
					  <th width="15%">ศึกษา</th>
					  <th width="15%">อื่นๆ</th>
					  <th width="15%">รหัสวิชาชีพ</th>
					  <th width="15%">รหัสสถานพยาบาล</th>
					  <th width="15%">ตำแหน่งอื่น</th>
					  <th width="15%">วันเกิด</th>
					  <th width="15%">อื่นๆ</th>
					  <th width="15%">ระบุ</th>
					  <th width="15%">หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)</th>
					  <th width="15%">Psychotraumatology & Stabilization Techniques</th>
					  <th width="15%">การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)</th>
					  <th width="15%">การเจรจาต่อรองในภาวะวิกฤต</th>
					  <th width="15%">ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)</th>
					  <th width="15%">หลักสูตร ICS100</th>
					  <th width="15%">หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand</th>
					  <th width="15%">อื่น ๆ</th>
					  <th width="15%">การอบรมMcatt</th>
					  <th width="15%">ระบุ</th>
					  <th width="15%">OPDIPD</th>
					  <th width="15%">IPD</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel2 = mysqli_fetch_array($objpersonnel2))
						{ 
						?>
						<tr>
							<td><?php echo $j++; ?></td>
							<td>
								<?php 
								echo $rowpersonnel2['prename'].$rowpersonnel2['firstname']." ".$rowpersonnel2['lastname'];
								?>
							</td>
						
						 	<td><?php echo $rowpersonnel2['Ptypename']; ?></td>
							<td><?php echo $rowpersonnel2['Mcatt1']; ?></td>
							<td><?php echo $rowpersonnel2['age']; ?></td>
							<td><?php echo $rowpersonnel2['positionAllName']; ?></td>
							<td><?php echo $rowpersonnel2['fixpositionAllName']; ?></td>
							<td><?php echo $rowpersonnel2['HOS_NAME']; ?></td>
							<td><?php echo $rowpersonnel2['positionrole']; ?></td>
							<td><?php echo $rowpersonnel2['congrat']; ?></td>
							<td><?php echo $rowpersonnel2['training']; ?></td>
							<td><?php echo $rowpersonnel2['cogratyear']; ?></td>
							<td><?php echo $rowpersonnel2['statuscong']; ?></td>
							<td><?php echo $rowpersonnel2['regislaw']; ?></td>
							<td><?php echo $rowpersonnel2['positiontypeID']; ?></td>
							<td><?php echo $rowpersonnel2['HospitalID']; ?></td>
							<td><?php echo $rowpersonnel2['position_other']; ?></td>
							<td><?php echo $rowpersonnel2['birthday']; ?></td>
							<td><?php echo $rowpersonnel2['other_r1']; ?></td>
							<td><?php echo $rowpersonnel2['other_training']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_1']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_2']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_3']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_4']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_5']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_6']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_7']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_8']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_9']; ?></td>
							<td><?php echo $rowpersonnel2['other2_mcatt']; ?></td>
							<td><?php echo $rowpersonnel2['opdipd']; ?></td>
							<td><?php echo $rowpersonnel2['ipd']; ?></td>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>



<?php
				  $objpersonnel = mysqli_query($con, $sqlpersonnel);
				  $i = 1;
?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  <!--<th width="10%">ตำแหน่ง</th>-->
					  <th width="10%">วิชาชีพ</th>
					  <th width="10%">ปฏิบัติงานวิกฤตสุขภาพจิต (MCATT)</th>
					  <th width="15%">ข้อมูลบุคลากร</th>
					  <?php /*<th width="5%">ปีที่คาดว่าจะจบ</th>
					  <th width="15%">หน่วยงาน</th> */?>
					  <!--
					  <th width="5%">						  
						  <center>แก้ไข</center></th>-->
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <!--<th width="5%"><center>ลบข้อมูล</center></th>-->
					  <th width="5%"></th>
					  <?php }else{?>
					  <th width="15%">แก้ไขข้อมูล</th>
					  <?php } ?>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))
						{ 
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<?php 
								echo $rowpersonnel['prename'].$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];
								?>
							</td>
							<!-- 
							<td>
								<?php /*/echo $rowpersonnel['positionrole'];
								$TypeForm = $rowpersonnel['positiontypeID'] ;
								if($TypeForm == 1){echo 'แพทย์เฉพาะทาง';}
								elseif($TypeForm == 2){echo 'พยาบาลเฉพาะทาง';}
								elseif($TypeForm == 3){echo 'เภสัชกร';}
								elseif($TypeForm == 4){echo $rowpersonnel['positionrole'];}
								elseif($TypeForm == 5){echo 'นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต';} 
								elseif($TypeForm == 6){echo 'นักกิจกรรมบำบัด';}
								*/?>
							</td>-->
						 	<td><?php echo $rowpersonnel['Ptypename']; ?></td>
							<td><?php echo $rowpersonnel['Mcatt1']; ?></td>

							
							<td>
							<center>
							<?php if($rowpersonnel['positiontypeID']== '1'){?>
							<a class="btn btn-info btn-sm" href="forms_m1_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '2'){ ?>
								<a class="btn btn-info btn-sm" href="forms_m2_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '3'){ ?>
								<a class="btn btn-info btn-sm" href="forms_m3_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>	  
							<?php }elseif($rowpersonnel['positiontypeID']== '4'){ ?>
								<a class="btn btn-info btn-sm" href="forms_m4_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>	  
							<?php }elseif($rowpersonnel['positiontypeID']== '5'){ ?>
								<a class="btn btn-info btn-sm" href="forms_m5_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>	
							<?php }else{ ?>
								<a class="btn btn-info btn-sm" href="forms_m6_view.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> รายละเอียดข้อมูล
								  </a>	  	  

							<?php } ?>
								  </center>
					
							</td>
							<?php /*
							<td><?php echo $rowpersonnel['cogratyear'];  ?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td> */ ?>
					        <td>
							<?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
							<?php if($rowpersonnel['positiontypeID']== '1'){?>
								<a class="btn btn-info btn-sm " href="forms_m1_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '2'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '3'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>  
							<?php }elseif($rowpersonnel['positiontypeID']== '4'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>  
							<?php }elseif($rowpersonnel['positiontypeID']== '5'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }else{ ?>
								<a class="btn btn-info btn-sm " href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>	  	  

							<?php } ?>
							
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								<?php if($rowpersonnel['positiontypeID']== '1'){?>
								<a class="btn btn-info btn-sm " href="forms_m1_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '2'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }elseif($rowpersonnel['positiontypeID']== '3'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>  
							<?php }elseif($rowpersonnel['positiontypeID']== '4'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>  
							<?php }elseif($rowpersonnel['positiontypeID']== '5'){ ?>
								<a class="btn btn-info btn-sm " href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
							<?php }else{ ?>
								<a class="btn btn-info btn-sm " href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>
								  	  	  

							<?php } ?>
							</center>
							<?php }?>
							<?php /* if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&type=<?php echo $rowpersonnel['positiontypeID'];?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>
							</center>
							</td>
							<?php } */?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				<?php /*} 
				elseif($PersonnelType == 2){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  
					  <th width="8%">วุฒิการศึกษา</th>
					  <th width="15%">การอบรมเฉพาะทาง</th>
					  <th width="15%">กำลังศึกษา</th>
					  <th width="5%">ปีที่คาดว่าจะจบ</th>
					  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))
						{ 
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<?php 
								echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];
								?>
							</td>
							 
							
							<td><?php 
								//-----CONGRAT
								if($rowpersonnel['congrat'] != ''){ 
									echo $CongratCer = $rowpersonnel['congrat']; 
								}else{ 
									echo $CongratCer = '-';
								}
								?>
							</td>
							<td>
								<?php
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training_);
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2].'<br>';}
								if($Training[3] !=''){echo '- '.$Training[3].'<br>';}
								?>
							</td>
							<td>
								<?php
								//-----LEARNING?
								$Learning 	= explode(",", $rowpersonnel['statuscong']);
								if($Learning[0] !=''){echo '- '.$Learning[0].'<br>';}
								if($Learning[1] !=''){echo '- '.$Learning[1].'<br>';}
								if($Learning[2] !=''){echo '- '.$Learning[2].'<br>';}
								if($Learning[3] !=''){echo '- '.$Learning[3].'<br>';}
								if($Learning[4] !=''){echo '- '.$Learning[4].'<br>';}
								?>
							</td>
							<td><?php echo $rowpersonnel['cogratyear'];  ?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				<?php } 
				elseif($PersonnelType == 3){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  
					  <th width="10%">การอบรมเฉพาะทาง</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							<td><?php 
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training);
							/*
							
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2];}
							*//*
								if($Training[2] !=''){
									echo $Training[2];
								}else{
									if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
									if($Training[1] !=''){echo '- '.$Training[1];}
								}
								
								
								?>
							</td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				<?php } 
				elseif($PersonnelType == 4){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  <th width="15%">ตำแหน่ง</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td>
								<?php echo $rowpersonnel['positionrole'];/*
								$TypeForm = $rowpersonnel['positiontypeID'] ;
								if($TypeForm == 1){echo 'แพทย์เฉพาะทาง';}
								elseif($TypeForm == 2){echo 'พยาบาลเฉพาะทาง';}
								elseif($TypeForm == 3){echo 'เภสัชกร';}
								elseif($TypeForm == 4){echo $rowpersonnel['positionrole'];}
								elseif($TypeForm == 5){echo 'นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต';} 
								elseif($TypeForm == 6){echo 'นักกิจกรรมบำบัด';}*/
								/*?>
							</td>
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 5){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  <!--<th width="12%">ตำแหน่ง</th>-->
					  <th width="10%">การอบรมเฉพาะทาง</th>
					  <th width="10%">ขึ้นทะเบียนนักสังคมสงเคราะห์</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<!--<td>
								<?php /*echo $rowpersonnel['positionrole'];/*
								$TypeForm = $rowpersonnel['positiontypeID'] ;
								if($TypeForm == 1){echo 'แพทย์เฉพาะทาง';}
								elseif($TypeForm == 2){echo 'พยาบาลเฉพาะทาง';}
								elseif($TypeForm == 3){echo 'เภสัชกร';}
								elseif($TypeForm == 4){echo $rowpersonnel['positionrole'];}
								elseif($TypeForm == 5){echo 'นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต';} 
								elseif($TypeForm == 6){echo 'นักกิจกรรมบำบัด';}*/
								/*?>
							</td>-->
							<td><?php 
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training_);
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2].'<br>';}
								if($Training[3] !=''){echo '- '.$Training[3].'<br>';}
								?>
							</td>
							<td><?php 
								if($rowpersonnel['regislaw'] <> ''){
									echo '<i class="fa fa-check" style="color: green"></i>';
								}
								?> 
							</td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 6){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 7){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 8){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php }  
				  elseif($PersonnelType == 9){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="10%"><center>จังหวัด</center></th>
					  <?php } ?>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php echo $rowpersonnel['CODE_PROVINCE'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php } 
				  elseif($PersonnelType == 10){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
				      <th width="10%"><center>ตำแหน่ง</center></th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="10%"><center>จังหวัด</center></th>					  
					  <?php } ?>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php echo $rowpersonnel['position_other'];?></td>
							<td><?php echo $rowpersonnel['CODE_PROVINCE'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php } */?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
	$("#example3").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,
	  "searching": false, "lengthChange": false, "info": false,
	  "paging": false,
      "buttons": ["copy", "csv", "excel", { 
      extend: 'print',
      text: 'PDF'
   },
    //"print"
	]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
