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
  CURLOPT_URL => 'https://opendata.moph.go.th/api/report_data/s_fx_smiv/'.$YEAR,
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

  
  $sql = "DELETE FROM HDCTB18OLD WHERE b_year = ".$YEAR;

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	//$result = mysqli_query($con, $sql);

	//mysqli_close($con);

    $stmt = mysqli_prepare($con, "INSERT INTO HDCTB18OLD(id, hospcode, areacode, date_com, b_year, target, result, r_new, f10_m, f10_f, f11_m, f11_f, f12_m, f12_f, f13_m, f13_f, f14_m, f14_f, f15_m, f15_f, f16_m, f16_f, f17_m, f17_f, f18_m, f18_f, f19_m, f19_f) 
  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  
  foreach ($data as $row) {
    $id = $row['id']; 
    $hospcode = $row['hospcode']; 
    $areacode = $row['areacode']; 
    $date_com = $row['date_com']; 
    $b_year = $row['b_year']; 
    $target = $row['target']; 
    $result = $row['result']; 
    $r_new = $row['r_new']; 
    $f10_m = $row['f10_m']; 
    $f10_f = $row['f10_f']; 
    $f11_m = $row['f11_m']; 
    $f11_f = $row['f11_f']; 
    $f12_m = $row['f12_m']; 
    $f12_f = $row['f12_f']; 
    $f13_m = $row['f13_m']; 
    $f13_f = $row['f13_f']; 
    $f14_m = $row['f14_m']; 
    $f14_f = $row['f14_f']; 
    $f15_m = $row['f15_m']; 
    $f15_f = $row['f15_f']; 
    $f16_m = $row['f16_m']; 
    $f16_f = $row['f16_f']; 
    $f17_m = $row['f17_m']; 
    $f17_f = $row['f17_f']; 
    $f18_m = $row['f18_m']; 
    $f18_f = $row['f18_f']; 
    $f19_m = $row['f19_m']; 
    $f19_f = $row['f19_f']; 
    
 

    
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssss", $id, $hospcode, $areacode, $date_com, $b_year, $target, $result, $r_new, $f10_m, $f10_f, $f11_m, $f11_f, $f12_m, $f12_f, $f13_m, $f13_f, $f14_m, $f14_f, $f15_m, $f15_f, $f16_m, $f16_f, $f17_m, $f17_f, $f18_m, $f18_f, $f19_m, $f19_f);
    $result = mysqli_stmt_execute($stmt);


    if (!$result) {
      echo "Error inserting data: " . mysqli_error($con);
      exit();
    }
      
  }
}

//print_r($data[0]['id']);


?>