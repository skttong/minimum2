<?php 
include('connect/conn.php');

		$sql = "
		UPDATE userhospital 
		SET 
		    Username ='".$_POST['username']."',
			Password ='".$_POST['password']."',
			prefixID ='".$_POST['prename']."',
			Name ='".$_POST['firstname']."', 
			Lname ='".$_POST['lastname']."', 
			telephone ='".$_POST['telephone']."', 
			mobile ='".$_POST['mobile']."', 
			useremail ='".$_POST['useremail']."',
			position ='".$_POST['position']."', 
			HospitalID ='".$_POST['CODE_HOS']."',
			TypeUser ='".$_POST['usertype']."',
			regupdate = NOW()
			WHERE UserID ='".$_POST['UserID']."' ;
		";

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
    echo "window.location = 'tables-memberalladmin.php'; ";
	echo "</script>";
	}
	


?>