<?php

include('connect/conn.php');

$curl = curl_init();

//date("Y")+543;

if (date("m") == '10' || date("m") == '11' || date("m") == '12'){

  $YEAR = date("Y")+543 ;
 }else{
 
   $YEAR = date("Y")+543 ;
 }

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://opendata.moph.go.th/api/report_data/s_pt_kill/'.$YEAR,
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

  
  $sql = "DELETE FROM HDCTB22OLD WHERE b_year = ".$YEAR;

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);

	//mysqli_close($con);


    $stmt = mysqli_prepare($con, "INSERT INTO HDCTB22OLD(id, hospcode, areacode, date_com, b_year, result, sex1, sex2, result10, result11, result12, result01, result02, result03, result04, result05, result06, result07, result08, result09) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  
  foreach ($data as $row) {
    $id = $row['id']; 
    $hospcode = $row['hospcode']; 
    $areacode = $row['areacode']; 
    $date_com = $row['date_com']; 
    $b_year = $row['b_year']; 
    $result = $row['result']; 
    $sex1 = $row['sex1']; 
    $sex2 = $row['sex2']; 
    $result10 = $row['result10']; 
    $result11 = $row['result11']; 
    $result12 = $row['result12']; 
    $result01 = $row['result01']; 
    $result02 = $row['result02']; 
    $result03 = $row['result03']; 
    $result04 = $row['result04']; 
    $result05 = $row['result05']; 
    $result06 = $row['result06']; 
    $result07 = $row['result07']; 
    $result08 = $row['result08']; 
    $result09 = $row['result09']; 
    

    

    
    
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $id, $hospcode, $areacode, $date_com, $b_year, $result, $sex1, $sex2, $result10, $result11, $result12, $result01, $result02, $result03, $result04, $result05, $result06, $result07, $result08, $result09);
    $result = mysqli_stmt_execute($stmt);


    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
      
  }
}

//print_r($data[0]['id']);


?>