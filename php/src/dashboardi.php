<?PHP
session_start();
include('connect/conn.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["CODE_PROVINCE"];
$HosMOHP		= $_SESSION["HostHMOO"];

$SQL_H = "";
//ทั้งหมด
if($_POST['CODE_HMOO']<>'ทั้งหมด'){
	if (isset($_POST['CODE_HMOO']))
	{
		$SQL_H = $SQL_H." and hospitalnew.CODE_HMOO = 'เขต ".$_POST['CODE_HMOO']."'";

	}
}
if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){
	if (isset($_POST['TYPE_SERVICE']))
	{
		$SQL_H = $SQL_H." and hospitalnew.TYPE_SERVICE = '".$_POST['TYPE_SERVICE']."'";

	}
}
if($_POST['CODE_PROVINCE']<>'ทั้งหมด'){
if (isset($_POST['CODE_PROVINCE']))
	{
		$SQL_H = $SQL_H." and province.PROVINCE_CODE = '".$_POST['CODE_PROVINCE']."'";
	}
}
//echo $SQL_H;

include('q_dashboardi.php');
$doc_1 = $row1['CountP'];
$doc_2 = $row2['CountP'];
$doc_3 = $row3['CountP'];
$doc_4 = $row4['Count_train'];
$doc_5 = $row5['Count_train'];
$doc_6 = $row6['Count_train'];

$doc_nu_1 = $row7['count_nu'];
$doc_nu_2 = $row8['count_nu'];
$doc_nu_3 = $row9['count_nu'];
$doc_nu_4 = $row10['count_nu'];
$doc_nu_5 = $row11['Count_NuSTU'];
$doc_nu_6 = $row12['Count_NuSTU'];
$doc_nu_7 = $row13['Count_NuSTU'];

$doc_psy_1 = $row14['Count_psy'];
$doc_psy_2 = $row15['Count_psy'];
$doc_psy_3 = $row16['Count_psy'];
$doc_psy_4 = $row17['Count_psy'];
	
$sql18 = "SELECT personnel.positiontypeID, Count(personnel.personnelID) AS Count_perstype 
		  FROM personnel
		  JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		  JOIN province on TRIM(province.PROVINCE_NAME) = TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
		  WHERE personnel.positiontypeID = '3'";
if($SQL_H != ''){
	$sql18 = $sql18.$SQL_H;
}

$obj18 = mysqli_query($con, $sql18);
$row18 = mysqli_fetch_array($obj18);

$sql19 = "SELECT personnel.positiontypeID, Count(personnel.personnelID) AS Count_perstype 
			FROM personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE personnel.positiontypeID = '5'";
if($SQL_H != ''){
	$sql19 = $sql19.$SQL_H;
}
$obj19 = mysqli_query($con, $sql19);
$row19 = mysqli_fetch_array($obj19);

$sql20 = "SELECT personnel.positiontypeID, Count(personnel.personnelID) AS Count_perstype 
		  FROM personnel 
		  JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		  JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
		  WHERE personnel.positiontypeID = '6'";
if($SQL_H != ''){
	$sql20 = $sql20.$SQL_H;
}
$obj20 = mysqli_query($con, $sql20);
$row20 = mysqli_fetch_array($obj20);

$sql21 = "SELECT personnel.positiontypeID, Count(personnel.personnelID) AS Count_perstype 
		  FROM personnel 
		  JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
		  JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
		  WHERE personnel.positiontypeID = '7'";
if($SQL_H != ''){
	$sql21 = $sql21.$SQL_H;
}
$obj21 = mysqli_query($con, $sql21);
$row21 = mysqli_fetch_array($obj21);

$sql22 = "SELECT
				personnel.positiontypeID,
				Count( personnel.personnelID ) AS Count_perstype 
			FROM
				personnel 
			JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE
				personnel.positiontypeID = '8' 
				OR personnel.positiontypeID = '9' 
				OR personnel.positiontypeID = '10'";

if($SQL_H != ''){
	$sql22 = $sql22.$SQL_H;
}
$obj22 = mysqli_query($con, $sql22);
$row22 = mysqli_fetch_array($obj22);


$persontype3 = $row18['Count_perstype'];
$persontype5 = $row19['Count_perstype'];
$persontype6 = $row20['Count_perstype'];
$persontype7 = $row21['Count_perstype'];
$persontypeOther = $row22['Count_perstype'];

