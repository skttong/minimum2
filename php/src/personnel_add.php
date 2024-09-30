<?php

//include auth.php file on all secure pages
include('connect/conn.php');
/*
$datadate = $_POST['txtBookdate'];
$timestamp = strtotime($datadate);
$ymd = date("Y-m-d", $timestamp);

$datadate2 = $_POST['date'];
$timestamp2 = strtotime($datadate2);
$ymd2 = date("Y-m-d", $timestamp2);
*/
	$UserID 		= $_POST['txtUserID'];
	$HospitalID 	= $_POST['txtHospitalID'];
	$positiontypeid = $_POST['positiontypeid'];
	$position_other	= $_POST['position_other'];
	$prename 		= $_POST['prename'];
	$firstname 		= $_POST['firstname'];
	$lastname 		= $_POST['lastname'];

	$birthday_		= $_POST['p_birthday'];
    if($birthday_ == ''){
		$birthday 	= '0000';
		$age 		= '0';
	}else{
		$birthday	= $_POST['p_birthday']-543;
		$age		= $_POST['age'];;
	}

	$Mcatt1 		= $_POST['Mcatt1'];
	$MWac1_1 		= $_POST['MWac1_1'];
	$MWac1_2 		= $_POST['MWac1_2'];
	$MWac1_3 		= $_POST['MWac1_3'];
	$MWac1_4 		= $_POST['MWac1_4'];
	$MWac1_5 		= $_POST['MWac1_5'];
	$MWac1_6 		= $_POST['MWac1_6'];
	$MWac1_7 		= $_POST['MWac1_7'];
	$MWac1_8 		= $_POST['MWac1_8'];
	if($_POST['MWac1_9'] <> "" ){
		$MWac1_9 		= $_POST['MWac1_9'];
	}
	if($_POST['MWac1_10'] <> "" ){
		$MWac1_9 		= $_POST['MWac1_10'];
	}
	$other2_mcatt 		= $_POST['other2_mcatt'];

if($positiontypeid == '1'){

	$r1 			= $_POST['r1'];
	$r2 			= $_POST['r2'];
	$other_r1 		= $_POST['other_r1'];	
	$training 		= $_POST['training'];	
	$other_training = $_POST['other_training'];
	$cogratyear 	= $_POST['cogratyear'];

	
	  $sql = "INSERT INTO personnel(HospitalID, positiontypeID, position_other, prename, firstname, lastname,birthday, age, r1, other_r1, r2, training, other_training, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 		VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$other_r1', '$r2', '$training','$other_training', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
	
}elseif($positiontypeid == '2'){

	$congrat = $_POST['congrat'];
	if($congrat == 'ปริญญาโท สาขาอื่น'){
		$congrat = $_POST['congrat'].','.$_POST['other_congrat'];
	}else{
		$congrat = $_POST['congrat'];
	}
	
	$training_1 = $_POST['training_1'];
	$training_2 = $_POST['training_2'];
	$training_3 = $_POST['training_3'];
	$training_4 = $_POST['training_4'];
	$training_5 = $_POST['training_5'];
	$training_6 = $_POST['training_6'];
	
	$training = $training_1.','.$training_2.','.$training_3.','.$training_4.','.$training_5.','.$training_6;
	
	$training_7 = $_POST['training_7'];
	$other_training = $_POST['other_training'];
	
	if($training_7 == 'อื่น ๆ'){
		$training = $training.','.$training_7.','.$other_training;	
	}
	/*
	$statuscong_1 = $_POST['statuscong_1'];
	$statuscong_2 = $_POST['statuscong_2'];
	$statuscong_3 = $_POST['statuscong_3'];
	$statuscong_4 = $_POST['statuscong_4'];
	$statuscong_5 = $_POST['statuscong_5'];
	
	$statuscong = $statuscong_1.','.$statuscong_2.','.$statuscong_3.','.$statuscong_4.','.$statuscong_5;
	
	
	$statuscong_6 = $_POST['statuscong_6'];
	$other_statuscong = $_POST['other_statuscong'];
	
	if($statuscong_6 == 'อื่น ๆ'){
		$statuscong = $statuscong.','.$other_statuscong;	
	}*/
	
	$statuscong 		= $_POST['statuscong'];
	$other_statuscong 	= $_POST['other_statuscong'];
	
	if($statuscong == 'อื่น ๆ'){
		$statuscong = $statuscong.','.$other_statuscong;	
	}
	
	$cogratyear = $_POST['cogratyear'];
	
	  $sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age,  congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt)  
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now() , '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '3'){

	/*$training_1 = $_POST['training_1'];
	$training_2 = $_POST['training_2'];
	$training_3 = $_POST['training_3'];
	
	$training = $training_1.','.$training_2.','.$training_3;*/
	$training = $_POST['training'];
		
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '4'){

	$position = $_POST['position'];
	
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$position', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '5'){

	$training = $_POST['training'];
	$regislaw = $_POST['regislaw'];
	
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '6'){
	
	$r2 		= $_POST['r2working'];
	$training 	= $_POST['training'];
	$other_training = $_POST['other2_training'];
	
	$sql = "INSERT INTO personnel(HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age,  r2, training, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt)  VALUES 
	('$HospitalID','$positiontypeid','$prename','$position_other', '$firstname', '$lastname', '$birthday', '$age', '$r2', '$training', '$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '7'){
	
	$r2 		= $_POST['r2working'];
	$training 	= $_POST['training'];
	$other_training = $_POST['other2_training'];
	
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '8'){
	
	$r2 		= $_POST['r2working'];
	$training 	= $_POST['training'];
	$other_training = $_POST['other2_training'];
	
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '9'){
	
	$r2 			= $_POST['r2working'];
	$training 		= $_POST['training'];
	$other_training = $_POST['other2_training'];
	//echo "<br>";
	
	$sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, other_training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$other_training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
	
}elseif($positiontypeid == '10'){
	$r2 		= $_POST['r2working'];
	$training 	= $_POST['training'];
	
	 $sql = "INSERT INTO personnel( HospitalID, positiontypeID, position_other, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate,  Mcatt1, MWac1_1, MWac1_2, MWac1_3, MWac1_4, MWac1_5, MWac1_6, MWac1_7, MWac1_8, MWac1_9, other2_mcatt) 
	 VALUES ('$HospitalID','$positiontypeid','$position_other' ,'$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now(), '$Mcatt1', '$MWac1_1', '$MWac1_2', '$MWac1_3', '$MWac1_4', '$MWac1_5', '$MWac1_6', '$MWac1_7', '$MWac1_8', '$MWac1_9', '$other2_mcatt');";
}

	//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	$result = mysqli_query($con, $sql);
	mysqli_close($con);


	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('บันทึกเรียบร้อยแล้ว');";
		echo "window.location = 'detail-all.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '1'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m1.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '2'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m2.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '3'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m3.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '4'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m4.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '5'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m5.php'; ";
		echo "</script>";
	}elseif($positiontypeid == '6'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m6.php?type=6'; ";
		echo "</script>";
	}elseif($positiontypeid == '7'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m6.php?type=7'; ";
		echo "</script>";
	}elseif($positiontypeid == '8'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m6.php?type=8'; ";
		echo "</script>";
	}elseif($positiontypeid == '9'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m6.php?type=9'; ";
		echo "</script>";
	}elseif($positiontypeid == '10'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m6.php?type=10'; ";
		echo "</script>";
	}
	
?>