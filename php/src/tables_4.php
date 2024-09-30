<?php
//include('connect/sessiontimeout.php');
include('connect/conn.php');
//include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];


$SQL_H = "";
//ทั้งหมด
if($_POST['CODE_HMOO']<>'ทั้งหมด'){
	if ($_POST['CODE_HMOO']!='')
	{
		$SQL_H = $SQL_H." and hosn.CODE_HMOO = '".'เขต '.$_POST['CODE_HMOO']."'";

	}
}
if($_POST['CODE_PROVINCE']<>'ทั้งหมด'){
	if ($_POST['CODE_PROVINCE']!='')
	{
		$SQL_P = "SELECT PROVINCE_NAME FROM province WHERE PROVINCE_ID ='".$_POST['CODE_PROVINCE']."'";
		$obj_p = mysqli_query($con, $SQL_P);
		$row2 = mysqli_fetch_array($obj_p);

		$SQL_H = $SQL_H." and hosn.CODE_PROVINCE = '"."จ.".trim($row2['PROVINCE_NAME']," ")."'";
	}
}

if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){

	//echo $_POST['TYPE_SERVICE'];
	if ($_POST['TYPE_SERVICE']!='')
	{
		$SQL_H = $SQL_H." and hosn.TYPE_SERVICE = '".$_POST['TYPE_SERVICE']."'";
	}
}

if($_POST['area']<>'ทั้งหมด'){

	//echo $_POST['TYPE_SERVICE'];
	if ($_POST['area']!='')
	{
		//$SQL_H = $SQL_H." and hosn.area = '".$_POST['area']."'";
	}
}

