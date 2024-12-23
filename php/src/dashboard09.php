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

$Year = date("Y")+543;

$sqlmid = "SELECT
    CODE_PROVINCE,
    YEAR,
    SUM(CODE_MALE) AS Total_Male,
    SUM(CODE_FEMALE) AS Total_Female,
    SUM(CODE_TOTAL) AS Total
FROM Midyear
;";
$objmid = mysqli_query($con, $sqlmid);
$rowmid = mysqli_fetch_array($objmid);

$Total_Male = $rowmid['Total_Male'];
$Total_Female = $rowmid['Total_Female'];
$Total = $rowmid['Total'];

$msql1 = "SELECT
  m.CODE_map02,
    m.CODE_PROVINCETH,
    m2.CODE_TOTAL ,
    IFNULL(SUM(ho.result1), 0) AS total_result1,
  IFNULL(SUM(ho.result2), 0) AS total_result2,
  IFNULL(SUM(ho.result1 + ho.result2), 0)AS total_all
FROM
  HDCTB21OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
RIGHT JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
JOIN Midyear m2 ON m2.CODE_PROVINCE = m.CODE_PROVINCE 
WHERE
    1 ";
    
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $msql1 = $msql1."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $msql1 = $msql1."AND ho.b_year = '".$Year."'" ;
  }

  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $msql1 = $msql1." AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
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
  m.CODE_map02,   m.CODE_PROVINCETH
";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	//if($mrow1['total_result2'] <> 0){
		//$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_result2']."],";
        $datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".number_format(($mrow1['total_result2']/$mrow1['CODE_TOTAL']*100000), 2, '.', ',').",name:'".$mrow1['CODE_PROVINCETH']."'},";
	//}
	//['th-ct', 10],
}


$sqlhdc01 = "SELECT
  h.groupcode,";
  /*
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
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

  $sqlhdc01 = $sqlhdc01."FROM
  HDCTB01 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
   
   /*
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
  }
    */

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
   // $sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
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
  h.groupcode;";
$objhdc01 = mysqli_query($con, $sqlhdc01);
//$rowhdc01 = mysqli_fetch_array($objhdc01);

$hdc01_1 ='';
$hdc01_2 ='';
$hdc01_3 ='';
$hdc01_41 ='';
$hdc01_42 ='';
$hdc01tatal1='';
$hdc01tatal2='';
$hdc01tatal3='';
$hdc01tatal41='';
$hdc01tatal42='';
/*
$labelhdc01 = $labelhdc01."'ปี ".((date("Y")+543+1))-$i."',";
*/
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
        $hdc01tatal1 = $rowhdc01[$years2[0]];
	}else if($rowhdc01['groupcode'] == '2.0'){
		$hdc01_2 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
        $hdc01tatal2 = $rowhdc01[$years2[0]];
	}else if($rowhdc01['groupcode'] == '3.0'){
		$hdc01_3 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
        $hdc01tatal3 = $rowhdc01[$years2[0]];
	}else if($rowhdc01['groupcode'] == '4.1'){
		$hdc01_41 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
        $hdc01tatal41 = $rowhdc01[$years2[0]];
	}else if($rowhdc01['groupcode'] == '4.2'){
		$hdc01_42 = "'".$rowhdc01[$years2[4]]."','".$rowhdc01[$years2[3]]."','".$rowhdc01[$years2[2]]."','".$rowhdc01[$years2[1]]."','".$rowhdc01[$years2[0]]."'";
        $hdc01tatal42 = $rowhdc01[$years2[0]];
	}
	
}

//echo $hdc01_1;

