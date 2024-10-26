<?php
include('connect.php');
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);

if (isset($_POST['agency'])) {
  $agency = $_POST['agency'];
}else{
  $agency ='';
}

if (isset($_POST['province_id'])) {
  $province_id = $_POST['province_id'];
  $sql3 = "SELECT code , name_th FROM provinces where id = '".$province_id."'";  
  $query3 = mysqli_query($conn, $sql3); 
  $result3 = mysqli_fetch_array($query3);
  $PROVINCE = $result3['code'];
  $PROVINCE_name = $result3['name_th'];
}else{
  $PROVINCE ='';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช</title>

    <link href="assets/bootstrap.min.css" rel="stylesheet">
		
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
	
/* Green */
.success {
	background-color: #008CBA;
	color: white;
	} /* Blue */

</style>
	
</head>
<body>
<div class="container my-5">
    <div class="card">
        <div class="card-body">
            <h3>ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช (ภาพรวม)</h3>
			<br>
            <!--<form name="formindex" method="post" action="detail.php">-->
			<form method="post" name="myForm" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="province">จังหวัด</label>
                      
                        <select name="province_id" id="province" class="form-control">
                        <?php if (isset($_POST['province_id'])) { ?>
                          <option value="<?php echo $province_id ; ?>"><?php echo $PROVINCE_name ; ?></option>
                        <?php }else{ ?>
                          <option value="">เลือกจังหวัด</option>
                       <?php } ?>
                            
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="province">สังกัด</label>
                        
                        <?php if ( $agency == 'IN') { ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="IN" checked >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="OUT">
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                        <?php }elseif( $agency == 'OUT'){ ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="IN"  >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="OUT" checked>
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                        <?php }else{ ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" checked>
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="IN" >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="OUT">
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                       <?php } ?>
                       

        
                    </div>
                </div> 
				<input type="submit" class="btn success" name="submit" value="ค้นหา">  
				
            </form>
        </div>
		
	<?php
		
	 	$sql2 = "SELECT
              tb_hospital.hospi_id,
              tb_hospital.hospi_name,
              tb_hospital.hospi_phone,
              provinces.name_th   AS ProvName,
              amphures.name_th    AS AmpName
            FROM
              tb_hospital
              INNER JOIN provinces ON tb_hospital.hospi_province = provinces.`code`
              INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.`code`
            WHERE
              tb_hospital.hospi_province = '$PROVINCE'";
        
        if ($agency!=''){
            $sql2 = $sql2." AND tb_hospital.agen_type = '$agency'";
        }

/*
        if ($hospital!=''){
            $sql2 = $sql2."AND tb_hospital.hospi_id = '$hospital' ";
        }    
        if ($amphure!=''){
            $sql2 = $sql2."AND tb_hospital.hospi_amphur = '$amphure' ";
        }           
*/
        //echo $sql2;    
          
		$query2 = mysqli_query($conn, $sql2);

        $rownum = mysqli_num_rows($query2); 


	?>
    </div>

    <br>
    <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>จำนวนโรงพยาบาล</p>
      <footer class="blockquote-footer"><?php echo $rownum; ?><!--<cite title="Source Title">Source Title</cite>--></footer>
    </blockquote>
  </div>
</div>
    <br>
<div class="card-columns">
<?php 
			  $i = 1;
			  while($result2 = mysqli_fetch_array($query2))
			  {
			  ?>

                <div class="card">
                   <!-- <img class="card-img-top" src="..." alt="Card image cap">-->
                    <div class="card-body">
                    <h5 class="card-title"><?php echo $result2['hospi_name']; ?></h5>
                    <p class="card-text"><?php echo $result2['ProvName']; ?></p>
                    <p class="card-text"><?php echo $result2['AmpName']; ?></p>
                    <p class="card-text"><?php echo $result2['hospi_phone']; ?></p>
                    <a href="detailhospital.php?id=<?php echo $result2['hospi_id']; ?>">รายละเอียด</a>
                    </div>
                </div>
  <?php } ?>
</div>
</div>

<script src="assets/jquery.min.js"></script>
<!--<script src="assets/script_Affiliation.js"></script>-->
</body>
</html>
<?php
mysqli_close($conn);