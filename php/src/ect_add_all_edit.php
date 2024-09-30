<?php 
include('connect/conn.php');

if($_POST['txtHospitalID'] == ""){
	echo "<script type='text/javascript'>";
	echo "alert('กรุณากรอกสถานบริการ');";
	echo "history.back();";
	echo "</script>";
	
} else {
	
	

$s = $_POST['txtHospitalID'];
$t = explode("-", $s);
$ectID = $_POST['ectID'];

$HospitalID = $t[0];	
	
	$splect = "SELECT * FROM ect where hospitalCode5 = '$HospitalID'"; 
	$queryect = mysqli_query($con, $splect);
	$numect = mysqli_num_rows($queryect);
	
	/*if($numect == "1"){
		echo "<script type='text/javascript'>";
	echo "alert('ได้กรอกสถานบริการนี้ไปแล้ว');";
	echo "history.back();";
	echo "</script>";
	} else {*/
 

			
		$sql = "UPDATE ect
                SET
                    ect = '".$_POST['ECT_Y']."',
                    ect_no = '".$_POST['count_ECT']."',
                    tms = '".$_POST['TMS_Y']."',
                    tms_no = '".$_POST['count_TMS']."',
                    ectDate = NOW()
                WHERE
                    ID = '$ectID';";
		
		//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
		$result = mysqli_query($con, $sql);

	mysqli_close($con);
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('บันทึกเรียบร้อยแล้ว');";
	echo "window.location = 'tables-ect.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
	echo "window.location = 'tables-ect.php'; ";
	echo "</script>";
	}
	}
//}
?>