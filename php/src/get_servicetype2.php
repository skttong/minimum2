
// get_amphures.php
<?php
include('connect/conn.php');

$typeAffiliation = $_GET['typeAffiliation'];
$codeprovince = $_GET['codeprovince'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง


if($codeprovince  <> 'ทั้งหมด'){
$sql = "SELECT TYPE_SERVICE  FROM hospitalnew 
WHERE type_Affiliation = '".$typeAffiliation."'
AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
GROUP BY hospitalnew.TYPE_SERVICE 
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}else{
$sql = "SELECT TYPE_SERVICE  FROM hospitalnew 
WHERE type_Affiliation = '".$typeAffiliation."'
GROUP BY hospitalnew.TYPE_SERVICE 
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}
$result = mysqli_query($con, $sql);

$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['TYPE_SERVICE'] . '">' . $row['TYPE_SERVICE'] . '</option>';
}

echo $html;