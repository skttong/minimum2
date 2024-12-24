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
if(trim($_POST['TYPE_SERVICE'])<>'ทั้งหมด'){
if (isset($_POST['CODE_PROVINCE']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_PROVINCE = '".$_POST['CODE_HMOO']."'";
	}
}
*/

$Year = '2567';

$sql1 = "SELECT
  SUM(CASE WHEN r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'dr01', 
  SUM(CASE WHEN r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr02', 
  SUM(CASE WHEN r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'dr03', 
  SUM(CASE WHEN r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr04' 
FROM
  personnel p
JOIN hospitalnew e ON e.CODE5 = p.HospitalID
WHERE 1
AND p.r2 = 'Full-Time'
";
/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql1 = $sql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
}
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql1 = $sql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql1 = $sql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql1 = $sql1."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql1 = $sql1."AND e.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}


if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql1 = $sql1."AND e.HOS_TYPE LIKE ('".$mySelect."%')" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql1 = $sql1."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql1 = $sql1."AND p.HospitalID = '".$CODE_HOS."'" ;
  }
}


$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$dr01 =  $row1['dr01'];
$dr02 =  $row1['dr02'];
$dr03 =  $row1['dr03'];
$dr04 =  $row1['dr04'];

$tsql1 = "SELECT
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'tdr01',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'tdr02',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'tdr03',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'อื่น ๆ' THEN 1 ELSE 0 END) AS 'tdr04'
FROM
  personnel p
JOIN hospitalnew e ON e.CODE5 = p.HospitalID
WHERE 1
";

$Year = '2567';

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $tsql1 = $tsql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
}
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$tsql1 = $tsql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$tsql1 = $tsql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $tsql1 = $tsql1."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $tsql1 = $tsql1."AND e.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $tsql1 = $tsql1."AND e.HOS_TYPE = '".$mySelect."'" ;
  }
}


if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $tsql1 = $tsql1."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $tsql1 = $tsql1."AND p.HospitalID = '".$CODE_HOS."'" ;
  }
}



$tobj1 = mysqli_query($con, $tsql1);
$trow1 = mysqli_fetch_array($tobj1);

$tdr01 =  $trow1['tdr01'];
$tdr02 =  $trow1['tdr02'];
$tdr03 =  $trow1['tdr03'];
$tdr04 =  $trow1['tdr04'];

 $sql2 = "WITH trained_personnel AS (
  SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID, b.personnelDate,
         SUBSTRING_INDEX(b.training, ',', 1) AS Countries1,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 2), ',', -1) AS Countries2,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 3), ',', -1) AS Countries3,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 4), ',', -1) AS Countries4,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 5), ',', -1) AS Countries5,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 6), ',', -1) AS Countries6,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.training, ',', 7), ',', -1) AS Countries7
  FROM personnel b
  JOIN hospitalnew e ON e.CODE5 = b.HospitalID
  WHERE b.positiontypeID = '2' AND b.setdel = '1'";

/*if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql2 = $sql2."AND YEAR(b.personnelDate) = '".$Year."'" ;
}*/

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql2 = $sql2."AND b.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql2 = $sql2."AND b.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql2 = $sql2."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql2 = $sql2."AND e.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql2 = $sql2."AND e.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql2 = $sql2."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql2 = $sql2."AND b.HospitalID = '".$CODE_HOS."'" ;
  }
}

$sql2=$sql2."
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
FROM hospitalnew hosn
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
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 2), ',', -1) AS Countries2,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 3), ',', -1) AS Countries3,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 4), ',', -1) AS Countries4,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 5), ',', -1) AS Countries5,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 6), ',', -1) AS Countries6,
         SUBSTRING_INDEX(SUBSTRING_INDEX(b.statuscong, ',', 7), ',', -1) AS Countries7
  FROM personnel b
  JOIN hospitalnew e ON e.CODE5 = b.HospitalID
  WHERE b.positiontypeID = '2' AND b.setdel = '1'
  ";

