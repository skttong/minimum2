<?php
$sql1 	= "SELECT personnel.positiontypeID,  COUNT(personnel.r1) AS CountP,  personnel.r1 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.r1 =  'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' ";
if($SQL_H != ''){
	$sql1 = $sql1.$SQL_H;
}
//echo $sql1;
$query1 = mysqli_query($con, $sql1);
$row1 	= mysqli_fetch_array($query1);

$sql2 	= "SELECT personnel.positiontypeID,  COUNT(personnel.r1) AS CountP,  personnel.r1 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.r1 =  'จิตแพทย์ทั่วไป' ";
if($SQL_H != ''){
	$sql2 = $sql2.$SQL_H;
}
$query2 = mysqli_query($con, $sql2);
$row2 	= mysqli_fetch_array($query2);

$sql3 	= "SELECT personnel.positiontypeID,  COUNT(personnel.r1) AS CountP,  personnel.r1 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.r1 =  'จิตแพทย์เด็กและวัยรุ่น' ";
if($SQL_H != ''){
	$sql3 = $sql3.$SQL_H;
}
$query3 = mysqli_query($con, $sql3);
$row3 	= mysqli_fetch_array($query3);

$sql4 	= "SELECT personnel.positiontypeID,  COUNT(personnel.training) AS Count_train,  personnel.training
			FROM personnel
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)'";
if($SQL_H != ''){
	$sql4 = $sql4.$SQL_H;
}
$query4 = mysqli_query($con, $sql4);
$row4 	= mysqli_fetch_array($query4);

$sql5 	= "SELECT personnel.positiontypeID,  COUNT(personnel.training) AS Count_train,  personnel.training
			FROM personnel
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป'";
if($SQL_H != ''){
	$sql5 = $sql5.$SQL_H;
}

$query5 = mysqli_query($con, $sql5);
$row5 	= mysqli_fetch_array($query5);

$sql6 	= "SELECT personnel.positiontypeID,  COUNT(personnel.training) AS Count_train,  personnel.training
			FROM personnel
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.training = 'จิตแพทย์เด็กและวัยรุ่น'";
if($SQL_H != ''){
	$sql6 = $sql6.$SQL_H;
}

$query6 = mysqli_query($con, $sql6);
$row6 	= mysqli_fetch_array($query6);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------type1 END

$sql7 	= "SELECT personnel.positiontypeID,  count(personnel.training) AS count_nu,  personnel.statuscong 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positiontypeID = 2 AND personnel.training LIKE 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)%'";
if($SQL_H != ''){
	$sql7 = $sql7.$SQL_H;
}

$query7 = mysqli_query($con, $sql7);
$row7 	= mysqli_fetch_array($query7);

$sql8 	= "SELECT personnel.positiontypeID,  count(personnel.training) AS count_nu,  personnel.statuscong 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positiontypeID = 2 AND personnel.training LIKE '%การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ%'";
if($SQL_H != ''){
	$sql8 = $sql8.$SQL_H;
}

$query8 = mysqli_query($con, $sql8);
$row8	= mysqli_fetch_array($query8);

$sql9 	= "SELECT personnel.positiontypeID,  count(personnel.training) AS count_nu,  personnel.statuscong 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positiontypeID = 2 AND personnel.training LIKE '%การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น%'";
if($SQL_H != ''){
	$sql9 = $sql9.$SQL_H;
}

$query9 = mysqli_query($con, $sql9);
$row9	= mysqli_fetch_array($query9);

$sql10 	 = "SELECT personnel.positiontypeID,  count(personnel.training) AS count_nu,  personnel.statuscong 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positiontypeID = 2 AND personnel.training LIKE '%การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด%'";
if($SQL_H != ''){
	$sql10 = $sql10.$SQL_H;
}
$query10 = mysqli_query($con, $sql10);
$row10	 = mysqli_fetch_array($query10);

$sql11 	 = "SELECT personnel.statuscong, Count(personnel.statuscong) AS Count_NuSTU 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.statuscong = 'กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'";
if($SQL_H != ''){
	$sql11 = $sql11.$SQL_H;
}
$query11 = mysqli_query($con, $sql11);
$row11	 = mysqli_fetch_array($query11);

$sql12 	 = "SELECT personnel.statuscong, Count(personnel.statuscong) AS Count_NuSTU 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.statuscong = 'กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น'";
if($SQL_H != ''){
	$sql12 = $sql12.$SQL_H;
}
$query12 = mysqli_query($con, $sql12);
$row12	 = mysqli_fetch_array($query12);

$sql13 	 = "SELECT personnel.statuscong, Count(personnel.statuscong) AS Count_NuSTU 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.statuscong = 'กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด'";
if($SQL_H != ''){
	$sql13 = $sql13.$SQL_H;
}
$query13 = mysqli_query($con, $sql13);
$row13	 = mysqli_fetch_array($query13);
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------type2 END
$sql14 	 = "SELECT personnel.positiontypeID, count(personnel.positionrole) AS Count_psy 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positionrole = 'นักจิตวิทยาคลินิก'";
if($SQL_H != ''){
	$sql14 = $sql14.$SQL_H;
}
$query14 = mysqli_query($con, $sql14);
$row14	 = mysqli_fetch_array($query14);

$sql15 	 = "SELECT personnel.positiontypeID, count(personnel.positionrole) AS Count_psy 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positionrole = 'นักจิตวิทยาคลินิก (บรรจุในตำแหน่งนักจิตวิทยา)'";
if($SQL_H != ''){
	$sql15 = $sql15.$SQL_H;
}
$query15 = mysqli_query($con, $sql15);
$row15	 = mysqli_fetch_array($query15);

$sql16 	 = "SELECT personnel.positiontypeID, count(personnel.positionrole) AS Count_psy 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positionrole = 'นักจิตวิทยา'";
if($SQL_H != ''){
	$sql16 = $sql16.$SQL_H;
}
$query16 = mysqli_query($con, $sql16);
$row16	 = mysqli_fetch_array($query16);

$sql17 	 = "SELECT personnel.positiontypeID, count(personnel.positionrole) AS Count_psy 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positionrole = 'นักจิตวิทยาการศึกษา (บรรจุในตำแหน่งนักจิตวิทยา)'";
if($SQL_H != ''){
	$sql17 = $sql17.$SQL_H;
}
$query17 = mysqli_query($con, $sql17);
$row17	 = mysqli_fetch_array($query17);



?>































