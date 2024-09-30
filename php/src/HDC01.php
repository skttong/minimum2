<?php

// Include the connection file (assuming it's in the 'connect' directory)
require_once('connect/conn.php');

// Error handling for connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// Function to simplify cURL request (optional)
function fetchDataFromAPI($url) {
  $curl = curl_init($url);

  curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl);
  $error = curl_error($curl);

  curl_close($curl);

  if ($error) {
    throw new Exception("Error fetching data from API: " . $error);
  }

  return json_decode($response, true);
}

try {
  // Get current year + 543 (assuming Thai Buddhist Era)
  $YEAR = date("Y") + 543;

  // API endpoint with dynamic year
  $API_URL = 'https://opendata.moph.go.th/api/report_data/s_mental_group/' . $YEAR;

  // Fetch data from API
  $data = fetchDataFromAPI($API_URL);

  if (!isset($data['data'])) {
    throw new Exception("Error fetching data from API. No data found.");
  }

  // Clear existing data for the year
  $stmt = mysqli_prepare($con, "DELETE FROM HDCTB01 WHERE b_year = ?");
  mysqli_stmt_bind_param($stmt, 'i', $YEAR);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  // Prepared statement for insertion
  $stmt = mysqli_prepare($con, "INSERT INTO HDCTB01 (id, hospcode, areacode, date_com, b_year, groupcode, total, ofc, sss, ucs, nrd, oth, v_total, v_ofc, v_sss, v_ucs, v_nrd, v_oth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

  // Insert each data row
  foreach ($data['data'] as $row) {

    mysqli_stmt_bind_param($stmt, "sssssissssssss", $row['id'],$row['hospcode'],$row['areacode'],$row['date_com'],$row['b_year'], $row['groupcode'], $row['total'], $row['ofc'], $row['sss'], $row['ucs'], $row['nrd'], $row['oth'], $row['v_total'], $row['v_ofc'], $row['v_sss'], $row['v_ucs'], $row['v_nrd'], $row['v_oth']);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_errno($stmt)) {
      echo "Error inserting data: " . mysqli_stmt_error($stmt) . "\n";
    }
  }

  mysqli_stmt_close($stmt);
  echo "Data inserted successfully.\n";
} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
}

mysqli_close($con);

?>