$sqlhdc02 = "SELECT
  h.groupcode,";
  /*
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
  */
    for($i=0; $i < (5); $i++) {
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      if($i == 4){
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
    }else{
      
      if($i == 4){
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc02 = $sqlhdc02."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
      }
  }

$sqlhdc02 = $sqlhdc02."
FROM
  HDCTB02 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
 
 /*
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc02 = $sqlhdc02."AND h.b_year = '".$Year."'" ;
  }
    */

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc02 = $sqlhdc02."AND h.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
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
  h.groupcode;";
$objhdc02 = mysqli_query($con, $sqlhdc02);
//$rowhdc01 = mysqli_fetch_array($objhdc01);

$hdc02_1 ='';
$hdc02_2 ='';
$hdc02_3 ='';
$hdc02_41 ='';
$hdc02_42 ='';
$hdc02tatal1='';
$hdc02tatal2='';
$hdc02tatal3='';
$hdc02tatal41='';
$hdc02tatal42='';

$labelhdc02 = ''; // ทำให้ค่าว่างก่อนเริ่ม
$yearshdc02 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $yearshdc02[] = (date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $yearshdc02[] = (date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

// เปลี่ยนลำดับให้เป็นจากปีเก่าที่สุด (2564) ไปถึงปีใหม่ (2568)
$yearshdc02 = array_reverse($yearshdc02); // สลับลำดับปี

// สร้าง label สำหรับการแสดงผล
foreach ($yearshdc02 as $index => $year) {
    if ($index == count($yearshdc02) - 1) {
        $labelhdc02 .= "'ปี $year' "; // ปีสุดท้าย (2568)
    } else {
        $labelhdc02 .= "'ปี $year',"; // ปีอื่นๆ
    }
}

$years2hdc02 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years2hdc02[] = 'total_'.(date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years2hdc02[] = 'total_'.(date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

while($rowhdc02 = mysqli_fetch_array($objhdc02))
{
	if($rowhdc02['groupcode'] == '1.1'){
		$hdc02_1 = "'".$rowhdc02[$years2hdc02[4]]."','".$rowhdc02[$years2hdc02[3]]."','".$rowhdc02[$years2hdc02[2]]."','".$rowhdc02[$years2hdc02[1]]."','".$rowhdc02[$years2hdc02[0]]."'";
        $hdc02tatal1 = $rowhdc02[$years2hdc02[0]];
	}else if($rowhdc02['groupcode'] == '2.0'){
		$hdc02_2 = "'".$rowhdc02[$years2hdc02[4]]."','".$rowhdc02[$years2hdc02[3]]."','".$rowhdc02[$years2hdc02[2]]."','".$rowhdc02[$years2hdc02[1]]."','".$rowhdc02[$years2hdc02[0]]."'";
        $hdc02tatal2 = $rowhdc02[$years2hdc02[0]];
	}else if($rowhdc02['groupcode'] == '3.0'){
		$hdc02_3 = "'".$rowhdc02[$years2hdc02[4]]."','".$rowhdc02[$years2hdc02[3]]."','".$rowhdc02[$years2hdc02[2]]."','".$rowhdc02[$years2hdc02[1]]."','".$rowhdc02[$years2hdc02[0]]."'";
        $hdc02tatal3 = $rowhdc02[$years2hdc02[0]];
	}else if($rowhdc02['groupcode'] == '4.1'){
		$hdc02_41 = "'".$rowhdc02[$years2hdc02[4]]."','".$rowhdc02[$years2hdc02[3]]."','".$rowhdc02[$years2hdc02[2]]."','".$rowhdc02[$years2hdc02[1]]."','".$rowhdc02[$years2hdc02[0]]."'";
        $hdc02tatal41 = $rowhdc02[$years2hdc02[0]];
	}else if($rowhdc02['groupcode'] == '4.2'){
		$hdc02_42 = "'".$rowhdc02[$years2hdc02[4]]."','".$rowhdc02[$years2hdc02[3]]."','".$rowhdc02[$years2hdc02[2]]."','".$rowhdc02[$years2hdc02[1]]."','".$rowhdc02[$years2hdc02[0]]."'";
        $hdc02tatal42 = $rowhdc02[$years2hdc02[0]];
	}
	//['th-ct', 10],
}

$sqlhdc04 = "SELECT
  smiv,";
  /*
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
  */
   for($i=0; $i < (5); $i++) {
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      if($i == 4){
        $sqlhdc04 = $sqlhdc04."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc04 = $sqlhdc04."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
    }else{
      
      if($i == 4){
        $sqlhdc04 = $sqlhdc04."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlhdc04 = $sqlhdc04."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
      }
  }

  $sqlhdc04 = $sqlhdc04." FROM
  HDCTB04 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
   /* 
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc04 = $sqlhdc04."AND h.b_year = '".$Year."'" ;
  }
    */

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc04 = $sqlhdc04."AND h.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    //$sqlhdc04 = $sqlhdc04."AND h.b_year = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlhdc04 = $sqlhdc04."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlhdc04 = $sqlhdc04."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlhdc04 = $sqlhdc04."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlhdc04 = $sqlhdc04."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlhdc04 = $sqlhdc04."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlhdc04 = $sqlhdc04."  
GROUP BY
  smiv;";
$objhdc04 = mysqli_query($con, $sqlhdc04);
//$rowhdc01 = mysqli_fetch_array($objhdc01);

$hdc04_1 ='';
$hdc04_2 ='';
$hdc04_3 ='';
$hdc04_4 ='';
$hdc04tatal1='';
$hdc04tatal2='';
$hdc04tatal3='';
$hdc04tatal4='';

$labelhdc04 = ''; // ทำให้ค่าว่างก่อนเริ่ม
$yearshdc04 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $yearshdc04[] = (date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $yearshdc04[] = (date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}

// เปลี่ยนลำดับให้เป็นจากปีเก่าที่สุด (2564) ไปถึงปีใหม่ (2568)
$yearshdc04 = array_reverse($yearshdc04); // สลับลำดับปี

// สร้าง label สำหรับการแสดงผล
foreach ($yearshdc04 as $index => $year) {
    if ($index == count($yearshdc02) - 1) {
        $labelhdc04 .= "'ปี $year' "; // ปีสุดท้าย (2568)
    } else {
        $labelhdc04 .= "'ปี $year',"; // ปีอื่นๆ
    }
}

$years2hdc04 = []; // สร้าง array เพื่อเก็บปี

// คำนวณปีงบประมาณ
for($i = 0; $i < 5; $i++) {
  if (date("m") == '10' || date("m") == '11' || date("m") == '12') {
    // ถ้าเดือนเป็น ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีถัดไป
    $years2hdc04[] = 'total_'.(date("Y") + 543 + 1) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  } else {
    // ถ้าไม่ใช่ ต.ค. - ธ.ค. ปีงบประมาณจะเป็นปีปัจจุบัน
    $years2hdc04[] = 'total_'.(date("Y") + 543) - $i; // เก็บปีปัจจุบันและย้อนหลัง
  }
}


while($rowhdc04 = mysqli_fetch_array($objhdc04))
{
	if($rowhdc04['smiv'] == '0'){
		$hdc04_1 = "'".$rowhdc04[$years2hdc02[4]]."','".$rowhdc04[$years2hdc02[3]]."','".$rowhdc04[$years2hdc02[2]]."','".$rowhdc04[$years2hdc02[1]]."','".$rowhdc04[$years2hdc02[0]]."'";
        $hdc04tatal1 = $rowhdc04[$years2hdc02[0]];
	}else if($rowhdc04['smiv'] == '1'){
		$hdc04_2 = "'".$rowhdc04[$years2hdc02[4]]."','".$rowhdc04[$years2hdc02[3]]."','".$rowhdc04[$years2hdc02[2]]."','".$rowhdc04[$years2hdc02[1]]."','".$rowhdc04[$years2hdc02[0]]."'";
        $hdc04tatal2 = $rowhdc04[$years2hdc02[0]];
	}else if($rowhdc04['smiv'] == '2'){
		$hdc04_3 = "'".$rowhdc04[$years2hdc02[4]]."','".$rowhdc04[$years2hdc02[3]]."','".$rowhdc04[$years2hdc02[2]]."','".$rowhdc04[$years2hdc02[1]]."','".$rowhdc04[$years2hdc02[0]]."'";
        $hdc04tatal3 = $rowhdc04[$years2hdc02[0]];
	}else if($rowhdc04['smiv'] == '3'){
		$hdc04_4 = "'".$rowhdc04[$years2hdc02[4]]."','".$rowhdc04[$years2hdc02[3]]."','".$rowhdc04[$years2hdc02[2]]."','".$rowhdc04[$years2hdc02[1]]."','".$rowhdc04[$years2hdc02[0]]."'";
        $hdc04tatal4 = $rowhdc04[$years2hdc02[0]];
	}
	//['th-ct', 10],
}



$sqlHD21OLD = "SELECT
 	ho.b_year,
    SUM(ho.result1) AS total_result1,
    SUM(ho.result2) AS total_result2,
    SUM(ho.result1 + ho.result2) AS total_all
FROM
    HDCTB21OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";


    /*
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD21OLD = $sqlHD21OLD."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD21OLD = $sqlHD21OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        $sqlHD21OLD = $sqlHD21OLD."AND ho.b_year = '".$Year."'" ;
      }
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD21OLD = $sqlHD21OLD."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD21OLD = $sqlHD21OLD."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD21OLD = $sqlHD21OLD."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD21OLD = $sqlHD21OLD."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD21OLD = $sqlHD21OLD."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD21OLD = $sqlHD21OLD." 
GROUP BY
    ho.b_year";

$objHD21OLD = mysqli_query($con, $sqlHD21OLD);
$rowHD21OLD = mysqli_fetch_array($objHD21OLD);

$total_result1 = $rowHD21OLD['total_result1'];
$total_result2 = $rowHD21OLD['total_result2'];
$total_all = $rowHD21OLD['total_all'];


$sqlHD18OLD = "SELECT
	ho.b_year,
    SUM(ho.f10_m) AS sum_f10_m,
    SUM(ho.f10_f) AS sum_f10_f,
    SUM(ho.f11_m) AS sum_f11_m,
    SUM(ho.f11_f) AS sum_f11_f,
    SUM(ho.f12_m) AS sum_f12_m,
    SUM(ho.f12_f) AS sum_f12_f,
    SUM(ho.f13_m) AS sum_f13_m,
    SUM(ho.f13_f) AS sum_f13_f,
    SUM(ho.f14_m) AS sum_f14_m,
    SUM(ho.f14_f) AS sum_f14_f,
    SUM(ho.f15_m) AS sum_f15_m,
    SUM(ho.f15_f) AS sum_f15_f,
    SUM(ho.f16_m) AS sum_f16_m,
    SUM(ho.f16_f) AS sum_f16_f,
    SUM(ho.f17_m) AS sum_f17_m,
    SUM(ho.f17_f) AS sum_f17_f,
    SUM(ho.f18_m) AS sum_f18_m,
    SUM(ho.f18_f) AS sum_f18_f,
    SUM(ho.f19_m) AS sum_f19_m,
    SUM(ho.f19_f) AS sum_f19_f,
    SUM(ho.f10_m)+SUM(ho.f10_f) AS sum_f10_all,
    SUM(ho.f11_m)+SUM(ho.f11_f) AS sum_f11_all,
    SUM(ho.f12_m)+SUM(ho.f12_f) AS sum_f12_all,
    SUM(ho.f13_m)+SUM(ho.f13_f) AS sum_f13_all,
    SUM(ho.f14_m)+SUM(ho.f14_f) AS sum_f14_all,
    SUM(ho.f15_m)+SUM(ho.f15_f) AS sum_f15_all,
    SUM(ho.f16_m)+SUM(ho.f16_f) AS sum_f16_all,
    SUM(ho.f17_m)+SUM(ho.f17_f) AS sum_f17_all,
    SUM(ho.f18_m)+SUM(ho.f18_f) AS sum_f18_all,
    SUM(ho.f19_m)+SUM(ho.f19_f) AS sum_f19_all
FROM
    HDCTB18OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
    
    /*
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18OLD = $sqlHD18OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18OLD = $sqlHD18OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        //$sqlHD18OLD = $sqlHD18OLD."AND ho.b_year = '".$Year."'" ;
      }
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD18OLD = $sqlHD18OLD."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD18OLD = $sqlHD18OLD."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD18OLD = $sqlHD18OLD."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD18OLD = $sqlHD18OLD."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD18OLD = $sqlHD18OLD."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD18OLD = $sqlHD18OLD." 
GROUP BY
    ho.b_year";



$labels = '';

$sum_f10_all ='';
$sum_f11_all ='';
$sum_f12_all ='';
$sum_f13_all ='';
$sum_f14_all ='';
$sum_f15_all ='';
$sum_f16_all ='';
$sum_f17_all ='';
$sum_f18_all ='';
$sum_f19_all ='';
$sum_year01 ='';
$sum_year02 ='';
$sum_year03 ='';

//echo $sqlHD18OLD;    
$objHD18OLD = mysqli_query($con, $sqlHD18OLD);

while($rowHD18OLD = mysqli_fetch_array($objHD18OLD))
{
   /* $labels = $labels."'".$rowHD18OLD['b_year']."',";
    $sum_f10_all = $sum_f10_all."'".$rowHD18OLD['sum_f10_all']."',";
    $sum_f11_all = $sum_f11_all."'".$rowHD18OLD['sum_f11_all']."',";
    $sum_f12_all = $sum_f12_all."'".$rowHD18OLD['sum_f12_all']."',";
    $sum_f13_all = $sum_f13_all."'".$rowHD18OLD['sum_f13_all']."',";
    $sum_f14_all = $sum_f14_all."'".$rowHD18OLD['sum_f14_all']."',";
    $sum_f15_all = $sum_f15_all."'".$rowHD18OLD['sum_f15_all']."',";
    $sum_f16_all = $sum_f16_all."'".$rowHD18OLD['sum_f16_all']."',";
    $sum_f17_all = $sum_f17_all."'".$rowHD18OLD['sum_f17_all']."',";
    $sum_f18_all = $sum_f18_all."'".$rowHD18OLD['sum_f18_all']."',";
    $sum_f19_all = $sum_f19_all."'".$rowHD18OLD['sum_f19_all']."',";
    */
    if($rowHD18OLD['b_year']=='2568'){
        $sum_year01 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2567'){
        $sum_year02 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2566'){
        $sum_year03 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2565'){
        $sum_year04 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2564'){
        $sum_year05 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }

}


$sqlHD18_1OLD = "SELECT
	ho.b_year,
	SUM(ho.r_new) AS sum_r_new,
  SUM(ho.f10_m+ho.f11_m+ho.f12_m+ho.f13_m+ho.f14_m+ho.f15_m+ho.f16_m+ho.f17_m+ho.f18_m+ho.f19_m) AS sum_r_new_m ,
  SUM(ho.f10_f+ho.f11_f+ho.f12_f+ho.f13_f+ho.f14_f+ho.f15_f+ho.f16_f+ho.f17_f+ho.f18_f+ho.f19_f) AS sum_r_new_f
FROM
    HDCTB18OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
    /*
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD18_1OLD = $sqlHD18_1OLD."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD18_1OLD = $sqlHD18_1OLD."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD18_1OLD = $sqlHD18_1OLD."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD18_1OLD = $sqlHD18_1OLD."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD18_1OLD = $sqlHD18_1OLD."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }


$objHD18_1OLD = mysqli_query($con, $sqlHD18_1OLD);
$rowHD18_1OLD = mysqli_fetch_array($objHD18_1OLD);

$sum_r_new =0;

$sum_r_new = $rowHD18_1OLD['sum_r_new'];

$sum_r_new_m = $rowHD18_1OLD['sum_r_new_m'];

$sum_r_new_f = $rowHD18_1OLD['sum_r_new_f'];



$sqlHD21OLD_2 = "SELECT
 	ho.b_year,
    SUM(ho.result1) AS total_result1,
    SUM(ho.result2) AS total_result2,
    SUM(ho.result1 + ho.result2) AS total_all
FROM
    HDCTB21OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";


 $Year2 = ((date("Y")+543)-4);

 $sqlHD21OLD_2 = $sqlHD21OLD_2."AND ho.b_year > '".$Year2."' " ;

    
    /*
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD21OLD_2 = $sqlHD21OLD_2."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD21OLD_2 = $sqlHD21OLD_2."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1;
        }else{
          $Year = (date("Y"));
        }
       // $sqlHD21OLD_2 = $sqlHD21OLD_2."AND ho.b_year = '".$Year."'" ;
      }
      
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD21OLD_2 = $sqlHD21OLD_2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD21OLD_2 = $sqlHD21OLD_2."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD21OLD_2 = $sqlHD21OLD_2."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD21OLD_2 = $sqlHD21OLD_2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD21OLD_2 = $sqlHD21OLD_2."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD21OLD_2 = $sqlHD21OLD_2."
GROUP BY
    ho.b_year
ORDER BY
    ho.b_year ASC ";
$objHD21OLD_2 = mysqli_query($con, $sqlHD21OLD_2);

$labels_2 = '';
$total_result1_2 = '';
$total_result2_2 = '';
$total_all_2 = '';

while($rowHD21OLD_2 = mysqli_fetch_array($objHD21OLD_2))
{
    $labels_2 = $labels_2."'".$rowHD21OLD_2['b_year']."',";
    $total_result1_2 = $total_result1_2."'".$rowHD21OLD_2['total_result1']."',";
    $total_result2_2 = $total_result2_2."'".$rowHD21OLD_2['total_result2']."',";
    $total_all_2 = $total_all_2."'".$rowHD21OLD_2['total_all']."',";
 
}


$sqlHD22OLD_1 = "SELECT
 	ho.b_year,
    SUM(ho.result) AS total_result,
    SUM(ho.sex1) AS total_sex1,
    SUM(ho.sex2) AS total_sex2
FROM
    HDCTB22OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";

$Year3 = ((date("Y")+543)-4);

$sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year > '".$Year3."' " ;

    /*
    if (isset($_POST['Year'])) {
        $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
      }else{
        $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
       // $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
      }
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD22OLD_1 = $sqlHD22OLD_1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD22OLD_1 = $sqlHD22OLD_1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD22OLD_1 = $sqlHD22OLD_1."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD22OLD_1 = $sqlHD22OLD_1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD22OLD_1 = $sqlHD22OLD_1."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD22OLD_1 = $sqlHD22OLD_1."
GROUP BY
    ho.b_year
ORDER BY
    ho.b_year ASC ";

$sqlHD22OLD_1 = mysqli_query($con, $sqlHD22OLD_1);
$rowHD22OLD_1 = mysqli_fetch_array($sqlHD22OLD_1);


$labels_22_1 = $rowHD22OLD_1['b_year'];
$total_result_22_1 = $rowHD22OLD_1['total_result'];
$total_sex1_22_1 = $rowHD22OLD_1['total_sex1'];
$total_sex2_22_1 = $rowHD22OLD_1['total_sex2'];



$sqlHD22OLD = "SELECT
 	ho.b_year,
    SUM(ho.result) AS total_result,
    SUM(ho.sex1) AS total_sex1,
    SUM(ho.sex2) AS total_sex2
FROM
    HDCTB22OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
    
    /*
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD22OLD = $sqlHD22OLD."AND ho.b_year = '".$Year."'" ;
      }
*/
      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD22OLD = $sqlHD22OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        //$sqlHD22OLD = $sqlHD22OLD."AND ho.b_year = '".$Year."'" ;
      }
      
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD22OLD = $sqlHD22OLD."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD22OLD = $sqlHD22OLD."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }
  
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD22OLD = $sqlHD22OLD."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD22OLD = $sqlHD22OLD."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD22OLD = $sqlHD22OLD."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD22OLD = $sqlHD22OLD."
GROUP BY
    ho.b_year
ORDER BY
    ho.b_year ASC ";

$sqlHD22OLD = mysqli_query($con, $sqlHD22OLD);

$labels_22 = '';
$total_result_22 = '';
$total_sex1_22 = '';
$total_sex2_22 = '';

while($rowHD22OLD = mysqli_fetch_array($sqlHD22OLD))
{
    $labels_22 = $labels_22."'".$rowHD22OLD['b_year']."',";
    $total_result_22 = $total_result_22."'".$rowHD22OLD['total_result']."',";
    $total_sex1_22 = $total_sex1_22."'".$rowHD22OLD['total_sex1']."',";
    $total_sex2_22 = $total_sex2_22."'".$rowHD22OLD['total_sex2']."',";
 
}


$sqlhdc17old = "SELECT ho.b_year, 
                    SUM(ho.result1) AS total_result1_17old, 
                    SUM(ho.result2) AS total_result2_17old,
                    SUM(ho.result1 + ho.result2) AS total_all_17old
                FROM HDCTB17OLD ho 
                JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 
                ";

      if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlhdc17old = $sqlhdc17old."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y")+543);
        }
        $sqlhdc17old = $sqlhdc17old."AND ho.b_year = '".$Year."'" ;
      }

      if (isset($_POST['CODE_HMOO'])) {
        if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
        $CODE_HMOO = $_POST['CODE_HMOO'];
        $sqlhdc17old = $sqlhdc17old."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
        }
      }
    
      if (isset($_POST['type_Affiliation'])) {
        if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
        $type_Affiliation = trim($_POST['type_Affiliation']);
        $sqlhdc17old = $sqlhdc17old."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
        }
      }
      
      
      if (isset($_POST['TYPE_SERVICE'])) {
        if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
        $mySelect = trim($_POST['TYPE_SERVICE']);
        $sqlhdc17old = $sqlhdc17old."AND hn.HOS_TYPE = '".$mySelect."'" ;
        }
      }
      
      if (isset($_POST['CODE_PROVINCE'])) {
        if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
        $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
        $sqlhdc17old = $sqlhdc17old."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
        }
      }
      
      if (isset($_POST['CODE_HOS'])) {
        if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
        $CODE_HOS = $_POST['CODE_HOS'];
        $sqlhdc17old = $sqlhdc17old."AND hn.CODE5 = '".$CODE_HOS."'" ;
        }
      }

