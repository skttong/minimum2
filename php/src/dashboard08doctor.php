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

  /*
	if($position == 'แพทย์'){
		header("Location: dashboard08doctor.php");
	}else*/if($position == 'พยาบาล'){
		header("Location: dashboard08nurse.php");
	}elseif($position == 'เภสัชกร'){
		header("Location: dashboard08medicine.php");
	}elseif($position == 'นักจิตวิทยา'){
		header("Location: dashboard08heart.php");
	}elseif($position == 'นักสังคมสงเคราะห์'){
		header("Location: dashboard08social.php");
	}elseif($position == 'นักกิจกรรมบำบัด'){
		header("Location: dashboard08physical-therapy.php");
	}elseif($position == 'เวชศาสตร์สื่อความหมาย'){
		header("Location: dashboard08translation.php");
	}elseif($position == 'นักวิชาการศึกษาพิเศษ'){
		header("Location: dashboard08education.php");
	}elseif($position == 'นักวิชาการสาธารณสุข'){
		header("Location: dashboard08health.php");
	}elseif($position == 'วิชาชีพอื่นๆ'){
		header("Location: dashboard08other.php");
	}
}


$sql1 = "WITH PersonnelCounts AS (
  SELECT
    SUM(CASE WHEN p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'dr01',
    SUM(CASE WHEN p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr02',
    SUM(CASE WHEN p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'dr03',
    SUM(CASE WHEN p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr04',
    SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'tdr01',
    SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'tdr02',
    SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'tdr03',
    SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'อื่น ๆ' THEN 1 ELSE 0 END) AS 'tdr04'
  FROM personnel p
  JOIN hospitalnew hn ON hn.CODE5 = p.HospitalID
  WHERE
  p.Mcatt1 = 'ใช่'
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
	$sql1 = $sql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sql1 = $sql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
    }

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $sql1 = $sql1."AND hn.Affiliation = '".$Affiliation."'" ;
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

$sql1 = $sql1."
)
SELECT * FROM PersonnelCounts;";
$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$dr01 =  $row1['dr01'];
$dr02 =  $row1['dr02'];
$dr03 =  $row1['dr03'];
$dr04 =  $row1['dr04'];
$vdr = $dr01.",".$dr02.",".$dr03.",".$dr04;
$tdr01 =  $row1['tdr01'];
$tdr02 =  $row1['tdr02'];
$tdr03 =  $row1['tdr03'];
$tdr04 =  $row1['tdr04'];
$vtdr = $tdr01.",".$tdr02.",".$tdr03.",".$tdr04;


$sql3 = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ')AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
AND 
  p.r2 = 'Full-Time'
";

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
	$sql3 = $sql3."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sql3 = $sql3."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
    }

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $sql3 = $sql3."AND hn.Affiliation = '".$Affiliation."'" ;
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

 //echo    $sql3;

$obj3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_array($obj3);

$MA01 = $row3['MA01'];
$MA02 = $row3['MA02'];
$MA03 = $row3['MA03'];
$MA04 = $row3['MA04'];

$sql4 = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') AND p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'MA01_1',
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') AND p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA01_2',
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') AND p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'MA01_3',
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ') AND p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA01_4',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด')  AND p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'MA02_1',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด')  AND p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA02_2',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด')  AND p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'MA02_3',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด')  AND p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA02_4',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'MA03_1',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA03_2',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'MA03_3',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA03_4',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'MA04_1',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA04_2',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'MA04_3',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA04_4'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
AND 
  p.r2 = 'Full-Time'
";