/*if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $tsql2 = $tsql2."AND YEAR(b.personnelDate) = '".$Year."'" ;
}
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$tsql2 = $tsql2."AND b.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$tsql2 = $tsql2."AND b.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $tsql2 = $tsql2."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $tsql2 = $tsql2."AND e.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $tsql2 = $tsql2."AND e.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $tsql2 = $tsql2."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $tsql2 = $tsql2."AND b.HospitalID = '".$CODE_HOS."'" ;
  }
}

$tsql2=$tsql2."
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
WHERE p.positiontypeID = '3' AND p.setdel = '1' ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql3 = $sql3."AND YEAR(p.personnelDate) = '".$Year."'" ;
}  
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql3 = $sql3."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql3 = $sql3."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql3 = $sql3."AND h.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql3 = $sql3."AND h.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql3 = $sql3."AND h.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql3 = $sql3."AND h.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql3 = $sql3."AND p.HospitalID = '".$CODE_HOS."'" ;
  }
}

$obj3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($obj3);

$SC =  $row3['total'];

$sql4 = "SELECT
    SUM(CASE WHEN personnel.positionrole = 'นักจิตวิทยา' THEN 1 ELSE 0 END) AS TC01,
    SUM(CASE WHEN personnel.positionrole = 'นักจิตวิทยาคลินิก' THEN 1 ELSE 0 END) AS TC02
FROM
    personnel
JOIN hospitalnew ON hospitalnew.CODE5 = personnel.HospitalID
WHERE
    personnel.positiontypeID = '4'
    AND setdel = '1'
    ";
/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql4 = $sql4."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql4 = $sql4."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql4 = $sql4."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql4 = $sql4."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql4 = $sql4."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql4 = $sql4."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}


if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql4 = $sql4."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql4 = $sql4."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}

$obj4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_array($obj4);

$TC01 =  0;
$TC02 =  0;
$TCtotal = 0;

if (isset($row4)) {
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
}

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
    AND personnel.positionrole = 'นักจิตวิทยา'
    ";
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
			personnel.positiontypeID  = '5'
		AND 
			personnel.setdel = '1' ";
/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql5 = $sql5."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql5 = $sql5."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql5 = $sql5."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql5 = $sql5."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql5 = $sql5."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql5 = $sql5."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql5 = $sql5."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql5 = $sql5."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}



//$sql5 = $sql5."GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$obj5 = mysqli_query($con, $sql5);
$row5 = mysqli_fetch_array($obj5);

$TOC = 0 ;
if (isset($row5)) {
$TOC =  $row5['total'];
}

$sql6 = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			personnel.positiontypeID	= '6'
		AND 
			personnel.setdel = '1' ";
/*      
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql6 = $sql6."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql6 = $sql6."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql6 = $sql6."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql6 = $sql6."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql6 = $sql6."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql6 = $sql6."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql6 = $sql6."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql6 = $sql6."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}

//$sql6 = $sql6."GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$obj6 = mysqli_query($con, $sql6);
$row6 = mysqli_fetch_array($obj6);

$TOC2 = 0 ;

if (isset($row6)) {
$TOC2 =  $row6['total'];
}
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
			setdel = '1' ";
/*      
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql7 = $sql7."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql7 = $sql7."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql7 = $sql7."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql7 = $sql7."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql7 = $sql7."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql7 = $sql7."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql7 = $sql7."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql7 = $sql7."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}

//$sql7 = $sql7."GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$obj7 = mysqli_query($con, $sql7);
$row7 = mysqli_fetch_array($obj7);

$TOC3 = 0;

if (isset($row7)) {
$TOC3 =  $row7['total'];
}
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
			setdel = '1' ";
/*      
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql8 = $sql8."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql8 = $sql8."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql8 = $sql8."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql8 = $sql8."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql8 = $sql8."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}


if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql8 = $sql8."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}


if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql8 = $sql8."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql8 = $sql8."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}

//$sql8 = $sql8."GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$obj8 = mysqli_query($con, $sql8);
$row8 = mysqli_fetch_array($obj8);

$TOC4 = 0;
if (isset($row8)) {
$TOC4 =  $row8['total'];
}

$sqlhl = "SELECT 
			hospitalnew.CODE_HMOO,
			hospitalnew.CODE_PROVINCE,
			COUNT(*) AS 'total'
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		WHERE 
			positiontypeID	= '9'
		AND 
			setdel = '1' ";
/*      
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlhl = $sqlhl."AND YEAR(personnel.personnelDate) = '".$Year."'" ;
} 
*/  

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlhl = $sqlhl."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlhl = $sqlhl."AND personnel.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND personnel.personnelDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sqlhl = $sqlhl."AND hospitalnew.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlhl = $sqlhl."AND hospitalnew.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sqlhl = $sqlhl."AND hospitalnew.HOS_TYPE = '".$mySelect."'" ;
  }
}


