
// get_amphures.php
<?php
include('connect/conn.php');

$CODE_PROVINCE = $_GET['codeprovince'];
$typeAffiliation = $_GET['typeAffiliation'];

if($typeAffiliation == 'ทั้งหมด'){

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT Affiliation 
FROM hospitalnew
WHERE 1
AND Affiliation <> ''
Group by Affiliation ;";

}elseif($CODE_PROVINCE == 'ทั้งหมด'){

  // Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
  $sql = "SELECT Affiliation 
  FROM hospitalnew
  WHERE type_Affiliation = '".$typeAffiliation."'
  AND Affiliation <> ''
  Group by Affiliation ;";
  
}else{

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT Affiliation 
FROM hospitalnew
WHERE NO_PROVINCE = '".$CODE_PROVINCE."'
AND type_Affiliation = '".$typeAffiliation."'
AND Affiliation <> ''
Group by Affiliation ;";

}

$result = mysqli_query($con, $sql);
$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
//$html = '<option value="ทั้งหมด">'.$sql.'</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['Affiliation'] . '">' . $row['Affiliation'] . '</option>';
}

echo $html;