<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // เปลี่ยนเป็นเส้นทางที่ถูกต้องถ้าจำเป็น

$mail = new PHPMailer(true);

/*drff vmuf zrrp kvgn */

try {
    // ตั้งค่าการใช้งาน SMTP
    $mail->isSMTP();                                      // กำหนดให้ใช้งาน SMTP
    $mail->Host = 'smtp.gmail.com';                       // เซิร์ฟเวอร์ SMTP ของ Gmail
    $mail->SMTPAuth = true;                               // เปิดการตรวจสอบสิทธิ์ SMTP
    $mail->Username = 'sommanuttong@gmail.com';            // อีเมลที่ใช้ส่ง
    $mail->Password = 'drff vmuf zrrp kvgn';                    // รหัสผ่านของอีเมล
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // เข้ารหัสข้อมูล
    $mail->Port = 587;                                   // พอร์ต SMTP

    // ผู้ส่งและผู้รับ
    $mail->setFrom($_POST['email'], $_POST['names']); // ตั้งค่าผู้ส่ง
    $mail->addAddress('Psychi.minimum@outlook.co.th', 'Recipient Name'); // ตั้งค่าผู้รับ

     // ตั้งค่าการเข้ารหัสเป็น UTF-8 เพื่อรองรับภาษาไทย
     $mail->CharSet = 'UTF-8';

    // ตั้งหัวข้อและเนื้อหาอีเมล
    $mail->isHTML(true);                                 // กำหนดว่าอีเมลเป็นแบบ HTML
    $mail->Subject = $_POST['title'];
    $mail->Body    = $_POST['remark']."\n ชื่อ :".$_POST['names']."\n เบอร์โทร :".$_POST['Tel'];
 
    // ส่งอีเมล
$mail->send();
    echo "<script type='text/javascript'>";
    echo "alert('ข้อมูลถูกส่งแล้ว');";
    echo "window.location = 'dashboard01.php'; ";
    echo "</script>";
    //echo 'อีเมลถูกส่งแล้ว';
} catch (Exception $e) {
    //echo "ไม่สามารถส่งอีเมลได้: {$mail->ErrorInfo}";
    echo "<script type='text/javascript'>";
    echo "alert('ไม่สามารถส่งอีเมลได้: {$mail->ErrorInfo}');";
    echo "window.location = 'dashboard01.php'; ";
    echo "</script>";
}
?>
