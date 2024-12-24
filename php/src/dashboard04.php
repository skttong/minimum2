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



$sql9 = "SELECT  
			SUM(b.ect_no) AS total_ect_no ,
			SUM(b.tms_no) AS total_tms_no
		FROM ect b  
    JOIN hospitalnew hn on hn.CODE5 = b.hospitalCode5 
    where 1 ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql9 = $sql9."AND YEAR(b.ectDate) = '".$Year."'" ;
}
  */ 

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql9 = $sql9."AND b.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.ectDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql9 = $sql9."AND b.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.ectDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sql9 = $sql9."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql9 = $sql9."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sql9 = $sql9."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sql9 = $sql9."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql9 = $sql9."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$obj9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_array($obj9);


$total_ect_no = $row9['total_ect_no'];
$total_tms_no = $row9['total_tms_no'];

$sqlect = "SELECT
  hn.CODE_HMOO,
  SUM(e.ect_no) AS total_ect_no,
  SUM(e.tms_no) AS total_tms_no
FROM
  ect e
RIGHT JOIN hospitalnew hn ON hn.CODE5 = e.hospitalCode5
WHERE 1 
";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlect = $sqlect."AND YEAR(e.ectDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlect = $sqlect."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlect = $sqlect."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlect = $sqlect."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlect = $sqlect."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlect = $sqlect."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlect = $sqlect."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlect = $sqlect."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$sqlect = $sqlect."
GROUP BY
  hn.CODE_HMOO;";
$object = mysqli_query($con, $sqlect);
//$rowbed = mysqli_fetch_array($objbed);

/*
$hmoo = '';
$b01 = '';
$b02 = '';



while($rowect = mysqli_fetch_array($object))
{
	$hmoo = $hmoo."'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."',";
	$b01 = $b01."'".$rowect['total_ect_no']."',";
	$b02 = $b02."'".$rowect['total_tms_no']."',";
	
}

*/

$hmoo = '';
$b01 = '';
$b02 = '';

$hmoo_1 = '';
$b01_1 = '';
$b02_1 = '';
$hmoo_2 = '';
$b01_2 = '';
$b02_2 = '';
$hmoo_3 = '';
$b01_3 = '';
$b02_3 = '';
$hmoo_4 = '';
$b01_4 = '';
$b02_4 = '';
$hmoo_5 = '';
$b01_5 = '';
$b02_5 = '';
$hmoo_6 = '';
$b01_6 = '';
$b02_6 = '';
$hmoo_7 = '';
$b01_7 = '';
$b02_7 = '';
$hmoo_8 = '';
$b01_8 = '';
$b02_8 = '';
$hmoo_9 = '';
$b01_9 = '';
$b02_9 = '';
$hmoo_10 = '';
$b01_10 = '';
$b02_10 = '';
$hmoo_11 = '';
$b01_11 = '';
$b02_11 = '';
$hmoo_12 = '';
$b01_12 = '';
$b02_12 = '';
$hmoo_13 = '';
$b01_13 = '';
$b02_13 = '';



while($rowect = mysqli_fetch_array($object))
{
  if($rowect['CODE_HMOO']== '1'){
    $hmoo_1 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_1 = "'".$rowect['total_ect_no']."'";
    $b02_1 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '2'){
    $hmoo_2 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_2 = "'".$rowect['total_ect_no']."'";
    $b02_2 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '3'){
    $hmoo_3 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_3 = "'".$rowect['total_ect_no']."'";
    $b02_3 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '4'){
    $hmoo_4 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_4 = "'".$rowect['total_ect_no']."'";
    $b02_4 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '5'){
    $hmoo_5 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_5 = "'".$rowect['total_ect_no']."'";
    $b02_5 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '6'){
    $hmoo_6 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_6 = "'".$rowect['total_ect_no']."'";
    $b02_6 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '7'){
    $hmoo_7 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_7 = "'".$rowect['total_ect_no']."'";
    $b02_7 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '8'){
    $hmoo_8 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_8 = "'".$rowect['total_ect_no']."'";
    $b02_8 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '9'){
    $hmoo_9 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_9 = "'".$rowect['total_ect_no']."'";
    $b02_9 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '10'){
    $hmoo_10 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_10 = "'".$rowect['total_ect_no']."'";
    $b02_10 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '11'){
    $hmoo_11 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_11 = "'".$rowect['total_ect_no']."'";
    $b02_11 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '12'){
    $hmoo_12 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_12 = "'".$rowect['total_ect_no']."'";
    $b02_12 = "'".$rowect['total_tms_no']."'";
  }else if($rowect['CODE_HMOO']== '13'){
    $hmoo_13 = "'เขตสุขภาพที่ ".$rowect['CODE_HMOO']."'";
    $b01_13 = "'".$rowect['total_ect_no']."'";
    $b02_13 = "'".$rowect['total_tms_no']."'";
  }
	
}

$hmoo = $hmoo_1.','.$hmoo_2.','.$hmoo_3.','.$hmoo_4.','.$hmoo_5.','.$hmoo_6.','.$hmoo_7.','.$hmoo_8.','.$hmoo_9.','.$hmoo_10.','.$hmoo_11.','.$hmoo_12.','.$hmoo_13;
$b01 = $b01_1.','.$b01_2.','.$b01_3.','.$b01_4.','.$b01_5.','.$b01_6.','.$b01_7.','.$b01_8.','.$b01_9.','.$b01_10.','.$b01_11.','.$b01_12.','.$b01_13;
$b02 = $b02_1.','.$b02_2.','.$b02_3.','.$b02_4.','.$b02_5.','.$b02_6.','.$b02_7.','.$b02_8.','.$b02_9.','.$b02_10.','.$b02_11.','.$b02_12.','.$b02_13;
//$b03 = $b03_1.','.$b03_2.','.$b03_3.','.$b03_4.','.$b03_5.','.$b03_6.','.$b03_7.','.$b03_8.','.$b03_9.','.$b03_10.','.$b03_11.','.$b03_12.','.$b03_13;



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
  m.CODE_PROVINCETH,
  SUM(e.ect_no) AS total_ect_no,
  SUM(e.tms_no) AS total_tms_no
FROM
  hospitalnew hn
left JOIN ect e ON hn.CODE5 = e.hospitalCode5
left JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
WHERE 1 
";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql1 = $msql1."AND YEAR(e.ectDate) = '".$Year."'" ;
} 
*/

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$msql1 = $msql1."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$msql1 = $msql1."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $msql1 = $msql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $msql1 = $msql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $msql1 = $msql1."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$msql1 = $msql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$msql1 = $msql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$msql1 = $msql1."
GROUP BY
   m.CODE_map02 ,m.CODE_PROVINCETH

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
$datamap2 ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_ect_no'] <> 0){
		//$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_ect_no']."],";
    $datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".$mrow1['total_ect_no'].",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
  if($mrow1['total_tms_no'] <> 0){
		//$datamap2 = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_tms_no']."],";
    $datamap2 = $datamap2."{'hc-key':'".$mrow1['CODE_map02']."',value:".$mrow1['total_tms_no'].",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}


$bsql1 = "SELECT
  hn.CODE_HMOO,
  COUNT(DISTINCT b.Wardall) AS total_beds, 
  SUM(b.Ward_no) AS total_ward_no,
  SUM(b.Unit) AS total_unit,
  SUM(b.Unit_no) AS total_unit_no
FROM
  bed b
right JOIN hospitalnew hn ON hn.CODE5 = b.hospitalCode5
WHERE 1 
";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsql1 = $bsql1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
*/

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$bsql1 = $bsql1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$bsql1 = $bsql1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsql1 = $bsql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $bsql1 = $bsql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $bsql1 = $bsql1."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsql1 = $bsql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsql1 = $bsql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$bsql1 = $bsql1."
GROUP BY
  hn.CODE_HMOO;";

$objb01 = mysqli_query($con, $bsql1);
//$rowb01 = mysqli_fetch_array($objb01);

$hmoo2 = '';
$b201 = '';
$b202 = '';
$b203 = '';
$b204 = '';

while($rowb01 = mysqli_fetch_array($objb01))
{
	$hmoo2 = $hmoo."'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."',";
	$b201 = $b201."'".$rowb01['total_beds']."',";
	$b202 = $b202."'".$rowb01['total_ward_no']."',";
	$b203 = $b203."'".$rowb01['total_unit']."',";
	$b204 = $b204."'".$rowb01['total_unit']."',";
}

$sqlall = "SELECT
  hn.HOS_NAME ,
  SUM(e.ect_no) AS total_ect_no,
  SUM(e.tms_no) AS total_tms_no
FROM
  ect e
JOIN hospitalnew hn ON hn.CODE5 = e.hospitalCode5
WHERE 1 
";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlall = $sqlall."AND YEAR(e.ectDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall = $sqlall."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlall = $sqlall."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlall = $sqlall."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlall = $sqlall."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlall = $sqlall."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlall = $sqlall."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlall = $sqlall."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$sqlall = $sqlall."
GROUP BY
  hn.HOS_NAME;"
;

//echo $sqlall;
$sqlall1 = $sqlall ;

$objall = mysqli_query($con, $sqlall);
$objall1 = mysqli_query($con, $sqlall1);




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
            <h3>การรักษาด้วย ECT/ TMS</h3>
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
			<form class="form-valide" action="dashboard04.php" method="post" id="myform1" name="foml">  
      <div class="row">
     <!-- ปีงบประมาณ -->
     <div class="col-md-2">
            <div class="form-group">
                <label>ปีงบประมาณ</label>
                <select class="form-control select2" name="Year" id="Year" style="width: 100%;">
                   <?PHP for($i=0; $i < (5); $i++) {
                      
                      if (date("m") == '10' || date("m") == '11' || date("m") == '12'){

                      ?>
                      
                       <option <?php if ($_POST['Year'] == ((date("Y")+543+1))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543+1))-$i; ?>"><?PHP echo ((date("Y")+543+1))-$i ;?></option>
                      <?php  
                      }else{
                        
                      ?>

                    <option <?php if ($_POST['Year'] == ((date("Y")+543))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543))-$i; ?>"><?PHP echo ((date("Y")+543))-$i ;?></option>
                    <?PHP } }?>
                  </select>
            </div>
        </div>
        
        <!-- เขตสุขภาพ -->
        <div class="col-md-2">
            <div class="form-group">
                <label>เขตสุขภาพ</label>
                <select class="form-control select2" name="CODE_HMOO" id="CODE_HMOO" style="width: 100%;" onChange="myFunction3()">
                    <option <?php if (isset($_POST['CODE_HMOO']) && $_POST['CODE_HMOO'] == 'ทั้งหมด' || !isset($_POST['CODE_HMOO'])){?> selected="selected" <?php } ?> value="ทั้งหมด">ทั้งหมด</option>
                    <?php for ($i = 1; $i <= 13; $i++) { ?>
                    <option <?php if (isset($_POST['CODE_HMOO']) && $_POST['CODE_HMOO'] == $i){?> selected="selected" <?php } ?> 
                        value="<?php echo $i; ?>">เขตสุขภาพ <?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- จังหวัด -->
        <div class="col-md-2">
            <div class="form-group">
                <label>จังหวัด</label>
                <select class="form-control select2" name="CODE_PROVINCE" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['CODE_PROVINCE']) && $_POST['CODE_PROVINCE'] == 'ทั้งหมด' || !isset($_POST['CODE_PROVINCE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- หน่วยงานใน/นอกสังกัด -->
        <div class="col-md-3">
            <div class="form-group">
                <label>หน่วยงานใน/นอกสังกัดกระทรวงสาธารณสุข</label>
                <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction5()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['type_Affiliation']) && $_POST['type_Affiliation'] == 'ทั้งหมด' || !isset($_POST['type_Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- สังกัด -->
        <div class="col-md-2">
            <div class="form-group">
                <label>สังกัด</label>
                <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction15()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['Affiliation']) && $_POST['Affiliation'] == 'ทั้งหมด' || !isset($_POST['Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- ประเภทหน่วยบริการ -->
        <div class="col-md-3">
            <div class="form-group">
                <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                <select class="form-control select2" name="TYPE_SERVICE" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction2()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['TYPE_SERVICE']) && $_POST['TYPE_SERVICE'] == 'ทั้งหมด' || !isset($_POST['TYPE_SERVICE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- หน่วยบริการ -->
        <div class="col-md-4">
            <div class="form-group">
                <label>หน่วยบริการ/หน่วยงาน</label>
                <select class="form-control select2" name="CODE_HOS" id="CODE_HOS" style="width: 100%;">
                    <option value="ทั้งหมด" <?php if (isset($_POST['CODE_HOS']) && $_POST['CODE_HOS'] == 'ทั้งหมด' || !isset($_POST['CODE_HOS'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
        <button type="reset" class="btn btn-default" id="resetButton"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>
    </div>  
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {

  

    myFunction3();
    myFunction4();
    myFunction5();
    myFunction15();
    myFunction2();
});



// Function for เขตสุขภาพ -> จังหวัด
function myFunction3() {
    const selectedValue = $('#CODE_HMOO').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_hmoo.php',
            data: { moo_id: selectedValue },
            success: function(data) {
                $('#CODE_PROVINCE').html(data);

                 // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                 const provinceValue = '<?php echo isset($_POST['CODE_PROVINCE']) ? $_POST['CODE_PROVINCE'] : ''; ?>';
                if (provinceValue) {
                    $('#CODE_PROVINCE').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for จังหวัด -> หน่วยงานใน/นอกสังกัด
function myFunction4() {
    const selectedValue = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_affiliationtype.php',
            data: { codeprovince: selectedValue },
            success: function(data) {
                $('#type_Affiliation').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['type_Affiliation']) ? $_POST['type_Affiliation'] : ''; ?>';
                if (provinceValue) {
                    $('#type_Affiliation').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for หน่วยงานใน/นอกสังกัด -> สังกัด
function myFunction5() {
    const selectedValue = $('#type_Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_affiliation2.php',
            data: { typeAffiliation: selectedValue, codeprovince: codeprovince },
            success: function(data) {
                $('#Affiliation').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['Affiliation']) ? $_POST['Affiliation'] : ''; ?>';
                if (provinceValue) {
                    $('#Affiliation').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for สังกัด -> ประเภทหน่วยบริการ
function myFunction15() {
    const selectedValue = $('#Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_servicetype.php',
            data: { Affiliation: selectedValue, codeprovince: codeprovince },
            success: function(data) {
                $('#TYPE_SERVICE').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['TYPE_SERVICE']) ? $_POST['TYPE_SERVICE'] : ''; ?>';
                if (provinceValue) {
                    $('#TYPE_SERVICE').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for ประเภทหน่วยบริการ -> หน่วยบริการ
function myFunction2() {
    const selectedValue = $('#TYPE_SERVICE').val();
    const Affiliation = $('#Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    const HostHMOO = $('#CODE_HMOO').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_service.php',
            data: { service_id: selectedValue, codeprovince: codeprovince, Affiliation: Affiliation, CODE_HMOO: HostHMOO },
            success: function(data) {
                $('#CODE_HOS').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                if (provinceValue) {
                    $('#CODE_HOS').val(provinceValue).trigger('change');
                }
            }
        });
    }
}


</script>

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

      <?php
// ฟังก์ชันสำหรับจัดการข้อมูล (แยก string, ลบช่องว่าง, ตัด index ใหม่)
function cleanData($data) {
  // แปลง string เป็น array
  $data = explode(',', $data);

  // ลบค่าว่างและ trim ช่องว่างหรือเครื่องหมายที่ไม่ต้องการ
  $data = array_filter($data, function($value) {
      return trim($value) !== '';
  });

  // ตัดช่องว่างและลบ ' ออกจากแต่ละค่า
  $data = array_map(function($value) {
      return trim($value, "' ");
  }, $data);

  // รีเซ็ต index ใหม่
  return array_values($data);
}

// จัดการกับตัวแปรทั้งหมด
$hmoo = cleanData($hmoo);
$b01 = cleanData($b01);
$b02 = cleanData($b02);


// ตรวจสอบผลลัพธ์
//var_dump($hmoo);
//var_dump($b01);
//var_dump($b02);

?>
	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Electroconvulsive therapy (ECT) & Transcranial Magnetic Stimulation (TMS)
                    (เครื่อง)</h3>
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
                labels: <?php echo json_encode($hmoo); ?>,
                datasets: [{
                    label: 'Electroconvulsive therapy (ECT)',
                    data: <?php echo json_encode($b01); ?>,
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'Transcranial Magnetic Stimulation (TMS)',
                    data: <?php echo json_encode($b02); ?>,
                    backgroundColor: '#41b8d5',
                    borderColor: '#41b8d5',
                    borderWidth: 1,
                    stack: 'combined1' // Enable stacking for this dataset
                }]
            },
            options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        maxRotation: 0,
                        autoSkip: true,
                        callback: function(value) {
                            return this.getLabelForValue(value).trim(); // ลบช่องว่างเกินออก
                        }
                    }
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
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

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Electroconvulsive therapy (ECT) & Transcranial Magnetic Stimulation (TMS) (เครื่อง)</h3>
				</div>
				<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="15%">จำนวน ECT</th>
					  <th width="15%">จำนวน TMS</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
				  		$i = 0;

						while($rowall = mysqli_fetch_array($objall)){
							$i++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowall['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowall['total_ect_no'];?></td>
						<td width="12%"><?php echo $rowall['total_tms_no'];?></td>
						
				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>

          <table id="example3" class="table table-bordered table-striped" hidden >
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="15%">จำนวน ECT</th>
					  <th width="15%">จำนวน TMS</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
				  		$j = 0;

						while($rowall1 = mysqli_fetch_array($objall1)){
							$j++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $j;?></td>
						<td width="12%"><?php echo $rowall1['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowall1['total_ect_no'];?></td>
						<td width="12%"><?php echo $rowall1['total_tms_no'];?></td>
						
				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>
				</div>
			</div>	

		  
		
		</div>
		<div class="col-md-6">


		<div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9ECFF; color: black;">
                <div class="inner">
                  
				<p>จำนวน ECT</p> 
					<h3><?php echo $total_ect_no ;?> เครื่อง</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                    
                    
					<p>จำนวน TMS</p>
					<h3><?php echo $total_tms_no?> เครื่อง</h3>
                   <!-- <p>xx : 1แสน ประชากร</p>-->
					
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
                  <option value="ECT" >ECT</option>
                  <option value="TMS" >TMS</option>
                  </select>
                </div>
              </div>

        <div id="map01">
          <div class="card-body">
            <div id="container"></div>
            
          </div>
        </div>

        <div id="map02" class="disabled">
          <div class="card-body" >
            <div id="container2"></div>
            
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
				const dropdown = document.getElementById('position2');
        const div1 = document.getElementById('map01');
        const div2 = document.getElementById('map02');
	
				dropdown.addEventListener('change', function() {
            //alert(dropdown.value);
            if (dropdown.value === 'ECT') {
                div2.classList.add('disabled');
                div1.classList.remove('disabled');
            }else{
                div2.classList.remove('disabled');
                div1.classList.add('disabled');
            }
           // const div = document.getElementById('myMctt3');
					 // div.classList.add('disabled');
					 // document.getElementById("other_r1").disabled = false;
				});

			</script>

			</div>
			 
			</div>
			<!-- ./row -->	
			</div>


		
	  </div>
      <!-- /.card -->	
						</div>
						</div>
						</div>


						<script>
		   
		   (async () => {
		   
			   const topology = await fetch(
				   'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
			   ).then(response => response.json());
		   
			   // Prepare demo data. The data is joined to map using value of 'hc-key'
			   // property by default. See API docs for 'joinBy' for more info on linking
			   // data and map.
			   const data = [
				  <?php echo $datamap ;?>
			   ];
		   
			   // Create the chart
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
					   text: ' '
				   },

           mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
          legend: {
                title: {
                    text: '',
                    style: {
                        color: ( // theme
                            Highcharts.defaultOptions &&
                            Highcharts.defaultOptions.legend &&
                            Highcharts.defaultOptions.legend.title &&
                            Highcharts.defaultOptions.legend.title.style &&
                            Highcharts.defaultOptions.legend.title.style.color
                        ) || 'black'
                    }
                },
                align: 'right',
                verticalAlign: 'bottom',
                floating: true,
                layout: 'vertical',
                valueDecimals: 1,
                backgroundColor: ( // theme
                    Highcharts.defaultOptions &&
                    Highcharts.defaultOptions.legend &&
                    Highcharts.defaultOptions.legend.backgroundColor
                ) || 'rgba(255, 255, 255, 0.85)',
                symbolRadius: 20,
                symbolHeight: 14
            },
            colorAxis: {
                dataClasses: [{           
                    from: 1,
                    color: '#056934',
                    name: 'มี'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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
                    color: '#000000',
                      format: '{point.name}'
                    // Only show dataLabels for areas with high label rank
                   // format: '{#if (lt point.properties.labelrank 5)}' +
                    //    '{point.properties.iso-a2}' +
                   //     '{/if}'
                },
					 
				   }]
			   });
		   
		   })();

       (async () => {
		   
       const topology = await fetch(
         'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
       ).then(response => response.json());
     
       // Prepare demo data. The data is joined to map using value of 'hc-key'
       // property by default. See API docs for 'joinBy' for more info on linking
       // data and map.
       const data = [
        <?php echo $datamap2 ;?>
       ];
     
       // Create the chart
       Highcharts.mapChart('container2', {
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
           text: ' '
         },

         mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
        legend: {
                title: {
                    text: '',
                    style: {
                        color: ( // theme
                            Highcharts.defaultOptions &&
                            Highcharts.defaultOptions.legend &&
                            Highcharts.defaultOptions.legend.title &&
                            Highcharts.defaultOptions.legend.title.style &&
                            Highcharts.defaultOptions.legend.title.style.color
                        ) || 'black'
                    }
                },
                align: 'right',
                verticalAlign: 'bottom',
                floating: true,
                layout: 'vertical',
                valueDecimals: 1,
                backgroundColor: ( // theme
                    Highcharts.defaultOptions &&
                    Highcharts.defaultOptions.legend &&
                    Highcharts.defaultOptions.legend.backgroundColor
                ) || 'rgba(255, 255, 255, 0.85)',
                symbolRadius: 20,
                symbolHeight: 14
            },
            colorAxis: {
                dataClasses: [{           
                    from: 1,
                    color: '#056934',
                    name: 'มี'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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
           
           dataLabels: {
             enabled: true,
             format: '{point.name}'
           }
           */ 
          dataLabels: {
                    enabled: true,
                    color: '#000000',
                      format: '{point.name}'
                    // Only show dataLabels for areas with high label rank
                   // format: '{#if (lt point.properties.labelrank 5)}' +
                    //    '{point.properties.iso-a2}' +
                   //     '{/if}'
                },
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
     // "buttons": ["copy", "csv", "excel", "pdf"]
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

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard04.php'; 
        });

      
</script>

</body>
</html>
