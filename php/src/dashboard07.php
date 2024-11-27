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



$sql1 = "SELECT
  pt.Ptype,
  COUNT(pl.Mcatt1) AS total_count
FROM
  personneltype pt
LEFT JOIN (
  SELECT
    positiontypeID,
    Mcatt1,
	MWac1_9,
	HospitalID,
	personnelDate
  FROM
    personnel
  WHERE
    Mcatt1 = 'ใช่'
) pl ON pt.Ptype = pl.positiontypeID
JOIN hospitalnew hn on hn.CODE5 = pl.HospitalID
WHERE 1 
";


if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql1 = $sql1."AND YEAR(pl.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql1 = $sql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$sql1 = $sql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$sql1 = $sql1."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sql1 = $sql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql1 = $sql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }  

$sql1 = $sql1." GROUP BY
  pt.Ptype;
";


$obj1 = mysqli_query($con, $sql1);

$PL01 = 0;
$PL02 = 0;
$PL03 = 0;
$PL04 = 0;
$PL05 = 0;
$PL06 = 0;
$PL07 = 0;
$PL08 = 0;
$PL09 = 0;
$PL10 = 0;


while($row1 = mysqli_fetch_array($obj1)){
	if($row1['Ptype']=='1'){
		$PL01 = $row1['total_count'];
	}elseif($row1['Ptype']=='2'){
		$PL02 = $row1['total_count'];
	}elseif($row1['Ptype']=='3'){
		$PL03 = $row1['total_count'];
	}elseif($row1['Ptype']=='4'){
		$PL04 = $row1['total_count'];
	}elseif($row1['Ptype']=='5'){
		$PL05 = $row1['total_count'];
	}elseif($row1['Ptype']=='6'){
		$PL06 = $row1['total_count'];
	}elseif($row1['Ptype']=='7'){
		$PL07 = $row1['total_count'];
	}elseif($row1['Ptype']=='8'){
		$PL08 = $row1['total_count'];
	}elseif($row1['Ptype']=='9'){
		$PL09 = $row1['total_count'];
	}elseif($row1['Ptype']=='10'){
		$PL10 = $row1['total_count'];
	} 

}

$msql1 = "SELECT
  m.CODE_map02,
  m.CODE_PROVINCETH,
  COUNT(p.personnelID) AS total_personnel
FROM
  personnel p
JOIN hospitalnew hn ON hn.CODE5 = p.HospitalID
JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
WHERE
  p.Mcatt1 = 'ใช่'
AND
  p.MWac1_9 <> 'ไม่ผ่านการอบรม'
";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$msql1 = $msql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
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
  m.CODE_map02,  m.CODE_PROVINCETH;
";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_personnel'] <> 0){
		//$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_personnel']."],";
		$datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".$mrow1['total_personnel'].",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}

$msql2 = "
SELECT p.PROVINCE_CODE , 
     m.CODE_map02, 
     m.CODE_PROVINCETH,
     count(c.province_code) AS total,
     c.event_date
FROM CMSreports c 
JOIN province p ON p.PROVINCE_CODE = c.province_code 
JOIN mapdetail m ON m.CODE_PROVINCE = TRIM(p.PROVINCE_NAME) 
WHERE 1 
";


	 if (isset($_POST['Year'])) {
		$Year = $_POST['Year']-543;
		$msql2 = $msql2."AND YEAR(c.event_date) = '".$Year."'" ;
	  }else{
		$msql2 = $msql2."AND YEAR(c.event_date) = '".(date("Y"))."'" ;
	  }

/*
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$msql2 = $msql2."AND h.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$msql2 = $msql2."AND h.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$msql2 = $msql2."AND h.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  */
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$msql2 = $msql2."AND p.PROVINCE_CODE = '".$CODE_PROVINCE."'" ;
	}
  }
  /*
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$msql2 = $msql2."AND h.CODE5 = '".$CODE_HOS."'" ;
	}
  } 
	*/
$msql2 = $msql2."
GROUP BY
 p.PROVINCE_CODE ;
";

//echo $msql2;
$mobj2 = mysqli_query($con, $msql2);

$datamap2 ='';

while($mrow2 = mysqli_fetch_array($mobj2))
{
	if($mrow2['total'] <> 0){
		//$datamap2 = $datamap2."['".$mrow2['CODE_map02']."',".$mrow2['total']."],";
		$datamap2 = $datamap2."{'hc-key':'".$mrow2['CODE_map02']."',value:".$mrow2['total'].",name:'".$mrow2['CODE_PROVINCETH']."'},";
	}

}

//echo $datamap2 ;

$MOOsql2 = "SELECT
  hn.CODE_HMOO,
  COUNT(DISTINCT p.personnelID) AS total_per
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่'
  ";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$MOOsql2 = $MOOsql2."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
   
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$MOOsql2 = $MOOsql2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$MOOsql2 = $MOOsql2."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$MOOsql2 = $MOOsql2."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$MOOsql2 = $MOOsql2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$MOOsql2 = $MOOsql2."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 

$MOOsql2 = $MOOsql2." GROUP BY
  hn.CODE_HMOO;
		";