$sqlect = "SELECT ect.ect, sum(ect.ect_no) AS S_ECT  
			FROM ect 
			JOIN hospitalnew on hospitalnew.CODE5 = ect.hospitalCode5
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE ect.ect = 'มี'";

if($SQL_H != ''){
	$sqlect = $sqlect.$SQL_H;
}

$object = mysqli_query($con, $sqlect);
$rowect = mysqli_fetch_array($object);

$sqltms = "SELECT ect.tms, Sum(ect.tms_no ) AS S_TMS 
			FROM ect 
			JOIN hospitalnew on hospitalnew.CODE5 = ect.hospitalCode5
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE ect.tms = 'มี'";

if($SQL_H != ''){
	$sqltms = $sqltms.$SQL_H;
}
$objtms = mysqli_query($con, $sqltms);
$rowtms = mysqli_fetch_array($objtms);

$sqlbedw = "SELECT bed.Wardall, SUM(bed.Ward_no) AS SWard 
			FROM bed 
			JOIN hospitalnew on hospitalnew.CODE5 = bed.hospitalCode5
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE bed.Wardall = 'มี'";

if($SQL_H != ''){
	$sqlbedw = $sqlbedw.$SQL_H;
}
$objbedw = mysqli_query($con, $sqlbedw);
$rowbedw = mysqli_fetch_array($objbedw);
$bedw = $rowbedw['SWard'];

$sqlbedp = "SELECT bed.Unit, Sum(bed.Unit_no) AS SUNIT 
			FROM bed 
			JOIN hospitalnew on hospitalnew.CODE5 = bed.hospitalCode5
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3)) 
			WHERE bed.Unit = 'มี'";

if($SQL_H != ''){
	$sqlbedp = $sqlbedp.$SQL_H;
}
$objbedp = mysqli_query($con, $sqlbedp);
$rowbedp = mysqli_fetch_array($objbedp);
$bedu = $rowbedp['SUNIT'];

$sqlbedi = "SELECT bed.Integrate, Sum(bed.Integrate_no) AS SIN 
			FROM bed 
			JOIN hospitalnew on hospitalnew.CODE5 = bed.hospitalCode5
			JOIN province on TRIM(province.PROVINCE_NAME) =TRIM(SUBSTRING(hospitalnew.CODE_PROVINCE,3))
			WHERE bed.Integrate = 'มี'";

