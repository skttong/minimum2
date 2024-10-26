<?php

include('connect/conn.php');

$curl = curl_init();

//date("Y")+543;

$YEAR = date("Y")+543 ;

 //$YEAR = '2565' ;

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://opendata.moph.go.th/api/report_data/s_smiv11/'.$YEAR,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

//curl_close($curl);

$error = curl_error($curl);

curl_close($curl);

if ($error) {
  echo "Error fetching data from API: " . $error;
  exit();
}


$data = json_decode($response, true); 

if (isset($data)) {

  
  $sql = "DELETE FROM HDCTB08 WHERE b_year = ".$YEAR;

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);

	//mysqli_close($con);

  $stmt = mysqli_prepare($con, "INSERT INTO HDCTB08(id, hospcode, areacode, date_com, b_year, totalb, newcase, repleate, target, result)
  VALUES (?,?,?,?,?,?,?,?,?,?)");

  foreach ($data as $row) {
    $id = $row['id']; 
    $hospcode = $row['hospcode']; 
    $areacode = $row['areacode']; 
    $date_com = $row['date_com']; 
    $b_year = $row['b_year']; 
    $totalb = $row['totalb']; 
    $newcase = $row['newcase']; 
    $repleate = $row['repleate']; 
    $target = $row['target']; 
    $result = $row['result']; 
    
    mysqli_stmt_bind_param($stmt, "ssssssssss", $id, $hospcode, $areacode, $date_com, $b_year, $totalb, $newcase, $repleate, $target, $result );
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
      
  }
}

//print_r($data[0]['id']);


?>