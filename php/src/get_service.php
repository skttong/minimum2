// get_amphures.php
<?php
include('connect/conn.php');

$service_id = $_GET['service_id'];
$codeprovince = $_GET['codeprovince'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง

/*
if($codeprovince  <> 'ทั้งหมด'){
echo $sql = "SELECT TYPE_SERVICE  FROM hospitalnew 
WHERE HOS_TYPE = '".$Affiliation."'
AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
GROUP BY hospitalnew.TYPE_SERVICE 
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}else{
$sql = "SELECT TYPE_SERVICE  FROM hospitalnew 
WHERE HOS_TYPE = '".$Affiliation."'
GROUP BY hospitalnew.TYPE_SERVICE 
ORDER BY hospitalnew.TYPE_SERVICE DESC";
}
$result = mysqli_query($con, $sql);
*/

$sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
WHERE hospitalnew.NO_PROVINCE =  '".$codeprovince."'
AND hospitalnew.TYPE_SERVICE LIKE '%$service_id%'
ORDER BY hospitalnew.NO_PROVINCE ASC ;";
$result = mysqli_query($con, $sql);

$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['CODE5'] . '">' . $row['HOS_NAME'] . '</option>';
}

echo $html;