/*
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql4 = $sql4."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year']-543;
    $sql4 = $sql4."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1;
    }else{
      $Year = (date("Y"));
    }
    $sql4 = $sql4."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }

  
  if (isset($_POST['CODE_HMOO'])) {
	if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
	$CODE_HMOO = $_POST['CODE_HMOO'];
	$sql4 = $sql4."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
	}
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sql4 = $sql4."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
    }

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $sql4 = $sql4."AND hn.Affiliation = '".$Affiliation."'" ;
      }
      }
  
  if (isset($_POST['TYPE_SERVICE'])) {
	if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
	$mySelect = trim($_POST['TYPE_SERVICE']);
	$sql4 = $sql4."AND hn.HOS_TYPE = '".$mySelect."'" ;
	}
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sql4 = $sql4."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
    }
    
    if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sql4 = $sql4."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
    } 

$obj4 = mysqli_query($con, $sql4);
$row4 = mysqli_fetch_array($obj4);

$dr01total = $row4['MA01_1'].",".$row4['MA01_2'].",".$row4['MA01_3'].",".$row4['MA01_4'];
$dr02total = $row4['MA02_1'].",".$row4['MA02_2'].",".$row4['MA02_3'].",".$row4['MA02_4'];
$dr03total = $row4['MA03_1'].",".$row4['MA03_2'].",".$row4['MA03_3'].",".$row4['MA03_4'];
$dr04total = $row4['MA04_1'].",".$row4['MA04_2'].",".$row4['MA04_3'].",".$row4['MA04_4'];



$MOOsql1 = "WITH PersonnelCounts AS (
  SELECT
     hn.CODE_HMOO,
    SUM(CASE WHEN p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'MA01',
    SUM(CASE WHEN p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA02',
    SUM(CASE WHEN p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'MA03',
    SUM(CASE WHEN p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'MA04'
  FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
  WHERE
  p.Mcatt1 = 'ใช่'
  AND 
  p.r2 = 'Full-Time'

";

/*
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$MOOsql1 = $MOOsql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year']-543;
    $MOOsql1 = $MOOsql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1;
    }else{
      $Year = (date("Y"));
    }
    $MOOsql1 = $MOOsql1."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
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

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $MOOsql1 = $MOOsql1."AND hn.Affiliation = '".$Affiliation."'" ;
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
  GROUP BY hn.CODE_HMOO
)
SELECT * FROM PersonnelCounts;
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


while($Mrow1 = mysqli_fetch_array($Mobj1))
{
	if($Mrow1['CODE_HMOO'] == 1){
		$Hmoo01_1 = $Mrow1['MA01'];
		$Hmoo01_2 = $Mrow1['MA02'];
		$Hmoo01_3 = $Mrow1['MA03'];
		$Hmoo01_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 2){
		$Hmoo02_1 = $Mrow1['MA01'];
		$Hmoo02_2 = $Mrow1['MA02'];
		$Hmoo02_3 = $Mrow1['MA03'];
		$Hmoo02_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 3){
		$Hmoo03_1 = $Mrow1['MA01'];
		$Hmoo03_2 = $Mrow1['MA02'];
		$Hmoo03_3 = $Mrow1['MA03'];
		$Hmoo03_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 4){
		$Hmoo04_1 = $Mrow1['MA01'];
		$Hmoo04_2 = $Mrow1['MA02'];
		$Hmoo04_3 = $Mrow1['MA03'];
		$Hmoo04_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 5){
		$Hmoo05_1 = $Mrow1['MA01'];
		$Hmoo05_2 = $Mrow1['MA02'];
		$Hmoo05_3 = $Mrow1['MA03'];
		$Hmoo05_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 6){
		$Hmoo06_1 = $Mrow1['MA01'];
		$Hmoo06_2 = $Mrow1['MA02'];
		$Hmoo06_3 = $Mrow1['MA03'];
		$Hmoo06_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 7){
		$Hmoo07_1 = $Mrow1['MA01'];
		$Hmoo07_2 = $Mrow1['MA02'];
		$Hmoo07_3 = $Mrow1['MA03'];
		$Hmoo07_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 8){
		$Hmoo08_1 = $Mrow1['MA01'];
		$Hmoo08_2 = $Mrow1['MA02'];
		$Hmoo08_3 = $Mrow1['MA03'];
		$Hmoo08_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 9){
		$Hmoo09_1 = $Mrow1['MA01'];
		$Hmoo09_2 = $Mrow1['MA02'];
		$Hmoo09_3 = $Mrow1['MA03'];
		$Hmoo09_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 10){
		$Hmoo10_1 = $Mrow1['MA01'];
		$Hmoo10_2 = $Mrow1['MA02'];
		$Hmoo10_3 = $Mrow1['MA03'];
		$Hmoo10_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 11){
		$Hmoo11_1 = $Mrow1['MA01'];
		$Hmoo11_2 = $Mrow1['MA02'];
		$Hmoo11_3 = $Mrow1['MA03'];
		$Hmoo11_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 12){
		$Hmoo12_1 = $Mrow1['MA01'];
		$Hmoo12_2 = $Mrow1['MA02'];
		$Hmoo12_3 = $Mrow1['MA03'];
		$Hmoo12_4 = $Mrow1['MA04'];
	}elseif($Mrow1['CODE_HMOO'] == 13){
		$Hmoo13_1 = $Mrow1['MA01'];
		$Hmoo13_2 = $Mrow1['MA02'];
		$Hmoo13_3 = $Mrow1['MA03'];
		$Hmoo13_4 = $Mrow1['MA04'];
	}
	//['th-ct', 10],
}

$dHMOO1 = "'เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'";

 $vMhoo1_1 = $Hmoo01_1.",".$Hmoo02_1.",".$Hmoo03_1.",".$Hmoo04_1.",".$Hmoo05_1.",".$Hmoo06_1.",".$Hmoo07_1.",".$Hmoo08_1.",".$Hmoo09_1.",".$Hmoo10_1.",".$Hmoo11_1.",".$Hmoo12_1.",".$Hmoo13_1 ;
 $vMhoo1_2 = $Hmoo01_2.",".$Hmoo02_2.",".$Hmoo03_2.",".$Hmoo04_2.",".$Hmoo05_2.",".$Hmoo06_2.",".$Hmoo07_2.",".$Hmoo08_2.",".$Hmoo09_2.",".$Hmoo10_2.",".$Hmoo11_2.",".$Hmoo12_2.",".$Hmoo13_2 ;
 $vMhoo1_3 = $Hmoo01_3.",".$Hmoo02_3.",".$Hmoo03_3.",".$Hmoo04_3.",".$Hmoo05_3.",".$Hmoo06_3.",".$Hmoo07_3.",".$Hmoo08_3.",".$Hmoo09_3.",".$Hmoo10_3.",".$Hmoo11_3.",".$Hmoo12_3.",".$Hmoo13_3 ;
 $vMhoo1_4 = $Hmoo01_4.",".$Hmoo02_4.",".$Hmoo03_4.",".$Hmoo04_4.",".$Hmoo05_4.",".$Hmoo06_4.",".$Hmoo07_4.",".$Hmoo08_4.",".$Hmoo09_4.",".$Hmoo10_4.",".$Hmoo11_4.",".$Hmoo12_4.",".$Hmoo13_4 ;


$sqlall = "WITH HospitalGroups AS (
    SELECT
        hn.CODE_PROVINCE,
        CASE 
            WHEN hn.HOS_TYPE IN ('กรมสุขภาพจิต','ศูนย์วิชาการ') THEN 'MCATT ระดับกรมสุขภาพจิต'
            WHEN hn.HOS_TYPE IN ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') THEN 'MCATT ระดับจังหวัด'
            WHEN hn.HOS_TYPE IN ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') THEN 'MCATT ระดับอำเภอ'
            WHEN hn.HOS_TYPE IN ('โรงพยาบาลส่งเสริมสุขภาพตำบล', 'ศูนย์บริการสาธารณสุข อปท.') THEN 'MCATT ระดับตำบล'
            ELSE 'Other'
        END AS HospitalGroup,
        p.r1
    FROM
        hospitalnew hn
    LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
    WHERE
        p.Mcatt1 = 'ใช่'
        AND 
  p.r2 = 'Full-Time'

";
/*
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall = $sqlall."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year']-543;
    $sqlall = $sqlall."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1;
    }else{
      $Year = (date("Y"));
    }
    $sqlall = $sqlall."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
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

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $sqlall = $sqlall."AND hn.Affiliation = '".$Affiliation."'" ;
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
)
SELECT
    CODE_PROVINCE,
    HospitalGroup,
    SUM(CASE WHEN r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'dr01',
    SUM(CASE WHEN r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr02',
    SUM(CASE WHEN r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'dr03',
    SUM(CASE WHEN r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr04'
FROM
    HospitalGroups
WHERE HospitalGroup <> 'Other'
GROUP BY
    CODE_PROVINCE, HospitalGroup;"
;

$sqlall1 = $sqlall;

$objall = mysqli_query($con, $sqlall);
$objall1 = mysqli_query($con, $sqlall1);

if (isset($_POST['CODE_HMOO'])) {

$sql3p = "SELECT
  SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ')AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA04'
FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
WHERE
  p.Mcatt1 = 'ใช่' 
AND 
  p.r2 = 'Full-Time'

";

/*
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sql3p = $sql3p."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year']-543;
    $sql3p = $sql3p."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1;
    }else{
      $Year = (date("Y"));
    }
    $sql3p = $sql3p."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
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

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $sql3p = $sql3p."AND hn.Affiliation = '".$Affiliation."'" ;
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

$MOOsql1p = "WITH PersonnelCounts AS (
  SELECT
     hn.CODE_PROVINCE,
     SUM(CASE WHEN hn.HOS_TYPE in ('กรมสุขภาพจิต','ศูนย์วิชาการ')AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA01',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลศูนย์','โรงพยาบาลทั่วไป' ,'สำนักงานสาธารณสุขจังหวัด') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA02',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลชุมชน','สำนักงานสาธารณสุขอำเภอ') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA03',
  SUM(CASE WHEN hn.HOS_TYPE in ('โรงพยาบาลส่งเสริมสุขภาพตำบล','ศูนย์บริการสาธารณสุข อปท.') AND p.positiontypeID = '1' THEN 1 ELSE 0 END) AS 'MA04'
  FROM
  hospitalnew hn 
LEFT JOIN personnel p ON hn.CODE5 = p.HospitalID
  WHERE
  Mcatt1 = 'ใช่'
AND 
  p.r2 = 'Full-Time'

";

/*
if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$MOOsql1p = $MOOsql1p."AND YEAR(p.personnelDate) = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year']-543;
    $MOOsql1p = $MOOsql1p."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
    }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1;
    }else{
      $Year = (date("Y"));
    }
    $MOOsql1p = $MOOsql1p."AND p.personnelDate >= CONCAT(".$Year-1 .",'-10-01') 
    AND p.personnelDate <= CONCAT(".$Year.", '-09-30')";
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

    if (isset($_POST['Affiliation'])) {
      if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
      $Affiliation = trim($_POST['Affiliation']);
      $MOOsql1p = $MOOsql1p."AND hn.Affiliation = '".$Affiliation."'" ;
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
  GROUP BY hn.CODE_PROVINCE
)
SELECT * FROM PersonnelCounts;
		";

  //  echo $MOOsql1p;

$Mobj1p = mysqli_query($con, $MOOsql1p);
//$row2 = mysqli_fetch_array($obj2);

$dHMOO1p = '' ;

$vMhoo1_1p = '' ;
$vMhoo1_2p = '' ; 
$vMhoo1_3p = ''; 
$vMhoo1_4p = ''; 

$i = 1 ;

while($row1p = mysqli_fetch_array($Mobj1p))
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
/*
echo $dHMOO1p;
echo "<br>";
echo $vMhoo1_1p;
echo "<br>";
echo $vMhoo1_2p;
echo "<br>";
echo$vMhoo1_3p;
echo "<br>";
echo$vMhoo1_4p;
*/

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
            <h3>ข้อมูลทรัพยากร MCATT แพทย์</h3>
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
			<form class="form-valide" action="dashboard08doctor.php" method="post" id="myform1" name="foml">  
      <div class="row">
      <div class="col-md-2">
               <div class="form-group">
                  <label> ประเภทบุคลากร</label>
                  <select name="position" class="form-control select2" id="position" style="width: 100%;">
                    <option  value="ทั้งหมด" >ทั้งหมด</option>
                    <option selected="selected" value="แพทย์" >แพทย์</option>
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
			<div class="col-lg-12">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner"><center>
                    
                    <p>ทั้งหมด</p>
					<h3><?php echo number_format(($dr01+$dr02+$dr03+$dr04), 0, '.', ',');?> คน</h3>
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
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>จิตแพทย์ผู้ใหญ่</p>
					<h3><?php echo number_format($dr01, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
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
                    
                    <p>จิตแพทย์เด็ก
                    และวัยรุ่น</p>
					<h3><?php echo number_format($dr02, 0, '.', ',') ;?> คน</h3>
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
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FDD0EC; color: black;">
				  <div class="inner">
                    
                    <p>เวชศาสตร์ป้องกัน 
                    สาขาจิตเวชชุมชน</p>
					<h3><?php echo number_format($dr03, 0, '.', ',');?> คน</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFDADA; color: black;">
				  <div class="inner">
                    
                    <p>อื่นๆ</p>
					<h3><?php echo number_format($dr04, 0, '.', ',');?> คน</h3>
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
                    data: [<?php echo $vdr ;?>],
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
               },
                {
                    label: 'กำลังศึกษาต่อเฉพาะทาง',
                    data: [<?php echo $vtdr ;?>],
                    backgroundColor: '#41b8d5',
                    borderColor: '#41b8d5',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                /* },
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
	

    

	  <!-- Default box -->
                        </div>

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

    

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<!--<h3 class="card-title">ข้อมูลแพทย์</h3>-->
          <div align="right">
						<button class="btn btn-navbar" id="download-button6" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart6" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx6 = document.getElementById('myChart6');
        
        
        const downloadButton6 = document.getElementById('download-button6');

        const myChart6 = new Chart(ctx6, {
            type: 'bar',
            data: {
                labels: ['จิตแพทย์ผู้ใหญ่', 'จิตแพทย์เด็กและวัยรุ่น', 'เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน', 'อื่นๆ'],
                datasets: [{
                    label: 'ระดับกรมสุขภาพจิต',
                    data: [<?php echo $dr01total;?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
               },
                {
                    label: 'ระดับจังหวัด',
                    data: [<?php echo $dr02total;?>],
                    backgroundColor: '#49c3fb',
                    borderColor: '#49c3fb',
                    borderWidth: 1,
                    stack: 'combined2' // Enable stacking for this dataset
                 },
                {
                    label: 'ระดับอำเภอ',
                    data: [<?php echo $dr03total;?>],
                    backgroundColor: '#65a6fa',
                    borderColor: '#65a6fa',
                    borderWidth: 1,
                    stack: 'combined3' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับตำบล',
                    data: [<?php echo $dr04total;?>],
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

downloadButton6.addEventListener('click', function() {
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

      <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">บุคลากรปฏิบัติงานวิกฤตสุขภาพจิต (MCATT) รายเขตสุขภาพ﻿</h3>
          <div align="right">
						<button class="btn btn-navbar" id="download-button7" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart7" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx7 = document.getElementById('myChart7');
        
        
        const downloadButton7 = document.getElementById('download-button7');

        const myChart7 = new Chart(ctx7, {
            type: 'bar',
            data: {
                labels: [<?php echo $dHMOO1 ;?>],
                datasets: [{
                    label: 'จิตแพทย์ผู้ใหญ่',
                    data: [<?php echo $vMhoo1_1 ;?>],
                    backgroundColor: '#00cadc',
                    borderColor: '#00cadc',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
               },
                {
                    label: 'จิตแพทย์เด็กและวัยรุ่น',
                    data: [<?php echo $vMhoo1_2 ;?>],
                    backgroundColor: '#49c3fb',
                    borderColor: '#49c3fb',
                    borderWidth: 1,
                    stack: 'combined2' // Enable stacking for this dataset
                 },
                {
                    label: 'เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน',
                    data: [<?php echo $vMhoo1_3 ;?>],
                    backgroundColor: '#65a6fa',
                    borderColor: '#65a6fa',
                    borderWidth: 1,
                    stack: 'combined3' // Enable stacking for this dataset
                },
                {
                    label: 'อื่นๆ',
                    data: [<?php echo $vMhoo1_4 ;?>],
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

downloadButton7.addEventListener('click', function() {
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
				<div class="card-header">
					<!--<h3 class="card-title">ข้อมูลแพทย์</h3>-->
          <div align="right">
						<button class="btn btn-navbar" id="download-button8" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart8" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx8 = document.getElementById('myChart8');
        
        
        const downloadButton8 = document.getElementById('download-button8');

        const myChart8 = new Chart(ctx8, {
            type: 'bar',
            data: {
                labels: [<?php echo $dHMOO1p; ?>],
                datasets: [{
                    label: 'ระดับกรมสุขภาพจิต',
                    data: [<?php echo $vMhoo1_1p; ?>],
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
                    borderWidth: 1,
                    stack: 'combined1' // Enable stacking for this dataset
                },
                {
                    label: 'ระดับจังหวัด',
                    data: [<?php echo $vMhoo1_2p; ?>],
                    backgroundColor: '#41b8d5',
                    borderColor: '#41b8d5',
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
                    backgroundColor: '#2d8bba',
                    borderColor: '#2d8bba',
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

downloadButton8.addEventListener('click', function() {
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
									<li>โรงพยาบาลส่งเสริมสุขภาพตำบล</li>
                  </ul>
								</ul>
							</span>
						</div>
                   
				</div></th>
                    <th width="12%">จิตแพทย์ผู้ใหญ่ (คน)</th>
                    <th width="12%">จิตแพทย์เด็กและวัยรุ่น (คน)</th>
                    <th width="12%">แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (คน)</th>
                    <th width="12%">อื่นๆ (คน)</th>
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
						<td width="12%"><?php echo $rowall['dr01'];?></td>
						<td width="12%"><?php echo $rowall['dr02'];?></td>
						<td width="12%"><?php echo $rowall['dr03'];?></td>
						<td width="12%"><?php echo $rowall['dr04'];?></td>
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
									<li>โรงพยาบาลส่งเสริมสุขภาพตำบล</li>
                  </ul>
								</ul>
							</span>
						</div>
                   
				</div></th>
                    <th width="12%">จิตแพทย์ผู้ใหญ่ (คน)</th>
                    <th width="12%">จิตแพทย์เด็กและวัยรุ่น (คน)</th>
                    <th width="12%">แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (คน)</th>
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
						<td width="12%"><?php echo $rowall1['HospitalGroup'];?></td>
						<td width="12%"><?php echo $rowall1['dr01'];?></td>
						<td width="12%"><?php echo $rowall1['dr02'];?></td>
						<td width="12%"><?php echo $rowall1['dr03'];?></td>
						<td width="12%"><?php echo $rowall1['dr04'];?></td>
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


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false,
     // "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$('#example2').DataTable({
	  "responsive": false, "lengthChange": false, "autoWidth": false,
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
  });
</script>

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard08doctor.php'; 
        });

      
</script>

</body>
</html>
