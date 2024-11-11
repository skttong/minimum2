
// get_amphures.php
<?php
include('connect/conn.php');

$codeprovince = $_GET['codeprovince'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง


if($codeprovince  <> 'ทั้งหมด'){
$sql = "SELECT type_Affiliation  FROM hospitalnew 
WHERE hospitalnew.NO_PROVINCE = '".$codeprovince."' 
GROUP BY hospitalnew.type_Affiliation 
ORDER BY hospitalnew.type_Affiliation DESC ";
}else{
$sql = "SELECT type_Affiliation  FROM hospitalnew 
GROUP BY hospitalnew.type_Affiliation 
ORDER BY hospitalnew.type_Affiliation DESC ";
}
$result = mysqli_query($con, $sql);

$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['type_Affiliation'] . '">' . $row['type_Affiliation'] . '</option>';
}

echo $html;