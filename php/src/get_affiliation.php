
// get_amphures.php
<?php
include('connect/conn.php');

$CODE_PROVINCE = $_GET['CODE_PROVINCE'];

if($CODE_PROVINCE == 'ทั้งหมด'){

  /*
  // Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
*/

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT HOS_TYPE 
FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน' 
AND HOS_TYPE <> ''
Group by HOS_TYPE;
";


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
$sql = "SELECT HOS_TYPE 
FROM hospitalnew
WHERE NO_PROVINCE = '".$CODE_PROVINCE."'
AND HOS_TYPE <> 'คลินิกเอกชน'
AND HOS_TYPE <> ''
Group by HOS_TYPE;";

}

$result = mysqli_query($con, $sql);
$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['HOS_TYPE'] . '">' . $row['HOS_TYPE'] . '</option>';
}

echo $html;