if($SQL_H != ''){
	$sqlbedi = $sqlbedi.$SQL_H;
}
$objbedi = mysqli_query($con, $sqlbedi);
$rowbedi = mysqli_fetch_array($objbedi);
$bedi = $rowbedi['SIN'];

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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  	
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <!--<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>	-->
	
  <?php include "header_font.php"; ?>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php //include "nav_bar.php" ?>
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
            <h3>Dashboard</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Blank Page</li>-->
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
			<form class="form-valide" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" id="myform1" name="foml">  
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="personnelDate" style="width: 100%;">
                    <option selected="selected" value="2566" >2566</option>
                    <option value="2565">2565</option>
                    
                  </select>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2"  style="width: 100%;">
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

                    provinceObject.html('<option value="ทั้งหมด">เลือกจังหวัด</option>');

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
					  <option value="<?PHP echo $rowprovince["PROVINCE_CODE"];?>" ><?PHP echo $rowprovince["PROVINCE_NAME"];?></option>
					  
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

    <!-- Main content -->
    <section class="content">

    

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><a href="tables-1.php?t=1">ข้อมูลแพทย์</a></h3>
				</div>
				<div class="card-body">
					<a href="tables-1.php?t=1"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx3 = document.getElementById('myChart3');

						  new Chart(ctx3, {
							  type: 'bar',
						  data: {
							labels: [""],  //ชื่อแกน X
							datasets: [{
							  label: "แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#2A9D8F',
							  borderColor: 	'#2A9D8F',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_1;?>],
							},{
							  label: "กำลังศึกษาแพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. กับ วว.)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#306b34',
							  borderColor: 	'#306b34',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_4;?>],
							},{
							  label: "จิตแพทย์ทั่วไป",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#ffee93',
							  borderColor: 	'#ffee93',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_2;?>],
							},
							{
							  label: "กำลังศึกษาจิตเวชศาสตร์/จิตแพทย์ทั่วไป",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#F2A65A',
							  borderColor: 	'#F2A65A',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_5;?>],
							},{
							  label: "จิตแพทย์เด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#FFB6C1',
							  borderColor: 	'#FFB6C1',
							  borderWidth: 1,	
							  barThickness: 60,	
							  data: [<?php echo $doc_3;?>],
							},{
							  
							  label: "กำลังศึกษาจิตแพทย์เด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#f08080',
							  borderColor: 	'#f08080',
							  borderWidth: 1,	
							  barThickness: 60,	
							  data: [<?php echo $doc_6;?>],
							}]
						  },
						  options: {
						    plugins: {
							  legend: {
								position: 'bottom',
								labels: {
									 usePointStyle: true  //<-- set this
								  }  
							  },
							  tooltip: {
								callbacks: {
								  title: () => undefined
								}
							  }
							},   
							scales: {
							  xAxes: [{
								//stacked: true,
								stacked: true,
								ticks: {
								  beginAtZero: true,
								  maxRotation: 0,
								  minRotation: 0
								}
							  }],
							  yAxes: [{
								//stacked: true,
							  }]
							},
						  }
						  });
					
					</script>
					
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><a href="tables-1.php?t=2">ข้อมูลพยาบาล</a></h3>
				</div>

				<div class="card-body">
					<!--<canvas id="myChart4"></canvas>-->
					<a href="tables-1.php?t=2"><canvas id="myChart4" style="min-height: 100%; height: 380px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx4 = document.getElementById('myChart4');

						  new Chart(ctx4, {
							  type: 'bar',
						  data: {
							labels: [""], //ชื่อแกน X
							datasets: [{
							  label: "การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#a3cef1',
							  borderColor: 	'#a3cef1',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_nu_1;?>],
							},{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#006494',
							  borderColor: 	'#006494',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_nu_5;?>],
								
							}, {
							  label: "การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#ffc09f',
							  borderColor: 	'#ffc09f',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_nu_3;?>],
							},
							{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#f68e5f',
							  borderColor: 	'#f68e5f',
							  borderWidth: 1,
							  barThickness: 60,		
							  data: [<?php echo $doc_nu_6;?>],
							
							}, {
							  label: "การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#fec9f1',
							  borderColor: 	'#fec9f1',
							  borderWidth: 1,
							  barThickness: 60,		
							   data: [<?php echo $doc_nu_4;?>],
							},{
							  label: "กำลังศึกษาการพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด",
							  type: "bar",
							  stack: "Sensitivity",
							  backgroundColor: '#966b9d',
							  borderColor: 	'#966b9d',
							  borderWidth: 1,	
							  barThickness: 60,	
							  data: [<?php echo $doc_nu_7;?>],
							}, {
							  label: "การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ",
							  type: "bar",
							  stack: "older",
							  backgroundColor: '#337766',
							  borderColor: 	'#337766',
							  borderWidth: 1,
							  barThickness: 60,		
							 data: [<?php echo $doc_nu_2;?>],
							
							}]
						  },
						  options: {
							 plugins: {
							  legend: {
								position: 'bottom',
								labels: {
									 usePointStyle: true  //<-- set this
								  }  
							  },
							  tooltip: {
								callbacks: {
								  title: () => undefined
								}
							  }
							},     
							scales: {
							  xAxes: [{
								//stacked: true,
								stacked: true,
								ticks: {
								  beginAtZero: true,
								  maxRotation: 0,
								  minRotation: 0
								}
							  }],
							  yAxes: [{
								stacked: true,
							  }]
							},
						  }
						  });
									
					</script>
				</div>

			</div>
		</div>
	  </div>
      <!-- /.card -->	
		
	  <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><a href="tables-1.php?t=4">ข้อมูลนักจิตวิทยา</a></h3>
				</div>

				<div class="card-body">
					<a href="tables-1.php?t=4"><canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
						 const ctx5 = document.getElementById('myChart5');

						  new Chart(ctx5, {
							  type: 'bar',
						  data: {
							labels: [""],  //ชื่อแกน X
							datasets: [{
							  label: "นักจิตวิทยาคลินิก",
							  type: "bar",
							  stack: "Base",
							  backgroundColor: '#f08080',
							  borderColor: 	'#f08080',
							  borderWidth: 1,	
							  barPercentage: 0.2,
							  //categorySpacing: 1,
							  barThickness: 60,	
							  data: [<?php echo $doc_psy_1;?>],
							},{
							  label: "นักจิตวิทยาคลินิก (บรรจุในตำแหน่งนักจิตวิทยา)",
							  type: "bar",
							  stack: "Base2",
							  backgroundColor: '#ffe066',
							  borderColor: 	'#ffe066',		
							  borderWidth: 1,
							  barPercentage: 0.2,
							  //categorySpacing: 1,
							  barThickness: 60,	
							  data: [<?php echo $doc_psy_2;?>],
							},{
							  label: "นักจิตวิทยา",
							  type: "bar",
							  stack: "Base3",		
							  backgroundColor: '#70c1b3',
							  borderColor: 	'#70c1b3',
							  borderWidth: 1,
							  barPercentage: 0.2,
							  //categorySpacing: 1,
							  barThickness: 60,	
							  data: [<?php echo $doc_psy_3;?>],
							},{
							  label: "นักจิตวิทยาการศึกษา (บรรจุในตำแหน่งนักจิตวิทยา)",
							  type: "bar",
							  stack: "Base4",			
							  backgroundColor: '#aaa1c8',
							  borderColor: 	'#aaa1c8',
							  borderWidth: 1,
							  barPercentage: 0.2,
							  //categorySpacing: 1,
							  barThickness: 60,	
							  data: [<?php echo $doc_psy_4;?>],
							}]
						  },
						  options: {
						    plugins: {
							  legend: {
								position: 'bottom',
								 labels: {
									 usePointStyle: true  //<-- set this
								  },
								  
								 
								 
							  },
							  tooltip: {
								callbacks: {
								  title: () => undefined
								}
							  }
							},   
							scales: {
							  xAxes: [{
								//stacked: true,
								stacked: true
							  }],
							  yAxes: [{
								stacked: true
								
							  }]
							},
						  }
						  });
					
					</script>
					
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<div class="row">
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #ABDEE6; color: black;">
				  <div class="inner">
					<h3><?php echo $persontype3.' คน' ;?></h3>

					<p>เภสัชกร
						<small><font color="d62828">(ผ่านการอบรมเฉพาะทาง)</font></small>
					  </p>
				  </div>
				  <div class="icon">
					<i class="fas fa-pills"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->

			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #9C8CB9; color: black;">
				  <div class="inner">
					<h3><?php echo $persontype5.' คน' ;?></h3>

					<p>นักสังคมสงเคราะห์
					  <small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-diagnoses"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
		  </div>
		  <!-- /.row -->	
		  <div class="row">
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FF968A; color: black;">
				  <div class="inner">
					<h3><?php echo $persontype6.' คน' ;?></h3>

					<p>นักกิจกรรมบำบัด 
						<small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-user-nurse"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->


			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FDDF9E; color: black;">
				  <div class="inner">
					<h3><?php echo $persontype7.' คน' ;?></h3>

					<p>นักสื่อความหมาย
						 <small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-american-sign-language-interpreting"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
		  </div>
		  <!-- /.row -->
		  <div class="row">
		 	 <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #FFB8DE; color: black;">
				  <div class="inner">
					<h3><?php echo $persontypeOther.' คน' ;?></h3>

					<p>อื่นๆ
						 <small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="	fas fa-users"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
		  </div>
		  <!-- /.row -->
	   </div>
		  
	</div>
	<!-- /.row -->

	
	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6 col-sm-6 col-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><a href="tables-2.php">ข้อมูลจำนวนเตียง</a></h3>
				</div>

				<div class="card-body" align="center">
	
					<a href="tables-2.php"><canvas id="myChart9" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas></a>
						
					
				</div>
				<div class="card-footer"><u>คำอธิบาย</u><br>
					 <b>Psychiatric Ward</b> หมายถึง หอผู้ป่วยจิตเวชมีพื้นที่ สถานที่ชัดเจน รวมถึงมีระบบบริหาร<br>
					 <b>Psychiatric Unit</b> หมายถึง เป็น Conner หรือพื้นที่ให้บริการอยู่ในหอผู้ป่วยอื่นๆ หรือใช้บุคลากรร่วมกัน <br>
					 <b>Intergrated Bed</b> หมายถึง การยืมเตียงชั่วคราวจากหอผู้ป่วยในแผนกอื่นหรือใช้เตียงร่วมโดยไม่ได้ระบุพื้นที่แยกสําหรับผู้ป่วยจิตเวชและยาเสพติด <br>
				</div>

			</div>
		</div>
		<div class="col-md-6">
		  <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #6DBFD1; color: black;">
				  <div class="inner">
					<h3><?php echo $rowect['S_ECT'].' เครื่อง';?></h3>

					<p>การรักษาด้วยไฟฟ้า (ECT)
						<small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-procedures"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #4A7A5E; color: black;">
				  <div class="inner">
					<h3><?php echo $rowtms['S_TMS'].' เครื่อง';?></h3>

					<p>การรักษาด้วยTranscranial Magnetic Stimulation (TMS)
						<small>&nbsp;</small>
					</p>
				  </div>
				  <div class="icon">
					<i class="fas fa-head-side-virus"></i>
				  </div>
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
			</div>
		</div>
	  </div>
      <!-- /.card -->
		
	  
		  	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
	  
