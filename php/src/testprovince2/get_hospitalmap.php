<?php
include('connect.php');

$sql = "SELECT  tb_hospitalmap.hospi_code,
                tb_hospitalmap.name_th,
                tb_hospitalmap.lat,
                tb_hospitalmap.lon 
        FROM tb_hospitalmap 
        INNER JOIN tb_hospital on tb_hospital.hospi_code = tb_hospitalmap.hospi_code";

$query = mysqli_query($conn, $sql);

$resultArray = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($resultArray, $result);
}
echo json_encode($resultArray);
