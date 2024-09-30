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
if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){
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
( SELECT count(*)
FROM  personnel p
WHERE  r1 = 'จิตแพทย์ทั่วไป' )AS 'dr01',
( SELECT count(*)
FROM  personnel p
WHERE  r1 = 'จิตแพทย์เด็กและวัยรุ่น' )AS 'dr02',
( SELECT count(*)
FROM  personnel p
WHERE  r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)')AS 'dr03',
( SELECT count(*)
FROM  personnel p
WHERE  r1 = 'แพทย์สาขาอื่น' )AS 'dr04'
FROM hospitalnew h;

";
$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$dr01 =  $row1['dr01'];
$dr02 =  $row1['dr02'];
$dr03 =  $row1['dr03'];
$dr04 =  $row1['dr04'];

$tsql1 = "SELECT DISTINCT
( SELECT count(*)
FROM  personnel p
WHERE  p.r1 = 'กำลังศึกษา'
AND p.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป')AS 'tdr01',
( SELECT count(*)
FROM  personnel p
WHERE  p.r1 = 'กำลังศึกษา'
AND p.training = 'จิตแพทย์เด็กและวัยรุ่น' )AS 'tdr02',
( SELECT count(*)
FROM  personnel p
WHERE  p.r1 = 'กำลังศึกษา'
AND p.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)')AS 'tdr03',
( SELECT count(*)
FROM  personnel p
WHERE  p.r1 = 'กำลังศึกษา'
AND p.training = 'อื่น ๆ')AS 'tdr04'
FROM hospitalnew h;

";
$tobj1 = mysqli_query($con, $tsql1);
$trow1 = mysqli_fetch_array($tobj1);

$tdr01 =  $trow1['tdr01'];
$tdr02 =  $trow1['tdr02'];
$tdr03 =  $trow1['tdr03'];
$tdr04 =  $trow1['tdr04'];

 $sql2 = "WITH trained_personnel AS (
  SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries1,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries2,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries3,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries4,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries5,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries6,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries7
  FROM personnel b
  JOIN hospitalnew e ON e.CODE5 = b.HospitalID
  WHERE b.positiontypeID = '2' AND b.setdel = '1'
)
SELECT DISTINCT
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries1 = 'ยังไม่ผ่านการอบรมเฉพาะทาง'
  ) AS 'nu01',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries2 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'
  ) AS 'nu02',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries3 = 'การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ'
  ) AS 'nu03',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries4 = 'การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น'
  ) AS 'nu04',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries5 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด'
  ) AS 'nu05',
   (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries6 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน'
  ) AS 'nu06',
   (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries7 = 'อื่น ๆ'
  ) AS 'nu07'
FROM hospitalnew hosn;

		";
$obj2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($obj2);

$nu01 =  $row2['nu01'];
$nu02 =  $row2['nu02'];
$nu03 =  $row2['nu03'];
$nu04 =  $row2['nu04'];
$nu05 =  $row2['nu05'];
$nu06 =  $row2['nu06'];
$nu07 =  $row2['nu07'];


$tsql2 = "WITH trained_personnel AS (
  SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries1,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries2,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries3,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries4,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries5,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries6,
         SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries7
  FROM personnel b
  JOIN hospitalnew e ON e.CODE5 = b.HospitalID
  WHERE b.positiontypeID = '2' AND b.setdel = '1'
)
SELECT DISTINCT
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries1 = 'ไม่ได้กำลังศึกษา'
  ) AS 'tnu01',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries2 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'
  ) AS 'tnu02',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries3 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้สูงอายุ)'
  ) AS 'tnu03',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries4 = 'การพยาบาลเฉพาะทางสุขภาพจิตและจิตเวชเด็กและวัยรุ่น'
  ) AS 'tnu04',
  (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries5 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด'
  ) AS 'tnu05',
   (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries6 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน'
  ) AS 'tnu06',
   (
    SELECT COUNT(*)
    FROM trained_personnel tp
    WHERE tp.Countries7 = 'อื่น ๆ'
  ) AS 'tnu07'