if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sqlhl = $sqlhl."AND hospitalnew.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sqlhl = $sqlhl."AND personnel.HospitalID = '".$CODE_HOS."'" ;
  }
}

//$sqlhl = $sqlhl."GROUP BY hospitalnew.CODE_HMOO, hospitalnew.CODE_PROVINCE ;";

$objhl = mysqli_query($con, $sqlhl);
$rowhl = mysqli_fetch_array($objhl);

//print_r($rowhl) ;

$TOC5 = 0;
if (isset($rowhl)) {
 $TOC5 = $rowhl['total'];
}


$sql9 = "SELECT  
			SUM(b.Ward_no) AS Ward_no  , 
			SUM(b.Unit) AS Unit ,
			SUM(b.Unit_no) AS Unit_no
		FROM bed b  
    JOIN hospitalnew hn on hn.CODE5 = b.hospitalCode5 
    where 1 ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql9 = $sql9."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
*/

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql9 = $sql9."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql9 = $sql9."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
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

$Ward_no = $row9['Ward_no'];
$Unit = $row9['Unit'];
$Unit_no = $row9['Unit_no'];

$sql11 = "SELECT SUM(ect_no) AS ect_no ,SUM(tms_no) AS tms_no
		FROM ect e
    JOIN hospitalnew hn on hn.CODE5 = e.hospitalCode5 
    where 1 ";
/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql11 = $sql11."AND YEAR(e.ectDate) = '".$Year."'" ;
} 
*/
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql11 = $sql11."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sql11 = $sql11."AND e.ectDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND e.ectDate <= CONCAT(".$Year.", '-09-30')";
  }


if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sql11 = $sql11."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql11 = $sql11."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sql11 = $sql11."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql11 = $sql11."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql11 = $sql11."AND hn.CODE5 = '".$CODE_HOS."'" ;
  }
}


$obj11 = mysqli_query($con, $sql11);
$row11 = mysqli_fetch_array($obj11);

$ect_no = $row11['ect_no'];
$tms_no = $row11['tms_no'];


$sqlmid = "SELECT
    SUM(CODE_MALE) AS Total_Male,
    SUM(CODE_FEMALE) AS Total_Female,
    SUM(CODE_TOTAL) AS Total
FROM Midyear ;
";
$objmid = mysqli_query($con, $sqlmid);
$rowmid = mysqli_fetch_array($objmid);

$Total_Male = $rowmid['Total_Male'];
$Total_Female = $rowmid['Total_Female'];
$Totalmidy = $rowmid['Total'];


$msql1 = "SELECT
  m.CODE_map02,m.CODE_PROVINCETH,
  SUM(h.a_total) AS total_a,
  SUM(h.b_total) AS total_b,
  SUM(h.total_bed) AS total_bed
FROM
  HDCTBBED h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE "
;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
  $msql1 = $msql1."WHERE h.b_year = '".$Year."'" ;
}else{
  if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1+543;
	}else{
		$Year = (date("Y"))+543;
	}
  $msql1 = $msql1."WHERE h.b_year = '".$Year."'" ;
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

