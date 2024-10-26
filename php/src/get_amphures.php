
// get_amphures.php
<?php
include('connect/conn.php');

$provinceId = $_GET['province_id'];

// Query เพื่อดึงข้อมูลอำเภอที่เกี่ยวข้อง
$sql = "SELECT * FROM amphure WHERE province_id = $provinceId";
$result = mysqli_query($con, $sql);

$html = '<option value="">เลือกอำเภอ</option>';
while ($row = mysqli_fetch_assoc($result)) {
  $html .= '<option value="' . $row['amphure_id'] . '">' . $row['amphure_name'] . '</option>';
}

echo $html;