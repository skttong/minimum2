<?PHP
session_start();

include('connect/conn.php');
/*
$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

$SQL_H = "";
//ทั้งหมด
if($_POST['CODE_HMOO']<>'ทั้งหมด'){
	if (isset($_POST['CODE_HMOO']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_HMOO = '".$_POST['CODE_HMOO']."'";

	}
}
if(trim($_POST['TYPE_SERVICE'])<>'ทั้งหมด'){
	if (isset($_POST['TYPE_SERVICE']))
	{
		$SQL_H = $SQL_H." and hosn.TYPE_SERVICE = '".$_POST['CODE_HMOO']."'";

	}
}
if(trim($_POST['TYPE_SERVICE'])<>'ทั้งหมด'){
if (isset($_POST['CODE_PROVINCE']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_PROVINCE = '".$_POST['CODE_HMOO']."'";
	}
}
*/



if (isset($_POST['position'])) {
	$position = $_POST['position'];

	/*if($position == 'แพทย์'){
		header("Location: dashboard02doctor.php");
	}else*/
	if($position == 'พยาบาล'){
		header("Location: dashboard02nurse.php");
	}elseif($position == 'เภสัชกร'){
		header("Location: dashboard02medicine.php");
	}elseif($position == 'นักจิตวิทยา'){
		header("Location: dashboard02heart.php");
	}elseif($position == 'นักสังคมสงเคราะห์'){
		header("Location: dashboard02social.php");
	}elseif($position == 'นักกิจกรรมบำบัด'){
		header("Location: dashboard02physical-therapy.php");
	}elseif($position == 'เวชศาสตร์สื่อความหมาย'){
		header("Location: dashboard02translation.php");
	}elseif($position == 'นักวิชาการศึกษาพิเศษ'){
		header("Location: dashboard02education.php");
	}elseif($position == 'นักวิชาการสาธารณสุข'){
		header("Location: dashboard02health.php");
	}elseif($position == 'วิชาชีพอื่นๆ'){
		header("Location: dashboard02other.php");
	}
}
  


$sql1 = "SELECT
  SUM(CASE WHEN r1 = 'จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'dr01', 
  SUM(CASE WHEN r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr02', 
  SUM(CASE WHEN r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'dr03', 
  SUM(CASE WHEN r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'dr04' 
FROM
  personnel p
JOIN hospitalnew e ON e.CODE5 = p.HospitalID
WHERE 1
AND p.r2 = 'Full-Time'

";


if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql1 = $sql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
}

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sql1 = $sql1."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sql1 = $sql1."AND e.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sql1 = $sql1."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sql1 = $sql1."AND p.HospitalID = '".$CODE_HOS."'" ;
  }
}



$obj1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_array($obj1);

$dr01 =  $row1['dr01'];
$dr02 =  $row1['dr02'];
$dr03 =  $row1['dr03'];
$dr04 =  $row1['dr04'];


$tsql1 = "SELECT
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตเวชศาสตร์/จิตแพทย์ทั่วไป' THEN 1 ELSE 0 END) AS 'tdr01',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 ELSE 0 END) AS 'tdr02',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'แพทย์เวชศาสตร์ป้องกันแขนงสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 ELSE 0 END) AS 'tdr03',
  SUM(CASE WHEN p.r1 = 'กำลังศึกษา' AND p.training = 'อื่น ๆ' THEN 1 ELSE 0 END) AS 'tdr04'
FROM
  personnel p
JOIN hospitalnew e ON e.CODE5 = p.HospitalID
WHERE 1
AND p.r2 = 'Full-Time'

";


if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $tsql1 = $tsql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
}

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $tsql1 = $tsql1."AND e.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $tsql1 = $tsql1."AND e.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $tsql1 = $tsql1."AND e.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $tsql1 = $tsql1."AND p.HospitalID = '".$CODE_HOS."'" ;
  }
}

$tobj1 = mysqli_query($con, $tsql1);
$trow1 = mysqli_fetch_array($tobj1);

$tdr01 =  $trow1['tdr01'];
$tdr02 =  $trow1['tdr02'];
$tdr03 =  $trow1['tdr03'];
$tdr04 =  $trow1['tdr04'];