$sqlhdc17old = $sqlhdc17old."
                GROUP BY ho.b_year";
$objhdc17old  = mysqli_query($con, $sqlhdc17old);
$rowhdc17old = mysqli_fetch_array($objhdc17old);

$total_result1_17old = $rowhdc17old['total_result1_17old'];
$total_result2_17old = $rowhdc17old['total_result2_17old'];
$total_all_17old = $rowhdc17old['total_all_17old'];


$sqlhdc19old = "SELECT ho.b_year, 
                    SUM(ho.ts1_all) AS total_ts1_all_19old, 
                    SUM(ho.ts2_all) AS total_ts2_all_19old,
                    SUM(ho.ts1_all + ho.ts2_all) AS total_all_19old
                FROM HDCTB19OLD ho 
                JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 
                ";

                if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlhdc19old = $sqlhdc19old."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        $sqlhdc19old = $sqlhdc19old."AND ho.b_year = '".$Year."'" ;
      }

      if (isset($_POST['CODE_HMOO'])) {
        if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
        $CODE_HMOO = $_POST['CODE_HMOO'];
        $sqlhdc19old = $sqlhdc19old."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
        }
      }
    
      if (isset($_POST['type_Affiliation'])) {
        if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
        $type_Affiliation = trim($_POST['type_Affiliation']);
        $sqlhdc19old = $sqlhdc19old."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
        }
      }
      
      
      if (isset($_POST['TYPE_SERVICE'])) {
        if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
        $mySelect = trim($_POST['TYPE_SERVICE']);
        $sqlhdc19old = $sqlhdc19old."AND hn.HOS_TYPE = '".$mySelect."'" ;
        }
      }
      
      if (isset($_POST['CODE_PROVINCE'])) {
        if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
        $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
        $sqlhdc19old = $sqlhdc19old."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
        }
      }
      
      if (isset($_POST['CODE_HOS'])) {
        if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
        $CODE_HOS = $_POST['CODE_HOS'];
        $sqlhdc19old = $sqlhdc19old."AND hn.CODE5 = '".$CODE_HOS."'" ;
        }
      }

      $sqlhdc19old = $sqlhdc19old."
                GROUP BY ho.b_year";

$objhdc19old  = mysqli_query($con, $sqlhdc19old);
$rowhdc19old = mysqli_fetch_array($objhdc19old);

$total_ts1_all_19old = $rowhdc19old['total_ts1_all_19old'];
$total_ts2_all_19old = $rowhdc19old['total_ts2_all_19old'];
$total_all_19old = $rowhdc19old['total_all_19old'];


