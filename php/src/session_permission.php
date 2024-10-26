<?php
	/*$splsetting = "SELECT * FROM settings WHERE id = '1'";
	$querysetting = mysqli_query($con, $splsetting);
	$resultsetting = mysqli_fetch_array($querysetting);*/

	$spluser = "SELECT * FROM userhospital WHERE UserID = '".$_SESSION['UserID']."'";
	$queryuser = mysqli_query($con, $spluser);
	$resultuser = mysqli_fetch_array($queryuser);

	$Username 	= $resultuser['Username'];
	$Name 		= $resultuser['Name']." ".$resultuser['Lname'];
	$position 	= $resultuser['position'];
	$HospitalID = $resultuser['HospitalID'];
	$TypeUser 	= $resultuser['TypeUser'];


$a_mthai[1]    =    'มกราคม';
$a_mthai[2]    =    'กุมภาพันธ์';
$a_mthai[3]    =    'มีนาคม';
$a_mthai[4]    =    'เมษายน';
$a_mthai[5]    =    'พฤษภาคม';
$a_mthai[6]    =    'มิถุนายน';
$a_mthai[7]    =    'กรกฎาคม';
$a_mthai[8]    =    'สิงหาคม';
$a_mthai[9]    =    'กันยายน ';
$a_mthai[10]    =    'ตุลาคม';
$a_mthai[11]    =    'พฤศจิกายน';
$a_mthai[12]    =    'ธันวาคม';
?>
