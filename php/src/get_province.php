<?php
include('connect/conn.php');
$sql = "SELECT PROVINCE_ID, PROVINCE_CODE, PROVINCE_NAME FROM province WHERE KET_SERVICE={$_POST['id']}";
//$sql = "SELECT PROVINCE_ID, PROVINCE_CODE, PROVINCE_NAME FROM province where PROVINCE_CODE = '10'";
$query = mysqli_query($con, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);
?>