<?php
include('connect.php');
$sql = "SELECT * FROM provinces";
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
    <?php include "tablehospital.php" ?>
</div>

<script src="assets/jquery.min.js"></script>
<script src="assets/script.js"></script>
</body>
</html>
<?php
//mysqli_close($conn);