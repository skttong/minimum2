// get_amphures.php
<?php
include('connect/conn.php');

// รับค่าพารามิเตอร์
$service_id = $_GET['service_id'] ?? '';
$codeprovince = $_GET['codeprovince'] ?? '';
$Affiliation = $_GET['Affiliation'] ?? '';
$CODE_HMOO = $_GET['CODE_HMOO'] ?? '';

// สร้างฐานข้อมูล (เชื่อมต่อฐานข้อมูล $con ล่วงหน้า)
$sql = "SELECT CODE5, HOS_NAME FROM hospitalnew WHERE 1=1";
$params = [];
$types = ""; // สำหรับระบุชนิดข้อมูลใน prepared statement

// เงื่อนไขเพิ่มเติมตามพารามิเตอร์
if ($codeprovince !== 'ทั้งหมด') {
    $sql .= " AND NO_PROVINCE = ?";
    $params[] = $codeprovince;
    $types .= "s"; // ชนิดข้อมูลเป็น string
}

if ($Affiliation !== 'ทั้งหมด') {
    $sql .= " AND Affiliation LIKE ?";
    $params[] = '%' . $Affiliation . '%';
    $types .= "s";
}

if ($service_id !== 'ทั้งหมด') {
    $sql .= " AND HOS_TYPE LIKE ?";
    $params[] = '%' . $service_id . '%';
    $types .= "s";
}

if ($CODE_HMOO !== 'ทั้งหมด' && $CODE_HMOO !== '') {
    $sql .= " AND CODE_HMOO LIKE ?";
    $params[] = '' . $CODE_HMOO . '';
    $types .= "s";
}

// เพิ่มคำสั่ง ORDER BY
$sql .= " ORDER BY CODE5 ASC";

/*
// ฟังก์ชันสำหรับรวมพารามิเตอร์เข้ากับ SQL
function combineSqlWithParams($sql, $params) {
  foreach ($params as $param) {
      // Escape ค่าพารามิเตอร์ให้เหมาะสมก่อนใส่ใน SQL
      $escaped = "'" . addslashes($param) . "'";
      // แทนที่ '?' ด้วยค่าพารามิเตอร์ที่ escape แล้ว
      $sql = preg_replace('/\?/', $escaped, $sql, 1);
  }
  return $sql;
}


$finalSql = combineSqlWithParams($sql, $params);
*/

// แสดงคำสั่ง SQL ที่สมบูรณ์
echo "<strong>คำสั่ง SQL ที่สมบูรณ์:</strong><br>$finalSql<br>";

// เตรียม statement
$stmt = $con->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $con->error);
}

// ผูกค่าพารามิเตอร์กับ statement
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

// Execute คำสั่ง SQL
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}

// ดึงผลลัพธ์
$result = $stmt->get_result();

// สร้าง HTML สำหรับแสดงผล
$html = '<option value="ทั้งหมด">ทั้งหมด</option>';
//$html = '<option value="ทั้งหมด">'. $finalSql.'</option>';

while ($row = $result->fetch_assoc()) {
    $html .= '<option value="' . htmlspecialchars($row['CODE5']) . '">' . htmlspecialchars($row['HOS_NAME']) . '</option>';
}

// ปิด statement
$stmt->close();

// แสดงผล
echo $html;
