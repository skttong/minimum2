<?php
include('connect.php');
$sql = "SELECT
			tb_hospital.hospi_id,
			tb_hospital.hospi_name,
			tb_hospital.hospi_phone,
			provinces.name_th AS ProvName,
			amphures.name_th AS AmpName,
			tb_hospital.hospi_address 
		FROM
			tb_hospital
			INNER JOIN provinces ON tb_hospital.hospi_province = provinces.`code`
			INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.`code`
        WHERE
			tb_hospital.hospi_id = '".$_GET['id']."'";
$query = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช</title>

    <link href="assets/bootstrap.min.css" rel="stylesheet">
		
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
	
</head>
<body>
<div class="container my-5">
    <div class="card">
        <div class="card-body">
            <?php $result = mysqli_fetch_assoc($query); ?>
            <p>
                <h3><?php echo $result['hospi_name']; ?></h3>
            </p>
            <p>
				<span><b>ที่อยู่ : </b></span><?php echo $result['hospi_address']; ?>
				<br>
				<?php echo $result['AmpName']; ?> <?php echo $result['ProvName']; ?>
            </p>
            <p>
                <span><b>โทรศัพ์ : </b></span><?php echo $result['hospi_phone']; ?>
            </p>
	    <p><a href="index.php">ย้อนกลับ</a></p>
        </div>
    </div>
</div>

<script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script>
</body>
</html>
<?php
mysqli_close($conn);