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
if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){
	if (isset($_POST['TYPE_SERVICE']))
	{
		$SQL_H = $SQL_H." and hosn.TYPE_SERVICE = '".$_POST['CODE_HMOO']."'";

	}
}
if($_POST['TYPE_SERVICE']<>'ทั้งหมด'){
if (isset($_POST['CODE_PROVINCE']))
	{
		$SQL_H = $SQL_H." and hosn.CODE_PROVINCE = '".$_POST['CODE_HMOO']."'";
	}
}
*/

$sqlfcenter = "SELECT
 *
FROM
  hospitalnew hn
JOIN serviceform sf ON sf.HospitalID = hn.CODE5
WHERE 1  "; 

/*  
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlfcenter = $sqlfcenter."AND YEAR(sf.mhpsDate) = '".$Year."'" ;
} 
*/

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlfcenter = $sqlfcenter."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlfcenter = $sqlfcenter."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlfcenter = $sqlfcenter."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlfcenter = $sqlfcenter."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlfcenter = $sqlfcenter."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlfcenter = $sqlfcenter."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlfcenter = $sqlfcenter."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 

//$sqlfcenter = "SELECT mhpsID, qustype, HospitalID, qus1_1, qus1_2, qus1_3, qus1_4, qus2_1, qus3_1, qus3_2, qus3_3, qus3_4, qus3_5,number_patients, problems_obstacles, feedback, DevelopmentPlan, statusfinal  FROM serviceform WHERE HospitalID = '10676'; "; 	

$queryfcenter = mysqli_query($con, $sqlfcenter);

$q1total_1 = 0;
$q2total_1 = 0;
$q3total_1 = 0;
$q4total_1 = 0;

while($resultfcenter = mysqli_fetch_array($queryfcenter)){ 
		$mhpsID = $resultfcenter['mhpsID'];
		$qustype = $resultfcenter['qustype'];
		$qus1_1 = preg_split ("/\,/", $resultfcenter['qus1_1']); 	
		$qus1_2 = preg_split ("/\,/", $resultfcenter['qus1_2']);
		$qus1_3 = preg_split ("/\,/", $resultfcenter['qus1_3']);
		$qus1_4 = preg_split ("/\,/", $resultfcenter['qus1_4']);
		$qus2_1 = preg_split ("/\,/", $resultfcenter['qus2_1']);	
		$qus3_1 = preg_split ("/\,/", $resultfcenter['qus3_1']);
		$qus3_2 = preg_split ("/\,/", $resultfcenter['qus3_2']);
		$qus3_3 = preg_split ("/\,/", $resultfcenter['qus3_3']);
		$qus3_4 = preg_split ("/\,/", $resultfcenter['qus3_4']);
		$qus3_5 = preg_split ("/\,/", $resultfcenter['qus3_5']);
		$number_patients = preg_split ("/\,/", $resultfcenter['number_patients']);
		$problems_obstacles = $resultfcenter['problems_obstacles'];
		$feedback	= $resultfcenter['feedback'];
		$DevelopmentPlan = $resultfcenter['DevelopmentPlan'];
		$statusfinal 	= $resultfcenter['statusfinal'];

   // print_r($qus3_1);

		if($qustype=='1'){
			$q1total_1 = $q1total_1+$qus1_1[3];
			$q2total_1 = $q2total_1+$qus1_1[5];
			$q3total_1 = $q3total_1+$qus3_1[0];
			$q4total_1 = $q4total_1+$qus3_4[5];
		}elseif($qustype=='2'){
			$q1total_1 = $q1total_1+$qus1_1[1];
      $q2total_1 = $q2total_1+$qus1_1[4];
			$q3total_1 = $q3total_1+$qus3_1[0];
			$q4total_1 = $q4total_1+$qus3_2[1];
		}elseif($qustype=='3'){
			$q1total_1 = $q1total_1+$qus2_1[1];
			//$q2total = $q2total+$qus1_1[6];
			//$q3total = $q3total+$qus3_1[1];
			//$q4total = $q4total+$qus3_[1];
		}
}

