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



if (isset($_POST['position'])) {
	$position = $_POST['position'];

  
	if($position == 'แพทย์'){
		header("Location: dashboard08doctor.php");
	}elseif($position == 'พยาบาล'){
		header("Location: dashboard08nurse.php");
	}elseif($position == 'เภสัชกร'){
		header("Location: dashboard08medicine.php");
	}elseif($position == 'นักจิตวิทยา'){
		header("Location: dashboard08heart.php");
	}elseif($position == 'นักสังคมสงเคราะห์'){
		header("Location: dashboard08social.php");
	}elseif($position == 'นักกิจกรรมบำบัด'){
		header("Location: dashboard08physical-therapy.php");
	/*}elseif($position == 'เวชศาสตร์สื่อความหมาย'){
		header("Location: dashboard08translation.php");*/
	}elseif($position == 'นักวิชาการศึกษาพิเศษ'){
		header("Location: dashboard08education.php");
	}elseif($position == 'นักวิชาการสาธารณสุข'){
		header("Location: dashboard08health.php");
	}elseif($position == 'วิชาชีพอื่นๆ'){
		header("Location: dashboard08other.php");
	}
}


$sql1 = "SELECT
    SUM(CASE WHEN personnel.positiontypeID = '7' THEN 1 ELSE 0 END) AS TC01
FROM
    personnel
JOIN hospitalnew ON hospitalnew.CODE5 = personnel.HospitalID
WHERE
    personnel.positiontypeID = '7'
AND personnel.setdel = '1'
AND personnel.Mcatt1 = 'ใช่'
";


if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql1 = $sql1."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql1 = $sql1."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$sql1 = $sql1."AND hospitalnew.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sql1 = $sql1."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sql1 = $sql1."AND hospitalnew.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$TCtotal = 0;

if (isset($row1)) {
  if($row1['TC01'] == ''){
    $TCtotal =  0;
  }else{
    $TCtotal =  $row1['TC01'];
  }
}

$sql2 = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต')AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป')AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน') AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
";


if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql2 = $sql2."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql2 = $sql2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$sql2 = $sql2."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sql2 = $sql2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sql2 = $sql2."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

$obj2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($obj2);

$MA01 = $row2['MA01'];
$MA02 = $row2['MA02'];
$MA03 = $row2['MA03'];
$MA04 = $row2['MA04'];