$obj2 = mysqli_query($con, $MOOsql2);
//$row2 = mysqli_fetch_array($obj2);
$Hmoo01 = 0 ;
$Hmoo02 = 0 ;
$Hmoo03 = 0 ;
$Hmoo04 = 0 ;
$Hmoo05 = 0 ;
$Hmoo06 = 0 ;
$Hmoo07 = 0 ;
$Hmoo08 = 0 ;
$Hmoo09 = 0 ;
$Hmoo10 = 0 ;
$Hmoo11 = 0 ;
$Hmoo12 = 0 ;
$Hmoo13 = 0 ;


while($row2 = mysqli_fetch_array($obj2))
{
	if($row2['CODE_HMOO'] == 1){
		$Hmoo01 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 2){
		$Hmoo02 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 3){
		$Hmoo03 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 4){
		$Hmoo04 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 5){
		$Hmoo05 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 6){
		$Hmoo06 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 7){
		$Hmoo07 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 8){
		$Hmoo08 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 9){
		$Hmoo09 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 10){
		$Hmoo10 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 11){
		$Hmoo11 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 12){
		$Hmoo12 = $row2['total_per'];
	}elseif($row2['CODE_HMOO'] == 13){
		$Hmoo13 = $row2['total_per'];
	}
	//['th-ct', 10],
}

$dHMOO = "'เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'";

$vMhoo = $Hmoo01.",".$Hmoo02.",".$Hmoo03.",".$Hmoo04.",".$Hmoo05.",".$Hmoo06.",".$Hmoo07.",".$Hmoo08.",".$Hmoo09.",".$Hmoo10.",".$Hmoo11.",".$Hmoo12.",".$Hmoo13 ;


$sql3 = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่'
 ";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql3 = $sql3."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql3 = $sql3."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$sql3 = $sql3."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$sql3 = $sql3."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sql3 = $sql3."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql3 = $sql3."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 

$obj3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($obj3);

$MA01 = $row3['MA01'];
$MA02 = $row3['MA02'];
$MA03 = $row3['MA03'];
$MA04 = $row3['MA04'];
 
$MOOsql1 = "SELECT
  hn.CODE_HMOO,
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') THEN 1 ELSE 0 END) AS 'MA04'
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

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$MOOsql1 = $MOOsql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$MOOsql1 = $MOOsql1."AND hn.HOS_TYPE = '".$mySelect."'" ;
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
		GROUP BY hn.CODE_HMOO;
	";



$obj1 = mysqli_query($con, $MOOsql1);
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


while($row1 = mysqli_fetch_array($obj1))
{
	if($row1['CODE_HMOO'] == 1){
		$Hmoo01_1 = $row1['MA01'];
		$Hmoo01_2 = $row1['MA02'];
		$Hmoo01_3 = $row1['MA03'];
		$Hmoo01_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 2){
		$Hmoo02_1 = $row1['MA01'];
		$Hmoo02_2 = $row1['MA02'];
		$Hmoo02_3 = $row1['MA03'];
		$Hmoo02_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 3){
		$Hmoo03_1 = $row1['MA01'];
		$Hmoo03_2 = $row1['MA02'];
		$Hmoo03_3 = $row1['MA03'];
		$Hmoo03_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 4){
		$Hmoo04_1 = $row1['MA01'];
		$Hmoo04_2 = $row1['MA02'];
		$Hmoo04_3 = $row1['MA03'];
		$Hmoo04_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 5){
		$Hmoo05_1 = $row1['MA01'];
		$Hmoo05_2 = $row1['MA02'];
		$Hmoo05_3 = $row1['MA03'];
		$Hmoo05_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 6){
		$Hmoo06_1 = $row1['MA01'];
		$Hmoo06_2 = $row1['MA02'];
		$Hmoo06_3 = $row1['MA03'];
		$Hmoo06_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 7){
		$Hmoo07_1 = $row1['MA01'];
		$Hmoo07_2 = $row1['MA02'];
		$Hmoo07_3 = $row1['MA03'];
		$Hmoo07_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 8){
		$Hmoo08_1 = $row1['MA01'];
		$Hmoo08_2 = $row1['MA02'];
		$Hmoo08_3 = $row1['MA03'];
		$Hmoo08_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 9){
		$Hmoo09_1 = $row1['MA01'];
		$Hmoo09_2 = $row1['MA02'];
		$Hmoo09_3 = $row1['MA03'];
		$Hmoo09_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 10){
		$Hmoo10_1 = $row1['MA01'];
		$Hmoo10_2 = $row1['MA02'];
		$Hmoo10_3 = $row1['MA03'];
		$Hmoo10_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 11){
		$Hmoo11_1 = $row1['MA01'];
		$Hmoo11_2 = $row1['MA02'];
		$Hmoo11_3 = $row1['MA03'];
		$Hmoo11_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 12){
		$Hmoo12_1 = $row1['MA01'];
		$Hmoo12_2 = $row1['MA02'];
		$Hmoo12_3 = $row1['MA03'];
		$Hmoo12_4 = $row1['MA04'];
	}elseif($row1['CODE_HMOO'] == 13){
		$Hmoo13_1 = $row1['MA01'];
		$Hmoo13_2 = $row1['MA02'];
		$Hmoo13_3 = $row1['MA03'];
		$Hmoo13_4 = $row1['MA04'];
	}
	//['th-ct', 10],
}

$dHMOO1 = "'เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'";