<script>
		 

  const ctx9 = document.getElementById('myChart9');

  new Chart(ctx9, {
    type: 'doughnut',
    data: {
      labels: [ 'Psychiatric Ward', 'Psychiatric Unit', 'Integrated Bed'],
      datasets: [{
        label: 'จำนวน',
		backgroundColor: [
		  '#e76f51',
		  '#588157',
		  '#a7a7f2'
		],
        data: [<?php echo $bedw;?>,<?php echo $bedu;?>,<?php echo $bedi;?>],
        borderWidth: 1
      }]
    },
    options: {
	 plugins: {
		  legend: {
			position: 'bottom',
			 labels: {
				 usePointStyle: true  //<-- set this
			  },



		  },
		  tooltip: {
			callbacks: {
			  title: () => undefined
			}
		  }
		}
	
    }
  });
	
 
	
 
</script>
<script>
	
(async () => {

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
    ).then(response => response.json());

    // Prepare demo data. The data is joined to map using value of 'hc-key'
    // property by default. See API docs for 'joinBy' for more info on linking
    // data and map.
    const data = [
        ['th-ct', 10], ['th-4255', 11], ['th-pg', 12], ['th-st', 13],
        ['th-kr', 14], ['th-sa', 15], ['th-tg', 16], ['th-tt', 17],
        ['th-pl', 18], ['th-ps', 19], ['th-kp', 20], ['th-pc', 21],
        ['th-sh', 22], ['th-at', 23], ['th-lb', 24], ['th-pa', 25],
        ['th-np', 26], ['th-sb', 27], ['th-cn', 28], ['th-bm', 29],
        ['th-pt', 30], ['th-no', 31], ['th-sp', 32], ['th-ss', 33],
        ['th-sm', 34], ['th-pe', 35], ['th-cc', 36], ['th-nn', 37],
        ['th-cb', 38], ['th-br', 39], ['th-kk', 40], ['th-ph', 41],
        ['th-kl', 42], ['th-sr', 43], ['th-nr', 44], ['th-si', 45],
        ['th-re', 46], ['th-le', 47], ['th-nk', 48], ['th-ac', 49],
        ['th-md', 50], ['th-sn', 51], ['th-nw', 52], ['th-pi', 53],
        ['th-rn', 54], ['th-nt', 55], ['th-sg', 56], ['th-pr', 57],
        ['th-py', 58], ['th-so', 59], ['th-ud', 60], ['th-kn', 61],
        ['th-tk', 62], ['th-ut', 63], ['th-ns', 64], ['th-pk', 65],
        ['th-ur', 66], ['th-sk', 67], ['th-ry', 68], ['th-cy', 69],
        ['th-su', 70], ['th-nf', 71], ['th-bk', 72], ['th-mh', 73],
        ['th-pu', 74], ['th-cp', 75], ['th-yl', 76], ['th-cr', 77],
        ['th-cm', 78], ['th-ln', 79], ['th-na', 80], ['th-lg', 81],
        ['th-pb', 82], ['th-rt', 83], ['th-ys', 84], ['th-ms', 85],
        ['th-un', 86], ['th-nb', 87]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: topology
        },

		
        title: {
            text: ' '
        },

        /*
		subtitle: {
            text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/th/th-all.topo.json">Thailand</a>'
        },
		/*
        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },
		*/
        colorAxis: {
            min: 0
        },

        series: [{
            data: data,
			/*
            name: 'Random data',
			
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
			
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
			*/
        }]
    });

})();


</script>

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
<!--<script src="script.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