FROM hospitalnew hosn;

  
		  ";
  $tobj2 = mysqli_query($con, $tsql2);
  $trow2 = mysqli_fetch_array($tobj2);
  
  $tnu01 =  $trow2['tnu01'];
  $tnu02 =  $trow2['tnu02'];
  $tnu03 =  $trow2['tnu03'];
  $tnu04 =  $trow2['tnu04'];
  $tnu05 =  $trow2['tnu05'];
  $tnu06 =  $trow2['tnu06'];
  $tnu07 =  $trow2['tnu07'];



$sql3 = "SELECT COUNT(*) AS 'total' 
FROM personnel p
JOIN hospitalnew h ON h.CODE5 = p.HospitalID 
WHERE p.positiontypeID = '3' AND p.setdel = '1' ;";
$obj3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($obj3);

$SC =  $row3['total'];

$sql4 = "SELECT
    hospitalnew.CODE_HMOO,
    hospitalnew.CODE_PROVINCE,
    SUM(CASE WHEN personnel.positionrole = 'นักจิตวิทยา' THEN 1 ELSE 0 END) AS TC01,
    SUM(CASE WHEN personnel.positionrole = 'นักจิตวิทยาคลินิก' THEN 1 ELSE 0 END) AS TC02
FROM
    personnel
JOIN hospitalnew ON hospitalnew.CODE5 = personnel.HospitalID
WHERE
    personnel.positiontypeID = '4'
    AND setdel = '1'
GROUP BY
    hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE;
;";
$obj4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_array($obj4);

//$TC01 =  $row4['TC01'];
//$TC02 =  $row4['TC02'];


if($row4['TC01'] == ''){
	$TC01 =  0;
}else{
	$TC01 =  $row4['TC01'];
}
if($row4['TC02'] == ''){
	$TC02 =  0;
}else{
	$TC02 =  $row4['TC02'];
}


$TCtotal =  $TC01 + $TC02;


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
			positiontypeID  = '5'
		AND 
			setdel = '1' 
		GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";
$obj5 = mysqli_query($con, $sql5);
$row5 = mysqli_fetch_array($obj5);

$TOC =  $row5['total'];


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
			setdel = '1' 
		GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";
$obj6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_array($obj6);

$TOC2 =  $row6['total'];

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
			setdel = '1' 
		GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";
$obj7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_array($obj7);

$TOC3 =  $row6['total'];

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
			setdel = '1' 
		GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$obj8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_array($obj8);

$TOC4 =  $row8['total'];

$sql9 = "SELECT  
			SUM(b.Ward_no) AS Ward_no  , 
			SUM(b.Unit) AS Unit ,
			SUM(b.Unit_no) AS Unit_no
		FROM bed b  ;";
$obj9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_array($obj9);

$Ward_no = $row9['Ward_no'];
$Unit = $row9['Unit'];
$Unit_no = $row9['Unit_no'];

$sql10 = "SELECT SUM(ect_no) AS ect_no ,SUM(tms_no) AS tms_no
		FROM ect ;";
$obj10 = mysqli_query($con, $sql10);
$row10 = mysqli_fetch_array($obj10);

$ect_no = $row10['ect_no'];
$tms_no = $row10['tms_no'];


$sqlmid = "SELECT
    CODE_PROVINCE,
    YEAR,
    SUM(CODE_MALE) AS Total_Male,
    SUM(CODE_FEMALE) AS Total_Female,
    SUM(CODE_TOTAL) AS Total
FROM Midyear
GROUP BY CODE_PROVINCE, YEAR;";
$objmid = mysqli_query($con, $sqlmid);
$rowmid = mysqli_fetch_array($objmid);

$Total_Male = $rowmid['Total_Male'];
$Total_Female = $rowmid['Total_Female'];
$Total = $rowmid['Total'];

