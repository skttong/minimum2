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
			SUM(b.Ward_no) AS Ward_no  , 
			SUM(b.Unit) AS Unit ,
			SUM(b.Unit_no) AS Unit_no
		FROM bed b  
    JOIN hospitalnew hn on hn.CODE5 = b.hospitalCode5 
    where 1 ";
 
 if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $sql9 = $sql9."AND b.Wardall = '".$position."'" ;
    } 
  }

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

if (isset($_POST['Affiliation'])) {
  if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
  $Affiliation = trim($_POST['Affiliation']);
  $sql9 = $sql9."AND hn.Affiliation = '".$Affiliation."'" ;
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
	$sql1 = $sql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql1 = $sql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

//echo $sql9;
$obj9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_array($obj9);

$Ward_no = $row9['Ward_no'];
$Unit = $row9['Unit'];
$Unit_no = $row9['Unit_no'];

$sqlbed = "SELECT
  hn.CODE_HMOO,
  SUM(CASE WHEN b.Wardall = 'Psychiatric Ward' THEN 1 ELSE 0 END) AS Psychiatric_Ward_Count,
  SUM(CASE WHEN b.Wardall = 'Psychiatric Unit/ Co-Ward' THEN 1 ELSE 0 END) AS Psychiatric_Unit_Count,
  SUM(CASE WHEN b.Wardall = 'Integrated Bed' THEN 1 ELSE 0 END) AS Integrated_Bed_Count
FROM
  hospitalnew hn
LEFT JOIN bed b ON hn.CODE5 = b.hospitalCode5  -- Assuming CODE5 is the linking column

where 1 ";


if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $sqlbed = $sqlbed."AND b.Wardall = '".$position."'" ;
    } 
  }

  /*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlbed = $sqlbed."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlbed = $sqlbed."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlbed = $sqlbed."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlbed = $sqlbed."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlbed = $sqlbed."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['Affiliation'])) {
  if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
  $Affiliation = trim($_POST['Affiliation']);
  $sqlbed = $sqlbed."AND hn.Affiliation = '".$Affiliation."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlbed = $sqlbed."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlbed = $sqlbed."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlbed = $sqlbed."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }


$sqlbed = $sqlbed."
GROUP BY
  hn.CODE_HMOO
ORDER BY
  hn.CODE_HMOO ASC;";
$objbed = mysqli_query($con, $sqlbed);
//$rowbed = mysqli_fetch_array($objbed);

$hmoo = '';
$b01 = '';
$b02 = '';
$b03 = '';

$hmoo_1 = '';
$b01_1 = '';
$b02_1 = '';
$b03_1 = '';
$hmoo_2 = '';
$b01_2 = '';
$b02_2 = '';
$b03_2 = '';
$hmoo_3 = '';
$b01_3 = '';
$b02_3 = '';
$b03_3 = '';
$hmoo_4 = '';
$b01_4 = '';
$b02_4 = '';
$b03_4 = '';
$hmoo_5 = '';
$b01_5 = '';
$b02_5 = '';
$b03_5 = '';
$hmoo_6 = '';
$b01_6 = '';
$b02_6 = '';
$b03_6 = '';
$hmoo_7 = '';
$b01_7 = '';
$b02_7 = '';
$b03_7 = '';
$hmoo_8 = '';
$b01_8 = '';
$b02_8 = '';
$b03_8 = '';
$hmoo_9 = '';
$b01_9 = '';
$b02_9 = '';
$b03_9 = '';
$hmoo_10 = '';
$b01_10 = '';
$b02_10 = '';
$b03_10 = '';
$hmoo_11 = '';
$b01_11 = '';
$b02_11 = '';
$b03_11 = '';
$hmoo_12 = '';
$b01_12 = '';
$b02_12 = '';
$b03_12 = '';
$hmoo_13 = '';
$b01_13 = '';
$b02_13 = '';
$b03_13 = '';


while($rowbed = mysqli_fetch_array($objbed))
{
  if($rowbed['CODE_HMOO']== '1'){
    $hmoo_1 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_1 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_1 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_1 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '2'){
    $hmoo_2 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_2 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_2 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_2 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '3'){
    $hmoo_3 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_3 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_3 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_3 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '4'){
    $hmoo_4 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_4 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_4 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_4 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '5'){
    $hmoo_5 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_5 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_5 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_5 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '6'){
    $hmoo_6 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_6 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_6 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_6 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '7'){
    $hmoo_7 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_7 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_7 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_7 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '8'){
    $hmoo_8 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_8 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_8 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_8 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '9'){
    $hmoo_9 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_9 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_9 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_9 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '10'){
    $hmoo_10 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_10 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_10 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_10 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '11'){
    $hmoo_11 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_11 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_11 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_11 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '12'){
    $hmoo_12 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_12 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_12 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_12 = "'".$rowbed['Integrated_Bed_Count']."'";
  }else if($rowbed['CODE_HMOO']== '13'){
    $hmoo_13 = "'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."'";
    $b01_13 = "'".$rowbed['Psychiatric_Ward_Count']."'";
    $b02_13 = "'".$rowbed['Psychiatric_Unit_Count']."'";
    $b03_13 = "'".$rowbed['Integrated_Bed_Count']."'";
  }
	
}

$hmoo = $hmoo_1.','.$hmoo_2.','.$hmoo_3.','.$hmoo_4.','.$hmoo_5.','.$hmoo_6.','.$hmoo_7.','.$hmoo_8.','.$hmoo_9.','.$hmoo_10.','.$hmoo_11.','.$hmoo_12.','.$hmoo_13;
$b01 = $b01_1.','.$b01_2.','.$b01_3.','.$b01_4.','.$b01_5.','.$b01_6.','.$b01_7.','.$b01_8.','.$b01_9.','.$b01_10.','.$b01_11.','.$b01_12.','.$b01_13;
$b02 = $b02_1.','.$b02_2.','.$b02_3.','.$b02_4.','.$b02_5.','.$b02_6.','.$b02_7.','.$b02_8.','.$b02_9.','.$b02_10.','.$b02_11.','.$b02_12.','.$b02_13;
$b03 = $b03_1.','.$b03_2.','.$b03_3.','.$b03_4.','.$b03_5.','.$b03_6.','.$b03_7.','.$b03_8.','.$b03_9.','.$b03_10.','.$b03_11.','.$b03_12.','.$b03_13;


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
  count(b.Wardall) AS total_beds
FROM
  hospitalnew hn
left JOIN bed b ON hn.CODE5 = b.hospitalCode5
left JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $msql1 = $msql1."AND b.Wardall = '".$position."'" ;
    } 
  }

  /*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql1 = $msql1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$msql1 = $msql1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$msql1 = $msql1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
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

if (isset($_POST['Affiliation'])) {
  if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
  $Affiliation = trim($_POST['Affiliation']);
  $msql1 = $msql1."AND hn.Affiliation = '".$Affiliation."'" ;
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
   m.CODE_map02,m.CODE_PROVINCETH 

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_beds'] <> 0){
		//$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_beds']."],";
    $datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".$mrow1['total_beds'].",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}


$bsql1 = "SELECT
  hn.CODE_HMOO,
  COUNT(DISTINCT b.Wardall) AS total_beds, 
  SUM(COALESCE(b.Ward_no, 0)) AS total_ward_no,
  SUM(COALESCE(b.Unit, 0)) AS total_unit,
  SUM(COALESCE(b.Unit_no, 0)) AS total_unit_no
FROM
  bed b
right JOIN hospitalnew hn ON hn.CODE5 = b.hospitalCode5
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsql1 = $bsql1."AND b.Wardall = '".$position."'" ;
    } 
  }

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

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsql1 = $bsql1."AND b.Wardall = '".$position."'" ;
    } 
  }

  if (isset($_POST['type_Affiliation'])) {
    if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
    $type_Affiliation = trim($_POST['type_Affiliation']);
    $bsql1 = $bsql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
    }
  }

  if (isset($_POST['Affiliation'])) {
    if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
    $Affiliation = trim($_POST['Affiliation']);
    $bsql1 = $bsql1."AND hn.Affiliation = '".$Affiliation."'" ;
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

$hmoo2_1 = '';
$b201_1 = '';
$b202_1 = '';
$b203_1 = '';
$b204_1 = '';
$hmoo2_2 = '';
$b201_2 = '';
$b202_2 = '';
$b203_2 = '';
$b204_2 = '';
$hmoo2_3 = '';
$b201_3 = '';
$b202_3 = '';
$b203_3 = '';
$b204_3 = '';
$hmoo2_4 = '';
$b201_4 = '';
$b202_4 = '';
$b203_4 = '';
$b204_4 = '';
$hmoo2_5 = '';
$b201_5 = '';
$b202_5 = '';
$b203_5 = '';
$b204_5 = '';
$hmoo2_6 = '';
$b201_6 = '';
$b202_6 = '';
$b203_6 = '';
$b204_6 = '';
$hmoo2_7 = '';
$b201_7 = '';
$b202_7 = '';
$b203_7 = '';
$b204_7 = '';
$hmoo2_8 = '';
$b201_8 = '';
$b202_8 = '';
$b203_8 = '';
$b204_8 = '';
$hmoo2_9 = '';
$b201_9 = '';
$b202_9 = '';
$b203_9 = '';
$b204_9 = '';
$hmoo2_10 = '';
$b201_10 = '';
$b202_10 = '';
$b203_10 = '';
$b204_10 = '';
$hmoo2_11 = '';
$b201_11 = '';
$b202_11 = '';
$b203_11 = '';
$b204_11 = '';
$hmoo2_12 = '';
$b201_12 = '';
$b202_12 = '';
$b203_12 = '';
$b204_12 = '';
$hmoo2_13 = '';
$b201_13 = '';
$b202_13 = '';
$b203_13 = '';
$b204_13 = '';


while($rowb01 = mysqli_fetch_array($objb01))
{
  if($rowb01['CODE_HMOO']== '1'){
    $hmoo2_1 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_1 = "'".$rowb01['total_beds']."'";
    $b202_1 = "'".$rowb01['total_ward_no']."'";
    $b203_1 = "'".$rowb01['total_unit']."'";
    $b204_1 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '2'){
    $hmoo2_2 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_2 = "'".$rowb01['total_beds']."'";
    $b202_2 = "'".$rowb01['total_ward_no']."'";
    $b203_2 = "'".$rowb01['total_unit']."'";
    $b204_2 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '3'){
    $hmoo2_3 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_3 = "'".$rowb01['total_beds']."'";
    $b202_3 = "'".$rowb01['total_ward_no']."'";
    $b203_3 = "'".$rowb01['total_unit']."'";
    $b204_3 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '4'){
    $hmoo2_4 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_4 = "'".$rowb01['total_beds']."'";
    $b202_4 = "'".$rowb01['total_ward_no']."'";
    $b203_4 = "'".$rowb01['total_unit']."'";
    $b204_4 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '5'){
    $hmoo2_5 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_5 = "'".$rowb01['total_beds']."'";
    $b202_5 = "'".$rowb01['total_ward_no']."'";
    $b203_5 = "'".$rowb01['total_unit']."'";
    $b204_5 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '6'){
    $hmoo2_6 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_6 = "'".$rowb01['total_beds']."'";
    $b202_6 = "'".$rowb01['total_ward_no']."'";
    $b203_6 = "'".$rowb01['total_unit']."'";
    $b204_6 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '7'){
    $hmoo2_7 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_7 = "'".$rowb01['total_beds']."'";
    $b202_7 = "'".$rowb01['total_ward_no']."'";
    $b203_7 = "'".$rowb01['total_unit']."'";
    $b204_7 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '8'){
    $hmoo2_8 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_8 = "'".$rowb01['total_beds']."'";
    $b202_8 = "'".$rowb01['total_ward_no']."'";
    $b203_8 = "'".$rowb01['total_unit']."'";
    $b204_8 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '9'){
    $hmoo2_9 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_9 = "'".$rowb01['total_beds']."'";
    $b202_9 = "'".$rowb01['total_ward_no']."'";
    $b203_9 = "'".$rowb01['total_unit']."'";
    $b204_9 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '10'){
    $hmoo2_10 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_10 = "'".$rowb01['total_beds']."'";
    $b202_10 = "'".$rowb01['total_ward_no']."'";
    $b203_10 = "'".$rowb01['total_unit']."'";
    $b204_10 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '11'){
    $hmoo2_11 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_11 = "'".$rowb01['total_beds']."'";
    $b202_11 = "'".$rowb01['total_ward_no']."'";
    $b203_11 = "'".$rowb01['total_unit']."'";
    $b204_11 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '12'){
    $hmoo2_12 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_12 = "'".$rowb01['total_beds']."'";
    $b202_12 = "'".$rowb01['total_ward_no']."'";
    $b203_12 = "'".$rowb01['total_unit']."'";
    $b204_12 = "'".$rowb01['total_unit_no']."'";
  }else if($rowb01['CODE_HMOO']== '13'){
    $hmoo2_13 = "'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."'";
    $b201_13 = "'".$rowb01['total_beds']."'";
    $b202_13 = "'".$rowb01['total_ward_no']."'";
    $b203_13 = "'".$rowb01['total_unit']."'";
    $b204_13 = "'".$rowb01['total_unit_no']."'";
  }
	
}

 $hmoo2 = $hmoo2_1.','.$hmoo2_2.','.$hmoo2_3.','.$hmoo2_4.','.$hmoo2_5.','.$hmoo2_6.','.$hmoo2_7.','.$hmoo2_8.','.$hmoo2_9.','.$hmoo2_10.','.$hmoo2_11.','.$hmoo2_12.','.$hmoo2_13;
 $b201 = $b201_1.','.$b201_2.','.$b201_3.','.$b201_4.','.$b201_5.','.$b201_6.','.$b201_7.','.$b201_8.','.$b201_9.','.$b201_10.','.$b201_11.','.$b201_12.','.$b201_13;
 $b202 = $b202_1.','.$b202_2.','.$b202_3.','.$b202_4.','.$b202_5.','.$b202_6.','.$b202_7.','.$b202_8.','.$b202_9.','.$b202_10.','.$b202_11.','.$b202_12.','.$b202_13;
 $b203 = $b203_1.','.$b203_2.','.$b203_3.','.$b203_4.','.$b203_5.','.$b203_6.','.$b203_7.','.$b203_8.','.$b203_9.','.$b203_10.','.$b203_11.','.$b203_12.','.$b203_13;
 $b204 = $b204_1.','.$b204_2.','.$b204_3.','.$b204_4.','.$b204_5.','.$b204_6.','.$b204_7.','.$b204_8.','.$b204_9.','.$b204_10.','.$b204_11.','.$b204_12.','.$b204_13;


$bsqlall1 = "SELECT
  hn.HOS_NAME ,
  b.Wardall,
  b.Ward_no,
  b.Unit,
  b.Unit_no 
FROM
  hospitalnew hn
JOIN bed b ON hn.CODE5 = b.hospitalCode5
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsqlall1 = $bsqlall1."AND b.Wardall = '".$position."'" ;
    } 
  }

  /*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsqlall1 = $bsqlall1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$bsqlall1 = $bsqlall1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$bsqlall1 = $bsqlall1."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsqlall1 = $bsqlall1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $bsqlall1 = $bsqlall1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['Affiliation'])) {
  if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
  $Affiliation = trim($_POST['Affiliation']);
  $bsqlall1 = $bsqlall1."AND hn.Affiliation = '".$Affiliation."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $bsqlall1 = $bsqlall1."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsqlall1 = $bsqlall1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsqlall1 = $bsqlall1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$bsqlall1_1 = $bsqlall1 ;
$objb01all = mysqli_query($con, $bsqlall1);
$objb01all1 = mysqli_query($con, $bsqlall1_1);
//$rowb01all = mysqli_fetch_array($objb01all);

$bsqlall2 = "SELECT
  hn.HOS_NAME ,
  b.TN2,
  b.MM1 ,
  b.MM2 ,
  b.MM3 
FROM
  hospitalnew hn
JOIN bed b ON hn.CODE5 = b.hospitalCode5 
WHERE b.EY = 'ไม่มี'";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsqlall2 = $bsqlall2."AND b.Wardall = '".$position."'" ;
    } 
  }

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsqlall2 = $bsqlall2."AND YEAR(b.bedDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$bsqlall2 = $bsqlall2."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$bsqlall2 = $bsqlall2."AND b.bedDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND b.bedDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsqlall2 = $bsqlall2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $bsqlall2 = $bsqlall2."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['Affiliation'])) {
  if (trim($_POST['Affiliation'])<> 'ทั้งหมด') {
  $Affiliation = trim($_POST['Affiliation']);
  $bsqlall2 = $bsqlall2."AND hn.Affiliation = '".$Affiliation."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $bsqlall2 = $bsqlall2."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsqlall2 = $bsqlall2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsqlall2 = $bsqlall2."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$bsqlall2_1 = $bsqlall2;

$objb02all = mysqli_query($con, $bsqlall2);
$objb02all2 = mysqli_query($con, $bsqlall2_1);
//$rowb02all = mysqli_fetch_array($objb02all);






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
            <h3>เตียงจิตเวช</h3>
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
			<form class="form-valide" action="dashboard03.php" method="post" id="myform1" name="foml">  
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
        <div class="col-md-2">
               <div class="form-group">
                  <label> เตียงจิตเวช</label>
                  <select name="position" class="form-control select2" id="position" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<option value="Psychiatric Ward" >Psychiatric Ward</option>
					<option value="Psychiatric Unit/ Co-Ward" >Psychiatric Unit</option>
					<option value="Integrated Bed" >Integrated Bed</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
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

	  <div class="row">
          <div	div class="col-md-6">
            
          	</div>
          	<!-- /.col -->
		  	<div class="col-md-6">
            
		  	</div>
			<!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
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
$b03 = cleanData($b03);
$hmoo2 = cleanData($hmoo2);
$b204 = cleanData($b204);
$b203 = cleanData($b203);

// ตรวจสอบผลลัพธ์
//var_dump($hmoo);
//var_dump($b01);
//var_dump($b02);
//var_dump($b03);
?>

    
	

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ชนิดเตียงจิตเวช</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
					<script>
						const ctx = document.getElementById('myChart3');
						
						
						const downloadButton = document.getElementById('download-button');

            const myChart3 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($hmoo); ?>, // จัดการ JSON ให้ถูกต้อง
            datasets: [
                {
                    label: 'Psychiatric Ward',
                    data: <?php echo json_encode($b01); ?>,
                    backgroundColor: '#6ce5e8',
                    stack: 'combined'
                },
                {
                    label: 'Psychiatric Unit',
                    data: <?php echo json_encode($b02); ?>,
                    backgroundColor: '#41b8d5',
                    stack: 'combined1'
                },
                {
                    label: 'Integrated Bed',
                    data: <?php echo json_encode($b03); ?>,
                    backgroundColor: '#2d8bba',
                    stack: 'combined2'
                }
            ]
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
					<h3 class="card-title">จำนวนเตียงจิตเวช</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button2" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas>
					<script>
        const ctx5 = document.getElementById('myChart5');
        
        
        const downloadButton2 = document.getElementById('download-button2');

        const myChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($hmoo2); ?>,
                datasets: [{
                    label: 'จำนวนเตียง (ผู้หญิง)',
                    data: <?php echo json_encode($b204); ?>,
                    backgroundColor: '#9ce7fa',
                    borderColor: '#9ce7fa',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'จำนวนเตียง (ผู้ชาย)',
                    data: <?php echo json_encode($b203); ?>,
                    backgroundColor: '#ffb9c2',
                    borderColor: '#ffb9c2',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
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

downloadButton2.addEventListener('click', function() {
    const chartData = myChart5.toBase64Image(); // Get chart image data
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
					<h3 class="card-title">อัตราการครองเตียง</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button4" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart4" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx4 = document.getElementById('myChart4');
        
        
        const downloadButton4 = document.getElementById('download-button4');

        const myChart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'],
                datasets: [{
                    label: 'อัตราการครองเตียง',
                    data: [],
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
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

downloadButton4.addEventListener('click', function() {
    const chartData = myChart5.toBase64Image(); // Get chart image data
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
                    
				<p>จำนวนเตียง</p> 
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format($Ward_no, 0, '.', ',');?> เตียง</h3>
                    <p><?php echo number_format((($Ward_no / $Total)*100000), 2, '.', ',');?> : 1แสน ประชากร</p>
					
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
                    
                    
				<p>อัตราการครองเตียง</p>
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php //echo number_format((($Ward_no / $Total)*100000), 0, '.', ',');?> 0 %</h3>
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

			  <div class="col-lg-12">
			  <div class="card">
				<div class="card-header">
					<h3 class="card-title">ชนิดเตียงจิตเวช</h3>
				</div>
				<div class="card-body">
					<div id="container"></div>
					
				</div>

			</div>
			  </div>
			  <!-- ./col -->

			  <div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">อัตราการครองเตียง</h3>
				</div>
				<div class="card-body">
					<div id="container2"></div>
					
				</div>

			</div>
            

		</div>
			   
			 
			</div>

			<!-- ./row -->	
			 
			</div>
	  </div>
      <!-- /.card -->	
      <?php /* ?>
	  <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th rowspan="2" width="2%">#</th>
					  <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th rowspan="2" width="15%">ชนิดเตียง</th>
					  <th colspan="2" width="6%">จำนวนเตียง</th>
					  <th rowspan="2" width="15%">อัตราการครองเตียง</th>
				   </tr>
				   <tr align="center">
					  <th width="6%">ผู้หญิง</th>
					  <th width="6%">ผู้ชาย</th>
				   </tr>
                   </thead>
                  <tbody>
				  <tr align="center">
						<td width="6%">วิชาชีพเฉพาะ</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">วิชาชีพเฉพาะ</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">ปฏิบัติงาน</td>
				   </tr>
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
<?php */ ?>
	  <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">เตียงจิตเวช</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th rowspan="2" width="2%">#</th>
                    <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                    <th rowspan="2" width="15%">ชนิดเตียง</th>
                    <th colspan="2" width="6%">จำนวนเตียง</th>
                    <th rowspan="2" width="15%">อัตราการครองเตียง</th>
                  </tr>
                  <tr align="center">
                      <th width="6%">ผู้หญิง</th>
                      <th width="6%">ผู้ชาย</th>
                  </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$i = 0;

						while($rowb01all = mysqli_fetch_array($objb01all)){
							$i++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowb01all['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb01all['Wardall'];?></td>
           <?php /* ?> <td width="12%"><?php echo $rowb01all['Ward_no'];?></td>  <?php */ ?>
            <td width="12%"><?php echo $rowb01all['Unit'];?></td>
            <td width="12%"><?php echo $rowb01all['Unit_no'];?></td>
            <td width="12%"></td>
				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>

          <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
                    <th rowspan="2" width="2%">#</th>
                    <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                    <th rowspan="2" width="15%">ชนิดเตียง</th>
                    <th colspan="2" width="6%">จำนวนเตียง</th>
                    <th rowspan="2" width="15%">อัตราการครองเตียง</th>
                  </tr>
                  <tr align="center">
                      <th width="6%">ผู้หญิง</th>
                      <th width="6%">ผู้ชาย</th>
                  </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$j = 0;

						while($rowb01all1 = mysqli_fetch_array($objb01all1)){
							$j++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $j;?></td>
						<td width="12%"><?php echo $rowb01all1['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb01all1['Wardall'];?></td>
           <?php /* ?> <td width="12%"><?php echo $rowb01all['Ward_no'];?></td>  <?php */ ?>
            <td width="12%"><?php echo $rowb01all1['Unit'];?></td>
            <td width="12%"><?php echo $rowb01all1['Unit_no'];?></td>
            <td width="12%"></td>
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
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">มินิธัญญารักษ์</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <th rowspan="2" width="2%">#</th>
                      <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                      <th rowspan="2" width="12%">มินิธัญญารักษ์ ชนิดเตียง</th>
                      <th colspan="2" width="12%">จำนวนเตียง</th>
                      <th rowspan="2" width="12%">อัตราการครองเตียง</th>
                    </tr>
                    <tr align="center">
                        <th width="6%">ผู้หญิง</th>
                        <th width="6%">ผู้ชาย</th>
                    </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$i = 0;

						while($rowb02all = mysqli_fetch_array($objb02all)){
							$i++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowb02all['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb02all['TN2'];?></td>
            <?php /* ?><td width="12%"><?php echo $rowb02all['MM1'];?></td><?php */ ?>
            <td width="12%"><?php echo $rowb02all['MM2'];?></td>
            <td width="12%"><?php echo $rowb02all['MM3'];?></td>
            <td width="12%"></td>
				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>


          <table id="example4" class="table table-bordered table-striped" hidden>
                  <thead>
                    <tr align="center">
                      <th rowspan="2" width="2%">#</th>
                      <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                      <th rowspan="2" width="12%">มินิธัญญารักษ์ ชนิดเตียง</th>
                      <th colspan="2" width="12%">จำนวนเตียง</th>
                      <th rowspan="2" width="12%">อัตราการครองเตียง</th>
                    </tr>
                    <tr align="center">
                        <th width="6%">ผู้หญิง</th>
                        <th width="6%">ผู้ชาย</th>
                    </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$y = 0;

						while($rowb02all1 = mysqli_fetch_array($objb02all2)){
							$y++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $y;?></td>
						<td width="12%"><?php echo $rowb02all1['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb02all1['TN2'];?></td>
            <?php /* ?><td width="12%"><?php echo $rowb02all['MM1'];?></td><?php */ ?>
            <td width="12%"><?php echo $rowb02all1['MM2'];?></td>
            <td width="12%"><?php echo $rowb02all1['MM3'];?></td>
            <td width="12%"></td>
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
                    from: 1.7,
                    color: '#056934',
                    name: 'มี Psychiatric Ward'
                }, {
                    from: 1.7,
                    to: 1,
                    color: '#fbe036',
                    name: 'มีแต่ Psychiatric Unit / Integrated Bed'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี '
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
                    from: 100,
                    color: '#bf3c26',
                    name: '> 100%'
                }, {
                    from: 100,
                    to: 50,
                    color: '#45a834',
                    name: '50 - 100%'
                }, {
                    to: 50,
                    color: '#e3e3e2',
                    name: '< 50%'
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
     // "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
     // "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
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
           window.location.href = 'dashboard03.php'; 
        });

      
</script>

</body>
</html>