$sqlhdc20old = "SELECT ho.b_year, 
                    SUM(ho.result1) AS total_result1_20old, 
                    SUM(ho.result2) AS total_result2_20old,
                    SUM(ho.result1 + ho.result2) AS total_all_20old
                FROM HDCTB20OLD ho 
                                JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 
                ";

                if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlhdc20old = $sqlhdc20old."AND ho.b_year = '".$Year."'" ;
      }else{
        if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
          $Year = (date("Y"))+1+543;
        }else{
          $Year = (date("Y"))+543;
        }
        $sqlhdc20old = $sqlhdc20old."AND ho.b_year = '".$Year."'" ;
      }


      if (isset($_POST['CODE_HMOO'])) {
        if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
        $CODE_HMOO = $_POST['CODE_HMOO'];
        $sqlhdc20old = $sqlhdc20old."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
        }
      }
    
      if (isset($_POST['type_Affiliation'])) {
        if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
        $type_Affiliation = trim($_POST['type_Affiliation']);
        $sqlhdc20old = $sqlhdc20old."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
        }
      }
      
      
      if (isset($_POST['TYPE_SERVICE'])) {
        if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
        $mySelect = trim($_POST['TYPE_SERVICE']);
        $sqlhdc20old = $sqlhdc20old."AND hn.HOS_TYPE = '".$mySelect."'" ;
        }
      }
      
      if (isset($_POST['CODE_PROVINCE'])) {
        if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
        $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
        $sqlhdc20old = $sqlhdc20old."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
        }
      }
      
      if (isset($_POST['CODE_HOS'])) {
        if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
        $CODE_HOS = $_POST['CODE_HOS'];
        $sqlhdc20old = $sqlhdc20old."AND hn.CODE5 = '".$CODE_HOS."'" ;
        }
      }

      $sqlhdc20old = $sqlhdc20old."
                GROUP BY ho.b_year";
                
$objhdc20old  = mysqli_query($con, $sqlhdc20old);
$rowhdc20old = mysqli_fetch_array($objhdc20old);