$maptitle = 'จิตแพทย์ทั่วไป';

 $msql1 = "SELECT 
    h.CODE_PROVINCE,
    m.CODE_map02,
    m.CODE_PROVINCETH,
    COUNT(DISTINCT COALESCE(p.personnelID, 0)) AS total_personnel,
    m2.CODE_TOTAl
FROM 
    hospitalnew h
LEFT JOIN  
    personnel p ON h.CODE5 = p.HospitalID
JOIN mapdetail m ON h.CODE_PROVINCE = m.CODE_PROVINCE
JOIN Midyear m2 ON h.CODE_PROVINCE = m2.CODE_PROVINCE 
WHERE 
    p.r1 = '$maptitle'
" ;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql1 = $msql1."AND YEAR(p.personnelDate) = '".$Year."'" ;
}

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $msql1 = $msql1."AND h.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $msql1 = $msql1."AND h.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $msql1 = $msql1."AND h.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $msql1 = $msql1."AND h.CODE5 = '".$CODE_HOS."'" ;
  }
}



$msql1 = $msql1 ."
GROUP BY 
    h.CODE_PROVINCE, m.CODE_map02, m.CODE_PROVINCETH;

";


$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_personnel'] <> 0){
		$datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".number_format(($mrow1['total_personnel']/$mrow1['CODE_TOTAl']*100000), 2, '.', ',').",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}

//echo $datamap ;

$maptitle2 = 'จิตแพทย์เด็กและวัยรุ่น';

 $msql2 = "SELECT 
    h.CODE_PROVINCE,
    m.CODE_map02,
    m.CODE_PROVINCETH,
    COUNT(DISTINCT p.personnelID) AS total_personnel,
    m2.CODE_TOTAl
FROM 
    hospitalnew h
LEFT JOIN  
    personnel p ON h.CODE5 = p.HospitalID
JOIN mapdetail m ON h.CODE_PROVINCE = m.CODE_PROVINCE
JOIN Midyear m2 ON h.CODE_PROVINCE = m2.CODE_PROVINCE 
WHERE 
    p.r1 = '$maptitle2'
AND p.r2 = 'Full-Time'
" ;

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql2 = $msql2."AND YEAR(p.personnelDate) = '".$Year."'" ;
}

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $msql2 = $msql2."AND h.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $msql2 = $msql2."AND h.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $msql2 = $msql2."AND h.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $msql2 = $msql2."AND h.CODE5 = '".$CODE_HOS."'" ;
  }
}


$msql2 = $msql2 ."
GROUP BY 
    h.CODE_PROVINCE, m.CODE_map02, m.CODE_PROVINCETH;

";


$mobj2 = mysqli_query($con, $msql2);

$datamap2 ='';
while($mrow2 = mysqli_fetch_array($mobj2))
{
	if($mrow2['total_personnel'] <> 0){
		$datamap2 = $datamap2."{'hc-key':'".$mrow2['CODE_map02']."',value:".number_format(($mrow2['total_personnel']/$mrow2['CODE_TOTAl']*100000), 2, '.', ',').",name:'".$mrow2['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}

//echo $datamap ;



$sqlmid = "SELECT
    SUM(CODE_MALE) AS Total_Male,
    SUM(CODE_FEMALE) AS Total_Female,
    SUM(CODE_TOTAL) AS Total
FROM Midyear
GROUP BY CODE_PROVINCE, YEAR;";
$objmid = mysqli_query($con, $sqlmid);
$rowmid = mysqli_fetch_array($objmid);

$Total_Male = $rowmid['Total_Male'];
$Total_Female = $rowmid['Total_Female'];
$Total = $rowmid['Total'];


$sqlall = "SELECT
  h.CODE5,
  h.HOS_NAME,
  COUNT(CASE WHEN p.r1 = 'จิตแพทย์ทั่วไป' THEN 1 END) AS dr01,
  COUNT(CASE WHEN p.r1 = 'จิตแพทย์เด็กและวัยรุ่น' THEN 1 END) AS dr02,
  COUNT(CASE WHEN p.r1 = 'แพทย์เวชศาสตร์ป้องกันสุขภาพจิตชุมชน (อว. หรือ วว.)' THEN 1 END) AS dr03,
  COUNT(CASE WHEN p.r1 = 'แพทย์สาขาอื่น ที่ปฏิบัติงานด้านจิตเวชผู้ใหญ่และจิตเวชเด็กและวัยรุ่น' THEN 1 END) AS dr04
FROM
  hospitalnew h
JOIN personnel p ON h.CODE5 = p.HospitalID 
WHERE 1 
AND p.r2 = 'Full-Time'
";
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlall = $sqlall."AND YEAR(p.personnelDate) = '".$Year."'" ;
}

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
  $CODE_HMOO = $_POST['CODE_HMOO'];
  $sqlall = $sqlall."AND h.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
  $mySelect = trim($_POST['TYPE_SERVICE']);
  $sqlall = $sqlall."AND h.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
  if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
  $CODE_PROVINCE = $_POST['CODE_PROVINCE'];
  $sqlall = $sqlall."AND h.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
  }
}

