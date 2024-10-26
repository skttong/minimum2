<?php 
session_start();

include("connect/conn.php");

$HospitalID 	= $_POST['HospitalID'];
$UserID 		= $_SESSION["UserID"];	

$sql = "UPDATE userhospital SET 
							`Password`	= '$HospitalID',
							 `prefixID` = 0, 
							`Name` = '', 
							`Lname` = '', 
							`telephone` = '', 
							`mobile` = '', 
							`useremail` = '', 
							`position` = '', 
							`TypeUser` = 'User_h', 
							`status` = '0', 
							`regupdate` = Now(), 
							`lock` = '0', 
							`stausloginfirst` = 0 
						WHERE 
							HospitalID = '$HospitalID';";

$result = mysqli_query($con, $sql);
if($result){
	if($_SESSION["TypeUser"] == "Admin"){
		echo "<script type='text/javascript'>";
		echo "alert('บันทึกเรียบร้อยแล้ว');";
		echo "window.location = 'tables-memberalladmin.php'; ";
		echo "</script>";
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('บันทึกเรียบร้อยแล้ว');";
		echo "window.location = 'tables-memberall.php'; ";
		echo "</script>";

	}
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('Error : ไม่สามารถรีเซ็ตข้อมูลนี้ได้ โปรดตรวจสอบข้อมูลอีกครั้ง');";
		echo "window.location = 'tables-memberalladmin.php'; ";
		echo "</script>";
}


//echo $_SESSION["HosType"] ; ใช้สำหรับรีเซ็ตข้อมูลเป็นเริ่มต้น 
/*
 $sqlse	= "SELECT
				userhospital.Username, 
				userhospital.`Password`, 
				userhospital.regupdate, 
				userhospital.stausloginfirst, 
				hospitalnew.HOS_NAME, 
				hospitalnew.CODE5
			FROM
				userhospital
				INNER JOIN
				hospitalnew
				ON 
					userhospital.HospitalID = hospitalnew.CODE5
			WHERE
				userhospital.`status` <> 'admin'
			AND	userhospital.UserID = '$UserID'"; 
$resultse = mysqli_query($con, $sqlse);
$rowse  = mysqli_fetch_array($resultse);

if($resultse){
	//echo "ok";
	//echo $rowse['HOS_NAME'];
	
$sql = "UPDATE userhospital SET 
							Password	= '$HospitalID',
							prefixID	= '0', 
							`Name`		= '".$rowse['HOS_NAME']."', 
							Lname		= ' ',  
							telephone	= ' ',  
							mobile		= ' ', 
							regupdate	= Now(),
							stausloginfirst	= '0' 
						WHERE 
							HospitalID = '$HospitalID';";

$result = mysqli_query($con, $sql);
	if($result){
			echo "<script type='text/javascript'>";
			echo "alert('บันทึกเรียบร้อยแล้ว');";
			echo "window.location = 'tables-memberall.php'; ";
			echo "</script>";
		}else{
			echo "<script type='text/javascript'>";
			echo "alert('Error : ไม่สามารถรีเซ็ตข้อมูลนี้ได้ โปรดตรวจสอบข้อมูลอีกครั้ง');";
			echo "</script>";
	}

}else{
	echo "<script type='text/javascript'>";
	echo "alert('Error : ไม่สามารถรีเซ็ตข้อมูลนี้ได้ โปรดตรวจสอบข้อมูลอีกครั้ง-1');";
	echo "</script>";
}

/*Header("Location: detail-1.php");*/
?>