$vMhoo1_1 = $Hmoo01_1.",".$Hmoo02_1.",".$Hmoo03_1.",".$Hmoo04_1.",".$Hmoo05_1.",".$Hmoo06_1.",".$Hmoo07_1.",".$Hmoo08_1.",".$Hmoo09_1.",".$Hmoo10_1.",".$Hmoo11_1.",".$Hmoo12_1.",".$Hmoo13_1 ;
$vMhoo1_2 = $Hmoo01_2.",".$Hmoo02_2.",".$Hmoo03_2.",".$Hmoo04_2.",".$Hmoo05_2.",".$Hmoo06_2.",".$Hmoo07_2.",".$Hmoo08_2.",".$Hmoo09_2.",".$Hmoo10_2.",".$Hmoo11_2.",".$Hmoo12_2.",".$Hmoo13_2 ;
$vMhoo1_3 = $Hmoo01_3.",".$Hmoo02_3.",".$Hmoo03_3.",".$Hmoo04_3.",".$Hmoo05_3.",".$Hmoo06_3.",".$Hmoo07_3.",".$Hmoo08_3.",".$Hmoo09_3.",".$Hmoo10_3.",".$Hmoo11_3.",".$Hmoo12_3.",".$Hmoo13_3 ;
$vMhoo1_4 = $Hmoo01_4.",".$Hmoo02_4.",".$Hmoo03_4.",".$Hmoo04_4.",".$Hmoo05_4.",".$Hmoo06_4.",".$Hmoo07_4.",".$Hmoo08_4.",".$Hmoo09_4.",".$Hmoo10_4.",".$Hmoo11_4.",".$Hmoo12_4.",".$Hmoo13_4 ;

$MOOsql1p = "SELECT
  hn.CODE_PROVINCE ,
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') THEN 1 ELSE 0 END) AS 'MA04'
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

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$MOOsql1p = $MOOsql1p."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$MOOsql1p = $MOOsql1p."AND hn.HOS_TYPE = '".$mySelect."'" ;
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
		GROUP BY 
	hn.CODE_PROVINCE
	";
$obj1p = mysqli_query($con, $MOOsql1p);
//$row2 = mysqli_fetch_array($obj2);

$dHMOO1p = '' ;

$vMhoo1_1p = '' ;
$vMhoo1_2p = '' ; 
$vMhoo1_3p = ''; 
$vMhoo1_4p = ''; 

$i = 1 ;

while($row1p = mysqli_fetch_array($obj1p))
{
	if($i == 1 ){
		
		$dHMOO1p =  "'".$row1p['CODE_PROVINCE']."'";

		$vMhoo1_1p = $row1p['MA01'];
		$vMhoo1_2p = $row1p['MA02'];
		$vMhoo1_3p = $row1p['MA03'];
		$vMhoo1_4p = $row1p['MA04'];

	}else{
	$dHMOO1p =  $dHMOO1p.",'".$row1p['CODE_PROVINCE']."'";

	$vMhoo1_1p = $vMhoo1_1p.",".$row1p['MA01'];
	$vMhoo1_2p = $vMhoo1_2p.",".$row1p['MA02'];
	$vMhoo1_3p = $vMhoo1_3p.",".$row1p['MA03'];
	$vMhoo1_4p = $vMhoo1_4p.",".$row1p['MA04'];
	}
	$i++;

}


$sql3p = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่'
 ";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql3p = $sql3p."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql3p = $sql3p."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$sql3p = $sql3p."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$sql3p = $sql3p."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sql3p = $sql3p."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql3p = $sql3p."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 

$obj3p = mysqli_query($con, $sql3p);
$row3p = mysqli_fetch_array($obj3p);

$MA01p = $row3p['MA01'];
$MA02p = $row3p['MA02'];
$MA03p = $row3p['MA03'];
$MA04p = $row3p['MA04'];

$sqlall = "SELECT
  hn.CODE_PROVINCE,
  SUM(CASE WHEN p.positiontypeID = 1 THEN 1 ELSE 0 END) AS PA01,
  SUM(CASE WHEN p.positiontypeID = 2 THEN 1 ELSE 0 END) AS PA02,
  SUM(CASE WHEN p.positiontypeID = 3 THEN 1 ELSE 0 END) AS PA03,
  SUM(CASE WHEN p.positiontypeID = 4 THEN 1 ELSE 0 END) AS PA04,
  SUM(CASE WHEN p.positiontypeID = 5 THEN 1 ELSE 0 END) AS PA05,
  SUM(CASE WHEN p.positiontypeID = 6 THEN 1 ELSE 0 END) AS PA06,
  SUM(CASE WHEN p.positiontypeID = 7 THEN 1 ELSE 0 END) AS PA07,
  SUM(CASE WHEN p.positiontypeID = 8 THEN 1 ELSE 0 END) AS PA08,
  SUM(CASE WHEN p.positiontypeID = 9 THEN 1 ELSE 0 END) AS PA09,
  SUM(CASE WHEN p.positiontypeID = 10 THEN 1 ELSE 0 END) AS PA10
FROM
  hospitalnew hn
JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่'
";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall = $sqlall."AND YEAR(p.personnelDate) = '".$Year."'" ;
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
	hn.CODE_PROVINCE;"
	;

$sqlall1 =  $sqlall;

$objall = mysqli_query($con, $sqlall);
$objall1 = mysqli_query($con, $sqlall1);

  $sqlall2 = "SELECT
    hn.CODE_HMOO,
    hn.CODE_PROVINCE,
    COALESCE(report_counts.total_reports, 0) AS total_reports,
    COALESCE(personnel_counts.total_personnel, 0) AS total_personnel
