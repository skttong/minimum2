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
  groupcode,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB01 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
    
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc01 = $sqlhdc01."AND h.b_year = '".$Year."'" ;
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
  HDCTB02 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
    
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc02 = $sqlhdc02."AND h.b_year = '".$Year."'" ;
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

$sqlhdc04 = "SELECT
  smiv,
  SUM(CASE WHEN b_year = '2567' THEN total ELSE 0 END) AS total_2567,
  SUM(CASE WHEN b_year = '2566' THEN total ELSE 0 END) AS total_2566,
  SUM(CASE WHEN b_year = '2565' THEN total ELSE 0 END) AS total_2565,
  SUM(CASE WHEN b_year = '2564' THEN total ELSE 0 END) AS total_2564,
  SUM(CASE WHEN b_year = '2563' THEN total ELSE 0 END) AS total_2563
FROM
  HDCTB04 h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
WHERE
    1 ";
    
if (isset($_POST['Year'])) {
    $Year = $_POST['Year'];
    $sqlhdc04 = $sqlhdc04."AND h.b_year = '".$Year."'" ;
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


while($rowhdc04 = mysqli_fetch_array($objhdc04))
{
	if($rowhdc04['smiv'] == '0'){
		$hdc04_1 = "'".$rowhdc04['total_2565']."','".$rowhdc04['total_2566']."','".$rowhdc04['total_2567']."'";
        $hdc04tatal1 = $rowhdc04['total_2567'];
	}else if($rowhdc04['smiv'] == '1'){
		$hdc04_2 = "'".$rowhdc04['total_2565']."','".$rowhdc04['total_2566']."','".$rowhdc04['total_2567']."'";
        $hdc04tatal2 = $rowhdc04['total_2567'];
	}else if($rowhdc04['smiv'] == '2'){
		$hdc04_3 = "'".$rowhdc04['total_2565']."','".$rowhdc04['total_2566']."','".$rowhdc04['total_2567']."'";
        $hdc04tatal3 = $rowhdc04['total_2567'];
	}else if($rowhdc04['smiv'] == '3'){
		$hdc04_4 = "'".$rowhdc04['total_2565']."','".$rowhdc04['total_2566']."','".$rowhdc04['total_2567']."'";
        $hdc04tatal4 = $rowhdc04['total_2567'];
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
    
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
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
    
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18OLD = $sqlHD18OLD."AND ho.b_year = '".$Year."'" ;
      }else{
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
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
    if($rowHD18OLD['b_year']=='2567'){
        $sum_year01 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2566'){
        $sum_year02 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }elseif($rowHD18OLD['b_year']=='2565'){
        $sum_year03 = "'".$rowHD18OLD['sum_f10_all']."',"."'".$rowHD18OLD['sum_f11_all']."',"."'".$rowHD18OLD['sum_f12_all']."',"."'".$rowHD18OLD['sum_f13_all']."',"."'".$rowHD18OLD['sum_f14_all']."',"."'".$rowHD18OLD['sum_f15_all']."',"."'".$rowHD18OLD['sum_f16_all']."',"."'".$rowHD18OLD['sum_f17_all']."',"."'".$rowHD18OLD['sum_f18_all']."',"."'".$rowHD18OLD['sum_f19_all']."'";
    }

}


$sqlHD18_1OLD = "SELECT
	ho.b_year,
	SUM(ho.r_new) AS sum_r_new,
    (ho.f10_m+ho.f11_m+ho.f12_m+ho.f13_m+ho.f14_m+ho.f15_m+ho.f16_m+ho.f17_m+ho.f18_m+ho.f19_m) AS sum_r_new_m ,
    (ho.f10_f+ho.f11_f+ho.f12_f+ho.f13_f+ho.f14_f+ho.f15_f+ho.f16_f+ho.f17_f+ho.f18_f+ho.f19_f) AS sum_r_new_f
FROM
    HDCTB18OLD ho
JOIN hospitalnew hn ON ho.hospcode = hn.CODE5
WHERE
    1 ";
    
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD18_1OLD = $sqlHD18_1OLD."AND ho.b_year = '".$Year."'" ;
      }else{
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
    
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD21OLD_2 = $sqlHD21OLD_2."AND ho.b_year = '".$Year."'" ;
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
    
    if (isset($_POST['Year'])) {
        $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
      }else{
        $sqlHD22OLD_1 = $sqlHD22OLD_1."AND ho.b_year = '".$Year."'" ;
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
    
    if (isset($_POST['Year'])) {
        $Year = $_POST['Year'];
        $sqlHD22OLD = $sqlHD22OLD."AND ho.b_year = '".$Year."'" ;
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
                WHERE ho.b_year = '$Year' 
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
                WHERE ho.b_year = '$Year' 
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
                WHERE ho.b_year = '$Year' 
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
              <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="Year" id="Year" style="width: 100%;">
                   <!-- <option selected="selected" value="2567" >2567</option>
                    <option value="2566">2566</option>
                    <option value="2565">2565</option>
                    <option value="2564">2564</option>
                    <option value="2563">2563</option>-->
                    <?PHP for($i=0; $i < (5); $i++) {?>
                    <option <?php if ($_POST['Year'] == ((date("Y")+543))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543))-$i; ?>"><?PHP echo ((date("Y")+543))-$i ;?></option>
                    <?PHP }?>
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
                                    labels: ['ปี 2563', 'ปี 2564', 'ปี 2565', 'ปี 2566', 'ปี 2567'],
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
                                    labels: ['ปี 2563', 'ปี 2564', 'ปี 2565', 'ปี 2566', 'ปี 2567'],
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
           
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">ผู้ป่วยยาเสพติด</h3>
                        
                        <div align="right">
                            <button class="btn btn-navbar" id="download-button9"><img width="10%" src="images/downloand.png"></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart9" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
                        <script>
                            const ctx9 = document.getElementById('myChart9');
                            
                            
                            const downloadButton9 = document.getElementById('download-button9');

                            const myChart9 = new Chart(ctx9, {
                                type: 'bar',
                                data: {
                                    labels: [''],
                                    datasets: [{
                                        label: 'Male',
                                        data: [<?php echo $sum_r_new_m ; ?>], // ข้อมูลจำนวนประชากรชายแต่ละกลุ่มอายุ
                                        backgroundColor: 'blue',
                                        borderColor: 'blue',
                                        borderWidth: 1
                                    },{
                                        label: 'Female',
                                        data: [<?php echo -$sum_r_new_f ; ?>], // ข้อมูลจำนวนประชากรหญิงแต่ละกลุ่มอายุ
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
                                        label: '2565',
                                        data: [<?php echo $sum_year03;?>],
                                        backgroundColor: '#00cadc',
                                        borderColor: '#00cadc',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2566',
                                        data: [<?php echo $sum_year02;?>],
                                        backgroundColor: '#49c3fb',
                                        borderColor: '#49c3fb',
                                        borderWidth: 1,
                                        stack: 'combined' // Enable stacking for this dataset
                                    },
                                    {
                                        label: '2567',
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
		<div class="col-md-6 col-sm-6 col-6">
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
                                    labels: [ 'ปี 2565', 'ปี 2566', 'ปี 2567'],
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
            <div class="row">
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
			 
			</div>
			<!-- ./row -->	 
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
