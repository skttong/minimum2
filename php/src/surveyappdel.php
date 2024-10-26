<?php
//include auth.php file on all secure pages
include('connect/conn.php');


$UserID = $_GET['id'];

$sql = "DELETE FROM surveyapp WHERE serveyid = '$UserID';";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);
	

	mysqli_close($con);
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('ดำเนินการลบข้อมูลแล้ว ขอบคุณค่ะ ');";
		//echo "window.location = 'surveyapp.php'; ";
		echo "window.location = '/tables-surveyapp.php'; ";
		echo "</script>";
	}
	else{
		echo "<script type='text/javascript'>";
        echo "window.location = '/tables-surveyapp.php'; ";
		echo "alert('ไม่สามารถลบข้อมูลแล้ว กรุณาติดต่อเจ้าหน้าที่');";
		echo "</script>";
	}
	
	
?>