$msql1 = $msql1 ."
GROUP BY
  m.CODE_map02,m.CODE_PROVINCETH;

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_bed'] <> 0){
		$datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".number_format(($mrow1['total_bed']/$Totalmidy*100000), 2, '.', ',').",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}

 /*     {
            "hc-key": "th-un",
            "value": 76,
             "name": "จุด2",
        "color": "#00FF00"
        },
        {
            "hc-key": "th-nb",
            "value": 77,
            "name": "จุด1",
            "color": "#FF00FF"
        }*/

 $sql10 = "SELECT
  SUM(h.a_total) AS total_a,
  SUM(h.b_total) AS total_b,
  SUM(h.total_bed) AS total_bed
FROM
  HDCTBBED h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE "
;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
  $sql10 = $sql10."WHERE h.b_year = '".$Year."'" ;
}else{
  if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1+543;
	}else{
		$Year = (date("Y"))+543;
	}
  $sql10 = $sql10."WHERE h.b_year = '".$Year."'" ;
}





if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql10 = $sql10."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sql10 = $sql10."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql10 = $sql10."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql10 = $sql10."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql10 = $sql10."AND hn.CODE5 = '".$CODE_HOS."'" ;
  }
}


$obj10 = mysqli_query($con, $sql10);
$row10 = mysqli_fetch_array($obj10);

$total_b = $row10['total_b'];
if($total_b == ''){
  $total_b = 0;
}
$total_a = $row10['total_a'];
if($total_a == ''){
  $total_a = 0;
}
$total_bed = $row10['total_bed'];
if($total_bed == ''){
  $total_bed = 0;
}


$sqlhdc01 = "SELECT
  h.groupcode, ";
  /*
  SUM(CASE WHEN h.b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN h.b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN h.b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN h.b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN h.b_year = '2563' THEN total ELSE 0 END) AS total_2563
  */
  for($i=0; $i < (5); $i++) {
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      if($i == 4){
        $sqlhdc01 = $sqlhdc01."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc01 = $sqlhdc01."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
    }else{
      
      if($i == 4){
        $sqlhdc01 = $sqlhdc01."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc01 = $sqlhdc01."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
      }
  }
$sqlhdc01 = $sqlhdc01."
FROM
  HDCTB01 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE 1  "
;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
  $sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
}else{
  if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
  }
  //$sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
}


if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sqlhdc01 = $sqlhdc01."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlhdc01 = $sqlhdc01."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sqlhdc01 = $sqlhdc01."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sqlhdc01 = $sqlhdc01."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sqlhdc01 = $sqlhdc01."AND hn.CODE5 = '".$CODE_HOS."'" ;
  }
}

$sqlhdc01 = $sqlhdc01."  
GROUP BY
  groupcode;";


$objhdc01 = mysqli_query($con, $sqlhdc01);
//$rowhdc01 = mysqli_fetch_array($objhdc01);

$hdc01_1 ='';
$hdc01_2 ='';
$hdc01_3 ='';
$hdc01_41 ='';
$hdc01_42 ='';

