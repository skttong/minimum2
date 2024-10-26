<?php
include('connect.php');
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	
	<?php
	echo $_POST['province_id'];
	echo $_POST['hospital_id'];
	echo $_POST['amphure_id'];
	
	
	$sql2 =  "SELECT
				tb_hospital.hospi_name,
				tb_hospital.hospi_code,
				tb_hospital.hospi_province,
				tb_hospital.hospi_amphur,
				amphures.name_th,
				amphures.`code`
			FROM
				tb_hospital
				INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.name_th
			";
	$query2 = mysqli_query($conn, $sql2);
	//$result2 = mysqli_fetch_array($query2);
	/* while($result2 = mysqli_fetch_array($query2)) {
		/* echo $result2['hospi_name'].'    '; 
		 echo $result2['hospi_province'].'    '; 
		 echo $result2['hospi_district'].'    '; 
		 echo $result2['hospi_amphur']; 
		 echo $result2['hospi_amphur_name'];  
		  echo $result2['hospi_code']; 
		 echo '<br>';
	*/
	/*
	echo $sql = "update tb_hospital set  
										hospi_amphur = '".$result2['code']."' 
										 
								  where 
								  	    hospi_code = ".$result2['hospi_code']."";
		 $query = mysqli_query($conn, $sql);
	 }*/?>
</body>
</html>