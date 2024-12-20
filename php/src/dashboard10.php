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

$Year = '2567';

$sqlmid = "SELECT
    CODE_PROVINCE,
    YEAR,
    SUM(CODE_MALE) AS Total_Male,
    SUM(CODE_FEMALE) AS Total_Female,
    SUM(CODE_TOTAL) AS Total
FROM Midyear ;";
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
    1  ";

/*
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $msql1 = $msql1."AND ho.b_year = '".$Year."'" ;
  }else{
    $msql1 = $msql1."AND ho.b_year = '".$Year."'" ;
  }
*/
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
    $msql1 = $msql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $msql1 = $msql1."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
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
  groupcode,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB01 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
/*    
if (isset($_POST['Year'])) {
    $sqlhdc01 = $sqlhdc01."AND ho.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc01 = $sqlhdc01."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlhdc01 = $sqlhdc01."AND ho.b_year = '".$Year."'" ;
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
    $sqlhdc01 = $sqlhdc01."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
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
$hdc01tatal1='';
$hdc01tatal2='';
$hdc01tatal3='';
$hdc01tatal41='';
$hdc01tatal42='';

while($rowhdc01 = mysqli_fetch_array($objhdc01))
{
	if($rowhdc01['groupcode'] == '1.1'){
		$hdc01_1 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
        $hdc01tatal1 = $rowhdc01['total_2567'];
	}else if($rowhdc01['groupcode'] == '2.0'){
		$hdc01_2 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
        $hdc01tatal2 = $rowhdc01['total_2567'];
	}else if($rowhdc01['groupcode'] == '3.0'){
		$hdc01_3 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
        $hdc01tatal3 = $rowhdc01['total_2567'];
	}else if($rowhdc01['groupcode'] == '4.1'){
		$hdc01_41 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
        $hdc01tatal41 = $rowhdc01['total_2567'];
	}else if($rowhdc01['groupcode'] == '4.2'){
		$hdc01_42 = "'".$rowhdc01['total_2563']."','".$rowhdc01['total_2564']."','".$rowhdc01['total_2565']."','".$rowhdc01['total_2566']."','".$rowhdc01['total_2567']."'";
        $hdc01tatal42 = $rowhdc01['total_2567'];
	}
	
}

$sqlhdc02 = "SELECT
  groupcode,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB02 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
 
 /*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlhdc02 = $sqlhdc02."AND ho.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc02 = $sqlhdc02."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlhdc02 = $sqlhdc02."AND ho.b_year = '".$Year."'" ;
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
    $sqlhdc02 = $sqlhdc02."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
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

while($rowhdc02 = mysqli_fetch_array($objhdc02))
{
	if($rowhdc02['groupcode'] == '1.1'){
		$hdc02_1 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
        $hdc02tatal1 = $rowhdc02['total_2567'];
	}else if($rowhdc02['groupcode'] == '2.0'){
		$hdc02_2 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
        $hdc02tatal2 = $rowhdc02['total_2567'];
	}else if($rowhdc02['groupcode'] == '3.0'){
		$hdc02_3 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
        $hdc02tatal3 = $rowhdc02['total_2567'];
	}else if($rowhdc02['groupcode'] == '4.1'){
		$hdc02_41 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
        $hdc02tatal41 = $rowhdc02['total_2567'];
	}else if($rowhdc02['groupcode'] == '4.2'){
		$hdc02_42 = "'".$rowhdc02['total_2563']."','".$rowhdc02['total_2564']."','".$rowhdc02['total_2565']."','".$rowhdc02['total_2566']."','".$rowhdc02['total_2567']."'";
        $hdc02tatal42 = $rowhdc02['total_2567'];
	}
	//['th-ct', 10],
}

;

$total_result1 = '';
$total_result2 = '';
$total_all = '';

$sqlHD16 = "SELECT
 	ho.b_year,
    SUM(ho.result1) AS total_result1,
    SUM(ho.result2) AS total_result2,
    SUM(ho.result1 + ho.result2) AS total_all
FROM
    HDCTB16 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
 
/* 
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD16 = $sqlHD16."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD16 = $sqlHD16."AND ho.b_year = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD16 = $sqlHD16."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlHD16 = $sqlHD16."AND ho.b_year = '".$Year."'" ;
  }
  
  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD16 = $sqlHD16."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD16 = $sqlHD16."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD16 = $sqlHD16."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD16 = $sqlHD16."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD16 = $sqlHD16."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
 $sqlHD16 = $sqlHD16."  
GROUP BY
  ho.b_year;";

$objHD16 = mysqli_query($con, $sqlHD16);
$rowHD16 = mysqli_fetch_array($objHD16);

$total_result1 = $rowHD16['total_result1'];
$total_result2 = $rowHD16['total_result2'];
$total_all = $rowHD16['total_all'];

$sqlHD12 = "SELECT
    ho.b_year,
    SUM(ho.result1) AS total12_result1,
    SUM(ho.result2) AS total12_result2,
    SUM(ho.result3) AS total12_result3,
    SUM(ho.result4) AS total12_result4
FROM
    HDCTB12 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
 
/* 
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD12 = $sqlHD12."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD12 = $sqlHD12."AND ho.b_year = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD12 = $sqlHD12."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlHD12 = $sqlHD12."AND ho.b_year = '".$Year."'" ;
  }
  

  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD12 = $sqlHD12."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD12 = $sqlHD12."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD12 = $sqlHD12."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD12 = $sqlHD12."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD12 = $sqlHD12."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD12 = $sqlHD12."  
GROUP BY
    ho.b_year;";

$objHD12 = mysqli_query($con, $sqlHD12);
$rowHD12 = mysqli_fetch_array($objHD12);

$total12_result1 = $rowHD12['total12_result1'];
$total12_result2 = $rowHD12['total12_result2'];
$total12_result3 = $rowHD12['total12_result3'];
$total12_result4 = $rowHD12['total12_result4'];

$sqlHD13 = "SELECT
    ho.b_year,
    SUM(ho.result1) AS total13_result1,
    SUM(ho.result2) AS total13_result2,
    SUM(ho.result3) AS total13_result3,
    SUM(ho.result4) AS total13_result4
FROM
    HDCTB13 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
 
 /*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD13 = $sqlHD13."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD13 = $sqlHD13."AND ho.b_year = '".$Year."'" ;
  }
*/

  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD13 = $sqlHD13."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlHD13 = $sqlHD13."AND ho.b_year = '".$Year."'" ;
  }

  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD13 = $sqlHD13."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD13 = $sqlHD13."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD13 = $sqlHD13."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD13 = $sqlHD13."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD13 = $sqlHD13."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD13 = $sqlHD13."  