$MOOsql1 = "SELECT
  hn.CODE_HMOO,
  SUM(CASE WHEN p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'PA01_1'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
";

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$MOOsql1 = $MOOsql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$MOOsql1 = $MOOsql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$MOOsql1 = $MOOsql1."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $MOOsql1 = $MOOsql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $MOOsql1 = $MOOsql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

    
  $MOOsql1 = $MOOsql1."
GROUP BY hn.CODE_HMOO 
  ;
		";
$Mobj1 = mysqli_query($con, $MOOsql1);
//$row2 = mysqli_fetch_array($obj2);
$Hmoo01_1 = 0 ;
$Hmoo02_1 = 0 ;
$Hmoo03_1 = 0 ;
$Hmoo04_1 = 0 ;
$Hmoo05_1 = 0 ;
$Hmoo06_1 = 0 ;
$Hmoo07_1 = 0 ;
$Hmoo08_1 = 0 ;
$Hmoo09_1 = 0 ;
$Hmoo10_1 = 0 ;
$Hmoo11_1 = 0 ;
$Hmoo12_1 = 0 ;
$Hmoo13_1 = 0 ;
/*
$Hmoo01_2 = 0 ;
$Hmoo02_2 = 0 ;
$Hmoo03_2 = 0 ;
$Hmoo04_2 = 0 ;
$Hmoo05_2 = 0 ;
$Hmoo06_2 = 0 ;
$Hmoo07_2 = 0 ;
$Hmoo08_2 = 0 ;
$Hmoo09_2 = 0 ;
$Hmoo10_2 = 0 ;
$Hmoo11_2 = 0 ;
$Hmoo12_2 = 0 ;
$Hmoo13_2 = 0 ;
$Hmoo01_3 = 0 ;
$Hmoo02_3 = 0 ;
$Hmoo03_3 = 0 ;
$Hmoo04_3 = 0 ;
$Hmoo05_3 = 0 ;
$Hmoo06_3 = 0 ;
$Hmoo07_3 = 0 ;
$Hmoo08_3 = 0 ;
$Hmoo09_3 = 0 ;
$Hmoo10_3 = 0 ;
$Hmoo11_3 = 0 ;
$Hmoo12_3 = 0 ;
$Hmoo13_3 = 0 ;
$Hmoo01_4 = 0 ;
$Hmoo02_4 = 0 ;
$Hmoo03_4 = 0 ;
$Hmoo04_4 = 0 ;
$Hmoo05_4 = 0 ;
$Hmoo06_4 = 0 ;
$Hmoo07_4 = 0 ;
$Hmoo08_4 = 0 ;
$Hmoo09_4 = 0 ;
$Hmoo10_4 = 0 ;
$Hmoo11_4 = 0 ;
$Hmoo12_4 = 0 ;
$Hmoo13_4 = 0 ;
*/

while($Mrow1 = mysqli_fetch_array($Mobj1))
{
	if($Mrow1['CODE_HMOO'] == 1){
		$Hmoo01_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 2){
		$Hmoo02_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 3){
		$Hmoo03_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 4){
		$Hmoo04_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 5){
		$Hmoo05_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 6){
		$Hmoo06_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 7){
		$Hmoo07_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 8){
		$Hmoo08_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 9){
		$Hmoo09_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 10){
		$Hmoo10_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 11){
		$Hmoo11_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 12){
		$Hmoo12_1 = $Mrow1['PA01_1'];
	}elseif($Mrow1['CODE_HMOO'] == 13){
		$Hmoo13_1 = $Mrow1['PA01_1'];
	}
	//['th-ct', 10],
}

$dHMOO1 = "'เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'";

 $vMhoo1_1 = $Hmoo01_1.",".$Hmoo02_1.",".$Hmoo03_1.",".$Hmoo04_1.",".$Hmoo05_1.",".$Hmoo06_1.",".$Hmoo07_1.",".$Hmoo08_1.",".$Hmoo09_1.",".$Hmoo10_1.",".$Hmoo11_1.",".$Hmoo12_1.",".$Hmoo13_1 ;
 //$vMhoo1_2 = $Hmoo01_2.",".$Hmoo02_2.",".$Hmoo03_2.",".$Hmoo04_2.",".$Hmoo05_2.",".$Hmoo06_2.",".$Hmoo07_2.",".$Hmoo08_2.",".$Hmoo09_2.",".$Hmoo10_2.",".$Hmoo11_2.",".$Hmoo12_2.",".$Hmoo13_2 ;
 //$vMhoo1_3 = $Hmoo01_3.",".$Hmoo02_3.",".$Hmoo03_3.",".$Hmoo04_3.",".$Hmoo05_3.",".$Hmoo06_3.",".$Hmoo07_3.",".$Hmoo08_3.",".$Hmoo09_3.",".$Hmoo10_3.",".$Hmoo11_3.",".$Hmoo12_3.",".$Hmoo13_3 ;
 //$vMhoo1_4 = $Hmoo01_4.",".$Hmoo02_4.",".$Hmoo03_4.",".$Hmoo04_4.",".$Hmoo05_4.",".$Hmoo06_4.",".$Hmoo07_4.",".$Hmoo08_4.",".$Hmoo09_4.",".$Hmoo10_4.",".$Hmoo11_4.",".$Hmoo12_4.",".$Hmoo13_4 ;


 $sqlall = "WITH HospitalGroups AS (
  SELECT
      hn.CODE_PROVINCE,
      hn.CODE5 AS HospitalID,
      CASE 
          WHEN hn.HOS_TYPE IN ('กรมสุขภาพจิต') THEN 'MCATT ระดับกรมสุขภาพจิต'
          WHEN hn.HOS_TYPE IN ('โรงพยาบาลศูนย์', 'โรงพยาบาลทั่วไป') THEN 'MCATT ระดับจังหวัด'
          WHEN hn.HOS_TYPE IN ('โรงพยาบาลชุมชน') THEN 'MCATT ระดับอำเภอ'
          WHEN hn.HOS_TYPE IN ('โรงพยาบาลส่งเสริมสุขภาพตำบล', 'ศูนย์บริการสาธารณสุข อปท.') THEN 'MCATT ระดับตำบล'
          ELSE 'Other'
      END AS HospitalGroup
  FROM
      hospitalnew hn
)
SELECT
  hg.CODE_PROVINCE,
  hg.HospitalGroup,
  COUNT(CASE WHEN pt.positiontypeID = '7' THEN 1 END) AS MD01
