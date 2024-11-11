<?php

include('connect/conn.php');

$curl = curl_init();


$YEAR = date("Y") ;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://cms.srph.go.th/api/v2/report-patient-type',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: XSRF-TOKEN=eyJpdiI6InNuZ2JWZ3p5a0tYaElzMVVSeVlvaXc9PSIsInZhbHVlIjoiUjFUVVdzYzM4dGR1WjdFNy9vcUR4WXBTMHFJNU9VdVZYNXpVK2hGYnpVM1htcUduVVBkNlNFWUdYMCtuTm5TUXpVRWNCb0NTT1VHU3VwMTNKQkVRcGlOMDE4OEVZMUY5cFQyTW4vbFR2ZkJKWFBiQXFxTnVsdnNkL3N4NG5mQlMiLCJtYWMiOiI0NTA0MjYxZDk5NjJlYTJmNGQ5ODNkMWY4NDVmM2UwZjA1YWVjNGM1MmYzZWM2MTc4YTJhZDA3N2E3Yzc4NDVjIn0%3D; laravel_session=eyJpdiI6IlJub1BBd3Q2NGd2cFZuWDVZZ0x6NHc9PSIsInZhbHVlIjoidU1PVzZhYkZTWlVwUzZXRGRvYW1nc21rT2d5V0lzc2FOc2xyOVdkVjRGOVZiOTJ4bDQzQVRoV1ZBRVNXL2kva0hJbDNsWUJDMDB4c3JSLzdVUGk1a2hUMlEzSHRjT0VZcnB1SWpzSlRHZS9XMkMvQUdEZGE0WjhRdWtsSWxiZWMiLCJtYWMiOiJjZGU1N2ZmMGFjODUxN2I2OGUzYjMxZmM0NTMzMTE5NmI2Y2M5ZDM4ZGU3NWMzMzZjOTU3OGQzZWEzMTI4OWMzIn0%3D'
  ),
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

if ($error) {
  echo "Error fetching data from API: " . $error;
  exit();
}

$data = json_decode($response, true); 

if (isset($data['data'])) {

    
  $sql = "DELETE FROM CMSreports ;";
 

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

  $sql2 = "ALTER TABLE CMSreports AUTO_INCREMENT = 1;";
  $result2 = mysqli_query($con, $sql2) or die ("Error in query: $sql2 " . mysqli_error());

  $stmt = mysqli_prepare($con, "INSERT INTO CMSreports (amphur_code, event_date, patient_id) VALUES (?, ?, ?)");

  foreach ($data['data'] as $row) {
    $amphur_code = $row['amphur_code']; // Replace with actual data key
    $event_date = $row['event_date'];  // Replace with actual data key
    $patient_id = $row['patient_id'];  // Replace with actual data key

    mysqli_stmt_bind_param($stmt, "sss", $amphur_code, $event_date, $patient_id);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
  }

  mysqli_stmt_close($stmt);
  echo "Data inserted successfully.";

}else{
  echo "Error fetching data from API. \n";
}

?>