GROUP BY
    ho.b_year;";
$objHD13 = mysqli_query($con, $sqlHD13);
$rowHD13 = mysqli_fetch_array($objHD13);

$total13_result1 = $rowHD13['total13_result1'];
$total13_result2 = $rowHD13['total13_result2'];
$total13_result3 = $rowHD13['total13_result3'];
$total13_result4 = $rowHD13['total13_result4'];


$sqlHD14 = "SELECT
    ho.b_year,
    SUM(ho.result1) AS total14_result1,
    SUM(ho.result2) AS total14_result2,
    SUM(ho.result3) AS total14_result3
FROM
    HDCTB14 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
 
 /*
if (isset($_POST['Year'])) {
    $sqlHD14 = $sqlHD14."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD13 = $sqlHD14."AND ho.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD14 = $sqlHD14."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlHD14 = $sqlHD14."AND ho.b_year = '".$Year."'" ;
  }


  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD14 = $sqlHD14."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD14 = $sqlHD14."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD14 = $sqlHD14."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD14 = $sqlHD14."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD14 = $sqlHD14."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD14 = $sqlHD14."  
GROUP BY
    ho.b_year;";

$objHD14 = mysqli_query($con, $sqlHD14);
$rowHD14 = mysqli_fetch_array($objHD14);

$total14_result1 = $rowHD14['total14_result1'];
$total14_result2 = $rowHD14['total14_result2'];
$total14_result3 = $rowHD14['total14_result3'];

$sqlHD15 = "SELECT
    ho.b_year,
    SUM(ho.result1) AS total15_result1,
    SUM(ho.result2) AS total15_result2,
    SUM(ho.result3) AS total15_result3,
    SUM(ho.result4) AS total15_result4
FROM
    HDCTB15 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD15 = $sqlHD15."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD15 = $sqlHD15."AND ho.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD15 = $sqlHD15."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    $sqlHD15 = $sqlHD15."AND ho.b_year = '".$Year."'" ;
  }


  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD15 = $sqlHD15."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD15 = $sqlHD15."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD15 = $sqlHD15."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD15 = $sqlHD15."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD15 = $sqlHD15."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD15 = $sqlHD15."  
GROUP BY
    ho.b_year;";

$objHD15 = mysqli_query($con, $sqlHD15);
$rowHD15 = mysqli_fetch_array($objHD15);

$total15_result1 = $rowHD15['total15_result1'];
$total15_result2 = $rowHD15['total15_result2'];
$total15_result3 = $rowHD15['total15_result3'];
$total15_result4 = $rowHD15['total15_result4'];





$sqlHD23 = "SELECT
  groupcode, ";
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
        $sqlHD23 = $sqlHD23."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlHD23 = $sqlHD23."SUM(CASE WHEN b_year = '".((date("Y")+543+1))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
    }else{
      
      if($i == 4){
        $sqlHD23 = $sqlHD23."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i." ";
      }else{
        $sqlHD23 = $sqlHD23."SUM(CASE WHEN b_year = '".((date("Y")+543))-$i."' THEN total ELSE 0 END) AS total_".((date("Y")+543+1))-$i.",";
      }
      }
  }
$sqlHD23 = $sqlHD23."
FROM
  HDCTB23 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD23 = $sqlHD23."AND h.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD23 = $sqlHD23."AND h.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
    //$sqlHD23 = $sqlHD23."AND h.b_year = '".$Year."'" ;
  }


  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD23 = $sqlHD23."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD23 = $sqlHD23."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD23 = $sqlHD23."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD23 = $sqlHD23."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD23 = $sqlHD23."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD23 = $sqlHD23."  
GROUP BY
  groupcode;";
	
$objhdc23 = mysqli_query($con, $sqlHD23);

$hdc23_1 ='';
$hdc23_2 ='';
$hdc23_3 ='';
$hdc23_41 ='';
$hdc23_42 ='';
$hdc23tatal1='';
$hdc23tatal2='';
$hdc23tatal3='';
$hdc23tatal41='';
$hdc23tatal42='';

$labelhdc23 = ''; // ทำให้ค่าว่างก่อนเริ่ม
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
        $labelhdc23 .= "'ปี $year' "; // ปีสุดท้าย (2568)
    } else {
        $labelhdc23 .= "'ปี $year',"; // ปีอื่นๆ
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

while($rowhdc23 = mysqli_fetch_array($objhdc23))
{
	if($rowhdc23['groupcode'] == '8'){
		$hdc23_1 = "'".$rowhdc23[$years2[4]]."','".$rowhdc23[$years2[3]]."','".$rowhdc23[$years2[2]]."','".$rowhdc23[$years2[1]]."','".$rowhdc23[$years2[0]]."'";
        $hdc23tatal1 = $rowhdc23[$years2[0]];
	}else if($rowhdc23['groupcode'] == '10.1'){
		$hdc23_2 = "'".$rowhdc23[$years2[4]]."','".$rowhdc23[$years2[3]]."','".$rowhdc23[$years2[2]]."','".$rowhdc23[$years2[1]]."','".$rowhdc23[$years2[0]]."'";
        $hdc23tatal2 = $rowhdc23[$years2[0]];
	}else if($rowhdc23['groupcode'] == '9.2'){
		$hdc23_3 = "'".$rowhdc23[$years2[4]]."','".$rowhdc23[$years2[3]]."','".$rowhdc23[$years2[2]]."','".$rowhdc23[$years2[1]]."','".$rowhdc23[$years2[0]]."'";
        $hdc23tatal3 = $rowhdc23[$years2[0]];
	}else if($rowhdc23['groupcode'] == '4.1'){
		$hdc23_41 = "'".$rowhdc23[$years2[4]]."','".$rowhdc23[$years2[3]]."','".$rowhdc23[$years2[2]]."','".$rowhdc23[$years2[1]]."','".$rowhdc23[$years2[0]]."'";
        $hdc23tatal41 = $rowhdc23[$years2[0]];
	}else if($rowhdc23['groupcode'] == '4.2'){
		$hdc23_42 = "'".$rowhdc23[$years2[4]]."','".$rowhdc23[$years2[3]]."','".$rowhdc23[$years2[2]]."','".$rowhdc23[$years2[1]]."','".$rowhdc23[$years2[0]]."'";
        $hdc23tatal42 = $rowhdc23[$years2[0]];
	}
	
}



$sqlHD16_2 = "SELECT
 	ho.b_year,
    SUM(ho.result1) AS total_result1,
    SUM(ho.result2) AS total_result2,
    SUM(ho.result1 + ho.result2) AS total_all
FROM
    HDCTB16 ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year'];
    $sqlHD16_2 = $sqlHD16_2."AND ho.b_year = '".$Year."'" ;
  }else{
    $sqlHD16_2 = $sqlHD16_2."AND ho.b_year = '".$Year."'" ;
  }
*/
  if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlHD16_2 = $sqlHD16_2."AND ho.b_year = '".$Year."'" ;
  }else{
    if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
      $Year = (date("Y"))+1+543;
    }else{
      $Year = (date("Y"))+543;
    }
   // $sqlHD16_2 = $sqlHD16_2."AND ho.b_year = '".$Year."'" ;
  }


  if (isset($_POST['CODE_HMOO'])) {
    if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlHD16_2 = $sqlHD16_2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
    }
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $sqlHD16_2 = $sqlHD16_2."AND hn.type_Affiliation = '".$type_Affiliation."'" ;
    }
  }
  
  if (isset($_POST['TYPE_SERVICE'])) {
    if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlHD16_2 = $sqlHD16_2."AND hn.HOS_TYPE = '".$mySelect."'" ;
    }
  }
  
  if (isset($_POST['CODE_PROVINCE'])) {
    if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
    $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
    $sqlHD16_2 = $sqlHD16_2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
    }
  }
  
  if (isset($_POST['CODE_HOS'])) {
    if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
    $CODE_HOS = $_POST['CODE_HOS'];
    $sqlHD16_2 = $sqlHD16_2."AND hn.CODE5 = '".$CODE_HOS."'" ;
    }
  }
