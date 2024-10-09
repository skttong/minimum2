<?php 
include('connect/conn.php');

		$sql = "INSERT INTO userhospital(Username, Password, prefixID, Name, Lname, HospitalID, TypeUser, status, stausloginfirst) 
		VALUES 
		('".$_POST['username']."','".$_POST['password']."','".$_POST['prename']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['CODE_HOS']."','".$_POST['usertype']."','0','0')";
		
		//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
		$result = mysqli_query($con, $sql);

	mysqli_close($con);
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('บันทึกเรียบร้อยแล้ว');";
	echo "window.location = 'tables-memberalladmin.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
    echo "window.location = 'addmember.php'; ";
	echo "</script>";
	}
	


?>