if (isset($_POST['CODE_HOS'])) {
  if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
  $CODE_HOS = $_POST['CODE_HOS'];
  $sqlall = $sqlall."AND h.CODE5 = '".$CODE_HOS."'" ;
  }
}


$sqlall = $sqlall."
GROUP BY
  h.CODE5, h.HOS_NAME;"
  ;

$sqlall2 = $sqlall;

$objall = mysqli_query($con, $sqlall);
$objall2 = mysqli_query($con, $sqlall2);



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  	
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>	
	

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/fonts-googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">

	<?php include "header_font.php"; ?>

  <style>
	
	  .divinfo{
		 /* background-color: #e7f3fe;*/
		  border-left: 3px solid #68AADF;
	  }
	  .top-right {
		  position: absolute;
		  top: 8px;
		  right: 16px;
	  }
	  .callout2
	  {
		  margin: 0 0 0 0 ;
		  padding: 15px 30px 7px 15px;
	  }
  </style>	
</head>
<body class="hold-transition sidebar-mini bodychange">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar2.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu2.php" ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h3>ข้อมูลทรัพยากรบุคลากร แพทย์ </h3>
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
			<form class="form-valide" action="dashboard02doctor.php" method="post" id="myform1" name="foml">  
      <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>ปีงบประมาณ</label>
                  <select class="form-control select2" name="Year" id="Year" style="width: 100%;">
                   <!-- <option selected="selected" value="2567" >2567</option>
                    <option value="2566">2566</option>
                    <option value="2565">2565</option>
                    <option value="2564">2564</option>
                    <option value="2563">2563</option>-->
                    <?PHP for($i=0; $i<= (5); $i++) {?>
                    <option <?php if ($_POST['Year'] == ((date("Y")+543))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543))-$i; ?>"><?PHP echo ((date("Y")+543))-$i ;?></option>
                    <?PHP }?>
                  </select>
                </div>
              </div>
              <!-- /.col -->

              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="CODE_HMOO" style="width: 100%;" onChange="myFunction3()">
                    <option <?php if ($_POST['CODE_HMOO'] == 'ทั้งหมด'){?> selected="selected" <?php } ?>  value="ทั้งหมด">ทั้งหมด</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '1'){?> selected="selected" <?php } ?> value="1">เขตสุขภาพ 1</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '2'){?> selected="selected" <?php } ?> value="2">เขตสุขภาพ 2</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '3'){?> selected="selected" <?php } ?> value="3">เขตสุขภาพ 3</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '4'){?> selected="selected" <?php } ?> value="4">เขตสุขภาพ 4</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '5'){?> selected="selected" <?php } ?> value="5">เขตสุขภาพ 5</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '6'){?> selected="selected" <?php } ?> value="6">เขตสุขภาพ 6</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '7'){?> selected="selected" <?php } ?> value="7">เขตสุขภาพ 7</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '8'){?> selected="selected" <?php } ?> value="8">เขตสุขภาพ 8</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '9'){?> selected="selected" <?php } ?> value="9">เขตสุขภาพ 9</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '10'){?> selected="selected" <?php } ?> value="10">เขตสุขภาพ 10</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '11'){?> selected="selected" <?php } ?> value="11">เขตสุขภาพ 11</option>
                    <option <?php if ($_POST['CODE_HMOO'] == '12'){?> selected="selected" <?php } ?> value="12">เขตสุขภาพ 12</option>
					          <option <?php if ($_POST['CODE_HMOO'] == '13'){?> selected="selected" <?php } ?> value="13">เขตสุขภาพ 13</option>
                   </select>
                </div>
                <script>
                   function myFunction3() {
                      const selectedValue = $('#CODE_HMOO').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hmoo.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { moo_id: selectedValue },
                            success: function(data) {
                              $('#CODE_PROVINCE').html(data);
                            }
                          });
                    }
			    	</script> 
            
			   <!-- /.col -->
             
			 <!-- /.col -->
              
				<!-- /.form-group -->
         
               
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                     <option value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP /*
          if($_POST['CODE_PROVINCE'] <> 'ทั้งหมด'){
					$sqlprovince = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
          WHERE  NO_PROVINCE = ".$_POST['CODE_PROVINCE']."
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option selected="selected" value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					} 
        }else{
					?>
               <option value="ทั้งหมด" >ทั้งหมด</option>
        <?php } */ ?>
                  </select>
                </div>

                <script>
                   function myFunction4() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_affiliation.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { CODE_PROVINCE: selectedValue },
                            success: function(data) {
                              $('#Affiliation').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	

              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2" name="Affiliation2" id="Affiliation2" style="width: 100%;" onChange="myFunction7()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="นอกสังกัด">ในสังกัด</option>
                    <option value="นอกสังกัด">นอกสังกัด</option>
                  </select>
                </div>
                </div>
                <!-- /.col -->	
              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction5()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?PHP 
                       if($_POST['Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['Affiliation']; ?> "><?php echo $_POST['Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

                <script>
                   function myFunction5() {
                      const selectedValue = $('#Affiliation').val();
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_servicetype.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { Affiliation: selectedValue , codeprovince: codeprovince  },
                            success: function(data) {
                              $('#TYPE_SERVICE').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->

              <div class="form-group" id="labelservice">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction2()">
                     <option value="ทั้งหมด">ทั้งหมด</option>
                     <?PHP 
                       if(trim($_POST['TYPE_SERVICE']) <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo trim($_POST['TYPE_SERVICE']); ?> "><?php echo trim($_POST['TYPE_SERVICE']); ?> </option>
                    <?php } ?>
                   <!-- <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					          <option value="F2">F2</option>
					          <option value="F3">F3</option>  -->
                  </select>
                </div>
                <!-- /.form-group -->  
                <script>
                   function myFunction2() {
                      const selectedValue = $('#TYPE_SERVICE').val();
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                          //alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue , codeprovince: codeprovince},
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 


              <div class="col-md-2">
               <div class="form-group">
                  <label>โรงพยาบาล</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP /*
          if($_POST['CODE_HOS'] <> ''){
					$sqlprovince = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
AND CODE5 = ".$_POST['CODE_HOS']."
ORDER BY hospitalnew.CODE_HMOO DESC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option selected="selected"  value="<?PHP echo $rowprovince["CODE5"];?>" ><?PHP echo $rowprovince["HOS_NAME"];?></option>
					  
					<?PHP
					} 
        } */
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->		


              

<!--<div class="col-md-2">
               <div class="form-group">
                  <label>เขตพื้นที่/Service Plan</label>
                  <select class="form-control select2" style="width: 100%;" id="mySelect" >
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
              </div>-->
              <!-- /.col -->		
			  <div class="col-md-2">
               <div class="form-group">
                  <label> ประเภทบุคลากร</label>
                  <select name="position" class="form-control select2" id="position" style="width: 100%;">
					<option selected="selected"value="แพทย์" >แพทย์</option>
					<option value="พยาบาล" >พยาบาล</option>
					<option value="เภสัชกร" >เภสัชกร</option>
					<option value="นักจิตวิทยา" >นักจิตวิทยา</option>
					<option value="นักสังคมสงเคราะห์" >นักสังคมสงเคราะห์</option>
					<option value="นักกิจกรรมบำบัด" >นักกิจกรรมบำบัด</option>
					<option value="เวชศาสตร์สื่อความหมาย" >เวชศาสตร์สื่อความหมาย</option>
					<option value="นักวิชาการศึกษาพิเศษ" >นักวิชาการศึกษาพิเศษ</option>
					<option value="นักวิชาการสาธารณสุข" >นักวิชาการสาธารณสุข</option>
					<option value="วิชาชีพอื่นๆ" >วิชาชีพอื่นๆ</option>

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

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">แพทย์</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href=#"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
		
					<script>
        const ctx = document.getElementById('myChart3');
        
        
        const downloadButton = document.getElementById('download-button');

        const myChart3 = new Chart(ctx, {
            type: 'bar',
			data: {
                labels: ['จิตแพทย์ผู้ใหญ่', 'จิตแพทย์เด็กและวัยรุ่น', 'เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน', 'อื่นๆ'],
                datasets: [{
                    label: 'ปฏิบัติงาน',
                    data: [<?php echo $dr01.','.$dr02.','.$dr03.','.$dr04;?>],
                    backgroundColor: '#6CE5E8',
                    borderColor: '#6CE5E8',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'กำลังศึกษาต่อเฉพาะทาง',
                    data: [<?php echo $tdr01.','.$tdr02.','.$tdr03.','.$tdr04;?>],
                    backgroundColor: '#41B8D5',
                    borderColor: '#41B8D5',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        stacked: true, // Enable stacking for the y-axis
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

downloadButton.addEventListener('click', function() {
    const chartData = myChart3.toBase64Image(); // Get chart image data
    const link = document.createElement('a');
    link.href = chartData;
    link.download = 'stacked-barchart.png'; // Set download filename
    link.click();
});
    </script>
					
				</div>
				

			</div>
			<div class="row">
			<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"></h3>
				</div>
				<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="15%">จิตแพทย์ผู้ใหญ่</th>
					  <th width="12%">จิตแพทย์เด็กและวัยรุ่น</th>
					  <th width="15%">เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน</th>
					  <th width="15%">อื่นๆ</th>
				   </tr>
                   </thead>
                  <tbody>

				  <?php
				  		$i = 0;

						while($rowall = mysqli_fetch_array($objall)){
							$i++;
				  ?>
				  <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowall['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowall['dr01'];?></td>
						<td width="12%"><?php echo $rowall['dr02'];?></td>
						<td width="12%"><?php echo $rowall['dr03'];?></td>
						<td width="12%"><?php echo $rowall['dr04'];?></td>
				   </tr>
				   <?php 
						}
				   ?>

					</tbody>
				  </table>

          <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="15%">จิตแพทย์ผู้ใหญ่</th>
					  <th width="12%">จิตแพทย์เด็กและวัยรุ่น</th>
					  <th width="15%">เวชศาสตร์ป้องกัน สาขาจิตเวชชุมชน</th>
					  <th width="15%">อื่นๆ</th>
				   </tr>
                   </thead>
                  <tbody>

				  <?php
				  		$j = 0;

						while($rowall2 = mysqli_fetch_array($objall2)){
							$j++;
				  ?>
				  <tr align="center">
						<td width="2%"><?php echo $j;?></td>
						<td width="12%"><?php echo $rowall2['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowall2['dr01'];?></td>
						<td width="12%"><?php echo $rowall2['dr02'];?></td>
						<td width="12%"><?php echo $rowall2['dr03'];?></td>
						<td width="12%"><?php echo $rowall2['dr04'];?></td>
				   </tr>
				   <?php 
						}
				   ?>

					</tbody>
				  </table>
				</div>
			</div>	
				
			</div>
			</div>
		
		</div>
		
		<div class="col-md-6">


		<div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9ECFF; color: black;">
                <div class="inner">
                    
				<p>จิตแพทย์ผู้ใหญ่</p> 
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($dr01), 0, '.', ',');?> คน</h3>
                    <p><?php echo number_format((($dr01/$Total)*100000), 4, '.', ',') ;?> : 1แสน ประชากร</p>
					
				  </div>
				  <!--<div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #D9D9D9; color: black;">
                <div class="inner">
                    
                    
					<p>จิตแพทย์เด็กและวัยรุ่น</p>
					<h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format(($dr02), 0, '.', ',');?> คน</h3>
					<p><?php echo number_format((($dr02/$Total)*100000), 4, '.', ',') ;?> : 1แสน ประชากร</p>
					
				  </div>
				 <!-- <div class="icon">
					<i class="fas fa-file-medical-alt"></i>
				  </div>-->
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-12">
			  <div class="card">
				<!--<div class="card-header">
					<h3 class="card-title">ผู้ป่วยในจิตเวช</h3>
				</div>-->
				<div class="col-md-4" >
                <div class="form-group">
                  <!--<label> ประเภทบุคลากร</label>-->
				  <br>
                  <select name="position2" class="form-control select2" id="position2" style="width: 100%;">
                    <option selected="selected" value="จิตแพทย์ผู้ใหญ่" >จิตแพทย์ผู้ใหญ่</option>
					          <option value="จิตแพทย์เด็กและวัยรุ่น" >จิตแพทย์เด็กและวัยรุ่น</option>
                  </select>
                </div>
              </div>
        <div id="map01">
          <div class="card-body">
            <div id="container"></div>
            
          </div>
        </div>

        <div id="map02" class="disabled">
          <div class="card-body">
            <div id="container2"></div>
            
          </div>
        </div>

        <style>
          .disabled {
          display: none;
                pointer-events: none;  /* Prevent any mouse events */
                opacity: 0.1;          /* Make it look disabled */
          
            }
        </style>

        <script>
				const dropdown = document.getElementById('position2');
        const div1 = document.getElementById('map01');
        const div2 = document.getElementById('map02');
	
				dropdown.addEventListener('change', function() {
            //alert(dropdown.value);
            if (dropdown.value === 'จิตแพทย์เด็กและวัยรุ่น') {
                div2.classList.remove('disabled');
                div1.classList.add('disabled');
            }else{
                div2.classList.add('disabled');
                div1.classList.remove('disabled');
            }
           // const div = document.getElementById('myMctt3');
					 // div.classList.add('disabled');
					 // document.getElementById("other_r1").disabled = false;
				});

			</script>
        

			</div>
			  </div>
			  <!-- ./col -->
			 
			</div>
			<!-- ./row -->	
			</div>
			
	  </div>
      <!-- /.card -->	
						</div>
						</div>


						<script>
		 

		 const ctx9 = document.getElementById('myChart9');
	   
		 new Chart(ctx9, {
		   type: 'doughnut',
		   data: {
			 labels: [ 'Psychiatric Ward', 'Psychiatric Unit', 'Integrated Bed'],
			 datasets: [{
			   label: 'จำนวน',
			   backgroundColor: [
				 '#056934',
				 '#fbe036',
				 '#cd0808'
			   ],
			   data: [<?php echo "22, 15, 5" ;?>],
			   borderWidth: 1
			 }]
		   },
		   options: {
			 cutoutPercentage: 95,
			 legend: {
			   display: false
			 },
			 tooltip: {
			   enabled: false
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
			<?php echo $datamap; ?> 
		   ];
	   
		   // Create the chart
		   Highcharts.mapChart('container', {
			
			chart: {
                map: topology,
                // Responsive options:
				height: 900, // Adjust the height as desired (e.g., 600, 800)
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 1000
                        },
                        chartOptions: {
                            title: {
                                style: {
                                    display: 'none' // Hide title on small screens
                                }
                            },
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom' // Move legend below chart on small screens
                            }
                        }
                    }]
                }
            },
	   
			   
			   title: {
				   text: ' '
			   },
         mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
			   
			   colorAxis: {
				min: 1,
            type: 'logarithmic',
            minColor: '#cd0808',
            maxColor: '#056934',
            stops: [
                [0, '#cd0808'],
                [0.67, '#fbe036'],
                [1, '#056934']
            ]
			   },*/

         legend: {
                title: {
                    text: '',
                    style: {
                        color: ( // theme
                            Highcharts.defaultOptions &&
                            Highcharts.defaultOptions.legend &&
                            Highcharts.defaultOptions.legend.title &&
                            Highcharts.defaultOptions.legend.title.style &&
                            Highcharts.defaultOptions.legend.title.style.color
                        ) || 'black'
                    }
                },
                align: 'right',
                verticalAlign: 'bottom',
                floating: true,
                layout: 'vertical',
                valueDecimals: 1,
                backgroundColor: ( // theme
                    Highcharts.defaultOptions &&
                    Highcharts.defaultOptions.legend &&
                    Highcharts.defaultOptions.legend.backgroundColor
                ) || 'rgba(255, 255, 255, 0.85)',
                symbolRadius: 20,
                symbolHeight: 14
            },
          
            colorAxis: {
                dataClasses: [{
                    
                    from: 1.7,
                    color: '#056934',
                    name: '>1.7 : แสนประชากร '
                }, {
                    from: 1.7,
                    to: 1,
                    color: '#fbe036',
                    name: '1 - 1.7 : แสนประชากร '
                }, {
                    to: 1,
                    color: '#cd0808',
                    name: '< 1 : แสนประชากร ' 
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี '
                }]
            },
			   
	   
			   series: [{
				   data: data,
				   
				   name: 'Random data',
				   /*
				   states: {
					   hover: {
						   color: '#BADA55'
					   }
				   },
				    */ 
            dataLabels: {
                    enabled: true,
                    color: '#000000',
                      format: '{point.name}'
                    // Only show dataLabels for areas with high label rank
                   // format: '{#if (lt point.properties.labelrank 5)}' +
                    //    '{point.properties.iso-a2}' +
                   //     '{/if}'
                },
				  
			   }]
		   });
	   
	   })();

     (async () => {
	   
     const topology = await fetch(
       'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
     ).then(response => response.json());
   
     // Prepare demo data. The data is joined to map using value of 'hc-key'
     // property by default. See API docs for 'joinBy' for more info on linking
     // data and map.
     const data2 = [
    <?php echo $datamap2; ?> 
     ];
   
     // Create the chart
     Highcharts.mapChart('container2', {
    
    chart: {
              map: topology,
              // Responsive options:
      height: 900, // Adjust the height as desired (e.g., 600, 800)
              responsive: {
                  rules: [{
                      condition: {
                          maxWidth: 1000
                      },
                      chartOptions: {
                          title: {
                              style: {
                                  display: 'none' // Hide title on small screens
                              }
                          },
                          legend: {
                              layout: 'horizontal',
                              align: 'center',
                              verticalAlign: 'bottom' // Move legend below chart on small screens
                          }
                      }
                  }]
              }
          },
   
       
       title: {
         text: ' '
       },

       mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
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
       
       colorAxis: {
      min: 1,
          type: 'logarithmic',
          minColor: '#cd0808',
          maxColor: '#056934',
          stops: [
              [0, '#cd0808'],
              [0.67, '#fbe036'],
              [1, '#056934']
          ]
       },
       */

       legend: {
                title: {
                    text: '',
                    style: {
                        color: ( // theme
                            Highcharts.defaultOptions &&
                            Highcharts.defaultOptions.legend &&
                            Highcharts.defaultOptions.legend.title &&
                            Highcharts.defaultOptions.legend.title.style &&
                            Highcharts.defaultOptions.legend.title.style.color
                        ) || 'black'
                    }
                },
                align: 'right',
                verticalAlign: 'bottom',
                floating: true,
                layout: 'vertical',
                valueDecimals: 1,
                backgroundColor: ( // theme
                    Highcharts.defaultOptions &&
                    Highcharts.defaultOptions.legend &&
                    Highcharts.defaultOptions.legend.backgroundColor
                ) || 'rgba(255, 255, 255, 0.85)',
                symbolRadius: 20,
                symbolHeight: 14
            },
          colorAxis: {
                dataClasses: [{
                    
                    from: 1.7,
                    color: '#056934',
                    name: '>1.7 : แสนประชากร '
                }, {
                    from: 1.7,
                    to: 1,
                    color: '#fbe036',
                    name: '1 - 1.7 : แสนประชากร '
                }, {
                    to: 1,
                    color: '#cd0808',
                    name: '< 1 : แสนประชากร ' 
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี '
                }]
            },
   
       series: [{
         data: data2,
         
         name: 'Random data',
         
         /*
         states: {
           hover: {
             color: '#BADA55'
           }
         },
           */
          dataLabels: {
                    enabled: true,
                    color: '#000000',
                      format: '{point.name}'
                    // Only show dataLabels for areas with high label rank
                   // format: '{#if (lt point.properties.labelrank 5)}' +
                    //    '{point.properties.iso-a2}' +
                   //     '{/if}'
                },
       
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

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

<script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
     // "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#example3").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,
	  "searching": false, "lengthChange": false, "info": false,
	  "paging": false,
      "buttons": ["copy", "csv", "excel", { 
      extend: 'print',
      text: 'PDF'
   },
    //"print"
	]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>