$sqlHD16_2 = $sqlHD16_2."  
GROUP BY
    ho.b_year
ORDER by ho.b_year ASC";

$objHD16_2 = mysqli_query($con, $sqlHD16_2);

$labels_2 = '';
$total_result1_2 = '';
$total_result2_2 = '';
$total_all_2 = '';

while($rowHD16 = mysqli_fetch_array($objHD16_2))
{
    $labels_2 = $labels_2."'".$rowHD16['b_year']."',";
    $total_result1_2 = $total_result1_2."'".$rowHD16['total_result1']."',";
    $total_result2_2 = $total_result2_2."'".$rowHD16['total_result2']."',";
    $total_all_2 = $total_all_2."'".$rowHD16['total_all']."',";
 
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
        //$sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
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

/*
$sqlHD13_2 = "SELECT
	ho.b_year,
    SUM(ho.target) AS sum_target
FROM
    HDCTB13 ho
WHERE
    ho.b_year = '2567'
Group by 
	ho.b_year";	
$objHD13_2 = mysqli_query($con, $sqlHD13_2);
$rowHD13_2 = mysqli_fetch_array($objHD13_2);

$sum_target = $rowHD13_2['sum_target'];

$sqlHD15 = "SELECT
    ho.b_year,
    SUM(ho.result1) AS total15_result1,
    SUM(ho.result2) AS total15_result2,
    SUM(ho.result3) AS total15_result3,
    SUM(ho.result4) AS total15_result4
FROM
    HDCTB15 ho
WHERE
    ho.b_year = '2567'
GROUP BY
    ho.b_year;";
$objHD15 = mysqli_query($con, $sqlHD15);
$rowHD15 = mysqli_fetch_array($objHD15);

$total15_result1 = $rowHD15['total15_result1'];
$total15_result2 = $rowHD15['total15_result2'];
$total15_result3 = $rowHD15['total15_result3'];
$total15_result4 = $rowHD15['total15_result4'];
*/

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
            <h3>จิตเวชเด็กและวัยรุ่น</h3>
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
			<form class="form-valide" action="dashboard10.php" method="post" id="myform1" name="foml">  
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

    <div class="row">
        <div class="col-lg-2">
            <!-- small card -->
            <div class="small-box" style="background-color: #ecc8d9; color: black;">
                <div class="inner">
                
                <p>ภาวะบกพร่องทางสติปัญญา</p>
                <h3><?php echo number_format($total14_result2);?> คน</h3>
                <p><?php echo number_format((($total14_result2/ $Total)*100000), 4);?>: 1แสน ประชากร</p>
                
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
                
                <p>โรคสมาธิสั้น</p>
                <h3><?php echo number_format($total12_result2);?> คน</h3>
                <p><?php echo number_format((($total12_result2/ $Total)*100000), 4);?>: 1แสน ประชากร</p>
                
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
                
                <p>โรคออทิสติก</p>
                <h3><?php echo number_format($total13_result2);?> คน</h3>
                <p><?php echo number_format((($total13_result2/ $Total)*100000), 4);?>: 1แสน ประชากร</p>
                
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
                <h3><?php echo number_format($total15_result2);?> คน</h3>
                <p><?php echo number_format((($total15_result2/ $Total)*100000), 4);?>: 1แสน ประชากร</p>
                
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
                <h3><?php echo number_format($total_result1);?> คน</h3>
                <p><?php echo number_format((($total_result1/ $Total)*100000), 4);?>: 1แสน ประชากร</p>
                
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
                        <h3 class="card-title">ผู้ป่วยจิตเวชเด็กและวัยรุ่น</h3>
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
                                    labels: [ <?php echo $labelhdc23; ?>],
                                    datasets: [{
                                        label: 'ภาวะบกพร่องทางสติปัญญา',
                                        data: [<?php echo $hdc23_1;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined1' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'โรคสมาธิสั้น',
                                        data: [<?php echo $hdc23_2;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined2' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'โรคออทิสติก',
                                        data: [<?php echo $hdc23_3;?>],
                                        backgroundColor: '#65a6fa',
                                        borderColor: '#65a6fa',
                                        borderWidth: 1,
                                        stack: 'combined3' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'โรคซึมเศร้า',
                                        data: [<?php echo $hdc23_42;?>],
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
                        <h3 class="card-title">ผู้ป่วยเด็กและวัยรุ่นยาเสพติด</h3>
                        
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
                                    labels: [<?php echo $labels; ?>],
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยเด็กและวัยรุ่นยาเสพติด</h3>
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button5"><img width="10%" src="images/downloand.png"></button>
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
                                    labels: ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79','80-84', '85+'],
                                    datasets: [{
                                        label: 'Male',
                                        data: [15000, 12000, 10000], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                        backgroundColor: 'blue',
                                        borderColor: 'blue',
                                        borderWidth: 1
                                    },{
                                        label: 'Female',
                                        data: [-10000, -11000, -12000], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
                                        backgroundColor: 'pink',
                                        borderColor: 'pink',
                                        borderWidth: 1
                                    }]
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยโรคซึมเศร้า</h3>
                        
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button8"><img width="10%" src="images/downloand.png"></button>
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
                                    labels: ['15+'],
                                    datasets: [{
                                        label: '',
                                        data: [<?php echo $total15_result1;?>], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                        backgroundColor: 'blue',
                                        borderColor: 'blue',
                                        borderWidth: 1
                                    }/*,{
                                        label: 'Female',
                                        data: [-10000, -11000, -12000], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
                                        backgroundColor: 'pink',
                                        borderColor: 'pink',
                                        borderWidth: 1
                                    }*/]
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ฆ่าตัวตายสำเร็จ</h3>
                        
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button9"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="#"><canvas id="myChart9" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
                        <script>
                            const ctx9 = document.getElementById('myChart9');
                            
                            
                            const downloadButton9 = document.getElementById('download-button9');

                            const myChart9 = new Chart(ctx9, {
                                type: 'bar',
                                data: {
                                    labels: ['15+'],
                                    datasets: [{
                                        label: '',
                                        data: [<?php echo $total_result1;?>], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                        backgroundColor: 'pink',
                                        borderColor: 'pink',
                                        borderWidth: 1
                                    }/*,{
                                        label: 'Female',
                                        data: [-10000, -11000, -12000], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
                                        backgroundColor: 'pink',
                                        borderColor: 'pink',
                                        borderWidth: 1
                                    }*/]
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
                        const chartData = myChart9.toBase64Image(); // Get chart image data
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


       
    <!-- Default box -->
    <div class="row">
		<div class="col-md-6">
        <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยจิตเวชเด็กและวัยรุ่นพยายามฆ่าตัวตาย และฆ่าตัวตายสำเร็จ </h3>
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button14"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    
                    </div>
                    <div class="card-body">
                        <a href="#"><canvas id="myChart14" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
                        <script>
                            const ctx14 = document.getElementById('myChart14');

                            
                            const downloadButton14 = document.getElementById('download-button14');

                            const myChart14 = new Chart(ctx14, {
                                type: 'line',
                                /*data: {
                                    labels: [<?php //echo $labels_2;?>],
                                    datasets: [{
                                        label: 'อัตราการฆ่าตัวตายสำเร็จ',
                                        data: [<?php //echo $total_result1_2;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined1' // Enable stacking for this dataset
                                    },
                                    {
                                        label: 'อัตราการพยายามฆ่าตัวตาย',
                                        data: [<?php //echo $total_result2_2;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined2' // Enable stacking for this dataset
                                   
                                    }]
                                },
                                */
                                data: {
                                    labels: [<?php echo $labels_22;?>],
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

		
      
        
        
		<div class="col-md-6">
		
			<div class="col-lg-12">

            <div class="card-body">
					<div id="container"></div>
					
				</div>
				
			  </div>
			  <!-- ./col -->
			 
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
           window.location.href = 'dashboard10.php'; 
        });

      
</script>


</body>
</html>