$total_result1_20old = $rowhdc20old['total_result1_20old'];
$total_result2_20old = $rowhdc20old['total_result2_20old'];
$total_all_20old = $rowhdc20old['total_all_20old'];



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
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/pictorial.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	

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
            <h3>จิตเวชผู้ใหญ่</h3>
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
			<form class="form-valide" action="dashboard09.php" method="post" id="myform1" name="foml">  
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

    <div class="row">
        <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #ecc8d9; color: black;">
                <div class="inner">
                
                <p>โรคจิตเภท</p>
                <h3><?php echo number_format($total_result2_17old, 0, '.', ',');?> คน</h3>
                <p><?php echo number_format((($total_result2_17old / $Total)*100000), 4, '.', ',');?>: 1แสน ประชากร</p>

                
                </div>
                
                <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>-->
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #f0eec8; color: black;">
                <div class="inner">
                
                <p>ยาเสพติด</p>
                <h3><?php echo number_format($sum_r_new, 0, '.', ',');?> คน</h3>
                <p><?php echo number_format((($sum_r_new/ $Total)*100000), 4, '.', ',');?>: 1แสน ประชากร</p>
                
                </div>
                
                <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>-->
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #c9ffda; color: black;">
                <div class="inner">
                
                <p>สมองเสื่อม</p>
                <h3><?php echo number_format($total_all_19old, 0, '.', ',');?> คน</h3>
                <p><?php echo number_format((($total_all_19old / $Total)*100000), 4, '.', ',');?>: 1แสน ประชากร</p>
                
                </div>
                
                <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>-->
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #c9ecff; color: black;">
                <div class="inner">
                
                <p>โรคซึมเศร้า</p>
                <h3><?php echo number_format($total_result2_20old, 0, '.', ',');?> คน</h3>
                <p><?php echo number_format((($total_result2_20old / $Total)*100000), 4, '.', ',');?>: 1แสน ประชากร</p>
                
                
                </div>
                
                <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>-->
            </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #d9d9d9; color: black;">
                <div class="inner">
                
                <p>ฆ่าตัวตายสำเร็จ</p>
                <h3><?php echo number_format($total_result1, 0, '.', ',');?> คน</h3>
                <p><?php echo number_format((($total_result1/ $Total)*100000), 4, '.', ',');?>: 1แสน ประชากร</p>
                
                </div>
                
                <!-- <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
                </a>-->
            </div>
            </div>
            <!-- ./col -->
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
                        <canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
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
                        <canvas id="myChart6" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                        <script>
                            const ctx6 = document.getElementById('myChart6');

                            const downloadButton6 = document.getElementById('download-button6');

                            const myChart6 = new Chart(ctx6, {
                                type: 'line',

                                data: {
                                    labels: [<?php echo $labelhdc02; ?>],
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

        <div class="row">
           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยยาเสพติด</h3>
                        
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button9"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    </div>
                    <div class="card-body">
                       <!-- <canvas id="myChart9" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>-->

                       <figure class="highcharts-figure">
    <div id="myChart9"></div>
  
  </figure>

                        <script>

Highcharts.chart('myChart9', {
    chart: {
        type: 'pictorial'
    },

    title: {
        text: ''
    },

    accessibility: {
        screenReaderSection: {
            beforeChartFormat: '<{headingTagName}>' +
                '{chartTitle}</{headingTagName}><p>{typeDescription}</p><p>' +
                '{chartLongdesc}</p>'
        },
        point: {
            valueDescriptionFormat: '{value}.'
        },
        series: {
            descriptionFormat: ''
        },
        landmarkVerbosity: 'one'
    },

    xAxis: {
        categories: ['ผู้หญิง', 'ผู้ชาย'],
        lineWidth: 0,
        opposite: true
    },

    yAxis: {
        visible: false,
        stackShadow: {
            enabled: true
        },
        max: 4000000
    },

    legend: {
        itemMarginTop: 15,
        itemMarginBottom: 15,
        layout: 'vertical',
        padding: 0,
        verticalAlign: 'middle',
        align: 'center',
        margin: 0
    },

    tooltip: {
        headerFormat: ''
    },

    plotOptions: {
        series: {
            pointPadding: 0,
            groupPadding: 0,
            dataLabels: {
                enabled: true,
                align: 'center',
                format: '{y}'
            },
            stacking: 'normal',
            paths: [{
                definition: 'm 656.59433,740.097 c -0.634,-1.435 -13.566,' +
                    '-15.425 -33.487,-23.292 -4.568,-1.94 -4.545,2.705 ' +
                    '-16.944,-34.925 -26.957,-72.647 -5.661,-112.736 -51.135,' +
                    '-200.791 -6.888,-14.322 -9.901,-24.921 -16.16,-50.12 ' +
                    '-25.397,-104.478 -6.032,-90.98 -15.87,-135.251 -17.961,' +
                    '-63.049 -50.754,-59.498 -71.782,-59.155 -16.944,0.378 ' +
                    '-45.224,-11.699 -52.936,-19.746 -10.555,-11.486 -17.912,' +
                    '-20.548 -11.679,-58.855 0,0 7.037,-12.141 9.078,-34.125 ' +
                    '9.284,11.287 24.572,-33.84 16.065,-42.691 -1.745,-1.867 ' +
                    '-5.169,-1.236 -6.289,1.015 -1.292,1.484 -1.315,3.695 ' +
                    '-2.888,4.964 -2,-9.359 3.289,-28.498 -7.935,-56.968 ' +
                    '-5.541,-12.289 -11.235,-15.496 -21.547,-22.44 -8.401,' +
                    '-6.048 -28.842,-7.595 -29.842,-7.717 h -9.461 c -1,' +
                    '0.122 -21.441,1.669 -29.842,7.717 -10.312,6.944 -16.006,' +
                    '10.151 -21.547,22.44 -11.224,28.47 -5.935,47.609 -7.935,' +
                    '56.968 -1.573,-1.269 -1.596,-3.48 -2.888,-4.964 -1.12,' +
                    '-2.251 -4.544,-2.882 -6.289,-1.015 -8.507,8.851 6.781,' +
                    '53.978 16.065,42.691 2.041,21.984 9.078,34.125 9.078,' +
                    '34.125 6.233,38.307 -1.124,47.369 -11.679,58.855 -7.712,' +
                    '8.047 -35.992,20.124 -52.935,19.746 -21.029,-0.343 ' +
                    '-53.822,-3.894 -71.782,59.155 -9.838,44.271 9.527,' +
                    '30.773 -15.87,135.251 -6.259,25.199 -9.272,35.798 ' +
                    '-16.16,50.12 -45.474004,88.055 -24.178004,128.144 ' +
                    '-51.135004,200.791 -12.399,37.63 -12.376,32.985 -16.944,' +
                    '34.925 -19.921,7.867 -32.853,21.857 -33.487,23.292 ' +
                    '-8.923,20.454 -23.3280004,27.412 -19.92100038,33.844 ' +
                    '0.89599998,1.702 3.31799998,2.588 4.94399998,1.381 ' +
                    '5.1890004,0.91 12.7380004,-4.808 16.1270004,-8.599 ' +
                    '4.102,-4.706 3.375,-7.457 11.332,-13.86 1.824,2.047 ' +
                    '-2.155,20.335 -3.12,23.398 -4.877,14.729 -26.5670004,' +
                    '49.619 -17.595,54.417 0.945,0.4 2.227,0.955 3.073,0.089 ' +
                    '1.553,-1.53 3.53,-2.604 4.841,-4.372 8.025,-10.218 ' +
                    '17.566,-34.36 24.059,-39.238 3.279,0.224 1.596,2.346 ' +
                    '-4.475,22.532 -3.673,13.084 -5.142,19.941 -5.142,19.941 ' +
                    '-10.126,30.466 6.229,25.716 11.501,6.808 0.448,-1.537 ' +
                    '9.722,-26.912 10.129,-28.16 1.241,-3.291 4.602,-17.806 ' +
                    '8.801,-14.872 0.646,2.469 -0.335,3.044 -3.536,31.521 ' +
                    '-2.6,21.813 -3.236,8.789 -2.713,26.425 0.079,2.164 ' +
                    '4.439,3.257 6.282,2.115 10.539,-9.723 12.692,-57.611 ' +
                    '18.074,-61.022 3.669,4.293 4.272,33.754 5.982,39.221 ' +
                    '2.652,9.705 7.446,4.802 7.981,3.239 3.825004,-9.324 ' +
                    '-0.19,-30.536 0.628,-45.388 0,0 4.369004,-14.53 ' +
                    '7.198004,-38.676 4.176,-45.514 -17.861004,13.267 48.59,' +
                    '-167.185 0,0 5.299,-10.218 13.794,-30.791 9.81,-21.31 ' +
                    '5.988,-35.652 19.766,-73.451 0.361,-1 16.239,-47.758 ' +
                    '24.363,-68.15 45.673,232.645 -9.743,77.068 -28.904,' +
                    '331.531 -5.708,105.042 1.862,76.707 18.19,223.544 ' +
                    '31.719,289.304 -15.087,130.161 35.652,384.312 10.99,' +
                    '51.495 9.837,44.86 11.854,56.284 2.28,21.363 -1.788,' +
                    '21.528 -1.679,31.313 -0.699,24.031 5.964,8.574 -1.712,' +
                    '52.53 -4.993,24.181 -4.913,9.214 -7.677,37.417 -3.463,' +
                    '13.977 -13.912,52.732 0.856,52.45 1.286,7.64 5.541,' +
                    '9.156 9.756,6.712 -0.684,2.455 1.381,4.293 2.766,6.011 ' +
                    '4.813,1.322 4.76,1.029 6.828,-0.555 1.495,5.791 5.173,' +
                    '5.742 6.748,6.16 4.768,1.476 5.904,-11.237 6.781,-16.16 ' +
                    '0.856,-0.046 1.705,-0.096 2.551,-0.129 -1.072,3.151 ' +
                    '-7.161,15.833 2.634,16.835 7.651,1.238 8.542,0.168 ' +
                    '12.727,-3.791 6.992,-7.01 5.41,-8.94 6.623,-20.685 ' +
                    '0.191,-2.384 5.685,-6.58 0.872,-37.642 -1.855,-15.952 ' +
                    '-0.832,2.69 0.304,-35.715 0.371,-16.594 5.685,-19.576 ' +
                    '6.408,-31.349 -6.493,-27.396 -1.465,-14.55 -4.045,' +
                    '-30.51 -6.145,-34.313 -7.105,-27.255 0.575,-107.316 ' +
                    '6.987,-65.839 14.147,-68.677 7.72,-136.864 -14.296,' +
                    '-110.15 -0.224,-68.945 1.451,-126.216 1.503,-67.36 ' +
                    '-4.198,-108.808 3.103,-168.203 4.314,-34.735 12.351,' +
                    '-68.835 12.215,-90.227 2.948,-3.639 4.984,-7.885 7.168,' +
                    '-11.993 3.172,-6.203 2.655,-0.513 2.627,-35.675 1.424,' +
                    '-0.218 2.885,-0.281 4.27,-0.677 0.162,-0.334 0.307,' +
                    '-0.661 0.436,-0.985 0.007,0.007 0.014,0.015 0.022,0.023 ' +
                    '0.008,-0.008 0.015,-0.016 0.022,-0.023 0.129,0.324 ' +
                    '0.274,0.651 0.436,0.985 1.385,0.396 2.846,0.459 4.27,' +
                    '0.677 -0.028,35.162 -0.545,29.472 2.627,35.675 2.184,' +
                    '4.108 4.22,8.354 7.168,11.993 -0.136,21.392 7.901,' +
                    '55.493 12.215,90.227 7.301,59.394 1.6,100.842 3.103,' +
                    '168.203 1.675,57.27 15.747,16.066 1.451,126.216 -6.427,' +
                    '68.186 0.733,71.025 7.72,136.864 7.68,80.061 6.72,' +
                    '73.003 0.575,107.316 -2.58,15.96 2.448,3.114 -4.045,' +
                    '30.51 0.723,11.773 6.037,14.755 6.408,31.349 1.136,' +
                    '38.405 2.159,19.763 0.304,35.715 -4.813,31.062 0.681,' +
                    '35.258 0.872,37.642 1.213,11.745 -0.369,13.675 6.623,' +
                    '20.685 4.185,3.959 5.076,5.029 12.727,3.791 9.795,' +
                    '-1.002 3.706,-13.684 2.634,-16.835 0.846,0.033 1.695,' +
                    '0.083 2.551,0.129 0.877,4.923 2.013,17.636 6.781,16.16 ' +
                    '1.575,-0.418 5.253,-0.369 6.748,-6.16 2.068,1.584 2.015,' +
                    '1.877 6.828,0.555 1.385,-1.718 3.45,-3.556 2.766,-6.011 ' +
                    '4.215,2.444 8.47,0.928 9.756,-6.712 14.768,0.282 4.319,' +
                    '-38.473 0.856,-52.45 -2.764,-28.203 -2.684,-13.236 ' +
                    '-7.677,-37.417 -7.676,-43.956 -1.013,-28.499 -1.712,' +
                    '-52.53 0.109,-9.785 -3.959,-9.95 -1.679,-31.313 2.017,' +
                    '-11.424 0.864,-4.789 11.854,-56.284 50.739,-254.151 ' +
                    '3.933,-95.007 35.652,-384.312 16.328,-146.837 23.898,' +
                    '-118.502 18.19,-223.544 -19.161,-254.463 -74.576,' +
                    '-98.886 -28.904,-331.531 8.124,20.392 24.002,67.15 ' +
                    '24.363,68.15 13.778,37.8 9.956,52.142 19.766,73.451 ' +
                    '8.495,20.573 13.794,30.791 13.794,30.791 66.451,180.451 ' +
                    '44.414,121.671 48.59,167.185 2.829,24.146 7.198,38.676 ' +
                    '7.198,38.676 0.818,14.852 -3.197,36.064 0.628,45.388 ' +
                    '0.535,1.563 5.329,6.466 7.981,-3.239 1.71,-5.467 2.313,' +
                    '-34.928 5.982,-39.221 5.382,3.411 7.535,51.3 18.074,' +
                    '61.022 1.843,1.142 6.203,0.049 6.282,-2.115 0.523,' +
                    '-17.636 -0.113,-4.612 -2.713,-26.425 -3.201,-28.477 ' +
                    '-4.182,-29.052 -3.536,-31.521 4.199,-2.934 7.56,11.581 ' +
                    '8.801,14.872 0.407,1.248 9.681,26.623 10.129,28.16 ' +
                    '5.272,18.908 21.627,23.658 11.501,-6.808 0,0 -1.469,' +
                    '-6.857 -5.142,-19.941 -6.071,-20.186 -7.754,-22.308 ' +
                    '-4.475,-22.532 6.493,4.878 16.034,29.02 24.059,39.238 ' +
                    '1.311,1.768 3.288,2.842 4.841,4.372 0.846,0.866 2.128,' +
                    '0.311 3.073,-0.089 8.972,-4.798 -12.718,-39.688 -17.595,' +
                    '-54.417 -0.965,-3.063 -4.944,-21.351 -3.12,-23.398 ' +
                    '7.957,6.403 7.23,9.154 11.332,13.86 3.389,3.791 10.938,' +
                    '9.509 16.127,8.599 1.626,1.207 4.048,0.321 4.944,-1.381 ' +
                    '3.403,-6.432 -11.002,-13.39 -19.925,-33.844 z'
            }, {
                definition: 'm 288.24306,919.66652 c -2.887,-37.612 3.116,' +
                    '-111.464 -6.141,-106.729 0,0 -1.513,6.585 -1.773,8.642 ' +
                    '-1.752,13.994 -0.121,74.406 -2.134,96.522 0,0 -7.163,' +
                    '57.876 -11.151,74.107 -3.988,16.22798 -11.166,115.22698 ' +
                    '-19.144,139.57398 -7.976,24.345 -16.75,56.8 -8.774,' +
                    '81.958 7.976,25.157 16.752,67.352 8.774,105.492 -7.976,' +
                    '38.14 -16.75,91.288 -11.964,118.069 3.521,19.706 4.786,' +
                    '38.546 7.978,42.603 3.188,4.057 0,12.169 0,22.721 0,' +
                    '10.547 1.594,33.271 -1.995,41.793 0,6.082 5.183,22.719 ' +
                    '2.394,30.427 -2.793,7.711 0,12.174 -3.591,15.417 -3.589,' +
                    '3.247 -9.572,11.77 -22.733,8.525 -7.978,-2.438 -8.375,' +
                    '-8.525 -7.178,-9.742 1.195,-1.216 -4.389,-0.402 -4.389,' +
                    '-0.402 -2.78,5.181 -12.76,6.868 -17.548,-0.406 -0.796,' +
                    '-1.218 -3.587,4.461 -9.969,3.243 -6.382,-1.218 -3.589,' +
                    '-4.055 -3.589,-4.055 0,0 -8.377,0.404 -10.37,-4.463 ' +
                    '-0.399,1.216 -4.387,2.839 -7.579,-0.406 -3.19,-3.245 ' +
                    '-2.791,-13.793 -1.594,-19.07 1.195,-5.277 6.796,-14.401 ' +
                    '8.774,-17.854 2.791,-4.867 13.161,-23.533 12.762,' +
                    '-28.806 -0.248,-3.263 0.796,-27.998 3.19,-34.081 2.394,' +
                    '-6.089 2.793,-13.391 2.793,-21.505 0,-8.116 1.995,' +
                    '-53.965 -13.959,-110.363 -15.954,-56.396 -23.531,' +
                    '-83.984 -23.928,-122.938 -0.399,-38.952 17.147,-62.483 ' +
                    '6.777,-121.312 -10.368,-58.836 -14.755,-97.785 -15.952,' +
                    '-101.439 -1.197,-3.647 -7.675,-87.08798 -7.675,' +
                    '-87.08798 -0.914,-90.865 2.12,-75.593 3.35,-108.574 ' +
                    '2.353,-63.252 1.051,-52.022 10.05,-88.612 1.577,-12.158 ' +
                    '2.454,-23.04 4.031,-35.203 0.657,-5.071 2.01,-11.418 ' +
                    '2.669,-16.489 9.196,-31.653 9.142,-25.304 5.191,-54.251 ' +
                    '-2.61,-19.17 0.658,-16.691 2.614,-36.464 0.344,-3.505 ' +
                    '3.794,-65.532 -2.78,-99.005 -4.466,-13.066 -8.932,' +
                    '-26.134 -13.4,-39.197 h -0.557 c 0.201,32.151 -11.049,' +
                    '55.538 -16.752,82.933 -1.867,13.001 -2.392,23.885 ' +
                    '-4.297,36.877 -0.585,4.014 -1.713,6.857 -2.315,10.995 ' +
                    '-2.596,17.861 2.82,24.968 -3.437,57.216 -7.242,37.317 ' +
                    '-22.927002,69.907 -30.150002,107.358 -1.197,6.198 ' +
                    '-0.553,12.864 -0.316,18.911 0.585,4.031 1.615,6.33 ' +
                    '2.475,10.552 1.195,5.861 1.78,13.168 2.863,18.818 1.334,' +
                    '6.942 1.438,15.31 1.664,23.435 0.207,7.346 1.037,12.54 ' +
                    '0.288,21.87 -0.218,2.72 -0.033,36.328 -3.134,48.688 ' +
                    '-1.434,5.7 -4.692,5.273 -6.077,4.279 -5.716,-7.654 ' +
                    '-0.615,-25.119 -6.28,-43.599 -0.559,0.38 -0.559,0.046 ' +
                    '-1.118,0.425 0.084,4.047 -0.667,9.273 -0.179,15.482 ' +
                    '0.779,9.977 0.378,14.142 0.07,18.034 -0.832,10.572 ' +
                    '-1.344,19.719 -3.924,25.218 -1.395,2.974 -5.2,5.59 ' +
                    '-8.669,1.478 -1.937,-3.302 -2.208,-8.173 -2.411,-15.058 ' +
                    '-0.878,-30.054 -0.969,-20.294 -1.334,-26.969 -0.388,' +
                    '-7.183 -0.61,-12.768 -0.61,-12.768 -0.89,-0.236 -1.494,' +
                    '-0.354 -2.345,-0.022 -2.167,19.698 -0.178,15.719 -2.96,' +
                    '39.445 -0.491,4.187 -0.139,12.028 -1.225,17.079 -2.229,' +
                    '10.363 -11.671,9.05 -12.444,1.027 -0.265,-2.74 -0.886,' +
                    '-5.687 -1.238,-8.086 -0.38,-2.592 -0.164,-6.26 -0.254,' +
                    '-8.989 -0.139,-4.209 -0.565,-7.888 -0.888,-12.069 ' +
                    '-0.373,-4.839 2.084,-17.895 0.023,-27.551 -0.026,0 ' +
                    '-1.142,0 -1.116,0 -0.734,4.359 -2.245,10.954 -3.969,' +
                    '19.445 -0.265,1.309 -0.399,3.632 -0.681,4.975 -1.549,' +
                    '7.394 -1.393,11.575 -2.166,16.148 -1.214,7.224 0.053,' +
                    '8.318 -2.505,13.124 -2.791,5.249 -7.135,2.857 -8.296,' +
                    '0.08 -1.801,-4.311 -2.814,-11.342 -2.795,-19.975 0.037,' +
                    '-15.995 2.716,-19.356 2.825,-40.619 0.023,-4.404 0.267,' +
                    '-8.277 -0.282,-12.349 v 2.129 c -2.435,4.109 -3.373,' +
                    '8.129 -7.8160001,10.222 -2.213,0.79 -4.001,1.246 -5.663,' +
                    '0.365 -1.62399996,-0.853 -2.71799996,-0.523 -2.11899996,' +
                    '-3.736 0.461,-2.47 1.58999996,-5.861 2.01399996,-8.907 ' +
                    '0.638,-4.582 0.555,-8.698 1.641,-13.506 0.632,-2.789 ' +
                    '2.368,-6.204 3.203,-8.885 1.366,-4.384 1.958,-10.449 ' +
                    '3.1560001,-12.473 0.903,-1.533 3.004,-3.975 4.31,-5.698 ' +
                    '0.346,-0.457 8.944,-13.182 12.286,-17.574 3.356,-4.409 ' +
                    '5.699,-8.14 5.699,-8.14 0.051,-11.746 3.059,-18.778 ' +
                    '2.08,-30.076 -1.692,-19.557 -0.495,1.76 -2.339,-121.232 ' +
                    '4.78,-68.261 11.045,-49.621 17.136,-111.518 4.058,' +
                    '-41.052 4.798,-56.274 7.364,-64.797 2.452,-8.147 6.34,' +
                    '-29.092 5.657,-43.675 -0.459,-9.801 -0.45,-14.221 ' +
                    '-1.543,-20.477 -2.05,-11.754 -1.431,-42.739 11.725,' +
                    '-69.299 11.477,-23.175 27.318,-34.048 49.629002,-43.289 ' +
                    '15.531,-6.434 14.433,-2.79 42.978,-18.213 17.074,-9.227 ' +
                    '57.814,-33.258 65.621,-50.863 0.124,-16.319 -0.366,' +
                    '-14.443 0.009,-29.778 0,0 -3.213,-13.298 -4.53,-22.591 ' +
                    '-6.854,-0.074 -10.769,-6.449 -13.127,-14.318 -2.094,' +
                    '-6.98 -1.877,-19.262 -1.918,-20.897999 -0.163,-6.367 ' +
                    '-0.441,-12.45 4.995,-14.77 1.445,-0.341 1.701,-0.376 ' +
                    '2.351,-0.208 0.836,0.213 1.278,1.131 2.115,1.344 -1.056,' +
                    '-33.236 4.238,-59.246 25.686,-73.844 38.147,-25.962 ' +
                    '84.194,-4.385 96.595,31.244 4.15,11.926 4.212,28.343 ' +
                    '2.791,42.601 h 0.557 c 1.212,-1.02 1.445,-1.628 3.877,' +
                    '-1.237 4.303,1.889 5.591,6.919 5.712,15.963999 0.177,' +
                    '13.445 -0.6,22.432 -9.367,31.903 -2.189,2.366 -4.282,' +
                    '2.09 -7.477,3.358 -0.207,4.645 -2.703,18.616 -2.703,' +
                    '18.616 0,0 -1.703,28.168 -0.651,31.938 4.364,15.563 ' +
                    '55.746,47.859 85.792,61.08 17.748,7.814 48.444,11.768 ' +
                    '69.031,44.574 13.863,22.079 19.151,53.497 15.704,74.476 ' +
                    '-1.369,8.304 -2.896,28.95 -0.455,42.944 10.918,54.033 ' +
                    '5.22,16.283 12.421,88.953 3.703,37.295 4.626,32.485 ' +
                    '12.068,67.063 0.877,4.079 0.794,6.836 1.346,12.065 ' +
                    '1.663,15.866 5.62,30.424 2.492,104.929 -2.799,66.377 ' +
                    '-3.96,53.491 -0.943,68.354 1.208,5.992 -3.063,8.431 ' +
                    '14.057,30.796 1.5,1.958 3.088,4.873 4.581,6.495 1.694,' +
                    '1.845 3.269,2.407 4.457,4.93 1.314,2.802 0.723,5.179 ' +
                    '1.38,8.273 0.807,3.74 1.647,6.727 4.105,12.349 1.013,' +
                    '2.327 -0.075,8.781 0.653,13.461 0.41,2.637 1.961,5.16 ' +
                    '2.388,7.739 0.002,0.022 0.939,1.3 0.762,2.483 -0.256,' +
                    '1.687 -2.004,3.38 -5.381,2.653 -6.446,-1.04 -7.101,' +
                    '-6.232 -10.611,-10.035 0.08,5.339 -0.595,7.281 1.099,' +
                    '29.728 0.427,5.661 3.893,30.336 -1.199,40.461 -1.756,' +
                    '3.495 -5.721,2.996 -7.803,0.51 -5.565,-6.642 -0.373,' +
                    '-10.685 -8.925,-51.36 -1.116,-5.271 -2.349,-0.61 -2.349,' +
                    '-0.61 -0.16,25.464 1.666,13.068 -0.25,31.836 -0.942,' +
                    '9.126 -0.375,27.282 -5.445,28.639 -4.658,1.253 -7.366,' +
                    '-2.318 -8.181,-5.416 -2.122,-8.108 -1.956,-18.062 ' +
                    '-2.014,-19.063 -0.154,-2.729 -1.026,-9.119 -1.135,' +
                    '-11.913 -0.365,-9.214 0.497,-12.819 -1.302,-26.917 ' +
                    '-0.143,-1.174 -1.462,-1.35 -1.462,-1.35 -1.961,1.819 ' +
                    '-0.851,8.454 -1.186,11.551 -3.15,28.922 0.442,32.063 ' +
                    '-4.351,43.031 -1.628,3.721 -6.48,3.881 -8.433,0.491 ' +
                    '-1.442,-2.512 -1.526,-5.726 -1.705,-6.352 -1.756,-6.089 ' +
                    '-1.334,-12.805 -1.863,-18.569 -0.354,-3.81 -0.926,' +
                    '-4.884 -0.856,-7.958 0.233,-10.437 2.309,-16.964 0.412,' +
                    '-27.651 -0.373,-0.187 -0.747,-0.378 -1.118,-0.564 ' +
                    '-0.745,1.157 -0.459,2.19 -0.832,3.716 -1.212,4.928 ' +
                    '-1.404,12.154 -2.204,17.859 -1.259,9.017 0.911,20.359 ' +
                    '-4.784,22.732 -2.791,-0.191 -2.603,-0.38 -4.274,-2.084 ' +
                    '-5.376,-13.557 -1.805,-31.088 -3.117,-47.522 -1.586,' +
                    '-19.77 -0.064,-18.681 0.35,-25.185 1.917,-31.072 0.966,' +
                    '-16.394 3.205,-32.181 2.262,-15.944 3.054,-13.863 4.133,' +
                    '-21.228 2.059,-14.053 -0.666,-20.851 -4.999,-37.704 ' +
                    '-0.491,-1.921 -1.163,-3.497 -1.622,-5.483 -2.089,-8.967 ' +
                    '-5.855,-19.003 -8.234,-27.605 -19.318,-69.827 -14.488,' +
                    '-54.078 -17.153,-72.648 -1.286,-8.943 -1.133,-5.494 ' +
                    '-0.113,-35.667 -0.809,-5.598 -2.364,-10.439 -3.177,' +
                    '-16.035 -1.797,-12.391 -2.844,-25.539 -4.639,-37.927 ' +
                    '-5.657,-26.218 -15.956,-48.792 -16.193,-80.094 -0.369,' +
                    '0.189 -0.743,0.378 -1.116,0.569 -2.808,11.112 -8.142,' +
                    '23.815 -12.783,35.175 -2.405,5.894 -0.418,6.326 -2.522,' +
                    '15.378 -2.886,12.424 -4.145,63.823 -0.885,88.047 0.927,' +
                    '6.952 1.197,1.809 2.793,20.448 0.284,3.354 -0.164,5.8 ' +
                    '-0.448,9.638 -0.233,3.137 -0.224,7.706 -0.638,10.272 ' +
                    '-1.468,9.087 -3.239,15.532 -1.15,24.966 2.02,9.109 ' +
                    '2.677,4.255 8.751,34.942 0.994,5.012 0.751,7.619 1.466,' +
                    '13.365 0.565,4.546 2.078,12.258 2.836,16.265 0.745,' +
                    '3.916 1.063,8.954 1.788,12.814 1.568,8.348 8.083,29.891 ' +
                    '8.46,62.064 0.704,59.53 4.476,55.504 4.024,102.244 ' +
                    '-0.614,56.92 -8.584,147.53898 -14.226,174.12198 -7.577,' +
                    '35.704 -12.762,81.961 -9.967,90.885 2.787,8.926 12.363,' +
                    '79.119 6.775,111.58 -5.582,32.455 -34.296,139.976 ' +
                    '-33.897,161.887 0.397,21.911 -5.919,41.448 0.397,55.584 ' +
                    '3.99,8.926 1.199,27.188 2.793,32.459 1.596,5.275 3.589,' +
                    '20.288 9.173,24.751 5.584,4.465 15.154,27.184 13.161,' +
                    '34.489 -1.995,7.302 -5.185,12.983 -10.37,10.956 -4.385,' +
                    '4.869 -9.971,3.651 -11.166,3.245 -1.197,-0.406 -4.387,' +
                    '8.926 -13.959,1.624 -2.392,3.649 -5.582,6.488 -12.365,' +
                    '3.649 -6.779,-2.839 -4.784,-3.649 -4.784,-3.649 l ' +
                    '-5.185,0.81 c 0,0 0.796,10.55 -8.776,10.55 -9.57,0 ' +
                    '-23.529,-6.493 -22.731,-17.04 0.796,-10.552 -0.798,' +
                    '-24.753 3.988,-39.358 -4.786,-10.144 -5.185,-26.372 ' +
                    '-2.791,-34.085 2.392,-7.704 0,-17.85 -0.401,-23.123 ' +
                    '-0.399,-5.277 7.579,-37.33 7.579,-46.254 0,-8.93 0.798,' +
                    '-90.483 -4.786,-102.654 -5.584,-12.169 -12.762,-60.049 ' +
                    '-4.387,-93.316 0,0 10.11,-48.282 10.37,-60.455 0.397,' +
                    '-18.666 -20.341,-75.874 -20.341,-98.593 0,-22.723 ' +
                    '-13.56,-109.14698 -15.154,-115.63998 -1.594,-6.492 ' +
                    '-9.109,-49.82 -9.109,-49.82'
            }]
        }
    },
 
    series: [{
        name: 'ผู้ป่วยยาเสพติด',
        data: [<?php echo $sum_r_new_f ; ?>, <?php echo $sum_r_new_m ; ?>]
    }/*
    ,{
        name: '',
        data: [0, ]
    },
    {
        name: 'Non-Essential Fat',
        data: [15, 12]
    }, {
        name: 'Muscle Tissue',
        data: [36, 45]
    },
    {
        name: 'Bone',
        data: [12, 15]
    }*/
    ],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    padding: 8,
                    margin: 12,
                    itemMarginTop: 0,
                    itemMarginBottom: 0,
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                }
            }
        }]
    }
});
                            
                        </script>
                        
                    </div>

                </div>
                
                

            </div>  
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยยาเสพติด</h3>
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button10"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    
                    </div>
                    <div class="card-body">
                        <canvas id="myChart10" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                        <script>
                            const ctx10 = document.getElementById('myChart10');

                            
                            const downloadButton10 = document.getElementById('download-button10');

                            const myChart10 = new Chart(ctx10, {
                                type: 'line',
                                data: {
                                    labels: ['F10  Alcohol related disorders','F11  Opioid related disorders',
                                        'F12  Cannabis related disorders','F13  Sedative, hypnotic, or anxiolytic related disorders',
                                        'F14  Cocaine related disorders', 'F15  Other stimulant related disorders',
                                        'F16  Hallucinogen related disorders', 'F17  Nicotine dependence',
                                        'F18  Inhalant related disorders','F19  Other psychoactive substance related disorders'
                                    ],
                                    
                                    datasets: [{
                                        label: '2564',
                                        data: [<?php echo $sum_year05;?>],
                                        backgroundColor: '#F0ccdc',
                                        borderColor: '#F0ccdc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2565',
                                        data: [<?php echo $sum_year04;?>],
                                        backgroundColor: '#B0cddc',
                                        borderColor: '#B0cddc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2566',
                                        data: [<?php echo $sum_year03;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2567',
                                        data: [<?php echo $sum_year02;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2568',
                                        data: [<?php echo $sum_year01;?>],
                                        backgroundColor: '#65a6fa',
                                        borderColor: '#65a6fa',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    }]
                                },

                                    <?php /*
                                    datasets: [{
                                        label: 'F10  Alcohol related disorders',
                                        data: [<?php echo $sum_f10_all;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F11  Opioid related disorders',
                                        data: [<?php echo $sum_f11_all;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F12  Cannabis related disorders',
                                        data: [<?php echo $sum_f12_all;?>],
                                        backgroundColor: '#65a6fa',
                                        borderColor: '#65a6fa',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F13  Sedative, hypnotic, or anxiolytic related disorders',
                                        data: [<?php echo $sum_f13_all;?>],
                                        backgroundColor: '#7e80e7',
                                        borderColor: '#7e80e7',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset	
                                    },
                                    {
                                        label: 'F14  Cocaine related disorders',
                                        data: [<?php echo $sum_f14_all;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F15  Other stimulant related disorders',
                                        data: [<?php echo $sum_f15_all;?>],
                                        backgroundColor: '#bb109d',
                                        borderColor: '#bb109d',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F16  Hallucinogen related disorders',
                                        data: [<?php echo $sum_f16_all;?>],
                                        backgroundColor: '#d0005f',
                                        borderColor: '#d0005f',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'F17  Nicotine dependence',
                                        data: [<?php echo $sum_f17_all;?>],
                                        backgroundColor: '#de4f45',
                                        borderColor: '#de4f45',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset	
                                    },
                                    {
                                        label: 'F18  Inhalant related disorders',
                                        data: [<?php echo $sum_f18_all;?>],
                                        backgroundColor: '#f79150',
                                        borderColor: '#f79150',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset	
                                    },
                                    {
                                        label: 'F19  Other psychoactive substance related disorders',
                                        data: [<?php echo $sum_f19_all;?>],
                                        backgroundColor: '#ffcb76',
                                        borderColor: '#ffcb76',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset	
                                    }]
                                },
                                */ ?>
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

                            downloadButton10.addEventListener('click', function() {
                            const chartData10 = myChart10.toBase64Image(); // Get chart image data
                            const link = document.createElement('a');
                            link.href = chartData10;
                            link.download = 'stacked-barchart.png'; // Set download filename
                            link.click();
                            });
                        
                        </script>
                        
                    </div>

                </div> 

            </div>
            
        </div>    

         


        
    
    <!-- Default box -->
    <div class="row">
		<div class="col-md-6">
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยSMIV</h3>
                        <div class="tooltip2"><i class='far fa-question-circle' style='font-size:14px;color:royalblue;'></i>
							<span class="tooltiptext"> 
								<ul>
									<li>1B030 : การประเมิน ผู้ป่วยจิตเวชที่มีความเสี่ยงสูง พบทำร้ายตนเองด้วยวิธีรุนแรง  มุ่งหวังให้เสียชีวิต</li>
									<li>1B031 : การประเมิน ผู้ป่วยจิตเวชที่มีความเสี่ยงสูง พบทำร้ายผู้อื่นด้วยวิธีรุนแรง/ก่อเหตุการณ์รุนแรงในชุมชน</li>
									<li>1B032 : การประเมิน ผู้ป่วยจิตเวชที่มีความเสี่ยงสูง พบมีอาการหลงผิด มีความคิดทำร้าย ผู้อื่นให้ถึงกับชีวิต หรือมุ่งร้ายผู้อื่นแบบเฉพาะเจาะจง เช่น ระบุชื่อคนที่จะมุ่งร้าย</li>
									<li>1B033 : การประเมิน ผู้ป่วยจิตเวชที่มีความเสี่ยงสูง พบก่อคดีอาชญากรรมรุนแรง  (ฆ่า พยายามฆ่า ข่มขืน วางเพลิง)</li>
								</ul>
							</span>
						</div>
                        
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button11"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart11" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                        <script>
                            const ctx11 = document.getElementById('myChart11');

                            const downloadButton11 = document.getElementById('download-button11');

                            const myChart11 = new Chart(ctx11, {
                                type: 'line',

                                    data: {
                                    labels: [<?php echo $labelhdc04; ?>],
                                    datasets: [{
                                        label: '1B030',
                                        data: [12, 22, 32, 22, 22],
                                        data: [<?php echo $hdc04_1;?>],
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined2' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B031',
                                        data: [<?php echo $hdc04_2;?>],
                                        backgroundColor: '#65a6fa',
                                        borderColor: '#65a6fa',
                                        borderWidth: 1,
                                        stack: 'combined3' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B032',
                                        data: [<?php echo $hdc04_3;?>],
                                        backgroundColor: '#7e80e7',
                                        borderColor: '#7e80e7',
                                        borderWidth: 1,
                                        stack: 'combined4' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B033',
                                        data: [<?php echo $hdc04_4;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined5' // Enable stacking for this dataset
                                    <?php /*},
                                    {
                                        label: '1B034',
                                        data: [<?php echo $hdc01_3;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined5' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B035',
                                        data: [<?php echo $hdc02_41;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined5' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B036',
                                        data: [<?php echo $hdc02_42;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined5' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '1B037',
                                        data: [<?php echo $hdc01_41;?>],
                                        backgroundColor: '#9b57cc',
                                        borderColor: '#9b57cc',
                                        borderWidth: 1,
                                        stack: 'combined5' // Enable stacking for this dataset */?>
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

                            downloadButton11.addEventListener('click', function() {
                            const chartData11 = myChart11.toBase64Image(); // Get chart image data
                            const link = document.createElement('a');
                            link.href = chartData11;
                            link.download = 'stacked-barchart.png'; // Set download filename
                            link.click();
                            });
                        
                        </script>
                        
                    </div>

                </div>
                


            </div>
        </div>        
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #f0eec8; color: black;">
				  <div class="inner">
                    
                    <p>อัตราการฆ่าตัวตาย</p>
					<h3><?php echo number_format($total_result1, 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($total_result1 / $Total)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #c9ffda; color: black;">
				  <div class="inner">
                    
                    <p>อัตราการพยายามฆ่าตัวตาย</p>
					<h3><?php echo number_format($total_result_22_1, 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($total_result_22_1 / $Total)*100000), 4, '.', ',');?> : 1แสน ประชากร</p>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
       <?php /*
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ผู้ฆ่าตัวตายสำเร็จ</h3>
                            
                            <div align="right">
                                <button class="btn btn-navbar" id="download-button13"><img width="10%" src="images/downloand.png"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart13" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                            <script>
                                const ctx13 = document.getElementById('myChart13');
                                
                                
                                const downloadButton13 = document.getElementById('download-button13');

                                const myChart13 = new Chart(ctx13, {
                                    type: 'bar',
                                    data: {
                                        labels: [''],
                                        datasets: [{
                                            label: '',
                                            data: [<?php echo $total_result1; ?>], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                            backgroundColor: 'pink',
                                            borderColor: 'pink',
                                            borderWidth: 1
                                        }/*,{
                                            label: 'Female',
                                            data: [-10000, -11000, -12000], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
                                            backgroundColor: 'pink',
                                            borderColor: 'pink',
                                            borderWidth: 1
                                        }*/ /*]
                                    },
                                    options: {
                                        plugins: {
                            tooltip: {
                            intersect: true,
                            callbacks: {
                                label: function(context) {
                                var label = context.dataset.label || '';
                                var value = context.formattedValue;
                                var positiveOnly = value < 0 ? -value : value;
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += positiveOnly
                                }
                                return label;
                                },
                            },
                            },
                            legend: {
                            position: "bottom",
                            },
                        },
                        responsive: true,
                                        indexAxis: 'y', // แสดงกราฟแบบแนวนอน
                                        scales: {
                                        x: {
                                        stacked: false,
                                        ticks: {
                                            beginAtZero: true,
                                            callback: (v) => {
                                            return v < 0 ? -v : v;
                                            },
                                        },
                                        },
                                        y: {
                                        stacked: true,
                                        ticks: {
                                            beginAtZero: true,
                                        },
                                        position: "left",
                                        },
                                    },
                                    }
                                });

                        downloadButton.addEventListener('click', function() {
                            const chartData13 = myChart13.toBase64Image(); // Get chart image data
                            const link = document.createElement('a');
                            link.href = chartData13;
                            link.download = 'stacked-barchart.png'; // Set download filename
                            link.click();
                        });
                            </script>
                            
                        </div>

                    </div>
				
			    </div>
			    <!-- ./col -->
			    <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ผู้พยายามฆ่าตัวตาย</h3>
                            
                            <div align="right">
                                <button class="btn btn-navbar" id="download-button12"><img width="10%" src="images/downloand.png"></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart12" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                            <script>
                                const ctx12 = document.getElementById('myChart12');
                                
                                
                                const downloadButton12 = document.getElementById('download-button12');

                                const myChart12 = new Chart(ctx12, {
                                    type: 'bar',
                                    data: {
                                        labels: [''],
                                        datasets: [{
                                            label: '',
                                            data: [<?php echo $total_result_22_1; ?>], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                            backgroundColor: 'blue',
                                            borderColor: 'blue',
                                            borderWidth: 1
                                        }/*,{
                                            label: 'Female',
                                            data: [-10000, -11000, -12000], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
                                            backgroundColor: 'pink',
                                            borderColor: 'pink',
                                            borderWidth: 1
                                        }*//*]
                                    },
                                    options: {
                                        plugins: {
                            tooltip: {
                            intersect: true,
                            callbacks: {
                                label: function(context) {
                                var label = context.dataset.label || '';
                                var value = context.formattedValue;
                                var positiveOnly = value < 0 ? -value : value;
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += positiveOnly
                                }
                                return label;
                                },
                            },
                            },
                            legend: {
                            position: "bottom",
                            },
                        },
                        responsive: true,
                                        indexAxis: 'y', // แสดงกราฟแบบแนวนอน
                                        scales: {
                                        x: {
                                        stacked: false,
                                        ticks: {
                                            beginAtZero: true,
                                            callback: (v) => {
                                            return v < 0 ? -v : v;
                                            },
                                        },
                                        },
                                        y: {
                                        stacked: true,
                                        ticks: {
                                            beginAtZero: true,
                                        },
                                        position: "left",
                                        },
                                    },
                                    }
                                });

                        downloadButton.addEventListener('click', function() {
                            const chartData12 = myChart12.toBase64Image(); // Get chart image data
                            const link = document.createElement('a');
                            link.href = chartData12;
                            link.download = 'stacked-barchart.png'; // Set download filename
                            link.click();
                        });
                            </script>
                            
                        </div>

                    </div>
				
			    </div>
			    <!-- ./col -->
			    
			 
			</div>
			<!-- ./row -->	 
      <?php */ ?>
			</div>

		
      
        
        
		<div class="col-md-6">
		  <div class="row">
			<div class="col-lg-12">

            <div class="card-body">
					<div id="container"></div>
					
				</div>
				
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
            </div>
            </div>
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">อัตราการฆ่าตัวตายสำเร็จและอัตราการพยายามฆ่าตัวตาย</h3>
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button14"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    
                    </div>
                    <div class="card-body">
                        <canvas id="myChart14" style="min-height: 100%; height: 900px; max-height: 700px; max-width: 100%;"></canvas>
                        <script>
                            const ctx14 = document.getElementById('myChart14');
                            
                            const downloadButton14 = document.getElementById('download-button14');

                            const myChart14 = new Chart(ctx14, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $labels_2;?>],
                                    datasets: [{
                                        label: 'อัตราการฆ่าตัวตายสำเร็จ',
                                        data: [<?php echo $total_result1_2;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined1' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'อัตราการพยายามฆ่าตัวตาย',
                                        data: [<?php echo $total_result_22;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined2' // Enable stacking for this dataset
                                   
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

                            downloadButton14.addEventListener('click', function() {
                            const chartData14 = myChart14.toBase64Image(); // Get chart image data
                            const link = document.createElement('a');
                            link.href = chartData14;
                            link.download = 'stacked-barchart.png'; // Set download filename
                            link.click();
                            });
                        
                        </script>
                        
                    </div>

                </div> 

            </div>
            
        </div> 
                   
        </div>
            
            </div> 
                   
            </div>
            
            </div> 
                       
        
      
                        </section>    
	
		
	
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
                text: 'อัตราการฆ่าตัวตายสำเร็จ' // Optional title
            },

            mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
                    from: 8,
                    color: '#ff3131',
                    name: '> 8 : แสนประชากร '
                }, {
                    from: 8,
                    to: 6.3,
                    color: '#ff914d',
                    name: '6.3 - 8 : แสนประชากร '
                }, {
                    to: 6.3,
                    color: '#ffde59',
                    name: '< 6.3 : แสนประชากร ' 
                }, {
                    to: 0,
                    color: '#7ed957',
                    name: 'ไม่มี '
                }]
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
           window.location.href = 'dashboard09.php'; 
        });

      
</script>


</body>
</html>
