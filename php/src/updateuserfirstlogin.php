<?php 
session_start();

include("connect/conn.php");


$prename 		= $_POST['prename'];
$firstname 		= $_POST['firstname'];
$lastname 		= $_POST['lastname'];
$telaphone 		= $_POST['telaphone'];
$moblie			= $_POST['moblie'];
$email			= $_POST['email'];
$HospitalID 	= $_POST['HospitalID'];
$newpassword 	= $_POST['newpassword'];
$UserID 		= $_SESSION["UserID"];	
$position		= $_POST['position'];


//echo $_SESSION["HosType"] ;
$sql = "UPDATE userhospital SET 
							Password	= '$newpassword',
							prefixID	= '$prename',
							Name		= '$firstname',
							Lname		= '$lastname',
							telephone	= '$telaphone',
							mobile		= '$moblie',
							useremail	= '$email',
							position	= '$position',
							regupdate	= Now(),
							stausloginfirst	= '1' 
						WHERE 
							UserID = '$UserID';";
$result = mysqli_query($con, $sql);

if($result){
	echo "<script type='text/javascript'>";
	echo "alert('ลงทะเบียนสำเร็จ');";
	/*if($_SESSION["HosType"] == 'กรมสุขภาพจิต'){
		echo "window.location = 'tables-preall2.php'; ";
	}elseif($_SESSION["HosType"] == 'ศูนย์วิชาการ'){
		echo "window.location = 'tables-preall2.php'; ";
	}else*/
	if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){
		echo "window.location = 'tables-preall.php'; ";
	}elseif($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){
		echo "window.location = 'tables-preall.php'; ";
	}else{
		echo "window.location = 'detail-1.php'; ";
	}
	
	echo "</script>";
}
else{
	echo "<script type='text/javascript'>";
	echo "alert('Error : การลงทะเบียนไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง);";
	echo "window.location = 'form_login.php'; ";
	echo "</script>";
}
?>