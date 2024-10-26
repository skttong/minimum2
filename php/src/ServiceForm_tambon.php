<?php

//include auth.php file on all secure pages
include('connect/conn.php');

$qustype = '3';
$UserID = $_POST['txtUserID'];
$HospitalID = $_POST['txtHospitalID'];


$qus1_1 = '';
$qus1_1 = ''; 
$qus1_2 = ''; 
$qus1_3 = ''; 
$qus1_4 = ''; 
$qus2_1 = ''; 
$qus2_2 = ''; 
$qus2_2_1 = ''; 
$qus2_2_2 = ''; 
$qus2_3 = ''; 
$qus3_1 = ''; 
$qus3_2 = ''; 
$qus3_3 = ''; 
$qus4_1 = ''; 
$qus4_2 = ''; 
$qus5_1 = ''; 
$number_patients	 	= '';
$problems_obstacles 	= $_POST['problems_obstacles'];
$feedback 				= $_POST['feedback'];
$DevelopmentPlan 		= $_POST['DevelopmentPlan'];



if($_POST['qus1_1_1'] <> ''){
	$qus1_1 = $_POST['qus1_1_1'];
}else{
	$qus1_1 = '0';
}
if($_POST['qus1_1_2'] <> ''){
	$qus1_1 = $qus1_1.','.$_POST['qus1_1_2'];
}else{
	$qus1_1 = $qus1_1.','.'0';
}
if($_POST['qus1_1_3'] <> ''){
	$qus1_1 = $qus1_1.','.$_POST['qus1_1_3'];
}else{
	$qus1_1 = $qus1_1.','.'0';
}

/*
if($_POST['qus1_1_4'] <> ''){
	$qus1_1 = $qus1_1.','.$_POST['qus1_1_4'];
}else{
	$qus1_1 = $qus1_1.','.'0';
}
*/
/*
if($_POST['rqus1_2_1'] <> ''){
	
	if($_POST['rqus1_2_1'] == 'อื่นๆ'){	
		$qus1_2 = $_POST['qus1_2_1'].','.$_POST['rqus1_2_1'].','.$_POST['other_rqus1_2_1'];
	}else{
		$qus1_2 = $_POST['qus1_2_1'].','.$_POST['rqus1_2_1'];
	}
}/*else{
	$qus1_2 = '0';
}*/
/*
if($_POST['qus1_3_1'] <> ''){
	$qus1_3 = $_POST['qus1_3_1'];
}else{
	$qus1_3 = '0';
}
if($_POST['qus1_3_2'] <> ''){
	$qus1_3 = $qus1_3.','.$_POST['qus1_3_2'];
}else{
	$qus1_3 = $qus1_3.','.'0';
}
if($_POST['qus1_3_3'] <> ''){
	$qus1_3 = $qus1_3.','.$_POST['qus1_3_3'];
}else{
	$qus1_3 = $qus1_3.','.'0';
}
if($_POST['qus1_3_4'] <> ''){
	$qus1_3 = $qus1_3.','.$_POST['qus1_3_4'];
	if($_POST['qus1_3_4'] <> ''){
		$qus1_3 = $qus1_3.','.$_POST['qus1_3_4'];
	}
}else{
	$qus1_3 = $qus1_3.','.'0';
}

*/