if($_POST['personnelDate']<>'ทั้งหมด'){

	//echo $_POST['TYPE_SERVICE'];
	if ($_POST['personnelDate']!='')
	{
		$personnelDate = $_POST['personnelDate']-543;
		$SQL_PD = "AND Year(personnelDate) ='".$personnelDate."'";
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/fonts-googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">
	
	<style>
	/* Style the tab */
	.tab {
	  overflow: hidden;
	  border: 1px solid #ccc;
	  background-color: #f1f1f1;
	}

	/* Style the buttons inside the tab */
	.tab button {
	  background-color: inherit;
	  float: left;
	  border: none;
	  outline: none;
	  cursor: pointer;
	  padding: 14px 16px;
	  transition: 0.3s;
	  font-size: 17px;
	}

	/* Change background color of buttons on hover */
	.tab button:hover {
	  background-color: #ddd;
	}

	/* Create an active/current tablink class */
	.tab button.active {
	  background-color: #ccc;
	}

	/* Style the tab content */
	.tabcontent {
	  display: none;
	  padding: 6px 12px;
	  border: 1px solid #ccc;
	  border-top: none;
	}
	</style>
</head>
<body class="hold-transition sidebar-mini bodychange">
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">	
        <div class="row mb-2">
          <div class="col-sm-6">
             <!--<h3>การรักษาด้วยไฟฟ้า (ECT)</h3>-->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-3.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">ตารางข้อมูล</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	

      

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		  
		<!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
			<form class="form-valide" action="tables_4.php" method="post" id="myform1" name="foml">  
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="personnelDate" id="personnelDate" style="width: 100%;">
                    <option selected="selected" value="2566" >2566</option>
                   <!-- <option value="2565">2565</option>
                    <option value="2564">2564</option>
                    <option value="2563">2563</option>
                    <option value="2562">2562</option>
                    <option value="2561">2561</option>
                    <option value="2560">2560</option>-->
                  </select>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2" name="area" id="area" style="width: 100%;">
                    <option selected="selected"  value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="ในสังกัด">ในสังกัด</option>
                    <option value="นอกสังกัด">นอกสังกัด</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
			   <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>เขตพื้นที่/Service Plan</label>
                  <select class="form-control select2" style="width: 100%;" id="mySelect" onChange="myFunction()">
                    <option selected="selected" value="ทั้งหมด"> ทั้งหมด</option>
                    <option value="เขตพื้นที่">เขตพื้นที่</option>
                    <option value="ServicePlan">Service Plan</option>
                    <option value="รายโรงพยาบาล">รายโรงพยาบาล</option>
                  </select>
				   
				<script>
					function myFunction() {
						let elementarea 		= document.getElementById("area");
						let elementlabelarea 	= document.getElementById("labelarea");
						let elementservice 		= document.getElementById("service");
						let elementlabelservice = document.getElementById("labelservice");
						
						selectElement = document.querySelector('#mySelect');	
        				output = selectElement.value;
						
						if(output === "ServicePlan"){
							//alert(output);
							elementservice.removeAttribute("hidden");
							elementlabelservice.removeAttribute("hidden");
							
							elementarea.setAttribute("hidden", "hidden");
							elementlabelarea.setAttribute("hidden", "hidden");
							
						}else{
							elementarea.removeAttribute("hidden");
							elementlabelarea.removeAttribute("hidden");
							
							elementservice.setAttribute("hidden", "hidden");
							elementlabelservice.setAttribute("hidden", "hidden");
						
							//alert("tong");
						}
						
					}
				</script> 
				   
                </div>
              </div>
              <!-- /.col -->	
			 <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;" onChange="myFunctionarea(this)">
                    <option value="ทั้งหมด">ทั้งหมด</option>
                    <option value="01">เขต1</option>
                    <option value="02">เขต2</option>
                    <option value="03">เขต3</option>
					<option value="04">เขต4</option>
                    <option value="05">เขต5</option>
                    <option value="06">เขต6</option>
					<option value="07">เขต7</option>
                    <option value="08">เขต8</option>
                    <option value="09">เขต9</option>
					<option value="10">เขต10</option>
                    <option value="11">เขต11</option>
                    <option value="12">เขต12</option>
					<option value="13">เขต13</option>
                   </select>
                </div>

				<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                   <script>
                    function myFunctionarea(x) {

                    //selectElement = document.querySelector('#area');    
                    //output = selectElement.value;


					var option = x.options[x.selectedIndex];
					var output = option && option.value;
					//alert(output); // Alerts "undefined" if nothing is selected

                    var province_id = output;
                    var provinceObject = $('#CODE_PROVINCE');

                    provinceObject.html('<option value="">เลือกจังหวัด</option>');

				

                    
                    $.ajax({
                        type: "POST",
                        url: 'get_province.php',
                        data: {id:province_id,function:'amphures'},
                        success: function(data){
                            var result = JSON.parse(data);

								

                            $.each(result, function(index, item){
                                provinceObject.append(
                                    $('<option></option>').val(item.PROVINCE_ID).html(item.PROVINCE_NAME)
                                );
                            });
                        
                        }
                
                    });
                }
            	</script>
				<!-- /.form-group -->
                <div class="form-group" id="labelservice" hidden="none">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" hidden="none">
                     <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					<option value="F2">F2</option>
					<option value="F3">F3</option>  
                  </select>
                </div>
                <!-- /.form-group -->  
              </div>
              <!-- /.col -->
			  <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT PROVINCE_ID, PROVINCE_CODE, PROVINCE_NAME FROM province ;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["PROVINCE_ID"];?>" ><?PHP echo $rowprovince["PROVINCE_NAME"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->		
            </div>
            <!-- /.row -->
		
			<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
				   <button type="reset" class="btn btn-default"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>
        </div>
        <!-- /.card -->	  
        <div class="row">
          <div class="col-12">
            
            <div class="card">
       
         
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
		  
	   <!-- /.row -->
        <div class="card card-white card-outline">
          <div class="card-header bg-olive color-palette">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
				ข้อมูลบุคลากรสุขภาพจิตและจิตเวช
            </h3>
          </div>
          <div class="card-body">
            <h4>
			  
			  
			</h4>
            <div class="row">
			  <div class="col-12">	
				 
				<div class="tab">
				  <button class="tablinks" onclick="openCity(event, 'type1')" id="defaultOpen">แพทย์</button>
				  <button class="tablinks" onclick="openCity(event, 'type2')">พยาบาล</button>
				  <button class="tablinks" onclick="openCity(event, 'type3')">เภสัชกร</button>
				  <button class="tablinks" onclick="openCity(event, 'type4')">นักจิตวิทยา</button>					
				  <button class="tablinks" onclick="openCity(event, 'type5')">นักสังคมสงเคราะห์</button>
				  <button class="tablinks" onclick="openCity(event, 'type6')">อื่นๆ</button>
				</div>

				<div id="type1" class="tabcontent"> 
				  <h3></h3>
				  <p>รายงานข้อมูลแพทย์</p>
				  <table id="example1" class="table table-bordered table-striped">
				  <thead>
				   <tr align="center">
					  <th rowspan="2">#</th>  
					  <th rowspan="2">เขตสุขภาพ</th>
					  <th rowspan="2">จังหวัด</th>
					  <th colspan="2">จิตแพทย์</th>
					  <th colspan="2">จิตแพทย์เด็กและวัยรุ่น</th>
					  <th colspan="2">แพทย์เวชสตร์ป้องกันแขนงสุขภาพจิตชุมชน(อว. กับ วว.)</th>
					  <th rowspan="2" style="vertical-align: middle">แพทย์สาขาอื่นๆ</th>
					</tr>
					 <tr align="center">
					  <th>ที่มีอยู่ปัจจุบัน</th>
					  <th>กำลังศึกษา</th>
					  <th>ที่มีอยู่ปัจจุบัน</th>
					  <th>กำลังศึกษา</th>
					  <th>ที่มีอยู่ปัจจุบัน</th>
					  <th>กำลังศึกษา</th>
				   </tr>   
				   </thead>
					<?PHP
						/*$sql1 = "SELECT DISTINCT 
								hosn.CODE_HMOO,hosn.CODE_PROVINCE,
								FLOOR(RAND()*(100-1+1)+1) AS 'จิตแพทย์ทั่วไป',
								FLOOR(RAND()*(100-1+1)+1) AS 'จิตแพทย์เด็กและวัยรุ่น',
								FLOOR(RAND()*(100-1+1)+1) AS 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)',
								FLOOR(RAND()*(100-1+1)+1) AS 'แพทย์สาขาอื่น'
								FROM
								  hospitalnew hosn 
								WHERE 1 ";*/
						$sql1 = "SELECT DISTINCT
										hosn.CODE_HMOO,
										hosn.CODE_PROVINCE,
										(SELECT
												count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.r1 = 'จิตแพทย์ทั่วไป' 
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
												
											) AS 'จิตแพทย์ทั่วไป',
										(SELECT
												COUNT(personnel.training)
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป'
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'training1',
										(SELECT
												count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.r1 = 'จิตแพทย์เด็กและวัยรุ่น' 
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'จิตแพทย์เด็กและวัยรุ่น',
										(SELECT
												COUNT(personnel.training)
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.training = 'จิตแพทย์เด็กและวัยรุ่น'
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'training2',
										( SELECT
												count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' 
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)',
										(SELECT
												COUNT(personnel.training)
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)'
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'training3',
										(SELECT
												count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' 
												AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
											) AS 'แพทย์สาขาอื่น' 
									FROM
										hospitalnew hosn 
									WHERE
										1";
						if($SQL_H!=''){
							$sql1 =	$sql1.$SQL_H;
						}
						$sql1 =	$sql1." GROUP BY 
								  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 

						//echo $sql1 ;
					?>	
				   <tbody align="center">
					<?PHP
						$obj1 = mysqli_query($con, $sql1);
						$i = 1;
						while($row1 = mysqli_fetch_array($obj1))

						{   
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $row1['CODE_HMOO'];?></td>	
						<td align="left"><?php echo $row1['CODE_PROVINCE'];?></td>
						<td><?php echo $row1['จิตแพทย์ทั่วไป'];?></td>
						<td><?php echo $row1['training1'];?></td>
						<td><?php echo $row1['จิตแพทย์เด็กและวัยรุ่น'];?></td>	
						<td><?php echo $row1['training2'];?></td>
						<td><?php echo $row1['แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)'];?></td>
						<td><?php echo $row1['training3'];?></td>
						<td><?php echo $row1['แพทย์สาขาอื่น'];?></td>	

					</tr>
					<?php } ?> 
				   </tbody>	
					<tfoot align="center">
						<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
					</tfoot>	
				</table>
				</div>

				<div id="type2" class="tabcontent">
				  <h3></h3>
				  <p>รายงานข้อมูลพยาบาล</p> 
				  <table id="example2" class="table table-bordered table-striped">
					  <thead>
					   <tr align="center">
						  <th rowspan="3">#</th> 
						  <th rowspan="3">เขตสุขภาพ</th>
						  <th rowspan="3">จังหวัด</th>
						  <th rowspan="2" colspan="2" style="vertical-align: middle">ปริญญาโทจิตเวช</th> 
						  <th colspan="6">การอบรมเฉพาะทาง:การพยาบาลเฉพาะทาง</th>   
						</tr>
						<tr align="center"> 
						  <th colspan="2">จิตเวชผู้ใหญ่</th>
						  <th colspan="2">จิตเวชเด็กและวัยรุ่น</th>
						  <th colspan="2">ยาและสารเสพติด</th>
						</tr>
						 <tr align="center">
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>	 
						  
					   </tr>  
					   </thead>
					   	<?PHP
							$sql2 = "  
					SELECT DISTINCT
					hosn.CODE_HMOO,
					hosn.CODE_PROVINCE,
					(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'ปริญญาโท',
						(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%จิตเวชผู้ใหญ่%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)',
						 (
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%จิตเวชเด็กและวัยรุ่น%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'จิตเวชเด็กและวัยรุ่น',
						 (
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
							 personnel.positiontypeID = '2'  
							AND personnel.congrat  LIKE 'ปริญญาโท%'
							and personnel.training like '%ยาและสารเสพติด%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'ยาและสารเสพติด'
					 
				FROM
					hospitalnew hosn 
				WHERE
					1  
		 ";
		 					if($SQL_H!=''){
								$sql2 =	$sql2.$SQL_H;
							}
							$sql2 =	$sql2." GROUP BY 
									  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
						?>	
						<tbody align="center">
						<?PHP
							$obj2 = mysqli_query($con, $sql2);
							$i = 1;
							while($row2 = mysqli_fetch_array($obj2))

							{   
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row2['CODE_HMOO'];?></td>	
							<td><?php echo $row2['CODE_PROVINCE'];?></td>
							<td><?php echo $row2['ปริญญาโท'];?></td>
							<td>-</td>
							<td><?php echo $row2['การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'];?></td>	
							<td>-</td>
							<td><?php echo $row2['จิตเวชเด็กและวัยรุ่น'];?></td>
							<td>-</td>
							<td><?php echo $row2['ยาและสารเสพติด'];?></td>	
							<td>-</td>

						</tr>
						<?php } ?> 
					   </tbody>	
					   <tfoot align="center">
							<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
						</tfoot>		
					</table>
				</div>

				<div id="type3" class="tabcontent">
				  <h3></h3>
				  <p>รายงานข้อมูลเภสัชกร</p>
				  <table id="example3" class="table table-bordered table-striped">
					  <thead>
					   <tr align="center">
						  <th rowspan="3">#</th> 
						  <th rowspan="3">เขตสุขภาพ</th>
						  <th rowspan="3">จังหวัด</th>
						  <th colspan="5">การอบรมเฉพาะทาง</th> 
					   </tr>
					    <tr align="center">
						  <th colspan="2">การบริบาลเภสัชกรรมเฉพาะทางด้านจิตเวช(หลักสูตร 4 เดือน)</th>
						  <th colspan="2">หลักสูตรระยะสั้นการใช้ยาจิตเวช</th>
						  <th rowspan="2" style="vertical-align: middle">ยังไม่ผ่านการอบรมเกี่ยวกับการใช้ยาจิตเวช</th>
					   </tr>
					    <tr align="center">
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>
						  <th>ที่มีอยู่ปัจจุบัน</th>
						  <th>กำลังศึกษา</th>
						  
					   </tr>		  
					   </thead>
						 
						<?PHP
							$sql3 = "   

							SELECT DISTINCT
					hosn.CODE_HMOO,
					hosn.CODE_PROVINCE,
					(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
						personnel.positiontypeID = '3'  
						and personnel.training like '%การบริบาลเภสัชกรรมเฉพาะทางด้านจิตเวช (หลักสูตร 4 เดือน)%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'การบริบาลเภสัชกรรมเฉพาะทางด้านจิตเวช (หลักสูตร 4 เดือน)',
						(
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
						personnel.positiontypeID = '3'  
						and personnel.training like '%หลักสูตรระยะสั้นการใช้ยาจิตเวช%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'หลักสูตรระยะสั้นการใช้ยาจิตเวช',
						 (
					  SELECT
							count( personnel.positiontypeID )
						FROM
							personnel
							INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
						WHERE
						personnel.positiontypeID = '3'  
						and personnel.training like '%ยังไม่ได้ผ่านการอบรมเกี่ยวกับการใช้ยาจิตเวช%'
							AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
							
						) AS 'ยังไม่ได้ผ่านการอบรมเกี่ยวกับการใช้ยาจิตเวช'
					 
				FROM
					hospitalnew hosn 
				WHERE
					1  
				";
							if($SQL_H!=''){
								$sql3 =	$sql3.$SQL_H;
							}
							 $sql3 =	$sql3." GROUP BY 
									  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
						?>	 
					  <tbody align="center">
						<?PHP
							$obj3 = mysqli_query($con, $sql3);
							$i = 1;
							while($row3 = mysqli_fetch_array($obj3))

							{   
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row3['CODE_HMOO'];?></td>	
							<td><?php echo $row3['CODE_PROVINCE'];?></td>
							<td><?php echo $row3['การบริบาลเภสัชกรรมเฉพาะทางด้านจิตเวช (หลักสูตร 4 เดือน)'];?></td>
							<td></td>
							<td><?php echo $row3['หลักสูตรระยะสั้นการใช้ยาจิตเวช'];?></td>	
							<td></td>
							<td><?php echo $row3['ยังไม่ได้ผ่านการอบรมเกี่ยวกับการใช้ยาจิตเวช'];?></td>

						</tr>
						<?php } ?> 
					   </tbody>	 
					   <tfoot align="center">
							<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
						</tfoot>	 
					</table>	   
				</div>
				  
				<div id="type4" class="tabcontent">
				
				  <h3></h3>
				  <p>รายงานข้อมูลนักจิตวิทยาคลินิก/นักจิตวิทยาคลินิก</p>
				  <table id="example4" class="table table-bordered table-striped">
					  <thead>
					   <tr align="center">
						  <th rowspan="2">#</th> 
						  <th rowspan="2">เขตสุขภาพ</th>
						  <th rowspan="2">จังหวัด</th>
						  <th rowspan="2">นักจิตวิทยาคลินิก</th>
						  <th colspan="2">นักจิตวิทยา</th>
						 
						</tr>
						<tr align="center">
						  <th>มีใบประกอบโรคศิลปะ</th>
						  <th>ไม่มีใบประกอบโรคศิลปะ</th>
						</tr>  
					   </thead>
						<?PHP
							$sql4 = "SELECT DISTINCT
							hosn.CODE_HMOO,
							hosn.CODE_PROVINCE,
							(
							  SELECT
									count( personnel.positiontypeID )
								FROM
									personnel
									INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
								WHERE
								personnel.positiontypeID = '4'  
								and personnel.positionrole = 'นักจิตวิทยา'
									AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
									
								) AS 'นักจิตวิทยา',
								(
							  SELECT
									count( personnel.positiontypeID )
								FROM
									personnel
									INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
								WHERE
								personnel.positiontypeID = '4'  
								and personnel.positionrole = 'นักจิตวิทยาคลินิก'
									AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
									
								) AS 'นักจิตวิทยาคลินิก'
							 
						FROM
							hospitalnew hosn 
						WHERE
							1  ";
						    if($SQL_H!=''){
								$sql4 =	$sql4.$SQL_H;
							}
							$sql4 =	$sql4." GROUP BY 
									  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
						?>	 
					   <tbody align="center">
						<?PHP
							$obj4 = mysqli_query($con, $sql4);
							$i = 1;
							while($row4 = mysqli_fetch_array($obj4))

							{   
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row4['CODE_HMOO'];?></td>	
							<td><?php echo $row4['CODE_PROVINCE'];?></td>
							<td><?php echo $row4['นักจิตวิทยา'];?></td>
							<td><?php echo $row4['นักจิตวิทยาคลินิก'];?></td>
							<td></td>
						</tr>
						<?php } ?> 
					   </tbody>	
					   <tfoot align="center">
							<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
						</tfoot>	 
					</table>	   
				</div>
				 
			<div id="type5" class="tabcontent">
				
				  <h3></h3>
				  <p>รายงานข้อมูลนักวังคมสงเคราะห์</p>
				  <table id="example5" class="table table-bordered table-striped">	 
					  <thead>
					   <tr align="center">
						  <th rowspan="2">#</th> 
						  <th rowspan="2">เขตสุขภาพ</th>
						  <th rowspan="2">จังหวัด</th>
						  <th rowspan="2">นักสังคมสงเคราะห์จิตเวช/<br>นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต</th>
						  <th colspan="2">การอบรมเฉพาะทาง</th>
						  
						</tr>
						<tr align="center">
						  <th>ผ่านการอบรมหลักสูตร<br>นักสังคมสงเคราะห์จิตเวช</th>
						  <th>ยังไม่ผ่านการอบรมหลักสูตร<br>นักสังคมสงเคราะห์จิตเวช</th>
						</tr>  
					   </thead>
						<?PHP
							$sql5 = "SELECT DISTINCT
							hosn.CODE_HMOO,
							hosn.CODE_PROVINCE,
							(
							  SELECT
									count( personnel.positiontypeID )
								FROM
									personnel
									INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
								WHERE
								personnel.positiontypeID = '5'  
									AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
									
								) AS 'นักสังคมสงเคราะห์จิตเวช',
								(
							  SELECT
									count( personnel.positiontypeID )
								FROM
									personnel
									INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
								WHERE
								personnel.positiontypeID = '5'  
								AND personnel.training = 'ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช'
									AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
									
								) AS 'ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช',
								(
									SELECT
										  count( personnel.positiontypeID )
									  FROM
										  personnel
										  INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
									  WHERE
									  personnel.positiontypeID = '5'  
									  AND personnel.training = 'ยังไม่ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช'
										  AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										  
									  ) AS 'ยังไม่ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช'
							 
						FROM
							hospitalnew hosn 
						WHERE
							1   ";
						    if($SQL_H!=''){
								$sql5 =	$sql5.$SQL_H;
							}
							$sql5 =	$sql5." GROUP BY 
									  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
						?>	 
					   <tbody>
						<?PHP
							$obj5 = mysqli_query($con, $sql5);
							$i = 1;
							while($row5 = mysqli_fetch_array($obj5))

							{   
						?>
						<tr align="center">
							<td><?php echo $i++; ?></td>
							<td><?php echo $row5['CODE_HMOO'];?></td>	
							<td><?php echo $row5['CODE_PROVINCE'];?></td>
							<td><?php echo $row5['นักสังคมสงเคราะห์จิตเวช'];?></td>
							<td><?php echo $row5['ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช'];?></td>
							<td><?php echo $row5['ยังไม่ผ่านการอบรมหลักสูตรนักสังคมสงเคราะห์จิตเวช'];?></td>
							<!--<td></td>-->
						</tr>
						<?php } ?> 
					   </tbody>
					   <tfoot align="center">
							<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
						</tfoot>	 
					</table>	 
				</div>
				  
				<div id="type6" class="tabcontent">
				  <h3></h3>
				  <p>รายงานข้อมูลนักกิจกรรมบำบัด/นักเวชศาสตร์สื่อความหมาย/นักวิชาการศึกษาพิเศษ/นักวิชาการสาธารณสุข</p>
				  <table id="example6" class="table table-bordered table-striped">
					  <thead>
					   <tr align="center">
						  <th rowspan="2">#</th> 
						  <th rowspan="2">เขตสุขภาพ</th>
						  <th rowspan="2">จังหวัด</th>
						  <th colspan="2">นักกิจกรรมบำบัด</th>
						  <th colspan="2">นักเวชศาสตร์สื่อความหมาย</th>
						  <th colspan="2">นักวิชาการศึกษาพิเศษ</th>
						  <th colspan="2">นักวิชาการสาธารณสุข</th>
						</tr>
						<tr align="center">	
						   <th>ปฏิบัติงานสุขภาพจิต</th>
						   <th>ไม่ได้ปฏิบัติงานสุขภาพจิต</th>	
						   <th>ปฏิบัติงานสุขภาพจิต</th>
						   <th>ไม่ได้ปฏิบัติงานสุขภาพจิต</th>	
						   <th>ปฏิบัติงานสุขภาพจิต</th>
						   <th>ไม่ได้ปฏิบัติงานสุขภาพจิต</th>	
						   <th>ปฏิบัติงานสุขภาพจิต</th>
						   <th>ไม่ได้ปฏิบัติงานสุขภาพจิต</th>	
						</tr>   
					   </thead>
						<?PHP
							$sql6 = "SELECT DISTINCT
										hosn.CODE_HMOO,
										hosn.CODE_PROVINCE,
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '6' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type6_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '6' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type6_n',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '7' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type7_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '7' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type7_n',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '8' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type8_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '8' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type8_n',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '8' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type8_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '8' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type8_n',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '9' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type9_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '9' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type9_n',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '10' 
											AND personnel.r2 = 'ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type10_y',
										(SELECT
												Count( personnel.positiontypeID )
											FROM
												personnel
												INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5 
											WHERE
												personnel.positiontypeID = '10' 
											AND personnel.r2 = 'ไม่ได้ปฏิบัติงานสุขภาพจิต'
											AND CODE_PROVINCE = hosn.CODE_PROVINCE ".$SQL_PD."
										) AS 'type10_n'
									FROM
										hospitalnew hosn
									 ";
						 	if(isset($SQL_H)){
								$sql6 =	$sql6.$SQL_H;
							}
							$sql6 =	$sql6."GROUP BY 
									  hosn.CODE_HMOO, hosn.CODE_PROVINCE;"; 
						?>	 
					   <tbody align="center">
						<?PHP
							$obj6 = mysqli_query($con, $sql6);
							$i = 1;
							while($row6 = mysqli_fetch_array($obj6))

							{   
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $row6['CODE_HMOO'];?></td>	
							<td><?php echo $row6['CODE_PROVINCE'];?></td>
							<td><?php echo $row6['type6_y'];?></td>
							<td><?php echo $row6['type6_n'];?></td>
							<td><?php echo $row6['type7_y'];?></td>
							<td><?php echo $row6['type7_n'];?></td>
							<td><?php echo $row6['type8_y'];?></td>
							<td><?php echo $row6['type8_n'];?></td>
							<td><?php echo $row6['type9_y'];?></td>
							<td><?php echo $row6['type9_n'];?></td>
							
						</tr>
						<?php } ?> 
					   </tbody>
					   <tfoot align="center">
							<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
						</tfoot>	 
					</table>	 
				</div>

				<script>
				function openCity(evt, cityName) {
				  var i, tabcontent, tablinks;
				  tabcontent = document.getElementsByClassName("tabcontent");
				  for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				  }
				  tablinks = document.getElementsByClassName("tablinks");
				  for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				  }
				  document.getElementById(cityName).style.display = "block";
				  evt.currentTarget.className += " active";
				}

				// Get the element with id="defaultOpen" and click on it
				document.getElementById("defaultOpen").click();
				</script>
				  
				  
				  
				  	
                </div>
              </div>
            </div>
          
            
         </div>
          <!--  /.card -->
        </div>
	  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php" ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
	  "lengthChange": false, 
	  "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "print"],
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=9;i++)
		  {
			   var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },	
	  
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=10;i++)
		  {
			  var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },
		
    });
	$('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=7;i++)
		  {
			  var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },	
    }); 
	$('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=5;i++)
		  {
			  var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },	
    });  
	$('#example5').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=5;i++)
		  {
			  var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },			
    });
	$('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	  "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
		  
		   $( api.column( 0 ).footer() ).html('Total');
		  
		  
		  for(var i=3; i<=10;i++)
		  {
			  var monTotal = 0;
			  monTotal = api
                .column( i )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
			  
			  $( api.column( i ).footer() ).html(monTotal);
			  
		  }

        },	
    });  
  });
</script>
</body>
</html>
