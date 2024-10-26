
// get_amphures.php
<?php
include('connect/conn.php');

$CODE_PROVINCE = $_GET['CODE_PROVINCE'];




if($moo_id == 'ทั้งหมด'){

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT DISTINCT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";



}else{

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT DISTINCT CODE5, HOS_NAME  FROM hospitalnew 
WHERE NO_PROVINCE = '$CODE_PROVINCE'
AND HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
$result = mysqli_query($con, $sql);

}

$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['CODE5'] . '">' . $row['HOS_NAME'] . '</option>';
}

echo $html;