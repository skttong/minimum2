<?php
//include auth.php file on all secure pages
include('connect/conn.php');

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

	$personnelID    = $_POST['personnelID'];

if($positiontypeid == '1'){

	$r1 			= $_POST['r1'];
	$r2 			= $_POST['r2'];
	$other_r1 		= $_POST['other_r1'];
	$training 		= $_POST['training'];
	$other_training = $_POST['other_training'];
	$cogratyear 	= $_POST['cogratyear'];
	
	$sql = "UPDATE personnel SET 
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								r1				= '$r1',
								other_r1		= '$other_r1',
								r2				= '$r2',
								training		= '$training',
								other_training	= '$other_training', 
								cogratyear		= '$cogratyear',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;

}elseif($positiontypeid == '2'){

	$congrat = $_POST['congrat'];
	
	if($congrat == "ปริญญาโท สาขาอื่น"){
		 $congrat = $_POST['congrat'].','.$_POST['other_congrat'];
		//echo '1';
	}else{
		$congrat = $_POST['congrat'];
		//echo '2';
	}
	
	$training_1 = $_POST['training_1'];
	$training_2 = $_POST['training_2'];
	$training_3 = $_POST['training_3'];
	$training_4 = $_POST['training_4'];
	$training_5 = $_POST['training_5'];
	
	$training = $training_1.','.$training_2.','.$training_3.','.$training_4.','.$training_5;
	
	$training_6 = $_POST['training_6'];
	$other_training = $_POST['other_training'];
	
	if($training_6 == 'อื่น ๆ'){
		$training = $training.','.$training_6.','.$other_training;	
	}
	
	$opdipd = $_POST['opdipd'];
	$ipd = $_POST['ipd'];
	
	$statuscong 		= $_POST['statuscong'];
	$other_statuscong 	= $_POST['other_statuscong'];
	
	if($statuscong == 'อื่น ๆ'){
		$statuscong = $statuscong.','.$other_statuscong;	
	}
	
	$cogratyear = $_POST['cogratyear'];
	
	//  $sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								congrat			= '$congrat',
								training		= '$training',
								statuscong		= '$statuscong', 
								cogratyear		= '$cogratyear',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' ,
								opdipd			= '$opdipd',
								ipd				= '$ipd'
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '3'){

	/*$training_1 = $_POST['training_1'];
	$training_2 = $_POST['training_2'];
	$training_3 = $_POST['training_3'];
	
	$training = $training_1.','.$training_2.','.$training_3;*/
	$training = $_POST['training'];
		
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								training		= '$training',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;

}elseif($positiontypeid == '4'){

	$position = $_POST['position'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$position', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								positionrole	= '$position',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '5'){

	$training = $_POST['training'];
	$regislaw = $_POST['regislaw'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								training		= '$training',
								regislaw		= '$regislaw',
								cogratyear		= '$cogratyear',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '6'){
	
	$r2 		= $_POST['r2working'];
	//$training 	= $_POST['training'];

	if($_POST['training_1']<>'ไม่เคยผ่านการอบรมเฉพาะทาง'){
		$training = $_POST['training_2'].','.$_POST['training_3'].','.$_POST['training_4'];
	}else{
		$training = $_POST['training_1'];
	}

	$other_training = $_POST['other_training2'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		='$HospitalID',
								prename			='$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		=  '$birthday',
								age				= '$age',
								r2				= '$r2',
								training		= '$training',
								other_training  = '$other_training',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '7'){
	
	$r2 		= $_POST['r2working'];
	//$training 	= $_POST['training'];

	if($_POST['training_1']<>'ไม่เคยผ่านการอบรมเฉพาะทาง'){
		$training = $_POST['training_2'].','.$_POST['training_3'].','.$_POST['training_4'];
	}else{
		$training = $_POST['training_1'];
	}

	$other_training = $_POST['other_training2'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		='$HospitalID',
								prename			='$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		=  '$birthday',
								age				= '$age',
								r2				= '$r2',
								training		= '$training',
								other_training  = '$other_training',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '8'){
	
	$r2 		= $_POST['r2working'];
	//$training 	= $_POST['training'];

	if($_POST['training_1']<>'ไม่เคยผ่านการอบรมเฉพาะทาง'){
		$training = $_POST['training_2'].','.$_POST['training_3'].','.$_POST['training_4'];
	}else{
		$training = $_POST['training_1'];
	}

	$other_training = $_POST['other_training2'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		='$HospitalID',
								prename			='$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		=  '$birthday',
								age				= '$age',
								r2				= '$r2',
								training		= '$training',
								other_training  = '$other_training',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '9'){
	$r2 			= $_POST['r2working'];
	if($_POST['training_1']<>'ไม่เคยผ่านการอบรมเฉพาะทาง'){
		$training = $_POST['training_2'].','.$_POST['training_3'].','.$_POST['training_4'];
	}else{
		$training = $_POST['training_1'];
	}

	$other_training = $_POST['other_training2'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, other_training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$other_training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								r2				= '$r2',
								training		= '$training',
								other_training	= '$other_training', 
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
	
}elseif($positiontypeid == '10'){
	$r2 		= $_POST['r2working'];
	if($_POST['training_1']<>'ไม่เคยผ่านการอบรมเฉพาะทาง'){
		$training = $_POST['training_2'].','.$_POST['training_3'].','.$_POST['training_4'];
	}else{
		$training = $_POST['training_1'];
	}

	$other_training = $_POST['other_training2'];
	
	//$sql = "INSERT INTO personnel( HospitalID, positiontypeID, prename, firstname, lastname, birthday, age, r1, r2, congrat, training, statuscong, positionrole, regislaw, cogratyear, UserID, personnelDate) VALUES ('$HospitalID','$positiontypeid','$prename', '$firstname', '$lastname', '$birthday', '$age', '$r1', '$r2', '$congrat', '$training', '$statuscong', '$positionrole', '$regislaw', '$cogratyear','$UserID', Now());";
	
	$sql = "UPDATE personnel SET 
								HospitalID		= '$HospitalID',
								prename			= '$prename',
								firstname		= '$firstname',
								lastname		= '$lastname',
								birthday		= '$birthday',
								age				= '$age',
								r2				= '$r2',
								position_other	= '$position_other',
								training		= '$training',
								other_training  = '$other_training',
								updatedetail	= Now(),
								Mcatt1			= '$Mcatt1'	,
								MWac1_1			= '$MWac1_1',
								MWac1_2 		= '$MWac1_2',
								MWac1_3			= '$MWac1_3', 
								MWac1_4			= '$MWac1_4',
								MWac1_5			= '$MWac1_5',
								MWac1_6			= '$MWac1_6',
								MWac1_7			= '$MWac1_7',
								MWac1_8			= '$MWac1_8',
								MWac1_9			= '$MWac1_9',
								other2_mcatt	= '$other2_mcatt' 
							WHERE 
								personnelID = '$personnelID'" ;
}
	$result = mysqli_query($con, $sql);

	mysqli_close($con);
	
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('บันทึกเรียบร้อยแล้ว');";
		if($positiontypeid == '1'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '2'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '3'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '4'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '5'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '6'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '7'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '8'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '9'){
			echo "window.location = 'tables-pre.php'; ";
		}elseif($positiontypeid == '10'){
			echo "window.location = 'tables-pre.php'; ";
		}
		echo "</script>";
	}elseif($positiontypeid == '1'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m1_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '2'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		//echo "window.location = 'forms_m2_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '3'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m3_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '4'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m4_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '5'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m5_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '6'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		//echo "window.location = 'forms_m6_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '7'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m7_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '8'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m8_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '9'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m9_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}elseif($positiontypeid == '10'){
		echo "<script type='text/javascript'>";
		echo "alert('Error: ข้อมูลไม่ถูกต้องกรุณาตรวจสอบข้อมูลอีกครั้ง !!');";
		echo "window.location = 'forms_m10_edit.php?personnelID=$personnelID&&type=$positiontypeid'";
		echo "</script>";
	}
	
	
?>