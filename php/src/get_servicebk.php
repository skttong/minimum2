// get_amphures.php
<?php
include('connect/conn.php');

/*
$service_id = $_GET['service_id'];
$codeprovince = $_GET['codeprovince'];
$Affiliation = $_GET['Affiliation'];
$CODE_HMOO = $_GET['CODE_HMOO'];


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
/*
if($codeprovince == 'ทั้งหมด'){
  if($CODE_HMOO == 'ทั้งหมด'){
  $sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
  WHERE hospitalnew.Affiliation  LIKE '%$Affiliation%'
  AND hospitalnew.HOS_TYPE LIKE '%$service_id%'
  ORDER BY hospitalnew.CODE5 ASC ;";
  $result = mysqli_query($con, $sql);
  }elseif($CODE_HMOO <> ''){
    if($service_id <> 'ทั้งหมด'){
    $sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
    WHERE hospitalnew.Affiliation  LIKE '%$Affiliation%'
    AND hospitalnew.HOS_TYPE LIKE '%$service_id%'
    AND hospitalnew.CODE_HMOO LIKE '%$CODE_HMOO%'
    ORDER BY hospitalnew.CODE5 ASC ;";
    $result = mysqli_query($con, $sql);
  }else{
    $sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
  WHERE hospitalnew.Affiliation  LIKE '%$Affiliation%'
  AND hospitalnew.HOS_TYPE LIKE '%$service_id%'
  AND hospitalnew.CODE_HMOO LIKE '%$CODE_HMOO%'
  AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
  ORDER BY hospitalnew.CODE5 ASC ;";
  $result = mysqli_query($con, $sql);
  }
}

}elseif($CODE_HMOO <> ''){
    $sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
    WHERE hospitalnew.Affiliation  LIKE '%$Affiliation%'
    AND hospitalnew.CODE_HMOO LIKE '%$CODE_HMOO%'
    AND hospitalnew.HOS_TYPE LIKE '%$service_id%'
    AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
    ORDER BY hospitalnew.CODE5 ASC ;";
    $result = mysqli_query($con, $sql);

}else{  
  $sql = "SELECT CODE5, HOS_NAME  FROM hospitalnew 
  WHERE hospitalnew.NO_PROVINCE =  '".$codeprovince."'
  AND hospitalnew.HOS_TYPE LIKE '%$service_id%'
  AND hospitalnew.Affiliation  LIKE '%$Affiliation%'
  AND hospitalnew.NO_PROVINCE =  '".$codeprovince."' 
  ORDER BY hospitalnew.CODE5 ASC ;";
  $result = mysqli_query($con, $sql);
}
  */

  // รับค่าพารามิเตอร์
$service_id = $_GET['service_id'] ?? '';
$codeprovince = $_GET['codeprovince'] ?? '';
$Affiliation = $_GET['Affiliation'] ?? '';
$CODE_HMOO = $_GET['CODE_HMOO'] ?? '';

// สร้างฐานข้อมูล (เชื่อมต่อฐานข้อมูล $con ล่วงหน้า)
$sql = "SELECT CODE5, HOS_NAME FROM hospitalnew WHERE 1=1";
$params = [];

// เงื่อนไขเพิ่มเติมตามพารามิเตอร์
if ($codeprovince !== 'ทั้งหมด') {
    $sql .= " AND NO_PROVINCE = ?";
    $params[] = $codeprovince;
}

if ($Affiliation !== '') {
    $sql .= " AND Affiliation LIKE ?";
    $params[] = '%' . $Affiliation . '%';
}

if ($service_id !== 'ทั้งหมด') {
    $sql .= " AND HOS_TYPE LIKE ?";
    $params[] = '%' . $service_id . '%';
}

if ($CODE_HMOO !== 'ทั้งหมด' && $CODE_HMOO !== '') {
    $sql .= " AND CODE_HMOO LIKE ?";
    $params[] = '%' . $CODE_HMOO . '%';
}

// เพิ่มคำสั่ง ORDER BY
$sql .= " ORDER BY CODE5 ASC";

$result = mysqli_query($con, $sql);

//$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
$html = '<option value="ทั้งหมด">'. $sql.'</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['CODE5'] . '">' . $row['HOS_NAME'] . '</option>';
}

echo $html;