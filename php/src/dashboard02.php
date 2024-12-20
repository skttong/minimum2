<?PHP
session_start();

include('connect/conn.php');
/*
$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

$SQL_H = "";
//ทั้งหมด
if($_POST['CODE_HMOO']<>'ทั้งหมด'){
	if (isset($_POST['CODE_HMOO']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_HMOO = '".$_POST['CODE_HMOO']."'";

	}
}
if(trim($_POST['TYPE_SERVICE'])<>'ทั้งหมด'){
	if (isset($_POST['TYPE_SERVICE']))
	{
		$SQL_H = $SQL_H." and hosn.TYPE_SERVICE = '".$_POST['CODE_HMOO']."'";

	}
}
if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){
if (isset($_POST['CODE_PROVINCE']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_PROVINCE = '".$_POST['CODE_HMOO']."'";
	}
}
*/



 $sql1 = "SELECT DISTINCT 
			(
			 SELECT  COUNT(pc.Countries)
			from 
				(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.r1, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.r1, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.r1, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1') pc
			JOIN personnel a on a.personnelID = pc.personnelID
			JOIN hospitalnew c on c.CODE5 = pc.HospitalID
			WHERE
				pc.Countries = 'จิตแพทย์ทั่วไป'
			) AS 'dr01',
			(
			 SELECT COUNT(pc.Countries)
			from 
				(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.r1, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.r1, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.r1, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1') pc
			JOIN personnel a on a.personnelID = pc.personnelID
			JOIN hospitalnew c on c.CODE5 = pc.HospitalID
			WHERE
				pc.Countries = 'จิตแพทย์เด็กและวัยรุ่น'
			) AS 'dr02',
			(
			 SELECT COUNT(pc.Countries)
			from 
				(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.r1, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.r1, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.r1, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1') pc
			JOIN personnel a on a.personnelID = pc.personnelID
			JOIN hospitalnew c on c.CODE5 = pc.HospitalID
			WHERE
				pc.Countries = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)'
			) AS 'dr03',
			(
			 SELECT COUNT(pc.Countries)
			from 
				(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.r1, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.r1, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1'
				UNION ALL
				SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.r1, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '1' AND b.setdel = '1') pc
			JOIN personnel a on a.personnelID = pc.personnelID
			JOIN hospitalnew c on c.CODE5 = pc.HospitalID
			WHERE
				pc.Countries = 'แพทย์สาขาอื่น'

			) AS 'dr04'
			FROM
			  hospitalnew hosn;";
$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$dr01 =  $row1['dr01'];
$dr02 =  $row1['dr02'];
$dr03 =  $row1['dr03'];
$dr04 =  $row1['dr04'];


$sql2 = "SELECT DISTINCT  
		(
		 SELECT COUNT(pc.Countries)
		from 

			(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.training, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.training, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1') pc
		JOIN personnel a on a.personnelID = pc.personnelID
		JOIN hospitalnew c on c.CODE5 = pc.HospitalID
		WHERE
			pc.Countries = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)' 

		) AS 'nu01' ,
		(
		 SELECT COUNT(pc.Countries)
		from 
			(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.training, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.training, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1') pc
		JOIN personnel a on a.personnelID = pc.personnelID
		JOIN hospitalnew c on c.CODE5 = pc.HospitalID
		WHERE
			pc.Countries = 'การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น' 
		) AS 'nu02' ,
		(
		 SELECT COUNT(pc.Countries)
		from 
			(SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, SUBSTRING_INDEX(b.training, ',', 1) AS Countries from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, '.', 2),',','-1') AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1'
			UNION ALL
			SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE,b.personnelID, SUBSTRING_INDEX(b.training, ',', -1) AS Countries  from personnel b JOIN hospitalnew e on e.CODE5 = b.HospitalID WHERE b.positiontypeID = '2' AND b.setdel = '1') pc
		JOIN personnel a on a.personnelID = pc.personnelID
		JOIN hospitalnew c on c.CODE5 = pc.HospitalID
		WHERE
			pc.Countries = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด' 
		) AS 'nu03'
		FROM
		  hospitalnew hosn;
		";
$obj2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($obj2);



$sql3 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '3'
		AND 
			setdel = '1' ;";
$obj3 = mysqli_query($con, $sql3);
//$row3 = mysqli_fetch_array($obj3);

$sql4_1 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			personnel.positiontypeID	= '4'
		AND 
			setdel = '1' 
        AND personnel.positionrole = 'นักจิตวิทยา';";
$obj4_1 = mysqli_query($con, $sql4_1);
//$row4_1 = mysqli_fetch_array($obj4_1);

$sql4_2 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			personnel.positiontypeID	= '4'
		AND 
			setdel = '1' 
        AND personnel.positionrole = 'นักจิตวิทยาคลินิก';";
$obj4_2 = mysqli_query($con, $sql4_2);
//$row4_2 = mysqli_fetch_array($obj4_2);

$sql5 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '5'
		AND 
			setdel = '1' ;";
$obj5 = mysqli_query($con, $sql5);
//$row5 = mysqli_fetch_array($obj5);

$sql6 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '6'
		AND 
			setdel = '1' ;";
$obj6 = mysqli_query($con, $sql6);
//$row6 = mysqli_fetch_array($obj6);

$sql7 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '7'
		AND 
			setdel = '1' ;";
$obj7 = mysqli_query($con, $sql7);
//$row7 = mysqli_fetch_array($obj7);

$sql8 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '8'
		AND 
			setdel = '1' ;";
$obj8 = mysqli_query($con, $sql8);
//$row8 = mysqli_fetch_array($obj8);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  	
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>	
	

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
	
	  .divinfo{
		 /* background-color: #e7f3fe;*/
		  border-left: 3px solid #68AADF;
	  }
	  .top-right {
		  position: absolute;
		  top: 8px;
		  right: 16px;
	  }
	  .callout2
	  {
		  margin: 0 0 0 0 ;
		  padding: 15px 30px 7px 15px;
	  }
  </style>	
</head>
<body class="hold-transition sidebar-mini bodychange">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar2.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu2.php" ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Dashboard</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Blank Page</li>-->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		  
		<!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
			<form class="form-valide" action="tables_4.php" method="post" id="myform1" name="foml">  
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="personnelDate" style="width: 100%;">
                    <option selected="selected" value="2566" >2566</option>
                    <option value="2565">2565</option>
                    <option value="2564">2564</option>
                    <option value="2563">2563</option>
                    <option value="2562">2562</option>
                    <option value="2561">2561</option>
                    <option value="2560">2560</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
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
			   	
			  <div class="col-md-2">
               <div class="form-group">
                  <label> ประเภทบุคลากร</label>
                  <select name="position" class="form-control select2" id="position" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<option value="แพทย์" >แพทย์</option>
					<option value="พยาบาล" >พยาบาล</option>
					<option value="เภสัชกร" >เภสัชกร</option>
					<option value="นักจิตวิทยา" >นักจิตวิทยา</option>
					<option value="นักสังคมสงเคราะห์" >นักสังคมสงเคราะห์</option>
					<option value="นักกิจกรรมบำบัด" >นักกิจกรรมบำบัด</option>
					<option value="เวชศาสตร์สื่อความหมาย" >เวชศาสตร์สื่อความหมาย</option>
					<option value="นักวิชาการศึกษาพิเศษ" >นักวิชาการศึกษาพิเศษ</option>
					<option value="นักวิชาการสาธารณสุข" >นักวิชาการสาธารณสุข</option>
					<option value="วิชาชีพอื่นๆ" >วิชาชีพอื่นๆ</option>

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
        <div class="row">
          <div class="col-12">
            
            <div class="card">
       
         
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
<?php /*
    <!-- Main content -->
    <section class="content">
    
    <!-- Default box -->
    <div class="row">
		<div class="col-md-6">
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>จิตแพทย์ผู้ใหญ่</p>
					<h3><?php echo '5';?> คน</h3>
                    <p>xx : 1แสน ประชากร</p>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>จิตแพทย์เด็กและวัยรุ่น</p>
					<h3><?php echo '9';?> คน</h3>
                    <p>xx : 1แสน ประชากร</p>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
			</div>

		
      
        
        
		<div class="col-md-6">
		  <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #B5F7F8; color: black;">
                <div class="inner">
                    
                    <p>เตียงจิตเวช</p>
					<h3><?php echo '9';?> เตียง</h3>
                    <p>xx : 1แสน ประชากร</p>
					
				  </div>
				  <!--<div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #B5F7F8; color: black;">
                <div class="inner">
                    
                    <p>อัตราการครองเตียง</p>
					<h3><?php echo '9';?> เตียง</h3>
                    <p> <small>&nbsp;</small></p>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				 <!-- <div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
			</div>
		</div>
	  </div>
      <!-- /.card -->
		
	  <!-- Default box -->
      <div class="row">
		
		<div class="col-md-8">
			<!--<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูล Ward จิตแพทย์และยาเสพติด</h3>
				</div>

				<div class="card-body">
					<div id="container"></div>
					
				</div>

			</div>-->
		</div>
		<div class="col-md-6">
			<!--<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลจำนวนเตียงและเครื่องมือแพทย์</h3>
				</div>

				<div class="card-body" align="center">
					
					<div style="width: 400px;">
					<canvas id="myChart9"></canvas>
					</div>
				</div>

			</div>-->
		
	  </div>
      <!-- /.card -->
		  
		  
	  
	</div>
*/?>
    

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">แพทย์</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
		
					<script>
        const ctx = document.getElementById('myChart3');
        
        
        const downloadButton = document.getElementById('download-button');

        const myChart3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['จิตแพทย์ผู้ใหญ่', 'จิตแพทย์เด็กและวัยรุ่น', 'เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน', 'อื่นๆ'],
                datasets: [{
                    label: 'ปฏิบัติงาน',
                    data: [<?php echo $dr01.','.$dr02.','.$dr03.','.$dr04;?>],
                    backgroundColor: '#6CE5E8',
                    borderColor: '#6CE5E8',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'กำลังศึกษาต่อเฉพาะทาง',
                    data: [10, 20, 30, 20],
                    backgroundColor: '#41B8D5',
                    borderColor: '#41B8D5',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        stacked: true, // Enable stacking for the y-axis
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

downloadButton.addEventListener('click', function() {
    const chartData = myChart3.toBase64Image(); // Get chart image data
    const link = document.createElement('a');
    link.href = chartData;
    link.download = 'stacked-barchart.png'; // Set download filename
    link.click();
});
    </script>
					
				</div>
				

			</div>

		  
		
		</div>
		
		<div class="col-md-6">


		<div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9ECFF; color: black;">
                <div class="inner">
                    
				<p>จิตแพทย์ผู้ใหญ่</p> 
					<h3><?php echo $dr01;?>คน</h3>
                    <p>xx : 1แสน ประชากร</p>
					
				  </div>
				  <!--<div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #D9D9D9; color: black;">
                <div class="inner">
                    
                    
					<p>จิตแพทย์เด็กและวัยรุ่น</p>
					<h3><?php echo $dr02;?> คน</h3>
                    <p>xx : 1แสน ประชากร</p>
					
				  </div>
				 <!-- <div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-12">
			  <div class="card">
				<!--<div class="card-header">
					<h3 class="card-title">ผู้ป่วยในจิตเวช</h3>
				</div>-->
				<div class="col-md-4" >
                <div class="form-group">
                  <!--<label> ประเภทบุคลากร</label>-->
				  <br>
                  <select name="position2" class="form-control select2" id="position2" style="width: 100%;">
                    <option selected="selected" value="จิตแพทย์ผู้ใหญ่" >จิตแพทย์ผู้ใหญ่</option>
					<option value="จิตแพทย์เด็กและวัยรุ่น" >จิตแพทย์เด็กและวัยรุ่น</option>
                  </select>
                </div>
              </div>
				<div class="card-body">
					<div id="container"></div>
					
				</div>

			</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
			</div>
			


		<?php /* <div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ข้อมูลพยาบาล</h3>
				</div>

				<div class="card-body">
					<!--<canvas id="myChart4"></canvas>-->
					<a href="tables-1.php?t=2"><canvas id="myChart4" style="min-height: 100%; height: 380px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx4 = document.getElementById('myChart4');

						  new Chart(ctx4, {
							  type: 'bar',
						  data: {
							labels: [""], //ชื่อแกน X
							datasets: [{
							  label: "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#FC8585',
							  borderColor: 	'#FC8585',
							  borderWidth: 1,
							  barThickness: 30,		
							  data: [<?php echo $row2['nu01'];?>],
							},{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#bd6f58',
							  borderColor: 	'#bd6f58',
							  borderWidth: 1,
							  barThickness: 30,		
							  data: [<?php echo "20";?>],
								
							}, {
							  label: "การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#FFC86D',
							  borderColor: 	'#FFC86D',
							  borderWidth: 1,
							  barThickness: 30,		
							  data: [<?php echo $row2['nu02'];?>],
							},
							{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#b158bd',
							  borderColor: 	'#b158bd',
							  borderWidth: 1,
							  barThickness: 30,		
							  data: [<?php echo "16";?>],
							
							}, {
							  label: "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#85CBD9',
							  borderColor: 	'#85CBD9',
							  borderWidth: 1,
							  barThickness: 30,		
							   data: [<?php echo $row2['nu03'];?>],
							},{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#58bd8d',
							  borderColor: 	'#58bd8d',
							  borderWidth: 1,	
							  barThickness: 30,	
							  data: [<?php echo "7";?>],
							}]
						  },
						  options: {
							 plugins: {
							  legend: {
								position: 'top',
								labels: {
									 usePointStyle: true  //<-- set this
								  }  
							  },
							  tooltip: {
								callbacks: {
								  title: () => undefined
								}
							  }
							},     
							scales: {
							  xAxes: [{
								//stacked: true,
								stacked: true,
								ticks: {
								  beginAtZero: true,
								  maxRotation: 0,
								  minRotation: 0
								}
							  }],
							  yAxes: [{
								stacked: true,
							  }]
							},
						  }
						  });
									
					</script>
				</div>

			</div>
		</div> */ ?>
	  </div>
      <!-- /.card -->	
						</div>
						</div>


						<script>
		 

		 const ctx9 = document.getElementById('myChart9');
	   
		 new Chart(ctx9, {
		   type: 'doughnut',
		   data: {
			 labels: [ 'Psychiatric Ward', 'Psychiatric Unit', 'Integrated Bed'],
			 datasets: [{
			   label: 'จำนวน',
			   backgroundColor: [
				 '#056934',
				 '#fbe036',
				 '#cd0808'
			   ],
			   data: [<?php echo "22, 15, 5" ;?>],
			   borderWidth: 1
			 }]
		   },
		   options: {
			 cutoutPercentage: 95,
			 legend: {
			   display: false
			 },
			 tooltip: {
			   enabled: false
			 }	
		   }
		 });
		   
		
		   
		
	   </script>
	   <script>
		   
	   (async () => {
	   
		   const topology = await fetch(
			   'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
		   ).then(response => response.json());
	   
		   // Prepare demo data. The data is joined to map using value of 'hc-key'
		   // property by default. See API docs for 'joinBy' for more info on linking
		   // data and map.
		   const data = [
			   ['th-ct', 10], ['th-4255', 11], ['th-pg', 12], ['th-st', 13],
			   ['th-kr', 14], ['th-sa', 15], ['th-tg', 16], ['th-tt', 17],
			   ['th-pl', 18], ['th-ps', 19], ['th-kp', 20], ['th-pc', 21],
			   ['th-sh', 22], ['th-at', 23], ['th-lb', 24], ['th-pa', 25],
			   ['th-np', 26], ['th-sb', 27], ['th-cn', 28], ['th-bm', 29],
			   ['th-pt', 30], ['th-no', 31], ['th-sp', 32], ['th-ss', 33],
			   ['th-sm', 34], ['th-pe', 35], ['th-cc', 36], ['th-nn', 37],
			   ['th-cb', 38], ['th-br', 39], ['th-kk', 40], ['th-ph', 41],
			   ['th-kl', 42], ['th-sr', 43], ['th-nr', 44], ['th-si', 45],
			   ['th-re', 46], ['th-le', 47], ['th-nk', 48], ['th-ac', 49],
			   ['th-md', 50], ['th-sn', 51], ['th-nw', 52], ['th-pi', 53],
			   ['th-rn', 54], ['th-nt', 55], ['th-sg', 56], ['th-pr', 57],
			   ['th-py', 58], ['th-so', 59], ['th-ud', 60], ['th-kn', 61],
			   ['th-tk', 62], ['th-ut', 63], ['th-ns', 64], ['th-pk', 65],
			   ['th-ur', 66], ['th-sk', 67], ['th-ry', 68], ['th-cy', 69],
			   ['th-su', 70], ['th-nf', 71], ['th-bk', 72], ['th-mh', 73],
			   ['th-pu', 74], ['th-cp', 75], ['th-yl', 76], ['th-cr', 77],
			   ['th-cm', 78], ['th-ln', 79], ['th-na', 80], ['th-lg', 81],
			   ['th-pb', 82], ['th-rt', 83], ['th-ys', 84], ['th-ms', 85],
			   ['th-un', 86], ['th-nb', 87]
		   ];
	   
		   // Create the chart
		   Highcharts.mapChart('container', {
			
			   chart: {
				   map: topology
			   },
	   
			   
			   title: {
				   text: ' '
			   },
	   
			   /*
			   subtitle: {
				   text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/th/th-all.topo.json">Thailand</a>'
			   },
			   /*
			   mapNavigation: {
				   enabled: true,
				   buttonOptions: {
					   verticalAlign: 'bottom'
				   }
			   },
			   */ 
			   colorAxis: {
				min: 1,
            type: 'logarithmic',
            minColor: '#cd0808',
            maxColor: '#056934',
            stops: [
                [0, '#cd0808'],
                [0.67, '#fbe036'],
                [1, '#056934']
            ]
			   },
			   
	   
			   series: [{
				   data: data,
				   /*
				   name: 'Random data',
				   
				   states: {
					   hover: {
						   color: '#BADA55'
					   }
				   },
				   */ 
				   dataLabels: {
					   enabled: true,
					   format: '{point.name}'
				   }
				   
			   }]
		   });
	   
	   })();
	   
	   
	   </script>
 

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
