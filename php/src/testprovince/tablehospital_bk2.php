<?php
include('connect.php');
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);

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
			<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="agency">สังกัด</label>
                        <select name="agency_id" id="agency" class="form-control">
                            <option value="">เลือกสังกัด</option>
                            <option value="21000">ในสังกัดกรมสุขภาพจิต</option>
                            <option value="27000">อื่นๆ</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="province">จังหวัด</label>
                        <select name="province_id" id="province" class="form-control">
                            <option value="">เลือกจังหวัด</option>
                        </select>
                    </div>
					
				<!-- 	<div class="form-group col-md-4">
                        <label for="hospital">โรงพยาบาล</label>
                        <select name="hospital_id" id="hospital" class="form-control">
                            <option value="">เลือกโรงพยาบาล</option>
                        </select>
                    </div>-->
					
                    <div class="form-group col-md-4">
                        <label for="amphure">อำเภอ</label>
                        <select name="amphure_id" id="amphure" class="form-control">
                            <option value="">เลือกอำเภอ</option>
                        </select>
                    </div>
                  <!--  <div class="form-group col-md-4">
                        <label for="district">ตำบล</label>
                        <select name="district_id" id="district" class="form-control">
                            <option value="">เลือกตำบล</option>
                        </select>
                    </div>-->
                </div> 
				<input type="submit" class="btn success" name="submit" value="ค้นหา">  
				
            </form>
        </div>
		
	<?php

    if (isset($_POST['agency_id'])) {
        $agency = $_POST['agency_id'];
    }else{
        $agency ='';
    }
    
    if (isset($_POST['province_id'])) {
        $sql3 = "SELECT code FROM provinces where id = '".$_POST['province_id']."'";  
        $query3 = mysqli_query($conn, $sql3); 
        $result3 = mysqli_fetch_array($query3);
        $PROVINCE = $result3['code'];
    }else{
        $PROVINCE ='';
    }
    /*
    if (isset($_POST['hospital_id'])) {
        $hospital = $_POST['hospital_id'];
    }else{
        $hospital ='';
    }
    */
    if (isset($_POST['amphure_id'])) {
        $amphure = $_POST['amphure_id'];
    }else{
        $amphure ='';
    }
	 
	 //$_POST['hospital_id'];
	 //$_POST['amphure_id'];
		
	 	$sql2 = "SELECT
                        tb_hospital.hospi_id,
						tb_hospital.hospi_name,
						tb_hospital.hospi_phone,
						provinces.name_th AS ProvName,
						amphures.name_th AS AmpName
					FROM
						tb_hospital
						INNER JOIN provinces ON tb_hospital.hospi_province = provinces.`code`
						INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.`code`
					WHERE
                        tb_hospital.agen_code = '$agency'";
        
        if ($PROVINCE!=''){
            $sql2 = $sql2." AND  tb_hospital.hospi_province = '$PROVINCE'";
        }

/*
        if ($hospital!=''){
            $sql2 = $sql2."AND tb_hospital.hospi_id = '$hospital' ";
        }  */   
        if ($amphure!=''){
            $sql2 = $sql2."AND tb_hospital.hospi_amphur = '$amphure' ";
        }           

        //echo $sql2;    
          
		$query2 = mysqli_query($conn, $sql2);

        $rownum = mysqli_num_rows($query2); 


	?>
    </div>
	<?php /*
	<div class="card">
		<div class="card-body">
		<div style="overflow-x:auto;">
		  <table>
			<tr>
			  <th>ลำดับ</th>
			  <th>รายชื่อ รพ.</th>
			  <th>จังหวัด</th>
			  <th>อำเภอ</th>
			 <!-- <th>ตำบล</th>-->
			  <th>เบอร์โทร</th>
			  <th>รายละเอียด</th>
			</tr>
			<?php 
			  $i = 1;
			  while($result2 = mysqli_fetch_array($query2))
			  {
			  ?>
			<tr>
			  <td><?php echo $i++; ?></td>
			  <td><?php echo $result2['hospi_name']; ?></td>
			  <td><?php echo $result2['ProvName']; ?></td>
			  <td><?php echo $result2['AmpName']; ?></td>
			  <!--<td>50</td>-->
			  <td><?php echo $result2['hospi_phone']; ?></td>
			  <td> <a href="detailhospital.php?id=<?php echo $result2['hospi_id']; ?>">รายละเอียด</a></td>
			</tr>
			<?php } ?>
		  </table>
		</div>
		</div>
	</div>
    */ ?>

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
 <!-- <div class="card p-3">
    <blockquote class="blockquote mb-0 card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card bg-primary text-white text-center p-3">
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
      <footer class="blockquote-footer">
        <small>
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card text-center">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img" src="..." alt="Card image">
  </div>
  <div class="card p-3 text-right">
    <blockquote class="blockquote mb-0">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>-->
</div>
</div>

<script src="assets/jquery.min.js"></script>
<script src="assets/script_2.js"></script>
</body>
</html>
<?php
mysqli_close($conn);