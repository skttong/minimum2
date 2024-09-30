<?php
//include auth.php file on all secure pages
include('connect/conn.php');

$qustype = '1';
$UserID  = $_POST['txtUserID'];

$HospitalID01 		= $_POST['txtHospitalID1']; 
$HospitalID02 		= $_POST['txtHospitalID2'];
$roipd 				= $_POST['roipd'];
$other_roipd 		= $_POST['other_roipd'];
$roopd 				= $_POST['roopd'];
$other_roopd 		= $_POST['other_roopd'];
$msexpert			= $_POST['msexpert']; 
$other_msexpert 	= $_POST['other_msexpert']; 
$riopd 				= $_POST['riopd'];
$other_riopd		= $_POST['other_riopd']; 
$rirooc 			= $_POST['rirooc'];
$other_rirooc 		= $_POST['other_rirooc'];
$dcmsexpert 		= $_POST['dcmsexpert'];
$other_dcmsexpert 	= $_POST['other_dcmsexpert'];
$mms 				= $_POST['mms'];
$other_mms 			= $_POST['other_mms']; 
$hospitalms 		= $_POST['hospitalms'];
$other_hospitalms 	= $_POST['other_hospitalms'];
$otherms 			= $_POST['otherms']; 
//$other_otherms 		= $_POST['other_otherms'];
$coordination		= $_POST['coordination']; 
$other_coordination = $_POST['other_coordination'];

	
$sql = "INSERT INTO satissurvey(HospitalID01, HospitalID02, roipd, other_roipd, roopd, other_roopd, msexpert, other_msexpert, riopd, other_riopd, rirooc, other_rirooc, dcmsexpert, other_dcmsexpert, mms, other_mms, hospitalms, other_hospitalms, otherms, coordination, other_coordination, UserID, satissurdate) 
VALUES ('$HospitalID01', '$HospitalID02', '$roipd', '$other_roipd', '$roopd', '$other_roopd', '$msexpert', '$other_msexpert', '$riopd', '$other_riopd', '$rirooc', '$other_rirooc', '$dcmsexpert', '$other_dcmsexpert', '$mms', '$other_mms', '$hospitalms', '$other_hospitalms', '$otherms', '$coordination', '$other_coordination', '$UserID', Now());";

$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	

	mysqli_close($con);
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('บันทึกเรียบร้อยแล้ว');";
	echo "window.location = 'detail-all.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
	echo "</script>";
	}
	
	
?>