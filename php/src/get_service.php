
// get_amphures.php
<?php
include('connect/conn.php');

$service_id = $_GET['service_id'];
$codeprovince = $_GET['codeprovince'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง

if($codeprovince  <> ''){
$sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
WHERE TYPE_SERVICE like '".$service_id."%'
AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince' 
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}else{
$sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
WHERE TYPE_SERVICE like '".$service_id."%'
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}
$result = mysqli_query($con, $sql);

$html = '<option value="">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['CODE5'] . '">' . $row['HOS_NAME'] . '</option>';
}

echo $html;