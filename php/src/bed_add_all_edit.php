<?php 
include('connect/conn.php');

/*$txtWard = $_POST['PW_Y'];
$cheWard = $_POST['count_PW'];
$txtUnit = $_POST['PU_Y'];
$cheUnit = $_POST['count_PU'];
$txtIntegrate = $_POST['IB_Y'];
$cheIntegrate = $_POST['count_IB'];*/
$bedID = $_POST['bedID'];
$txtWard = $_POST['training_1'];
$cheWard = $_POST['number_patients_1'];
$txtUnit = $_POST['number_patients_2'];
$cheUnit = $_POST['number_patients_3'];
$txtIntegrate = $_POST['number_patients_4'];
$cheIntegrate = $_POST['number_patients_5'];
$ECT_Y1 = $_POST['ECT_Y1'];
$ECT_Y = $_POST['ECT_Y'];
$training_2 = $_POST['training_2'];
$number_p1tients_2_1 = $_POST['number_p1tients_2_1'];
$number_p1tients_2_2 = $_POST['number_p1tients_2_2'];
$number_p1tients_2_3 = $_POST['number_p1tients_2_3'];
$number_p1tients_2_4 = $_POST['number_p1tients_2_4'];
$number_p1tients_2_5 = $_POST['number_p1tients_2_5'];



$s = $_POST['txtHospitalID'];
$t = explode("-", $s);

$HospitalID = $t[0];	
	
	$splect = "SELECT * FROM bed where hospitalCode5 = '$HospitalID'"; 
	$queryect = mysqli_query($con, $splect);
	$numect = mysqli_num_rows($queryect);
	
	/*if($numect == "1"){
		echo "<script type='text/javascript'>";
		echo "alert('ได้กรอกสถานบริการนี้ไปแล้ว');";
		echo "window.location = 'tables-bed.php'; ";
		echo "</script>";
	} else {*/
		
	echo $sql = "UPDATE bed
                SET
                    Wardall = '$txtWard',
                    Ward_no = '$cheWard',
                    Unit = '$txtUnit',
                    Unit_no = '$cheUnit',
                    Integrate = '$txtIntegrate',
                    Integrate_no = '$cheIntegrate',
                    bedDate = NOW(),
                    EY1 = '$ECT_Y1',
                    EY = '$ECT_Y',
                    TN2 = '$training_2',
                    MM1 = '$number_p1tients_2_1',
                    MM2 = '$number_p1tients_2_2',
                    MM3 = '$number_p1tients_2_3',
                    MM4 = '$number_p1tients_2_4',
                    MM5 = '$number_p1tients_2_5'
                WHERE
                    bedID = '$bedID';
			";

//$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
$result = mysqli_query($con, $sql);

	mysqli_close($con);
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('บันทึกเรียบร้อยแล้ว');";
		echo "window.location = 'tables-bed.php'; ";
		echo "</script>";
	}
	else{
		echo "<script type='text/javascript'>";
		echo "alert('Error!!');";
		echo "</script>";
	}
//}
?>