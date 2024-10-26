<?php

// ข้อมูลการเชื่อมต่อฐานข้อมูล
$host = 'db';
$user = 'root';
$pass = '1234';
$dbname = 'db_minimum'; // ชื่อฐานข้อมูล

// กำหนดเส้นทางที่จะเก็บไฟล์ .sql
$backup_file = 'backup_' . date("Y-m-d_H-i-s") . '.sql';
$folder = 'backup/';

if (!is_dir($folder)) {
    mkdir($folder, 0777, true); // สร้างโฟลเดอร์ถ้ายังไม่มี
}

$backup_file = $folder . $backup_file;

// คำสั่ง mysqldump
$command = "mysqldump --user=$user --password=$pass --host=$host $dbname > $backup_file";

// เรียกใช้คำสั่ง
system($command, $output);

// ตรวจสอบผลการทำงาน
if ($output === 0) {
    echo "Database has been successfully dumped to: " . $backup_file;
} else {
    echo "Error during database dump.";
}
?>