/*
echo $q1total_1 ;
echo "<br>";
echo $q2total_1 ;
echo "<br>";
echo $q3total_1 ;
echo "<br>";
echo $q4total_1 ;
echo "<br>";
*/

$msql1 = "SELECT
    m.CODE_map02,
    m.CODE_PROVINCETH,
    SUM(
      CASE 
        WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 4), ',', -1)
        WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 2), ',', -1)
        WHEN sf.qustype = '3' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus2_1, ',', 2), ',', -1)
        ELSE 0
      END
    ) AS q1,
    SUM(
      CASE 
        WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 6), ',', -1)
        WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 5), ',', -1)
        ELSE 0
      END
    ) AS q2,
    SUM(
      CASE 
        WHEN sf.qustype = '1' OR sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_1, ',', 1), ',', -1)
        ELSE 0
      END
    ) AS q3,
    SUM(
      CASE 
        WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_4, ',', 6), ',', -1)
        WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_2, ',', 2), ',', -1)
        ELSE 0
      END
    ) AS q4
  FROM
    hospitalnew hn
  LEFT JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
  JOIN serviceform sf ON sf.HospitalID = hn.CODE5
  WHERE 1
 ";

 /* 
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql1 = $msql1."AND YEAR(sf.mhpsDate) = '".$Year."'" ;
}
  */ 

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$msql1 = $msql1."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$msql1 = $msql1."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $msql1 = $msql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $msql1 = $msql1."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $msql1 = $msql1."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$msql1 = $msql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$msql1 = $msql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  } 

  $msql1 = $msql1." GROUP BY m.CODE_PROVINCETH HAVING q1 > 0 OR q2 > 0 OR q3 > 0 OR q4 > 0 " ;
  

//echo $msql1;
$mobj1 = mysqli_query($con, $msql1);

$datamap1 ='';
$datamap2 ='';
$datamap3 ='';
$datamap4 ='';


// วนลูปดึงข้อมูลจากฐานข้อมูล
while ($mrow1 = mysqli_fetch_array($mobj1)) {
  // สร้างข้อมูลสำหรับแผนที่ของแต่ละคำถาม
  $datamap1 .= "{'hc-key':'" . $mrow1['CODE_map02'] . "', value:" . $mrow1['q1'] . ", name:'" . $mrow1['CODE_PROVINCETH'] . "'},";
  $datamap2 .= "{'hc-key':'" . $mrow1['CODE_map02'] . "', value:" . $mrow1['q2'] . ", name:'" . $mrow1['CODE_PROVINCETH'] . "'},";
  $datamap3 .= "{'hc-key':'" . $mrow1['CODE_map02'] . "', value:" . $mrow1['q3'] . ", name:'" . $mrow1['CODE_PROVINCETH'] . "'},";
  $datamap4 .= "{'hc-key':'" . $mrow1['CODE_map02'] . "', value:" . $mrow1['q4'] . ", name:'" . $mrow1['CODE_PROVINCETH'] . "'},";
}




$sqlall = "SELECT
   hn.HOS_NAME,
   hn.TYPE_SERVICE,
   hn.CODE_PROVINCE,
   CASE 
      WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 4), ',', -1)
      WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 2), ',', -1)
      WHEN sf.qustype = '3' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus2_1, ',', 2), ',', -1)
      ELSE 0
   END AS q1,
   CASE 
      WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 6), ',', -1)
      WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus1_1, ',', 5), ',', -1)
      ELSE 0
   END AS q2,
   CASE 
      WHEN sf.qustype = '1' OR sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_1, ',', 1), ',', -1)
      ELSE 0
   END AS q3,
   CASE 
      WHEN sf.qustype = '1' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_4, ',', 6), ',', -1)
      WHEN sf.qustype = '2' THEN SUBSTRING_INDEX(SUBSTRING_INDEX(sf.qus3_2, ',', 2), ',', -1)
      ELSE 0
   END AS q4 
