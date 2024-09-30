
// get_amphures.php
<?php
include('connect/conn.php');

$moo_id = $_GET['moo_id'];

if($moo_id == 'ทั้งหมด'){

  /*
  // Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
*/

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
where HOS_TYPE <> 'คลินิกเอกชน'
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";


}else{

/*  
// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE CODE_HMOO like '".$moo_id."'
AND HOS_TYPE <> 'คลินิกเอกชน'
GROUP BY hospitalnew.HOS_NAME
ORDER BY hospitalnew.CODE_HMOO DESC;";

*/

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
WHERE CODE_HMOO like '".$moo_id."'
AND HOS_TYPE <> 'คลินิกเอกชน'
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";

}

$result = mysqli_query($con, $sql);
$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['NO_PROVINCE'] . '">' . $row['CODE_PROVINCE'] . '</option>';
}

echo $html;