<?php
include('connect.php');

$sql = "SELECT * FROM tb_hospital  WHERE hospi_amphur={$_GET['amphure_id']}";

$query = mysqli_query($conn, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);