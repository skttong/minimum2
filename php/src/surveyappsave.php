<?php
//include auth.php file on all secure pages
include('connect/conn.php');

//$qustype = '1';
$UserID  = $_POST['txtUserID'];
$HOSPID	  = $_POST['hosID'];

$qunaire11 = $_POST['qunaire11'];
$qunaire12 = $_POST['qunaire12'];
$qunaire13 = $_POST['qunaire13'];
$qunaire14 = $_POST['qunaire14'];
$qunaire15 = $_POST['qunaire15'];
$qunaire16 = $_POST['qunaire16'];
$qunaire17 = $_POST['qunaire17'];
$qunaire18 = $_POST['qunaire18'];

$qunaire21 = $_POST['qunaire21'];
$qunaire22 = $_POST['qunaire22'];
$qunaire23 = $_POST['qunaire23'];
$qunaire24 = $_POST['qunaire24'];
$qunaire25 = $_POST['qunaire25'];
$qunaire26 = $_POST['qunaire26'];
$qunaire27 = $_POST['qunaire27'];
$qunaire28 = $_POST['qunaire28'];
$qunaire29 = $_POST['qunaire29'];
$qunaire210 = $_POST['qunaire210'];

$qunaire31 = $_POST['qunaire31'];
$qunaire32 = $_POST['qunaire32'];
$qunaire33 = $_POST['qunaire33'];
$qunaire34 = $_POST['qunaire34'];

$qunaire4 = $_POST['qunaire4'];
$qunaire5 = $_POST['qunaire5_other'];

echo $qunaire11.$qunaire12.$qunaire13.$qunaire14.$qunaire15.$qunaire16.$qunaire17.$qunaire18.'<br>'.
	$qunaire21.$qunaire22.$qunaire23.$qunaire24.$qunaire25.$qunaire26.$qunaire27.$qunaire28.$qunaire29.$qunaire210.'<br>'.
	$qunaire31.$qunaire32.$qunaire33.$qunaire34.'<br>'.
	$qunaire4.$qunaire5;

$sql = "INSERT INTO surveyapp(
							sur_design1, 
							sur_design2, 
							sur_design3, 
							sur_design4, 
							sur_design5, 
							sur_design6, 
							sur_design7, 
							sur_design8, 
							sur_content1, 
							sur_content2, 
							sur_content3, 
							sur_content4, 
							sur_content5, 
							sur_content6, 
							sur_content7, 
							sur_content8, 
							sur_content9, 
							sur_content10, 
							sur_nextstep1, 
							sur_nextstep2, 
							sur_nextstep3, 
							sur_nextstep4, 
							sur_allaroud, 
							sur_other5, 
							userID, 
							hospID, 
							stamptime 
					)VALUES('$qunaire11',
							'$qunaire12',
							'$qunaire13',
							'$qunaire14',
							'$qunaire15',
							'$qunaire16',
							'$qunaire17',
							'$qunaire18',
							'$qunaire21',
							'$qunaire22',
							'$qunaire23',
							'$qunaire24',
							'$qunaire25',
							'$qunaire26',
							'$qunaire27',
							'$qunaire28',
							'$qunaire29',
							'$qunaire210',
							'$qunaire31',
							'$qunaire32',
							'$qunaire33',
							'$qunaire34',
							'$qunaire4',
							'$qunaire5',
							'$UserID',
							'$HOSPID',
							Now());";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);
	

	mysqli_close($con);
	if($result){
		echo "<script type='text/javascript'>";
		echo "alert('ขอบคุณค่ะ สำหรับการทำแบบประเมินความพึงพอใจ');";
		//echo "window.location = 'surveyapp.php'; ";
		echo "window.location = 'detail-all.php'; ";
		echo "</script>";
	}
	else{
		echo "<script type='text/javascript'>";
		echo "alert('ไม่สามารถทำแบบประเมินไ้ด้ กรุณาติดต่อเจ้าหน้าที่');";
		echo "</script>";
	}
	
	
?>