
// get_amphures.php
<?php
include('connect/conn.php');

$Affiliation = $_GET['Affiliation'];
$codeprovince = $_GET['codeprovince'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง


if($codeprovince  <> 'ทั้งหมด'){
$sql = "SELECT HOS_TYPE  FROM hospitalnew 
WHERE Affiliation = '".$Affiliation."'
AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
GROUP BY hospitalnew.HOS_TYPE 
ORDER BY hospitalnew.HOS_TYPE DESC";
}else{
$sql = "SELECT HOS_TYPE  FROM hospitalnew 
WHERE Affiliation = '".$Affiliation."'
GROUP BY hospitalnew.HOS_TYPE 
ORDER BY hospitalnew.HOS_TYPE DESC";
}
$result = mysqli_query($con, $sql);

$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['HOS_TYPE'] . '">' . $row['HOS_TYPE'] . '</option>';
}

echo $html;