FROM
  hospitalnew hn
JOIN serviceform sf ON sf.HospitalID = hn.CODE5
WHERE 1

";

/*
if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlall = $sqlall."AND YEAR(sf.mhpsDate) = '".$Year."'" ;
} 
  */

if (isset($_POST['Year'])) {
	$Year = $_POST['Year']-543;
	$sqlall = $sqlall."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }else{
	if (date("m") == '10' || date("m") == '11' || date("m") == '12'){
		$Year = (date("Y"))+1;
	}else{
		$Year = (date("Y"));
	}
	$sqlall = $sqlall."AND sf.mhpsDate >= CONCAT(".$Year-1 .",'-10-01') 
	AND sf.mhpsDate <= CONCAT(".$Year.", '-09-30')";
  }

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlall = $sqlall."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['type_Affiliation'])) {
  if (trim($_POST['type_Affiliation'])<> 'ทั้งหมด') {
  $type_Affiliation = trim($_POST['type_Affiliation']);
  $sqlall = $sqlall."AND hn.type_Affiliation LIKE ('".$type_Affiliation."%')" ;
  }
}

if (isset($_POST['TYPE_SERVICE'])) {
  if (trim($_POST['TYPE_SERVICE'])<> 'ทั้งหมด') {
    $mySelect = trim($_POST['TYPE_SERVICE']);
    $sqlall = $sqlall."AND hn.HOS_TYPE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlall = $sqlall."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlall = $sqlall."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }  

  $sqlall = $sqlall." HAVING q1 > 0 OR q2 > 0 OR q3 > 0 OR q4 > 0 " ;
  

$sqlall1 = $sqlall; 

$objall = mysqli_query($con, $sqlall);
$objall1 = mysqli_query($con, $sqlall1);

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
            <h3>ระบบบริการจิตเวช</h3>
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
			<form class="form-valide" action="dashboard06.php" method="post" id="myform1" name="foml">  
      <div class="row">
             <!-- ปีงบประมาณ -->
     <div class="col-md-2">
            <div class="form-group">
                <label>ปีงบประมาณ</label>
                <select class="form-control select2" name="Year" id="Year" style="width: 100%;">
                   <?PHP for($i=0; $i < (5); $i++) {
                      
                      if (date("m") == '10' || date("m") == '11' || date("m") == '12'){

                      ?>
                      
                       <option <?php if ($_POST['Year'] == ((date("Y")+543+1))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543+1))-$i; ?>"><?PHP echo ((date("Y")+543+1))-$i ;?></option>
                      <?php  
                      }else{
                        
                      ?>

                    <option <?php if ($_POST['Year'] == ((date("Y")+543))-$i){?> selected="selected" <?php } ?> value="<?PHP echo ((date("Y")+543))-$i; ?>"><?PHP echo ((date("Y")+543))-$i ;?></option>
                    <?PHP } }?>
                  </select>
            </div>
        </div>
        
        <!-- เขตสุขภาพ -->
        <div class="col-md-2">
            <div class="form-group">
                <label>เขตสุขภาพ</label>
                <select class="form-control select2" name="CODE_HMOO" id="CODE_HMOO" style="width: 100%;" onChange="myFunction3()">
                    <option <?php if (isset($_POST['CODE_HMOO']) && $_POST['CODE_HMOO'] == 'ทั้งหมด' || !isset($_POST['CODE_HMOO'])){?> selected="selected" <?php } ?> value="ทั้งหมด">ทั้งหมด</option>
                    <?php for ($i = 1; $i <= 13; $i++) { ?>
                    <option <?php if (isset($_POST['CODE_HMOO']) && $_POST['CODE_HMOO'] == $i){?> selected="selected" <?php } ?> 
                        value="<?php echo $i; ?>">เขตสุขภาพ <?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <!-- จังหวัด -->
        <div class="col-md-2">
            <div class="form-group">
                <label>จังหวัด</label>
                <select class="form-control select2" name="CODE_PROVINCE" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['CODE_PROVINCE']) && $_POST['CODE_PROVINCE'] == 'ทั้งหมด' || !isset($_POST['CODE_PROVINCE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- หน่วยงานใน/นอกสังกัด -->
        <div class="col-md-3">
            <div class="form-group">
                <label>หน่วยงานใน/นอกสังกัดกระทรวงสาธารณสุข</label>
                <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction5()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['type_Affiliation']) && $_POST['type_Affiliation'] == 'ทั้งหมด' || !isset($_POST['type_Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- สังกัด -->
        <div class="col-md-2">
            <div class="form-group">
                <label>สังกัด</label>
                <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction15()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['Affiliation']) && $_POST['Affiliation'] == 'ทั้งหมด' || !isset($_POST['Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- ประเภทหน่วยบริการ -->
        <div class="col-md-3">
            <div class="form-group">
                <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                <select class="form-control select2" name="TYPE_SERVICE" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction2()">
                    <option value="ทั้งหมด" <?php if (isset($_POST['TYPE_SERVICE']) && $_POST['TYPE_SERVICE'] == 'ทั้งหมด' || !isset($_POST['TYPE_SERVICE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>

        <!-- หน่วยบริการ -->
        <div class="col-md-4">
            <div class="form-group">
                <label>หน่วยบริการ/หน่วยงาน</label>
                <select class="form-control select2" name="CODE_HOS" id="CODE_HOS" style="width: 100%;">
                    <option value="ทั้งหมด" <?php if (isset($_POST['CODE_HOS']) && $_POST['CODE_HOS'] == 'ทั้งหมด' || !isset($_POST['CODE_HOS'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
        <button type="reset" class="btn btn-default" id="resetButton"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>
    </div>  
</form>

<script>
document.addEventListener("DOMContentLoaded", function () {

  

    myFunction3();
    myFunction4();
    myFunction5();
    myFunction15();
    myFunction2();
});



// Function for เขตสุขภาพ -> จังหวัด
function myFunction3() {
    const selectedValue = $('#CODE_HMOO').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_hmoo.php',
            data: { moo_id: selectedValue },
            success: function(data) {
                $('#CODE_PROVINCE').html(data);

                 // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                 const provinceValue = '<?php echo isset($_POST['CODE_PROVINCE']) ? $_POST['CODE_PROVINCE'] : ''; ?>';
                if (provinceValue) {
                    $('#CODE_PROVINCE').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for จังหวัด -> หน่วยงานใน/นอกสังกัด
function myFunction4() {
    const selectedValue = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_affiliationtype.php',
            data: { codeprovince: selectedValue },
            success: function(data) {
                $('#type_Affiliation').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['type_Affiliation']) ? $_POST['type_Affiliation'] : ''; ?>';
                if (provinceValue) {
                    $('#type_Affiliation').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for หน่วยงานใน/นอกสังกัด -> สังกัด
function myFunction5() {
    const selectedValue = $('#type_Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_affiliation2.php',
            data: { typeAffiliation: selectedValue, codeprovince: codeprovince },
            success: function(data) {
                $('#Affiliation').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['Affiliation']) ? $_POST['Affiliation'] : ''; ?>';
                if (provinceValue) {
                    $('#Affiliation').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for สังกัด -> ประเภทหน่วยบริการ
function myFunction15() {
    const selectedValue = $('#Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_servicetype.php',
            data: { Affiliation: selectedValue, codeprovince: codeprovince },
            success: function(data) {
                $('#TYPE_SERVICE').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['TYPE_SERVICE']) ? $_POST['TYPE_SERVICE'] : ''; ?>';
                if (provinceValue) {
                    $('#TYPE_SERVICE').val(provinceValue).trigger('change');
                }
            }
        });
    }
}

// Function for ประเภทหน่วยบริการ -> หน่วยบริการ
function myFunction2() {
    const selectedValue = $('#TYPE_SERVICE').val();
    const Affiliation = $('#Affiliation').val();
    const codeprovince = $('#CODE_PROVINCE').val();
    const HostHMOO = $('#CODE_HMOO').val();
    if (selectedValue) {
        $.ajax({
            url: 'get_service.php',
            data: { service_id: selectedValue, codeprovince: codeprovince, Affiliation: Affiliation, CODE_HMOO: HostHMOO },
            success: function(data) {
                $('#CODE_HOS').html(data);

                // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                const provinceValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                if (provinceValue) {
                    $('#CODE_HOS').val(provinceValue).trigger('change');
                }
            }
        });
    }
}


</script>
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
        <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #ECC8D9; color: black;">
				  <div class="inner">
                    
                    <p>บริการบำบัดผู้ป่วยยาเสพติด</p>
					<h3><?php echo $q1total_1;?> แห่ง</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->

				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #F0EEC8; color: black;">
				  <div class="inner">
                    
                    <p>บริการTelepsychiatry</p>
					<h3><?php echo $q2total_1;?> แห่ง</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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

		
      
        
        
		<div class="col-md-6">
		  <div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9FFDA; color: black;">
                <div class="inner">
                    
                    <p>บริการจิตเวชเด็ก</p>
					<h3><?php echo $q3total_1;?> แห่ง</h3>
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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
				<div class="small-box" style="background-color: #C9ECFF; color: black;">
                <div class="inner">
                    
                    <p>ยาสมาธิสั้น</p>
					<h3><?php echo $q4total_1;?> แห่ง</h3>
                    <!--<p> <small>&nbsp;</small></p>-->
                    <!--<p>xx : 1แสน ประชากร</p>-->
					
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
			 
			</div>
			<!-- ./row -->	
			</div>
		</div>
	  </div>
      <!-- /.card -->
		
	  <!-- Default box -->
      <div class="row">
		
	  <div class="col-md-12">
			<div class="card">
				<!--<div class="card-header">
					<h3 class="card-title">ผู้ป่วยในจิตเวช</h3>
				</div>-->
				<div class="col-md-3" >
                <div class="form-group">
                  <!--<label> ประเภทบุคลากร</label>-->
				  <br>
                  <select name="position2" class="form-control select2" id="position2" style="width: 100%;">
                    <option selected="selected" value="บริการบำบัดผู้ป่วยยาเสพติด" >บริการบำบัดผู้ป่วยยาเสพติด</option>
					<option value="บริการTelepsychiatry" >บริการTelepsychiatry</option>
					<option value="บริการจิตเวชเด็ก" >บริการจิตเวชเด็ก</option>
					<option value="ยาสมาธิสั้น" >ยาสมาธิสั้น</option>
                  </select>
                </div>
              </div>

              
				

        <div id="map01" >
          <div class="card-body">
            <div id="container" style="height:500%;"></div>
            
          </div>
        </div>

        <div id="map02" class="disabled">
          <div class="card-body">
            <div id="container2" style="height:500%;"></div>
            
          </div>
        </div>

        <div id="map03" class="disabled">
          <div class="card-body">
            <div id="container3" style="height:500%;"></div>
            
          </div>
        </div>

        <div id="map04" class="disabled">
          <div class="card-body">
            <div id="container4" style="height:500%;"></div>
            
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
        const div3 = document.getElementById('map03');
        const div4 = document.getElementById('map04');
	
				dropdown.addEventListener('change', function() {
            //alert(dropdown.value);
            if (dropdown.value === 'บริการบำบัดผู้ป่วยยาเสพติด') {
                div1.classList.remove('disabled');
                div2.classList.add('disabled');
                div3.classList.add('disabled');
                div4.classList.add('disabled');
            }else if (dropdown.value === 'บริการTelepsychiatry') {
                div1.classList.add('disabled');
                div2.classList.remove('disabled');
                div3.classList.add('disabled');
                div4.classList.add('disabled');
            }else if (dropdown.value === 'บริการจิตเวชเด็ก') {
                div1.classList.add('disabled');
                div2.classList.add('disabled');
                div3.classList.remove('disabled');
                div4.classList.add('disabled');
            }else if (dropdown.value === 'ยาสมาธิสั้น') {
                div1.classList.add('disabled');
                div2.classList.add('disabled');
                div3.classList.add('disabled');
                div4.classList.remove('disabled');
            }
           // const div = document.getElementById('myMctt3');
					 // div.classList.add('disabled');
					 // document.getElementById("other_r1").disabled = false;
				});

			</script>


			</div>
            

		</div>
	  
	</div>

	<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="12%">ระดับโรงพยาบาล</th>
					  <th width="12%">จังหวัด</th>
					 <!-- <th width="12%">รายละเอียด</th>-->
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
						<td width="12%"><?php echo $rowall['TYPE_SERVICE'];?></td>
            <td width="12%"><?php echo $rowall['CODE_PROVINCE'];?></td>
            <!--<td width="12%">รายละเอียด</td>-->
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
					  <th width="12%">ระดับโรงพยาบาล</th>
            <th width="12%">จังหวัด</th>
					  <th width="12%">บริการบำบัดผู้ป่วยยาเสพติด</th>
            <th width="12%">บริการTelepsychiatry</th>
            <th width="12%">บริการจิตเวชเด็ก</th>
            <th width="12%">ยาสมาธิสั้น</th>
					  <!--<th width="12%">รายละเอียด</th>-->
				   </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$j = 0;

						while($rowall1 = mysqli_fetch_array($objall1)){
							$j++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $j;?></td>
						<td width="12%"><?php echo $rowall1['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowall1['TYPE_SERVICE'];?></td>
            <td width="12%"><?php echo $rowall1['CODE_PROVINCE'];?></td>
            <td width="12%"><?php echo $rowall1['q1'];?></td>
            <td width="12%"><?php echo $rowall1['q2'];?></td>
            <td width="12%"><?php echo $rowall1['q3'];?></td>
            <td width="12%"><?php echo $rowall1['q4'];?></td>
           <!-- <td width="12%">รายละเอียด</td>-->
				   </tr>
				   <?php 
						}
				   ?>
					</tbody>
				  </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

    

	 
    </div>
       
		
   
  <!-- /.content-wrapper -->
	
<script>
	
(async () => {

    const topology = await fetch(
        'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
    ).then(response => response.json());

    // Prepare demo data. The data is joined to map using value of 'hc-key'
    // property by default. See API docs for 'joinBy' for more info on linking
    // data and map.
    const data = [
       <?php echo $datamap1; ?>
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
                    from: 100,
                    color: '#056934',
                    name: '100%'
                },{
                    to: 100,
                    color: '#fbe036',
                    name: '< 100%'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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
const data = [
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
                    from: 100,
                    color: '#056934',
                    name: '100%'
                },{
                    to: 100,
                    color: '#fbe036',
                    name: '< 100%'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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
const data = [
   <?php echo $datamap3; ?>
];

// Create the chart
Highcharts.mapChart('container3', {
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
                    from: 100,
                    color: '#056934',
                    name: '100%'
                },{
                    to: 100,
                    color: '#fbe036',
                    name: '< 100%'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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
const data = [
   <?php echo $datamap4; ?>
];

// Create the chart
Highcharts.mapChart('container4', {
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
                    from: 100,
                    color: '#056934',
                    name: '100%'
                },{
                    to: 100,
                    color: '#fbe036',
                    name: '< 100%'
                }, {
                    to: 0,
                    color: '#e3e3e2',
                    name: 'ไม่มี'
                }]
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

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard06.php'; 
        });

      
</script>

</body>
</html>