FROM
  HospitalGroups hg
JOIN personnel pt ON hg.HospitalID = pt.HospitalID
WHERE 
  pt.positiontypeID = '7'
AND 
  pt.Mcatt1 = 'ใช่'
";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall = $sqlall."AND YEAR(pt.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sqlall = $sqlall."AND hg.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$sqlall = $sqlall."AND hg.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlall = $sqlall."AND hg.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlall = $sqlall."AND hg.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

  $sqlall = $sqlall."
GROUP BY
  hg.CODE_PROVINCE, hg.HospitalGroup;"
;

$objall = mysqli_query($con, $sqlall);


  
if (isset($_POST['CODE_HMOO'])) {

$sql2p = "SELECT
  hn.CODE_PROVINCE,
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต')AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป')AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน') AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
";


if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql2p = $sql2p."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql2p = $sql2p."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$sql2p = $sql2p."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sql2p = $sql2p."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sql2p = $sql2p."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

$obj2p = mysqli_query($con, $sql2p);
$row2p = mysqli_fetch_array($obj2p);

$MA01p = $row2p['MA01'];
$MA02p = $row2p['MA02'];
$MA03p = $row2p['MA03'];
$MA04p = $row2p['MA04'];


$MOOsql1p = "SELECT
  hn.CODE_HMOO,
  SUM(CASE WHEN p.positiontypeID = '7' THEN 1 ELSE 0 END) AS 'PA01_1'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
";

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$MOOsql1p = $MOOsql1p."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$MOOsql1p = $MOOsql1p."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if ($_POST['TYPE_SERVICE']<> 'ทั้งหมด') {
	$mySelect = $_POST['TYPE_SERVICE'];
	$MOOsql1p = $MOOsql1p."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $MOOsql1p = $MOOsql1p."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $MOOsql1p = $MOOsql1p."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
    }  

    
  $MOOsql1p = $MOOsql1p."
GROUP BY hn.CODE_HMOO 
  ;
		";
$Mobj1p = mysqli_query($con, $MOOsql1p);
//$row2 = mysqli_fetch_array($obj2);



$dHMOO1p = '' ;

$vMhoo1_1p = '' ;
$vMhoo1_2p = '' ;


$i = 1 ;

while($row1p = mysqli_fetch_array($Mobj1p))
{
	if($i == 1 ){
		
		$dHMOO1p =  "'".$row1p['CODE_PROVINCE']."'";

		$vMhoo1_1p = $row1p['PA01_1'];

	}else{
	$dHMOO1p =  $dHMOO1p.",'".$row1p['CODE_PROVINCE']."'";

	$vMhoo1_1p = $vMhoo1_1p.",".$row1p['PA01_1'];


	}
	$i++;

}


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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
          <h3> ข้อมูลทรัพยากร MCATT นักเวชศาสตร์สื่อความหมาย</h3>
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
			<form class="form-valide" action="dashboard08translation.php" method="post" id="myform1" name="foml">  
      <div class="row">
      <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="Year" id="Year" style="width: 100%;">
                   <!-- <option selected="selected" value="2567" >2567</option>
                    <option value="2566">2566</option>
                    <option value="2565">2565</option>
                    <option value="2564">2564</option>
                    <option value="2563">2563</option>-->
                    <?PHP for($i=0; $i<= (5); $i++) {?>
                    <option value="<?PHP echo ((date("Y")+543))-$i?>"><?PHP echo ((date("Y")+543))-$i?></option>
                    <?PHP }?>
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
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;" onChange="myFunction3()">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="1">เขต1</option>
                    <option value="2">เขต2</option>
                    <option value="3">เขต3</option>
					          <option value="4">เขต4</option>
                    <option value="5">เขต5</option>
                    <option value="6">เขต6</option>
					          <option value="7">เขต7</option>
                    <option value="8">เขต8</option>
                    <option value="9">เขต9</option>
					          <option value="10">เขต10</option>
                    <option value="11">เขต11</option>
                    <option value="12">เขต12</option>
					          <option value="13">เขต13</option>
                   </select>
                </div>
                <script>
                   function myFunction3() {
                      const selectedValue = $('#area').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hmoo.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { moo_id: selectedValue },
                            success: function(data) {
                              $('#CODE_PROVINCE').html(data);
                            }
                          });
                    }
			    	</script> 
				<!-- /.form-group -->
                <div class="form-group" id="labelservice" hidden="none">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" hidden="none" onChange="myFunction2()">
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
                <script>
                   function myFunction2() {
                      const selectedValue = $('#service').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue },
                            success: function(data) {
                              $('#CODE_PROVINCE').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>

                <script>
                   function myFunction4() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hos.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { CODE_PROVINCE: selectedValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	


              <div class="col-md-2">
               <div class="form-group">
                  <label>โรงพยาบาล</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["CODE5"];?>" ><?PHP echo $rowprovince["HOS_NAME"];?></option>
					  
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
                    <option  value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="แพทย์" >แพทย์</option>
                    <option value="พยาบาล" >พยาบาล</option>
                    <option value="เภสัชกร" >เภสัชกร</option>
                    <option value="นักจิตวิทยา" >นักจิตวิทยา</option>
                    <option value="นักสังคมสงเคราะห์" >นักสังคมสงเคราะห์</option>
                    <option value="นักกิจกรรมบำบัด" >นักกิจกรรมบำบัด</option>
                    <option selected="selected" value="เวชศาสตร์สื่อความหมาย" >เวชศาสตร์สื่อความหมาย</option>
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

    <!-- Main content -->
    <section class="content">
    
    <!-- Default box -->
    <div class="row">
		<div class="col-md-12 col-sm-12 col-12">
        <div class="row">
			  <div class="col-lg-3">
				<!-- small card -->
				<div class="small-box" style="background-color: #e7cdc2; color: black;">
				  <div class="inner">
                    
                    <p>นักเวชศาสตร์สื่อความหมาย</p>
					          <h3><?php echo number_format($TCtotal, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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

       
    <div class="col-md-12 col-sm-12 col-12">
	  <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักเวชศาสตร์สื่อความหมายปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) จำแนกตามระดับ﻿</h3>
				</div>

			</div>

		</div>
     
      <!-- /.card -->	

		</div>
	  <div class="row">
		<div class="col-md-6 col-sm-6 col-6">
			
        <div class="row">
			
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>ระดับกรมสุขภาพจิต</p>
					<h3><?php echo number_format($MA01, 0, '.', ',');?> คน</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับจังหวัด</p>
					<h3><?php echo number_format($MA02, 0, '.', ',');?> คน</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับอำเภอ</p>
					<h3><?php echo number_format($MA03, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับตำบล</p>
					<h3><?php echo number_format($MA04, 0, '.', ',');?> คน</h3>
                    
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

  </div>

    

      <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">นักเวชศาสตร์สื่อความหมายปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) รายเขตสุขภาพ﻿</h3>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart7" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx7 = document.getElementById('myChart7');
        
        
        const downloadButton7 = document.getElementById('download-button7');

        const myChart7 = new Chart(ctx7, {
            type: 'bar',
            data: {
              labels: [<?php echo $dHMOO1; ?>],
                datasets: [{
                    label: 'นักเวชศาสตร์สื่อความหมาย',
                    data: [<?php echo $vMhoo1_1; ?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
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
    const chartData = myChart7.toBase64Image(); // Get chart image data
    const link = document.createElement('a');
    link.href = chartData;
    link.download = 'stacked-barchart.png'; // Set download filename
    link.click();
});
    </script>
					
				</div>
                

                

			</div>

            
           

		
		</div>

    
	  </div>
      <!-- /.card -->	

		</div>

    <?php  if (isset($_POST['CODE_HMOO'])) { ?>
	  <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">บุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) จำแนกตามระดับจังหวัด﻿</h3>
				</div>

			</div>

		</div>
     
      <!-- /.card -->	

		</div>

		<div class="row">
		<div class="col-md-6 col-sm-6 col-6">
			
        <div class="row">
			
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>ระดับกรมสุขภาพจิต</p>
					<h3><?php echo $MA01p;?> คน</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับจังหวัด</p>
					<h3><?php echo $MA02p;?> คน</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับอำเภอ</p>
					<h3><?php echo $MA03p;?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    <p>ระดับตำบล</p>
					<h3><?php echo $MA04p;?> คน</h3>
                    
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

		 <!-- Default box -->
		 <div class="row">
		<div class="col-md-12">
			<div class="card">
				<!--<div class="card-header">
					<h3 class="card-title">ข้อมูลแพทย์</h3>
				</div>-->
				<div class="card-body">
					<a href="#"><canvas id="myChart8" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx8 = document.getElementById('myChart8');
        
        
        const downloadButton8 = document.getElementById('download-button');

        const myChart8 = new Chart(ctx8, {
          type: 'bar',
          data: {
              labels: [<?php echo $dHMOO1p; ?>],
                datasets: [{
                    label: 'นักเวชศาสตร์สื่อความหมาย',
                    data: [<?php echo $vMhoo1_1p; ?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
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
    const chartData = myChart8.toBase64Image(); // Get chart image data
    const link = document.createElement('a');
    link.href = chartData;
    link.download = 'stacked-barchart.png'; // Set download filename
    link.click();
});
    </script>
					
				</div>
                

                

			</div>

            
           

		  

                
		
		</div>

		

       
	  </div>
      <!-- /.card -->	
	

	  <?php  } ?>


		<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th width="5%">จังหวัด</th>
                    <th width="12%">ระดับ MCATT <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext"> 
								<ul>
								<p>MCATT ในแต่ละระดับ แบ่งตามหน่วยงาน ดังนี้</p>
									<li>MCATT ระดับกรมสุขภาพจิต</li>
                  <ul>
									<li>สถาบัน/โรงพยาบาล/ศูนย์ สังกัดกรมสุขภาพจิต</li>
                  </ul>
									<li>MCATT ระดับจังหวัด</li>
                  <ul>
									<li>สสจ./โรงพยาบาลศูนย์/โรงพยาบาลทั่วไป</li>
                  </ul>
                  <li>MCATT ระดับอำเภอ</li>
                  <ul>
									<li>สสอ./โรงพยาบาลชุมชน</li>
                  </ul>
                  <li>MCATT ระดับตำบล</li>
                  <ul>
									<li>สสอ./โรงพยาบาลชุมชน</li>
                  </ul>
								</ul>
							</span>
						</div>
                   
				</div></th>
                    <th width="12%">นักเวชศาสตร์สื่อความหมาย (คน)</th>
                  </tr>
                   </thead>
                  <tbody>
				          <?php
                      $i = 0;

                    while($rowall = mysqli_fetch_array($objall)){
                      $i++;
                  ?>
                  <tr align="center">
                    <td width="5%"><?php echo $rowall['CODE_PROVINCE'];?></td>
                    <td width="12%"><?php echo $rowall['HospitalGroup'];?></td>
                    <td width="12%"><?php echo $rowall['MD01'];?></td>
                  </tr>
                  <?php 
                    }
                  ?>
					</tbody>
				  </table>
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


</div>
</div>


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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
  $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
</script>

</body>
</html>
