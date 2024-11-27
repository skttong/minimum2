<?php

include('connect/conn.php');

$curl = curl_init();

//date("Y")+543;

if (date("m") == '10' || date("m") == '11' || date("m") == '12'){

  $YEAR = date("Y")+543+1 ;
 }else{
 
   $YEAR = date("Y")+543 ;
 }

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://opendata.moph.go.th/api/report_data/s_dementia/'.$YEAR,
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

  
  $sql = "DELETE FROM HDCTB19OLD WHERE b_year = ".$YEAR;

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);

	//mysqli_close($con);

    $stmt = mysqli_prepare($con, "INSERT INTO HDCTB19OLD(id, hospcode, areacode, date_com, b_year, groupcode, ts1_all, ts2_all, ts1_f00, ts2_f00, ts1_f01, ts2_f01, ts1_f02, ts2_f02, ts1_g311, ts2_g311) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  
  foreach ($data as $row) {
    $id = $row['id']; 
    $hospcode = $row['hospcode']; 
    $areacode = $row['areacode']; 
    $date_com = $row['date_com']; 
    $b_year = $row['b_year']; 
    $groupcode = $row['groupcode']; 
    $ts1_all = $row['ts1_all']; 
    $ts2_all = $row['ts2_all']; 
    $ts1_f00 = $row['ts1_f00']; 
    $ts2_f00 = $row['ts2_f00']; 
    $ts1_f01 = $row['ts1_f01'];
    $ts2_f01 = $row['ts2_f01']; 
    $ts1_f02 = $row['ts1_f02'];
    $ts2_f02 = $row['ts2_f02'];
    $ts1_g311 = $row['ts1_g311'];
    $ts2_g311 = $row['ts2_g311'];  
    
    
    mysqli_stmt_bind_param($stmt, "ssssssssssssssss", $id, $hospcode, $areacode, $date_com, $b_year, $groupcode, $ts1_all, $ts2_all, $ts1_f00, $ts2_f00, $ts1_f01, $ts2_f01, $ts1_f02, $ts2_f02, $ts1_g311, $ts2_g311);
    $result = mysqli_stmt_execute($stmt);


    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
      
  }
}

//print_r($data[0]['id']);


?>