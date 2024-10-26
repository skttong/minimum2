<?php 
include('connect/conn.php');

        $UserID = $_GET['id'];

	 $sql = "DELETE FROM userhospital WHERE UserID = $UserID ;";
		
		//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
		$result = mysqli_query($con, $sql);

	mysqli_close($con);
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('ลบเรียบร้อยแล้ว');";
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