$labelhdc01 = ''; // ทำให้ค่าว่างก่อนเริ่ม
$years = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years[] = (date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years[] = (date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

// เปลี่ยนลำดับให้เป็นจากปีเก่าที่สุด (2564) ไปถึงปีใหม่ (2568)
$years = array_reverse($years); // สลับลำดับปี

// สร้าง label สำหรับการแสดงผล
foreach ($years as $index => $year) {
    if ($index == count($years) - 1) {
        $labelhdc01 .= "'ปี $year' "; // ปีสุดท้าย (2568)
    } else {
        $labelhdc01 .= "'ปี $year',"; // ปีอื่นๆ
    }
}

$years2 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years2[] = 'total_'.(date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years2[] = 'total_'.(date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

//print_r($years2);



while($rowhdc01 = mysqli_fetch_array($objhdc01))
{
	if($rowhdc01['groupcode'] == '1.1'){
		$hdc01_1 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
	}else if($rowhdc01['groupcode'] == '2.0'){
		$hdc01_2 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
	}else if($rowhdc01['groupcode'] == '3.0'){
		$hdc01_3 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
	}else if($rowhdc01['groupcode'] == '4.1'){
		$hdc01_41 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
	}else if($rowhdc01['groupcode'] == '4.2'){
		$hdc01_42 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
	}
	//['th-ct', 10],
}

$sqlhdc02 = "SELECT
  h.groupcode, ";
  /*
  SUM(CASE WHEN h.b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN h.b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN h.b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN h.b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN h.b_year = '2563' THEN total ELSE 0 END) AS total_2563
  */
  for($i=0; $i < (5); $i++) {
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      if($i == 4){
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN h.b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN h.b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
    }else{
      
      if($i == 4){
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN h.b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN h.b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
      }
  }

$sqlhdc02 = $sqlhdc02."
FROM
  HDCTB02 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE 1  "
;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
  $sqlhdc02 = $sqlhdc02."AND h.b_year = '".$Year."'" ;
}else{
  if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
  }
 // $sqlhdc02 = $sqlhdc02."AND h.b_year = '".$Year."'" ;
}


if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sqlhdc02 = $sqlhdc02."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlhdc02 = $sqlhdc02."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sqlhdc02 = $sqlhdc02."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sqlhdc02 = $sqlhdc02."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sqlhdc02 = $sqlhdc02."AND hn.CODE5 = '".$CODE_HOS."'" ;
  }
}

$sqlhdc02 = $sqlhdc02."  
GROUP BY
  groupcode;";

  //echo $sqlhdc01;

$objhdc02 = mysqli_query($con, $sqlhdc02);
//$rowhdc01 = mysqli_fetch_array($objhdc01);

$hdc02_1 ='';
$hdc02_2 ='';
$hdc02_3 ='';
$hdc02_41 ='';
$hdc02_42 ='';

$labelhdc02 = ''; // ทำให้ค่าว่างก่อนเริ่ม
$years3 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years3[] = (date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years3[] = (date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

// เปลี่ยนลำดับให้เป็นจากปีเก่าที่สุด (2564) ไปถึงปีใหม่ (2568)
$years3 = array_reverse($years3); // สลับลำดับปี

// สร้าง label สำหรับการแสดงผล
foreach ($years3 as $index => $year) {
    if ($index == count($years3) - 1) {
        $labelhdc02 .= "'ปี $year' "; // ปีสุดท้าย (2568)
    } else {
        $labelhdc02 .= "'ปี $year',"; // ปีอื่นๆ
    }
}

$years4 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years4[] = 'total_'.(date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years4[] = 'total_'.(date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

//print_r($years2);

while($rowhdc02 = mysqli_fetch_array($objhdc02))
{
	if($rowhdc02['groupcode'] == '1.1'){
		$hdc02_1 = "'".$rowhdc02[$years4[4]]."','".$rowhdc02[$years4[3]]."','".$rowhdc02[$years4[2]]."','".$rowhdc02[$years4[1]]."','".$rowhdc02[$years4[0]]."'";
	}else if($rowhdc02['groupcode'] == '2.0'){
		$hdc02_2 = "'".$rowhdc02[$years4[4]]."','".$rowhdc02[$years4[3]]."','".$rowhdc02[$years4[2]]."','".$rowhdc02[$years4[1]]."','".$rowhdc02[$years4[0]]."'";
	}else if($rowhdc02['groupcode'] == '3.0'){
		$hdc02_3 = "'".$rowhdc02[$years4[4]]."','".$rowhdc02[$years4[3]]."','".$rowhdc02[$years4[2]]."','".$rowhdc02[$years4[1]]."','".$rowhdc02[$years4[0]]."'";
	}else if($rowhdc02['groupcode'] == '4.1'){
		$hdc02_41 = "'".$rowhdc02[$years4[4]]."','".$rowhdc02[$years4[3]]."','".$rowhdc02[$years4[2]]."','".$rowhdc02[$years4[1]]."','".$rowhdc02[$years4[0]]."'";
	}else if($rowhdc02['groupcode'] == '4.2'){
		$hdc02_42 = "'".$rowhdc02[$years4[4]]."','".$rowhdc02[$years4[3]]."','".$rowhdc02[$years4[2]]."','".$rowhdc02[$years4[1]]."','".$rowhdc02[$years4[0]]."'";
	}
}

//echo $hdc02_1 ;
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
              <h3>ข้อมูลภาพรวม</h3>
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
          <form class="form-valide" action="dashboard01.php" method="post" id="myForm1" name="myForm1">  
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
                    <h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($dr01), 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format(($dr01/$Totalmidy*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
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
					          <h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($dr02), 0, '.', ',') ;?> คน</h3>
                    <p><?php echo number_format((($dr02 / $Totalmidy)*100000), 4, '.', ','); ?> : 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($total_bed), 0, '.', ',') ;?> เตียง</h3>
                    <p><?php echo number_format((($total_bed / $Totalmidy)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
                    <p>ข้อมูลจาก HDC</p>
					
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
                    <?php 
                    
                          // วันที่เริ่มต้น
                          $startDate = '2023-10-01';

                          // แปลงวันที่เป็นวัตถุ DateTime
                          $startDateTime = new DateTime($startDate);

                          // หาวันที่ปัจจุบัน
                          $now = new DateTime();

                          // หาช่วงเวลาต่างกัน (ในหน่วยวัน)
                          $interval = $now->diff($startDateTime);
                          $days = $interval->days;

                          //echo "จำนวนวันนับจากวันที่ $startDate ถึงวันนี้ คือ $days วัน";
                    
                    ?>
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php 
          if($total_b<>0){
            echo number_format(($total_b*100/$total_bed/$days), 2, '.', ',') ;
          }else{
            echo '0';
          }
          
          ?> %</h3>
                    <p> <small>&nbsp;</small></p>
                    <!--<p>xx : 1แสน ประชากร</p>-->
                    <p>ข้อมูลจาก HDC</p>
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
					          <h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($nu02), 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($nu02 / $Totalmidy)*100000), 4, '.', ',') ;?>  : 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($nu04), 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($nu04 / $Totalmidy)*100000), 4, '.', ',');?>  : 1แสน ประชากร</p>
					
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
					<a href="#"><canvas id="myChart4" style="min-height: 100%; height: 380px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx4 = document.getElementById('myChart4');

                         const downloadButton2 = document.getElementById('download-button2');

const myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: ['พยาบาลเฉพาะทางสุขภาพจิตและจิตเวช', 'พยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น', 'พยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด', 'พยาบาลเฉพาะทางผู้สูงอายุ'],
        datasets: [{
            label: 'ปฏิบัติงาน',
            data: [<?php echo $nu02.','.$nu04.','.$nu05.','.$nu03.','.$nu06.','.$nu07;?>],
            backgroundColor: '#6CE5E8',
            borderColor: '#6CE5E8',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'กำลังศึกษาต่อเฉพาะทาง',
            data: [<?php echo $tnu02.','.$tnu04.','.$tnu05.','.$tnu03.','.$tnu06.','.$tnu07;?>],
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
						<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($SC), 0, '.', ',');?> คน</h3>
						<p><?php echo number_format((($SC / $Totalmidy)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
						
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
		<div class="col-md-6">
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFDADA; color: black;">
				  <div class="inner">
                    
                    <p>นักจิตวิทยา</p>
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($TCtotal), 0, '.', ',') ;?> คน</h3>
                    <p><?php echo number_format((($TCtotal / $Totalmidy)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format($TOC, 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($TOC / $Totalmidy)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format($TOC2 , 0, '.', ',') ;?> คน</h3>
                    <p><?php echo number_format((($TOC2 / $Totalmidy)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($TOC3), 0, '.', ',')  ;?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo number_format((($TOC3 / $Totalmidy)*100000), 4, '.', ',') ;?> : 1แสน ประชากร</p>
					
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
					<h3 class="card-title">นักจิตวิทยา</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button3"><img width="10%" src="images/downloand.png"></button>
					</div>
                   
				</div>

				<div class="card-body" align="center">
	
					<a href="tables-2.php"><canvas id="myChart9" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas></a>
						
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($TOC4), 0, '.', ',')   ;?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo number_format((($TOC4 / $Totalmidy)*100000), 4, '.', ',')  ;?>: 1แสน ประชากร</p>
					
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
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($TOC5), 0, '.', ',');?> คน</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <p><?php echo number_format((($TOC5 / $Totalmidy)*100000), 4, '.', ',') ;?> : 1แสน ประชากร</p>
                    
					
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
					<h3><i class="fas" style="color:#FFFFFF;">&nbsp;</i><?php echo $ect_no;?> เครื่อง</h3>
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
				<div class="card-header">
					<h3 class="card-title">ผู้ป่วยนอกจิตเวช</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button5"><img width="10%" src="images/downloand.png"></button>
					</div>
                   
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx5 = document.getElementById('myChart5');

						 
                         const downloadButton5 = document.getElementById('download-button5');

const myChart5 = new Chart(ctx5, {
    type: 'line',
    data: {
        labels: [<?php echo $labelhdc01; ?>],
        datasets: [{
            label: 'ความผิดปกติทางจิตและพฤติกรรมที่เกิดจากการใช้สารออกฤทธิ์ต่อจิตประสาท(F10-F19)',
            data: [<?php echo $hdc01_2;?>],
            backgroundColor: '#00cadc',
            borderColor: '#00cadc',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'โรคจิตเภท พฤติกรรมแบบโรคจิตเภท และโรคหลงผิด (F20-F29)',
            data: [<?php echo $hdc01_3;?>],
            backgroundColor: '#49c3fb',
            borderColor: '#49c3fb',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'โรคซึมเศร้า(F32,F33,F34.1,F38,F39)',
            data: [<?php echo $hdc01_42;?>],
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
            data: [<?php echo $hdc01_1;?>],
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
					<a href="#"><canvas id="myChart6" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx6 = document.getElementById('myChart6');

                         const downloadButton6 = document.getElementById('download-button6');

const myChart6 = new Chart(ctx6, {
    type: 'line',
    data: {
        labels: [<?php echo $labelhdc02 ; ?>],
        datasets: [{
            label: 'ความผิดปกติทางจิตและพฤติกรรมที่เกิดจากการใช้สารออกฤทธิ์ต่อจิตประสาท(F10-F19)',
            data: [<?php echo $hdc02_2;?>],
            backgroundColor: '#00cadc',
            borderColor: '#00cadc',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'โรคจิตเภท พฤติกรรมแบบโรคจิตเภท และโรคหลงผิด (F20-F29)',
            data: [<?php echo $hdc02_3;?>],
            backgroundColor: '#49c3fb',
            borderColor: '#49c3fb',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'โรคซึมเศร้า(F32,F33,F34.1,F38,F39)',
            data: [<?php echo $hdc02_42;?>],
            backgroundColor: '#65a6fa',
            borderColor: '#65a6fa',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
		},
        {
            label: 'ไบโพล่า(F31)',
            data: [<?php echo $hdc02_41;?>],
            backgroundColor: '#7e80e7',
            borderColor: '#7e80e7',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset	
		},
        {
            label: 'โรคสมองเสื่อม(F00-F03)',
            data: [<?php echo $hdc02_1;?>],
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
            labels: ['นักจิตวิทยา', 'นักจิตวิทยาคลินิค'],
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
 
            mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
                 name: 'จำนวนต่อแสนประชากร',
                // states: {
                //     hover: {
                //         color: '#BADA55'
                //     }
                // },
                // dataLabels: {
                //     enabled: true,
                //     format: '{point.name}'
                // }
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

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard01.php'; 
        });

      
</script>

</body>
</html>