$msql1 = "SELECT
  m.CODE_map02,
  SUM(h.a_total) AS total_a,
  SUM(h.b_total) AS total_b
FROM
  HDCTBBED h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
WHERE
  h.b_year = '2567'  -- Add a filter for the year
GROUP BY
  m.CODE_map02;

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_a'] <> 0){
		$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_a']."],";
	}
	//['th-ct', 10],
}



/*$sqlhdc01 = "SELECT
  groupcode,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB01
GROUP BY
  groupcode;";
$objhdc01 = mysqli_query($con, $sqlhdc01);
//$rowhdc01 = mysqli_fetch_array($objhdc01);
*/
$hdc01_1 ='';
$hdc01_2 ='';
$hdc01_3 ='';
$hdc01_41 ='';
$hdc01_42 ='';
while($rowhdc01 = mysqli_fetch_array($objhdc01))
{
	if($rowhdc01['groupcode'] == '1.1'){
		$hdc01_1 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
	}else if($rowhdc01['groupcode'] == '2.0'){
		$hdc01_2 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
	}else if($rowhdc01['groupcode'] == '3.0'){
		$hdc01_3 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
	}else if($rowhdc01['groupcode'] == '4.1'){
		$hdc01_41 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
	}else if($rowhdc01['groupcode'] == '4.2'){
		$hdc01_42 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
	}
	//['th-ct', 10],
}

/*$sqlhdc02 = "SELECT
  groupcode,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB02
GROUP BY
  groupcode;";
$objhdc02 = mysqli_query($con, $sqlhdc02);
//$rowhdc01 = mysqli_fetch_array($objhdc01);
*/
$hdc02_1 ='';
$hdc02_2 ='';
$hdc02_3 ='';
$hdc02_41 ='';
$hdc02_42 ='';
while($rowhdc02 = mysqli_fetch_array($objhdc02))
{
	if($rowhdc02['groupcode'] == '1.1'){
		$hdc02_1 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
	}else if($rowhdc02['groupcode'] == '2.0'){
		$hdc02_2 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
	}else if($rowhdc02['groupcode'] == '3.0'){
		$hdc02_3 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
	}else if($rowhdc02['groupcode'] == '4.1'){
		$hdc02_41 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
	}else if($rowhdc02['groupcode'] == '4.2'){
		$hdc02_42 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
	}
	//['th-ct', 10],
}


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
  text-align: left;
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