FROM 
    hospitalnew hn
LEFT JOIN (
    SELECT 
        COUNT(c.amphur_code) AS total_reports,
        LEFT(c.amphur_code, 2) AS amphur_prefix, 
		c.amphur_code  
    FROM 
        CMSreports c
	WHERE 1 
		"
		;
	 if (isset($_POST['Year'])) {
		$Year = $_POST['Year']-543;
		$sqlall2 = $sqlall2."AND YEAR(c.event_date) = '".$Year."'" ;
	  }else{
		$sqlall2 = $sqlall2."AND YEAR(c.event_date) = '".(date("Y"))."'" ;
	  }
	$sqlall2 = $sqlall2."
    GROUP BY amphur_prefix
	HAVING  amphur_prefix <> ''
) report_counts ON hn.NO_PROVINCE = report_counts.amphur_prefix
LEFT JOIN (
    SELECT 
        hn.CODE_PROVINCE,
        COUNT(*) AS total_personnel
    FROM 
        personnel p
    JOIN 
        hospitalnew hn ON hn.CODE5 = p.HospitalID
    WHERE 
        p.Mcatt1 = 'ใช่'
	AND
  		p.MWac1_9 <> 'ไม่ผ่านการอบรม'
    GROUP BY 
        hn.CODE_PROVINCE
) personnel_counts ON hn.CODE_PROVINCE = personnel_counts.CODE_PROVINCE
JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE total_personnel <> 0
";
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall2 = $sqlall2."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sqlall2 = $sqlall2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
	if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
	$type_Affiliation = trim($_POST['type_Affiliation']);
	$sqlall2 = $sqlall2."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
	}
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$sqlall2 = $sqlall2."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlall2 = $sqlall2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlall2 = $sqlall2."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 


$sqlall2 = $sqlall2."
	GROUP BY
   	hn.CODE_PROVINCE,hn.CODE_HMOO;"
	;

$sqlall2_1 = $sqlall2;	

