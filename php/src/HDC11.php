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
  CURLOPT_URL => 'https://opendata.moph.go.th/api/report_data/s_psych_bed/'.$YEAR,
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

  
  $sql = "DELETE FROM HDCTBBED WHERE b_year = ".$YEAR ;

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);

	//mysqli_close($con);
    
    $stmt = mysqli_prepare($con, "INSERT INTO HDCTBBED(id, hospcode, b_year, a_total, b_total, a10, b10, a11, b11, a12, b12, a1, b1, a2, b2, a3, b3, a4, b4, a5, b5, a6, b6, a7, b7, a8, b8, a9, b9, areacode, date_com, total_bed) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  
  foreach ($data as $row) {
    $id = $row['id']; 
    $hospcode = $row['hospcode']; 
    $b_year = $row['b_year']; 
    $a_total = $row['a_total']; 
    $b_total = $row['b_total']; 
    $a10 = $row['a10']; 
    $b10 = $row['b10']; 
    $a11 = $row['a11']; 
    $b11 = $row['b11']; 
    $a12 = $row['a12']; 
    $b12 = $row['b12'];
    $a1 = $row['a1']; 
    $b1 = $row['b1']; 
    $a2 = $row['a2']; 
    $b2 = $row['b2']; 
    $a3 = $row['a3']; 
    $b3 = $row['b3']; 
    $a4 = $row['a4']; 
    $b4 = $row['b4']; 
    $a5 = $row['a5']; 
    $b5 = $row['b5']; 
    $a6 = $row['a6']; 
    $b6 = $row['b6']; 
    $a7 = $row['a7']; 
    $b7 = $row['b7']; 
    $a8 = $row['a8']; 
    $b8 = $row['b8']; 
    $a9 = $row['a9']; 
    $b9 = $row['b9']; 
    $areacode = $row['areacode']; 
    $date_com = $row['date_com']; 
    $total_bed = $row['total_bed']; 
    

    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssss", $id, $hospcode, $b_year, $a_total, $b_total, $a10, $b10, $a11, $b11, $a12, $b12, $a1, $b1, $a2, $b2, $a3, $b3, $a4, $b4, $a5, $b5, $a6, $b6, $a7, $b7, $a8, $b8, $a9, $b9, $areacode, $date_com, $total_bed);
    $result = mysqli_stmt_execute($stmt);


    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
      
  }
}

//print_r($data[0]['id']);


?>