.tooltip2 {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/
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
           <!-- <h3>Dashboard</h3>-->
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

    <!-- Main content -->
    <section class="content">
    
    <!-- Default box -->
    <div class="row">
		<div class="col-md-6 col-sm-6 col-6">
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>จิตแพทย์ผู้ใหญ่</p>
					<h3><?php echo $dr01;?> คน</h3>
                    <p><?php echo (($dr01 / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
					<h3><?php echo $dr02;?> คน</h3>
                    <p><?php echo (($dr02 / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
					<h3><?php echo $Ward_no;?> เตียง</h3>
                    <p><?php echo (($Ward_no / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
					<h3><?php echo $Ward_no;?> %</h3>
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
					<a href="tables-1.php?t=1"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>

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
                    data: [<?php echo $tdr01.','.$tdr02.','.$tdr03.','.$tdr04;?>],
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

            
           

		  <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #B5F7F8; color: black;">
                <div class="inner">
                    
                    <p>พยาบาล PGสุขภาพจิต</p>
					<h3><?php echo $nu02;?> คน</h3>
                    <p><?php echo (($nu02 / $Total)*100000);?>  : 1แสน ประชากร</p>
					
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
                    
                    <p>พยาบาล PGจิตเวชเด็ก</p>
					<h3><?php echo $nu04;?> คน</h3>
                    <p><?php echo (($nu04 / $Total)*100000);?>  : 1แสน ประชากร</p>
					
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
			<div class="row">
       <div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">พยาบาล</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button2"><img width="10%" src="images/downloand.png"></button>
					</div>
                  
				</div>

				<div class="card-body">
					<!--<canvas id="myChart4"></canvas>-->
					<a href="tables-1.php?t=2"><canvas id="myChart4" style="min-height: 100%; height: 380px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx4 = document.getElementById('myChart4');

                         const downloadButton2 = document.getElementById('download-button2');

const myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: ['พยาบาลเฉพาะทางสุขภาพจิตและจิตเวช', 'พยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น', 'พยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด', 'พยาบาลเฉพาะทางผู้สูงอายุ'],
        datasets: [{
            label: 'ปฏิบัติงาน',
            data: [<?php echo $nu02.','.$nu03.','.$nu04.','.$nu05.','.$nu06.','.$nu07;?>],
            backgroundColor: '#6CE5E8',
            borderColor: '#6CE5E8',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'กำลังศึกษาต่อเฉพาะทาง',
            data: [<?php echo $tnu02.','.$tnu03.','.$tnu04.','.$tnu05.','.$tnu06.','.$tnu07;?>],
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

downloadButton2.addEventListener('click', function() {
const chartData2 = myChart4.toBase64Image(); // Get chart image data
const link = document.createElement('a');
link.href = chartData2;
link.download = 'stacked-barchart.png'; // Set download filename
link.click();
});

									
					</script>
				</div>

			</div>
		</div> 
        
		</div>


                
		
		</div>

        <div class="col-lg-6">
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<!--<div class="card-header">
							<h3 class="card-title">ผู้ป่วยในจิตเวช</h3>
						</div>-->
						<div class="card-body">
							<div id="container"></div>
							
						</div>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<!-- small card -->
					<div class="small-box" style="background-color: #b3e8a2; color: black;">
					<div class="inner">
						
						<p>เภสัชกร</p>
						<h3><?php echo $nu02;?> คน</h3>
						<p><?php echo (($nu02 / $Total)*100000);?> : 1แสน ประชากร</p>
						
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
				
				
			</div>
				<!-- ./row -->	
            

		</div>
		
	  </div>
      <!-- /.card -->	
		
	  

         <!-- Default box -->
    <div class="row">
		<div class="col-md-6 col-sm-6 col-6">
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFDADA; color: black;">
				  <div class="inner">
                    
                    <p>นักจิตวิทยา</p>
					<h3><?php echo $TCtotal ;?> คน</h3>
                    <p><?php echo (($TCtotal / $Total)*100000);?> : 1แสน ประชากร</p>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FDC7BD; color: black;">
				  <div class="inner">
                    
                    <p>นักสังคมสงเคราะห์</p>
					<h3><?php echo $SC;?> คน</h3>
                    <p><?php echo (($SC / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
				<div class="small-box" style="background-color: #FFDAC3; color: black;">
                <div class="inner">
                    
                    <p>นักกิจกรรมบำบัด</p>
					<h3><?php echo $TOC ;?> คน</h3>
                    <p><?php echo (($TOC / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
				<div class="small-box" style="background-color: #FDD0EC; color: black;">
                <div class="inner">
                    
                    <p>นักฝึกพูด</p>
					<h3><?php echo $TOC2 ;?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo (($TOC2 / $Total)*100000);?> : 1แสน ประชากร</p>
					
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
	

      <div class="row">
		<div class="col-md-6 col-sm-6 col-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักจิตวิทยา</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button3"><img width="10%" src="images/downloand.png"></button>
					</div>
                   
				</div>

				<div class="card-body" align="center">
	
					<a href="tables-2.php"><canvas id="myChart9" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas></a>
						
					
				</div>
				<div class="card-header">
					<h3 class="card-title">ข้อมูลบริการ 5 โรคสำคัญ&nbsp;&nbsp; </h3>
					<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext"> 
								<ul>
									<li>ความผิดปกติทางจิตและพฤติกรรมที่เกิดจากการใช้สารออกฤทธิ์ต่อจิตประสาท(F10-F19))</li>
									<li>โรคจิตเภท พฤติกรรมแบบโรคจิตเภท และโรคหลงผิด (F20-F29)</li>
									<li>โรคซึมเศร้า(F32,F33,F34.1,F38,F39)</li>
									<li>ไบโพล่า(F31)</li>
									<li>โรคสมองเสื่อม(F00-F03)</li>
								</ul>
							</span>
						</div>
                   
				</div>

			</div>
		</div>
		<div class="col-md-6">
		  <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #D2C7FF; color: black;">
                <div class="inner">
                    
                    <p>ครูการศึกษาพิเศษ</p>
					<h3><?php echo $TOC3 ;?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo (($TOC3 / $Total)*100000);?>: 1แสน ประชากร</p>
					
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
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #B5F7F8; color: black;">
                <div class="inner">
                    
                    <p>นักวิชาการสาธารณสุข</p>
					<h3><?php echo $TOC4 ;?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo (($TOC4 / $Total)*100000);?> : 1แสน ประชากร</p>
					
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

            <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #CAEAFD; color: black;">
                <div class="inner">
                    
                    <p>จำนวน ECT</p>
					<h3><?php echo $ect_no;?> เครื่อง</h3>
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
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #BEF1A5; color: black;">
                <div class="inner">
                    
                    <p>จำนวน TMS</p>
					<h3><?php echo $tms_no;?> เครื่อง</h3>
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

        


      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ผู้ป่วยนอกจิตเวช</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button5"><img width="10%" src="images/downloand.png"></button>
					</div>
                   
				</div>
				<div class="card-body">
					<a href="tables-1.php?t=1"><canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx5 = document.getElementById('myChart5');

						 
                         const downloadButton5 = document.getElementById('download-button5');

const myChart5 = new Chart(ctx5, {
    type: 'line',
    data: {
        labels: ['ปี 2563', 'ปี 2564', 'ปี 2565', 'ปี 2566', 'ปี 2567'],
        datasets: [{
            label: 'ความผิดปกติทางจิตและพฤติกรรมที่เกิดจากการใช้สารออกฤทธิ์ต่อจิตประสาท(F10-F19)',
            data: [<?php echo $hdc01_1;?>],
            backgroundColor: '#00cadc',
            borderColor: '#00cadc',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'โรคจิตเภท พฤติกรรมแบบโรคจิตเภท และโรคหลงผิด (F20-F29)',
            data: [<?php echo $hdc01_2;?>],
            backgroundColor: '#49c3fb',
            borderColor: '#49c3fb',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'โรคซึมเศร้า(F32,F33,F34.1,F38,F39)',
            data: [<?php echo $hdc01_3;?>],
            backgroundColor: '#65a6fa',
            borderColor: '#65a6fa',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'ไบโพล่า(F31)',
            data: [<?php echo $hdc01_41;?>],
            backgroundColor: '#7e80e7',
            borderColor: '#7e80e7',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset	
		},
        {
            label: 'โรคสมองเสื่อม(F00-F03)',
            data: [<?php echo $hdc01_42;?>],
            backgroundColor: '#9b57cc',
            borderColor: '#9b57cc',
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

downloadButton5.addEventListener('click', function() {
const chartData5 = myChart5.toBase64Image(); // Get chart image data
const link = document.createElement('a');
link.href = chartData5;
link.download = 'stacked-barchart.png'; // Set download filename
link.click();
});
					
					</script>
					
				</div>

			</div>
            

		</div>
        <div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ผู้ป่วยในจิตเวช</h3>
                    
					<div align="right">
						<button class="btn btn-navbar" id="download-button6"><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="tables-1.php?t=1"><canvas id="myChart6" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx6 = document.getElementById('myChart6');

                         const downloadButton6 = document.getElementById('download-button6');

const myChart6 = new Chart(ctx6, {
    type: 'line',
    data: {
        labels: ['ปี 2563', 'ปี 2564', 'ปี 2565', 'ปี 2566', 'ปี 2567'],
        datasets: [{
            label: 'ความผิดปกติทางจิตและพฤติกรรมที่เกิดจากการใช้สารออกฤทธิ์ต่อจิตประสาท(F10-F19)',
            data: [<?php echo $hdc02_1;?>],
            backgroundColor: '#00cadc',
            borderColor: '#00cadc',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'โรคจิตเภท พฤติกรรมแบบโรคจิตเภท และโรคหลงผิด (F20-F29)',
            data: [<?php echo $hdc02_2;?>],
            backgroundColor: '#49c3fb',
            borderColor: '#49c3fb',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'โรคซึมเศร้า(F32,F33,F34.1,F38,F39)',
            data: [<?php echo $hdc02_41;?>],
            backgroundColor: '#65a6fa',
            borderColor: '#65a6fa',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'ไบโพล่า(F31)',
            data: [<?php echo $hdc02_42;?>],
            backgroundColor: '#7e80e7',
            borderColor: '#7e80e7',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset	
		},
        {
            label: 'โรคสมองเสื่อม(F00-F03)',
            data: [10, 25, 35, 20],
            backgroundColor: '#9b57cc',
            borderColor: '#9b57cc',
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

downloadButton6.addEventListener('click', function() {
const chartData6 = myChart6.toBase64Image(); // Get chart image data
const link = document.createElement('a');
link.href = chartData6;
link.download = 'stacked-barchart.png'; // Set download filename
link.click();
});
					
					</script>
					
				</div>

			</div>
            

		</div>
        </div>
		
	  </div>
      <!-- /.card -->	
		
       
		
      
	 <script>
		 

  const ctx9 = document.getElementById('myChart9');

  const downloadButton3 = document.getElementById('download-button3');

        const data = {
            labels: ['นักจิตวิทยาคลินิค', 'นักจิตวิทยาคลินิค (บรรจุตำแหน่งนักจิตวิทยา)', 'นักจิตวิทยา', 'นักจิตวิทยาการศึกษา(บรรจุตำแหน่งนักจิตวิทยา)'],
            datasets: [{
                data: [<?php echo $TC01.','.$TC02;?>],
                backgroundColor: ['#00CADC', '#49C3FB', '#65A6FA', '#7E80E7'],
                borderColor: ['#00CADC', '#49C3FB', '#65A6FA', '#7E80E7'],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {} // Add any desired chart options here
        };

        const myChart9 = new Chart(ctx9, config);

        downloadButton3.addEventListener('click', function() {
            const chartData3 = myChart9.toBase64Image();
            const link = document.createElement('a');
            link.href = chartData3;
            link.download = 'doughnut-chart.png';
            link.click();
        });
 
</script>
<script>
	
	(async () => {
        const topology = await fetch(
            'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
        ).then(response => response.json());

        const data = [
          <?php echo $datamap; ?> 
            // ... (remaining data)
        ];

        // Create the responsive Highcharts map
        Highcharts.mapChart('container', {
            chart: {
                map: topology,
                // Responsive options:
				height: 900, // Adjust the height as desired (e.g., 600, 800)
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 1000
                        },
                        chartOptions: {
                            title: {
                                style: {
                                    display: 'none' // Hide title on small screens
                                }
                            },
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom' // Move legend below chart on small screens
                            }
                        }
                    }]
                }
            },

            title: {
                text: 'เตียงจิตเวช' // Optional title
            },

            colorAxis: {
				min: 0,
            //type: 'logarithmic',
           // minColor: '#cd0808',
            //maxColor: '#056934',
            //stops: [
            //    [0, '#cd0808'],
            //    [0.67, '#fbe036'],
            //    [1, '#056934']
            //]
            },

            series: [{
                data: data,
                // Optional series options (uncomment if desired):
                // name: 'Random data',
                // states: {
                //     hover: {
                //         color: '#BADA55'
                //     }
                // },
                // dataLabels: {
                //     enabled: true,
                //     format: '{point.name}'
                // }
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