$objall2 = mysqli_query($con, $sqlall2);
$objall2_1 = mysqli_query($con, $sqlall2_1);

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
            <h3>ข้อมูลภาพรวมทรัพยากร MCATT </h3>
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
			<form class="form-valide" action="dashboard07.php" method="post" id="myform1" name="foml">  
			<div class="row">
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
              <!-- /.col -->

              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="CODE_HMOO" style="width: 100%;" onChange="myFunction3()">
                    <option <?php if ($_POST['CODE_HMOO'] == 'ทั้งหมด'){?> selected="selected" <?php } ?>  value="ทั้งหมด">ทั้งหมด</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '1'){?> selected="selected" <?php } ?> value="1">เขตสุขภาพ 1</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '2'){?> selected="selected" <?php } ?> value="2">เขตสุขภาพ 2</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '3'){?> selected="selected" <?php } ?> value="3">เขตสุขภาพ 3</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '4'){?> selected="selected" <?php } ?> value="4">เขตสุขภาพ 4</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '5'){?> selected="selected" <?php } ?> value="5">เขตสุขภาพ 5</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '6'){?> selected="selected" <?php } ?> value="6">เขตสุขภาพ 6</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '7'){?> selected="selected" <?php } ?> value="7">เขตสุขภาพ 7</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '8'){?> selected="selected" <?php } ?> value="8">เขตสุขภาพ 8</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '9'){?> selected="selected" <?php } ?> value="9">เขตสุขภาพ 9</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '10'){?> selected="selected" <?php } ?> value="10">เขตสุขภาพ 10</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '11'){?> selected="selected" <?php } ?> value="11">เขตสุขภาพ 11</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '12'){?> selected="selected" <?php } ?> value="12">เขตสุขภาพ 12</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '13'){?> selected="selected" <?php } ?> value="13">เขตสุขภาพ 13</option>
                   </select>
                </div>
                <script>
                   function myFunction3() {
                      const selectedValue = $('#CODE_HMOO').val();
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
            
			   <!-- /.col -->
             
			 <!-- /.col -->
              
				<!-- /.form-group -->
         
        
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                     <option value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP /*
          if($_POST['CODE_PROVINCE'] <> 'ทั้งหมด'){
					$sqlprovince = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
          WHERE  NO_PROVINCE = ".$_POST['CODE_PROVINCE']."
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option selected="selected" value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					} 
        }else{
					?>
               <option value="ทั้งหมด" >ทั้งหมด</option>
        <?php } */ ?>
                  </select>
                </div>

                <script>
                   function myFunction4() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                          //alert(selectedValue);
                          $.ajax({
                            url: 'get_affiliationtype.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { codeprovince: selectedValue },
                            success: function(data) {
                              $('#type_Affiliation').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	

              <div class="col-md-3">
               <div class="form-group">
                  <label>หน่วยงานใน/ นอกสังกัดกระทรวงสาธารณสุข</label>
                  <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction5()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?PHP 
                       if($_POST['type_Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['type_Affiliation']; ?> "><?php echo $_POST['type_Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

                <script>
                   function myFunction5() {
                      const selectedValue = $('#type_Affiliation').val();
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_affiliation2.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { typeAffiliation: selectedValue , codeprovince: codeprovince  },
                            success: function(data) {
                              $('#Affiliation').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->
              
              <div class="col-md-2">
               <div class="form-group">
                  <label>สังกัด</label>
                  <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction15()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?PHP 
                       if($_POST['Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['Affiliation']; ?> "><?php echo $_POST['Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

                <script>
                   function myFunction15() {
                      const selectedValue = $('#Affiliation').val();
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_servicetype.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { Affiliation: selectedValue , codeprovince: codeprovince  },
                            success: function(data) {
                              $('#TYPE_SERVICE').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->
              <div class="col-md-3">
              <div class="form-group" id="labelservice">
                  <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction2()">
                     <option value="ทั้งหมด">ทั้งหมด</option>
                     <?PHP 
                       if(trim($_POST['TYPE_SERVICE']) <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo trim($_POST['TYPE_SERVICE']); ?> "><?php echo trim($_POST['TYPE_SERVICE']); ?> </option>
                    <?php } ?>
                   <!-- <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					          <option value="F2">F2</option>
					          <option value="F3">F3</option>  -->
                  </select>
                </div>
                <!-- /.form-group -->  
                <script>
                   function myFunction2() {
					const selectedValue = $('#TYPE_SERVICE').val();
                      const Affiliation 		= document.getElementById("Affiliation").value;
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                      const HostHMOO 		    = document.getElementById("CODE_HMOO").value;
                          //alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, CODE_HMOO: HostHMOO },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
</div>

              <div class="col-md-4">
               <div class="form-group">
                  <label>หน่วยบริการ/หน่วยงาน</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP /*
          if($_POST['CODE_HOS'] <> ''){
					$sqlprovince = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
AND CODE5 = ".$_POST['CODE_HOS']."
ORDER BY hospitalnew.CODE_HMOO DESC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option selected="selected"  value="<?PHP echo $rowprovince["CODE5"];?>" ><?PHP echo $rowprovince["HOS_NAME"];?></option>
					  
					<?PHP
					} 
        } */
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->		
			   		
            </div>
            <!-- /.row -->
		
			<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
				   <button type="reset" class="btn btn-default" id="resetButton"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
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
		<div class="col-md-6">
		<div class="row">
		<div class="col-lg-12">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner"><center>
                    
					<h3>ทั้งหมด <?php echo number_format(($PL01+$PL02+$PL03+$PL04+$PL05+$PL06+$PL07+$PL08+$PL09+$PL10), 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					</center>
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  </div>
				  
        <div class="row">
			<div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>แพทย์</p>
					<h3><?php echo number_format($PL01, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #B5F7F8; color: black;">
				  <div class="inner">
                    
                    <p>พยาบาล</p>
					<h3><?php echo number_format($PL02, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #FDC7BD; color: black;">
				  <div class="inner">
                    
                    <p>สังคมสงเคราะห์</p>
					<h3><?php echo number_format($PL05, 0, '.', ',');?> คน</h3>
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
			<div class="row">
			<div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #FDD0EC; color: black;">
				  <div class="inner">
                    
                    <p>นักวิชาการสาธารณสุข</p>
					<h3><?php echo number_format($PL09, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFDADA; color: black;">
				  <div class="inner">
                    
                    <p>นักจิตวิทยา</p>
					<h3><?php echo number_format($PL04, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFDAC3; color: black;">
				  <div class="inner">
                    
                    <p>นักกิจกรรมบำบัด</p>
					<h3><?php echo number_format($PL06, 0, '.', ',');?> คน</h3>
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
			<div class="row">
			<div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #B3E8A2; color: black;">
				  <div class="inner">
                    
                    <p>เภสัชกร</p>
					<h3><?php echo number_format($PL03, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #C5DED8; color: black;">
				  <div class="inner">
                    
                    <p>นักเวชศาสตร์สื่อความหมาย</p>
					<h3><?php echo number_format($PL07, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #D9D9D9; color: black;">
				  <div class="inner">
                    
                    <p>นักวิชาการศึกษาพิเศษ</p>
					<h3><?php echo number_format($PL08, 0, '.', ',');?> คน</h3>
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
			 
			<div class="row">
			<div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9FFDA; color: black;">
				  <div class="inner">
                    
                    <p>อื่นๆ</p>
					<h3><?php echo number_format($PL10, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			<?php /*
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #ECC8D9; color: black;">
				  <div class="inner">
                    
                    <p>บริการบำบัดผู้ป่วยยาเสพติด</p>
					<h3><?php echo '5';?> แห่ง</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-4">
				<!-- small card -->
				<div class="small-box" style="background-color: #F0EEC8; color: black;">
				  <div class="inner">
                    
                    <p>บริการTelepsychiatry</p>
					<h3><?php echo '9';?> แห่ง</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->

			  */ ?>
			   
			 
			</div>
			<!-- ./row -->	

		</div>

		<div class="col-md-3">
			<div class="card">
			<div class="card-header">
				<center><h3 class="card-title"><p>บุคลากรที่ผ่านการอบรม</p> <p>หลักสูตร MCATT</p></h3></center>
                   
				</div>
				<div class="card-body">
					<div id="container"></div>
					
				</div>

			</div>
			
            

		</div>	
		<div class="col-md-3">
			<div class="card">
			<div class="card-header">
			<center><h3 class="card-title"><p>ผู้ได้รับผลกระทบ </p> <p>จากเหตุการณ์วิกฤต/ภัยพิบัติ&nbsp;&nbsp;</p> </h3></center>
			<div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext"> 
								<ul>
								<p>ผู้ได้รับผลกระทบจากเหตุการณ์วิกฤต/ภัยพิบัติ หมายถึง</p>
									<li>ผู้ได้รับบาดเจ็บ</li>
									<li>ผู้อยู่ในเหตุการณ์</li>
									<li>ญาติผู้เสียชีวิต</li>
									<li>ญาติผู้บาดเจ็บ</li>
									<li>ผู้สูญเสียบ้าน/ทรัพย์สิน</li>
									<li>เจ้าหน้าที่/ผู้ให้การช่วยเหลือ</li>
									<li>ผู้รับรู้เหตุการณ์</li>
								</ul>
							</span>
						</div>
                   
				</div>
				<div class="card-body">
					<div id="container2"></div>
					
				</div>

			</div>
			
            

		</div>	
		
		</div>
	

    

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">บุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) รายเขตสุขภาพ﻿</h3>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx = document.getElementById('myChart3');
        
        
        const downloadButton = document.getElementById('download-button');

        const myChart3 = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $dHMOO;?>],
                datasets: [{
                    label: 'บุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) รายเขตสุขภาพ﻿',
                    data: [<?php echo $vMhoo ;?>],
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
               /* },
                {
                    label: 'Psychiatric Unit',
                    data: [10, 20, 30, 20],
                    backgroundColor: '#41b8d5',
                    borderColor: '#41b8d5',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'Integrated Bed',
                    data: [10, 20, 30, 20],
                    backgroundColor: '#2d8bba',
                    borderColor: '#2d8bba',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
               */ }]
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

    
	  </div>
      <!-- /.card -->	

	  <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">บุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) จำแนกตามระดับ﻿</h3>
				</div>

			</div>

		</div>
     
      <!-- /.card -->	

		</div>
	  <div class="row">
		<div class="col-md-6">
			
        <div class="row">
			
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <div class="tooltip2"><h5>ระดับกรมสุขภาพจิต<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
									<li>MCATT ระดับกรมสุขภาพจิต</li>
                  <ul>
									<li>สถาบัน/โรงพยาบาล/ศูนย์ สังกัดกรมสุขภาพจิต</li>
                  </ul>
								</ul>
							</span>
						</div>
					<h3><?php echo $MA01;?> คน</h3>
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
                    
                    <div class="tooltip2"><h5>ระดับจังหวัด<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
                  <li>MCATT ระดับจังหวัด</li>
                  <ul>
									<li>สสจ./โรงพยาบาลศูนย์/โรงพยาบาลทั่วไป</li>
                  </ul>
								</ul>
							</span>
						</div>
					<h3><?php echo $MA02;?> คน</h3>
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
                    
                     <div class="tooltip2"><h5>ระดับอำเภอ<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
              <li>MCATT ระดับอำเภอ</li>
                  <ul>
									<li>สสอ./โรงพยาบาลชุมชน</li>
                  </ul>
								</ul>
							</span>
						</div>
					<h3><?php echo $MA03;?> คน</h3>
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
                    
                    <div class="tooltip2"><h5>ระดับตำบล<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
              <li>MCATT ระดับตำบล</li>
                  <ul>
									<li>โรงพยาบาลส่งเสริมสุขภาพตำบล</li>
                  </ul>
								</ul>
							</span>
						</div>   
					<h3><?php echo $MA04;?> คน</h3>
                    
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
		<div class="col-md-12">
			<div class="card">
				<!--<div class="card-header">
					<h3 class="card-title">ข้อมูลแพทย์</h3>
				</div>-->
				<div class="card-body">
					<a href="#"><canvas id="myChart6" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx6 = document.getElementById('myChart6');
        
        
        const downloadButton6 = document.getElementById('download-button');

        const myChart6 = new Chart(ctx6, {
            type: 'bar',
            data: {
                labels: [<?php echo $dHMOO1; ?>],
                datasets: [{
                    label: 'ระดับกรมสุขภาพจิต',
                    data: [<?php echo $vMhoo1_1; ?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับจังหวัด',
                    data: [<?php echo $vMhoo1_2; ?>],
                    backgroundColor: '#49c3fb',
                    borderColor: '#49c3fb',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับอำเภอ',
                    data: [<?php echo $vMhoo1_3; ?>],
                    backgroundColor: '#2d8bba',
                    borderColor: '#2d8bba',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
				},
                {
                    label: 'ระดับตำบล',
                    data: [<?php echo $vMhoo1_4; ?>],
                    backgroundColor: '#7e80e7',
                    borderColor: '#7e80e7',
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
    const chartData = myChart6.toBase64Image(); // Get chart image data
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

	  <?php if (isset($_POST['CODE_HMOO'])) { ?>
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
		<div class="col-md-6">
			
        <div class="row">
			
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <div class="tooltip2"><h5>ระดับกรมสุขภาพจิต<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
									<li>MCATT ระดับกรมสุขภาพจิต</li>
                  <ul>
									<li>สถาบัน/โรงพยาบาล/ศูนย์ สังกัดกรมสุขภาพจิต</li>
                  </ul>
								</ul>
							</span>
						</div>
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
                    
                    <div class="tooltip2"><h5>ระดับจังหวัด<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
                  <li>MCATT ระดับจังหวัด</li>
                  <ul>
									<li>สสจ./โรงพยาบาลศูนย์/โรงพยาบาลทั่วไป</li>
                  </ul>
								</ul>
							</span>
						</div>
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
                    
                     <div class="tooltip2"><h5>ระดับอำเภอ<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
              <li>MCATT ระดับอำเภอ</li>
                  <ul>
									<li>สสอ./โรงพยาบาลชุมชน</li>
                  </ul>
								</ul>
							</span>
						</div>
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
                    
                    <div class="tooltip2"><h5>ระดับตำบล<i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i></h5>
							<span class="tooltiptext"> 

              <ul>
              <li>MCATT ระดับตำบล</li>
                  <ul>
									<li>โรงพยาบาลส่งเสริมสุขภาพตำบล</li>
                  </ul>
								</ul>
							</span>
						</div>   
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
					<a href="#"><canvas id="myChart7" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx7 = document.getElementById('myChart7');
        
        
        const downloadButton7 = document.getElementById('download-button');

        const myChart7 = new Chart(ctx7, {
            type: 'bar',
            data: {
                labels: [<?php echo $dHMOO1p; ?>],
                datasets: [{
                    label: 'ระดับกรมสุขภาพจิต',
                    data: [<?php echo $vMhoo1_1p; ?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
                    borderWidth: 1,
                    stack: 'combined1' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับจังหวัด',
                    data: [<?php echo $vMhoo1_2p; ?>],
                    backgroundColor: '#49c3fb',
                    borderColor: '#49c3fb',
                    borderWidth: 1,
                    stack: 'combined2' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับอำเภอ',
                    data: [<?php echo $vMhoo1_3p; ?>],
                    backgroundColor: '#2d8bba',
                    borderColor: '#2d8bba',
                    borderWidth: 1,
                    stack: 'combined3' // Enable stacking for this dataset
				},
                {
                    label: 'ระดับตำบล',
                    data: [<?php echo $vMhoo1_4p; ?>],
                    backgroundColor: '#7e80e7',
                    borderColor: '#7e80e7',
                    borderWidth: 1,
                    stack: 'combined4' // Enable stacking for this dataset
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
	

	  <?php } ?>

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
						<th width="30%">รวมทั้งหมด(คน)</th>
						<th width="30%">แพทย์(คน)</th>
						<th width="30%">พยาบาล(คน)</th>
						<th width="30%">นักสังคมสงเคราะห์(คน)</th>
						<th width="30%">นักจิตวิทยา(คน)</th>
						<th width="30%">นักกิจกรรมบำบัด(คน)</th>
						<th width="30%">เภสัชกร(คน)</th>
						<th width="30%">นักเวชศาสตร์สื่อความหมาย(คน)</th>
						<th width="30%">นักวิชาการศึกษาพิเศษ(คน)</th>
						<th width="30%">นักวิชาการสาธารณสุข</th>
						<th width="30%">อื่นๆ (คน)</th>			  
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
						<td width="30%"><?php 
							echo $rowall['PA01']+$rowall['PA02']+$rowall['PA03']+$rowall['PA04']+$rowall['PA05']+$rowall['PA06']+$rowall['PA07']+$rowall['PA08']+$rowall['PA09']+$rowall['PA10'];
						?></td>
						<td width="30%"><?php echo $rowall['PA01'];?></td>
						<td width="30%"><?php echo $rowall['PA02'];?></td>
						<td width="30%"><?php echo $rowall['PA05'];?></td>
						<td width="30%"><?php echo $rowall['PA04'];?></td>
						<td width="30%"><?php echo $rowall['PA06'];?></td>
						<td width="30%"><?php echo $rowall['PA03'];?></td>
						<td width="30%"><?php echo $rowall['PA07'];?></td>
						<td width="30%"><?php echo $rowall['PA08'];?></td>
						<td width="30%"><?php echo $rowall['PA09'];?></td>
						<td width="30%"><?php echo $rowall['PA10'];?></td>
				   </tr>
				   <?php 
						}
				   ?>
				
					</tbody>
				  </table>

				  <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
						<th width="5%">จังหวัด</th>
						<th width="12%">รวมทั้งหมด(คน)</th>
						<th width="12%">แพทย์(คน)</th>
						<th width="12%">พยาบาล(คน)</th>
						<th width="12%">นักสังคมสงเคราะห์(คน)</th>
						<th width="12%">นักจิตวิทยา(คน)</th>
						<th width="12%">นักกิจกรรมบำบัด(คน)</th>
						<th width="12%">เภสัชกร(คน)</th>
						<th width="12%">นักเวชศาสตร์สื่อความหมาย(คน)</th>
						<th width="12%">นักวิชาการศึกษาพิเศษ(คน)</th>
						<th width="12%">นักวิชาการสาธารณสุข</th>
						<th width="12%">อื่นๆ (คน)</th>			  
				   </tr>
                   </thead>
                  <tbody>

				  <?php
				  		$j = 0;

						while($rowall1 = mysqli_fetch_array($objall1)){
							$j++;
				  ?>
          <tr align="center">
						<td width="5%"><?php echo $rowall1['CODE_PROVINCE'];?></td>
						<td width="12%"><?php 
							echo $rowall1['PA01']+$rowall1['PA02']+$rowall1['PA03']+$rowall1['PA04']+$rowall1['PA05']+$rowall1['PA06']+$rowall1['PA07']+$rowall1['PA08']+$rowall1['PA09']+$rowall1['PA10'];
						?></td>
						<td width="12%"><?php echo $rowall1['PA01'];?></td>
						<td width="12%"><?php echo $rowall1['PA02'];?></td>
						<td width="12%"><?php echo $rowall1['PA03'];?></td>
						<td width="12%"><?php echo $rowall1['PA04'];?></td>
						<td width="12%"><?php echo $rowall1['PA05'];?></td>
						<td width="12%"><?php echo $rowall1['PA06'];?></td>
						<td width="12%"><?php echo $rowall1['PA07'];?></td>
						<td width="12%"><?php echo $rowall1['PA08'];?></td>
						<td width="12%"><?php echo $rowall1['PA09'];?></td>
						<td width="12%"><?php echo $rowall1['PA10'];?></td>
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

	  <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="5%">เขตสุขภาพ</th>
					  <th width="12%">จังหวัด</th>
					  <th width="12%">บุคลากรที่ผ่านการอบรม หลักสูตร MCATT (คน)</th>
					  <th width="12%">ผู้ได้รับผลกระทบจากเหตุการณ์วิกฤต/ภัยพิบัติ (คน)</th>
					  <th width="12%">สัดส่วน (บุคลากร : ผู้ได้รับผลกระทบ)</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
				  		$i = 0;

						while($rowall2 = mysqli_fetch_array($objall2)){
							$i++;
				  ?>
          			<tr align="center">
						<td width="5%"><?php echo $rowall2['CODE_HMOO'];?></td>
						<td width="12%"><?php echo $rowall2['CODE_PROVINCE'];?></td>
						<td width="12%"><?php echo $rowall2['total_personnel'];?></td>
						<td width="12%"><?php echo $rowall2['total_reports'];?></td>
						<td width="12%"><?php echo '1'.':'.number_format($rowall2['total_reports']/$rowall2['total_personnel'], 2, '.', ',');?></td>
						

				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>

				  <table id="example4" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
					  <th width="5%">เขตสุขภาพ</th>
					  <th width="12%">จังหวัด</th>
					  <th width="12%">บุคลากรที่ผ่านการอบรม หลักสูตร MCATT (คน)</th>
					  <th width="12%">ผู้ได้รับผลกระทบจากเหตุการณ์วิกฤต/ภัยพิบัติ (คน)</th>
					  <th width="12%">สัดส่วน (บุคลากร : ผู้ได้รับผลกระทบ)</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
				  		$j = 0;

						while($rowall2_1 = mysqli_fetch_array($objall2_1)){
							$j++;
				  ?>
          			<tr align="center">
						<td width="5%"><?php echo $rowall2_1['CODE_HMOO'];?></td>
						<td width="12%"><?php echo $rowall2_1['CODE_PROVINCE'];?></td>
						<td width="12%"><?php echo $rowall2_1['total_personnel'];?></td>
						<td width="12%"><?php echo $rowall2_1['total_reports'];?></td>
						<td width="12%"><?php echo '1'.':'.number_format($rowall2_1['total_reports']/$rowall2_1['total_personnel'], 2, '.', ',');?></td>
						

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

		

		
     
	 <script>
		 

  const ctx9 = document.getElementById('myChart9');

  new Chart(ctx9, {
    type: 'doughnut',
    data: {
      labels: [ 'Psychiatric Ward', 'Psychiatric Unit', 'Integrated Bed'],
      datasets: [{
        label: 'จำนวน',
		backgroundColor: [
		  '#3EB567',
		  '#EB5F28',
		  '#425BD6'
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
       <?php echo $datamap; ?>
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
            text: ''
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
        colorAxis: {
            min: 1,
            type: 'logarithmic',
            minColor: '#f8f8f8',
            maxColor: '#318fb5',
            stops: [
                [0, '#f8f8f8'],
                [0.4, '#d4edf4'],
				[0.8, '#98d6fc'],
                [11, '#318fb5']
            ]
        },

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
                    from: 10,
                    color: '#318fb5',
                    name: '> 10 คน'
				},{
					from: 10,
                    to: 5,
                    color: '#98d6fc',
                    name: '5 - 10 คน'
                },{
                    to: 5,
                    color: '#d4edf4',
                    name: '< 5 คน'
                }, {
                    to: 0,
                    color: '#f8f8f8',
                    name: 'ไม่มี'
                }]
            },

        series: [{
            data: data,
			
            name: ' ',
			/*
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
      <?php echo $datamap2; ?>
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
            text: ''
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
                    from: 700,
                    color: '#318fb5',
                    name: '> 699 คน'
				},{
					from: 699,
                    to: 200,
                    color: '#98d6fc',
                    name: '299 - 699 คน'
                },{
                    to: 299,
                    color: '#d4edf4',
                    name: '< 299 คน'
                }, {
                    to: 0,
                    color: '#f8f8f8',
                    name: 'ไม่มี'
                }]
            },

        series: [{
            data: data,
			
            name: ' ',
			/*
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
      "responsive": false, "lengthChange": false, "autoWidth": false,
   	  "scrollX": 500,
     // "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$('#example2').DataTable({
	  "responsive": true, "lengthChange": false, "autoWidth": true,
   	  "scrollX": 300,
     // "buttons": ["copy", "csv", "excel", "pdf"]
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
	$("#example4").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,
	  "searching": false, "lengthChange": false, "info": false,
	  "paging": false,
      "buttons": ["copy", "csv", "excel", { 
      extend: 'print',
      text: 'PDF'
   },
    //"print"
	]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard07.php'; 
        });

      
</script>

</body>
</html>