if($_POST['qus2_1_1'] <> ''){
	$qus2_1 = $_POST['qus2_1_1'];
}else{
	$qus2_1 = '0';
}
if($_POST['qus2_1_2'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_2'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_3'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_3'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_4'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_4'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_5'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_5'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_6'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_6'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_7'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_7'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_8'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_8'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_9'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_9'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_10'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_10'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_11'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_11'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}
if($_POST['qus2_1_12'] <> ''){
	$qus2_1 = $qus2_1.','.$_POST['qus2_1_12'];
}else{
	$qus2_1 = $qus2_1.','.'0';
}

if($_POST['qus2_2_1'] <> ''){
	$qus2_2 = $_POST['qus2_2_1'];
}else{
	$qus2_2 = '0';
}
if($_POST['qus2_2_2'] <> ''){
	$qus2_2 = $qus2_2.','.$_POST['qus2_2_2'];
}else{
	$qus2_2 = $qus2_2.','.'0';
}

if($_POST['qus2_2_1_1'] <> ''){
	$qus2_2_1 = $_POST['qus2_2_1_1'];
}else{
	$qus2_2_1 = '0';
}
if($_POST['qus2_2_1_2'] <> ''){
	$qus2_2_1 = $qus2_2_1.','.$_POST['qus2_2_1_2'];
}else{
	$qus2_2_1 = $qus2_2_1.','.'0';
}
if($_POST['qus2_2_1_3'] <> ''){
	$qus2_2_1 = $qus2_2_1.','.$_POST['qus2_2_1_3'];
}else{
	$qus2_2_1 = $qus2_2_1.','.'0';
}
if($_POST['qus2_2_1_4'] <> ''){
	$qus2_2_1 = $qus2_2_1.','.$_POST['qus2_2_1_4'];
}else{
	$qus2_2_1 = $qus2_2_1.','.'0';
}


if($_POST['qus2_2_2_1'] <> ''){
	$qus2_2_2 = $_POST['qus2_2_2_1'];
}else{
	$qus2_2_2 = '0';
}
if($_POST['qus2_2_2_2'] <> ''){
	$qus2_2_2 = $qus2_2_2.','.$_POST['qus2_2_2_2'];
}else{
	$qus2_2_2 = $qus2_2_2.','.'0';
}
if($_POST['qus2_2_2_3'] <> ''){
	$qus2_2_2 = $qus2_2_2.','.$_POST['qus2_2_2_3'];
}else{
	$qus2_2_2 = $qus2_2_2.','.'0';
}
if($_POST['qus2_2_2_4'] <> ''){
	$qus2_2_2 = $qus2_2_2.','.$_POST['qus2_2_2_4'];
}else{
	$qus2_2_2 = $qus2_2_2.','.'0';
}



if($_POST['qus2_3_1'] <> ''){
	$qus2_3 = $_POST['qus2_3_1'];
}else{
	$qus2_3 = '0';
}
if($_POST['qus2_3_2'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_2'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_2'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_3'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_3'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_3'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_4'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_4'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_5'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_5'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_6'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_6'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}
if($_POST['qus2_3_7'] <> ''){
	$qus2_3 = $qus2_3.','.$_POST['qus2_3_7'];
}else{
	$qus2_3 = $qus2_3.','.'0';
}


if($_POST['qus3_1_1'] <> ''){
	$qus3_1 = $_POST['qus3_1_1'];
}else{
	$qus3_1 = '0';
}
if($_POST['qus3_1_2'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_2'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}
if($_POST['qus3_1_3'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_3'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}
if($_POST['qus3_1_4'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_4'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}
if($_POST['qus3_1_5'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_5'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}
if($_POST['qus3_1_6'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_6'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}
if($_POST['qus3_1_7'] <> ''){
	$qus3_1 = $qus3_1.','.$_POST['qus3_1_7'];
}else{
	$qus3_1 = $qus3_1.','.'0';
}


if($_POST['qus3_2_1'] <> ''){

	if($_POST['rqus3_2_1'] == 'อื่นๆ'){	
		$qus3_2 = $_POST['qus3_2_1'].','.$_POST['rqus3_2_1'].','.$_POST['other_rqus3_2_1'];
	}else{
		$qus3_2 = $_POST['qus3_2_1'].','.$_POST['rqus3_2_1'];
	}

}


if($_POST['qus3_2_2'] <> ''){
	$qus3_3 = $_POST['qus3_2_2'];
}else{
	$qus3_3 = '0';
}

if($_POST['qus3_2_3'] <> ''){
	$qus3_4 = $_POST['qus3_2_3'];
}else{
	$qus3_4 = '0';
}


if($_POST['qus3_3_1'] <> ''){
	$qus3_5 = $_POST['qus3_3_1'];
}else{
	$qus3_5 = '0';
}
if($_POST['qus3_3_2'] <> ''){
	$qus3_5 = $qus3_5.','.$_POST['qus3_3_2'];
}else{
	$qus3_5 = $qus3_5.','.'0';
}
if($_POST['qus3_3_3'] <> ''){
	$qus3_5 = $qus3_5.','.$_POST['qus3_3_3'];
	if($_POST['other_qus3_3'] <> ''){
		$qus3_5 = $qus3_5.','.$_POST['other_qus3_3'];
	}
}else{
	$qus3_5 = $qus3_5.','.'0';
}


if($_POST['qus4_1_1'] <> ''){
	$qus4_1 = $_POST['qus4_1_1'];
}else{
	$qus4_1 = '0';
}
if($_POST['qus4_1_2'] <> ''){
	$qus4_1 = $qus4_1.','.$_POST['qus4_1_2'];
}else{
	$qus4_1 = $qus4_1.','.'0';
}
if($_POST['qus4_1_3'] <> ''){
	$qus4_1 = $qus4_1.','.$_POST['qus4_1_3'];
}else{
	$qus4_1 = $qus4_1.','.'0';
}
if($_POST['qus4_1_4'] <> ''){
	$qus4_1 = $qus4_1.','.$_POST['qus4_1_4'];
}else{
	$qus4_1 = $qus4_1.','.'0';
}


$qus5_1 = ''; 

if($_POST['qus4_2_1'] <> ''){
	$qus4_2 = $_POST['qus4_2_1'];
}else{
	$qus4_2 = '0';
}
if($_POST['qus4_2_2'] <> ''){
	$qus4_2 = $qus4_2.','.$_POST['qus4_2_2'];
}else{
	$qus4_2 = $qus4_2.','.'0';
}
if($_POST['qus4_2_3'] <> ''){
	$qus4_2 = $qus4_2.','.$_POST['qus4_2_3'];
}else{
	$qus4_2 = $qus4_2.','.'0';
}
if($_POST['qus4_2_4'] <> ''){
	$qus4_2 = $qus4_2.','.$_POST['qus4_2_4'];
}else{
	$qus4_2 = $qus4_2.','.'0';
}


if($_POST['qus5_1_1'] <> ''){
	$qus5_1 = $_POST['qus5_1_1'];
}else{
	$qus5_1 = '0';
}
if($_POST['qus5_1_2'] <> ''){
	$qus5_1 = $qus5_1.','.$_POST['qus5_1_2'];
}else{
	$qus5_1 = $qus5_1.','.'0';
}
if($_POST['qus5_1_3'] <> ''){
	$qus5_1 = $qus5_1.','.$_POST['qus5_1_3'];
}else{
	$qus5_1 = $qus5_1.','.'0';
}



if($_POST['number_patients_1'] <> ''){
	$number_patients = $_POST['number_patients_1'];
}else{
	$number_patients = '0';
}
if($_POST['number_patients_2'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_2'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_3'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_3'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_4'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_4'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_5'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_5'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_6'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_6'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_7'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_7'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_8'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_8'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_9'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_9'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_10'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_10'];
}else{
	$number_patients = $number_patients.','.'0';
}
if($_POST['number_patients_11'] <> ''){
	$number_patients = $number_patients.','.$_POST['number_patients_11'];
}else{
	$number_patients = $number_patients.','.'0';
}

$statusfinal = $_POST['statusfinal'];
if($statusfinal == ''){
	$statusfinal = 0 ;
}




$sql = "INSERT INTO serviceform(qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus2_2, qus2_2_1, qus2_2_2, qus2_3, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5, qus4_1, qus4_2, qus5_1, number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal, UserID, mhpsDate) VALUES ('$qustype', '$HospitalID', '$qus1_1', '$qus1_2', '$qus1_3', '$qus1_4', '$qus2_1', '$qus2_2', '$qus2_2_1', '$qus2_2_2', '$qus2_3', '$qus3_1', '$qus3_2', '$qus3_3', '$qus3_4', '$qus3_5', '$qus4_1', '$qus4_2', '$qus5_1', '$number_patients', '$problems_obstacles', '$feedback', '$DevelopmentPlan','$statusfinal', '$UserID', Now());";

$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	

	mysqli_close($con);
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('บันทึกเรียบร้อยแล้ว');";
	echo "window.location = 'tables-sys.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
	echo "</script>";
	}

	
?>