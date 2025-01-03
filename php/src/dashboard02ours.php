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



$sql2 = "WITH trained_personnel AS (
	SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries1,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries2,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries3,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries4,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries5,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries6,
		   SUBSTRING_INDEX(b.training, ',', 1) AS Countries7
	FROM personnel b
	JOIN hospitalnew e ON e.CODE5 = b.HospitalID
	WHERE b.positiontypeID = '2' AND b.setdel = '1'
  )
  SELECT DISTINCT
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries1 = 'ยังไม่ผ่านการอบรมเฉพาะทาง'
	) AS 'nu01',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries2 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'
	) AS 'nu02',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries3 = 'การพยาบาลเฉพาะสุขภาพจิตและจิตเวชผู้สูงอายุ'
	) AS 'nu03',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries4 = 'การพยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น'
	) AS 'nu04',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries5 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด'
	) AS 'nu05',
	 (
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries6 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน'
	) AS 'nu06',
	 (
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries7 = 'อื่น ๆ'
	) AS 'nu07'
  FROM hospitalnew hosn;
  
		  ";
  $obj2 = mysqli_query($con, $sql2);
  $row2 = mysqli_fetch_array($obj2);
  
  $nu01 =  $row2['nu01'];
  $nu02 =  $row2['nu02'];
  $nu03 =  $row2['nu03'];
  $nu04 =  $row2['nu04'];
  $nu05 =  $row2['nu05'];
  $nu06 =  $row2['nu06'];
  $nu07 =  $row2['nu07'];
  
  
  $tsql2 = "WITH trained_personnel AS (
	SELECT b.HospitalID, e.CODE_HMOO, e.CODE_PROVINCE, b.personnelID,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries1,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries2,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries3,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries4,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries5,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries6,
		   SUBSTRING_INDEX(b.statuscong, ',', 1) AS Countries7
	FROM personnel b
	JOIN hospitalnew e ON e.CODE5 = b.HospitalID
	WHERE b.positiontypeID = '2' AND b.setdel = '1'
  )
  SELECT DISTINCT
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries1 = 'ไม่ได้กำลังศึกษา'
	) AS 'tnu01',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries2 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้ใหญ่)'
	) AS 'tnu02',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries3 = 'การพยาบาลเฉพาะทางจิตเวชสุขภาพจิตและจิตเวช (จิตเวชผู้สูงอายุ)'
	) AS 'tnu03',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries4 = 'การพยาบาลเฉพาะทางสุขภาพจิตและจิตเวชเด็กและวัยรุ่น'
	) AS 'tnu04',
	(
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries5 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด'
	) AS 'tnu05',
	 (
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries6 = 'การพยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด ระยะสั้น 10 วัน'
	) AS 'tnu06',
	 (
	  SELECT COUNT(*)
	  FROM trained_personnel tp
	  WHERE tp.Countries7 = 'อื่น ๆ'
	) AS 'tnu07'
  FROM hospitalnew hosn;
  
	
			";
	$tobj2 = mysqli_query($con, $tsql2);
	$trow2 = mysqli_fetch_array($tobj2);
	
	$tnu01 =  $trow2['tnu01'];
	$tnu02 =  $trow2['tnu02'];
	$tnu03 =  $trow2['tnu03'];
	$tnu04 =  $trow2['tnu04'];
	$tnu05 =  $trow2['tnu05'];
	$tnu06 =  $trow2['tnu06'];
	$tnu07 =  $trow2['tnu07'];

	$sqlmid = "SELECT
    CODE_PROVINCE,
    YEAR,
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

$msql1 = "SELECT
  m.CODE_map02,
  m.CODE_PROVINCETH,
  SUM(h.a_total) AS total_a,
  SUM(h.b_total) AS total_b,
   m2.CODE_TOTAl
FROM
  HDCTBBED h
JOIN hospitalnew hn ON h.hospcode = hn.CODE5
JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
JOIN Midyear m2 ON hn.CODE_PROVINCE = m2.CODE_PROVINCE 

WHERE
  h.b_year = '2567'  -- Add a filter for the year
GROUP BY
   m.CODE_map02, m.CODE_PROVINCETH;

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_a'] <> 0){
		$datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".number_format(($mrow1['total_a']/$mrow1['CODE_TOTAl']*100000), 2, '.', ',').",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}

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
			<form class="form-valide" action="tables_4.php" method="post" id="myform1" name="foml">  
      <div class="row">
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
	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ours</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart3" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
		
					<script>
        const ctx = document.getElementById('myChart3');
        
        
        const downloadButton = document.getElementById('download-button');

        const myChart3 = new Chart(ctx, {
            type: 'bar',
            data: {
        labels: ['พยาบาลเฉพาะทางสุขภาพจิตและจิตเวช', 'พยาบาลเฉพาะทางจิตเวชเด็กและวัยรุ่น', 'พยาบาลเฉพาะทางผู้ใช้ยาและสารเสพติด', 'พยาบาลเฉพาะทางผู้สูงอายุ'],
        datasets: [{
            label: 'ปฏิบัติงาน',
            data: [<?php echo $nu02.','.$nu03.','.$nu04.','.$nu05.','.$nu06.','.$nu07;?>],
            backgroundColor: '#6CE5E8',
            borderColor: '#6CE5E8',
            borderWidth: 1,
            stack: 'combined' // Enable stacking for this dataset
        },
        {
            label: 'กำลังศึกษาต่อเฉพาะทาง',
            data: [<?php echo $tnu02.','.$tnu03.','.$tnu04.','.$tnu05.','.$tnu06.','.$tnu07;?>],
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
					  <th width="15%">มีกลุ่มงานสุขภาพจิตและยาเสพติด</th>
				   </tr>
                   </thead>
                  <tbody>
				  <tr align="center">
						<td width="2%">#</td>
						<td width="12%">โรงพยาบาล/หน่วยงาน</td>
						<td width="15%">มีกลุ่มงานสุขภาพจิตและยาเสพติด</td>
				   </tr>
					</tbody>
				  </table>
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
				<h3><?php echo $nu02;?> คน</h3>
				<p><?php echo (($nu02 / $Total)*100000);?>  : 1แสน ประชากร</p>
					
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
					<h3><?php echo $nu04;?> คน</h3>
				<p><?php echo (($nu04 / $Total)*100000);?>  : 1แสน ประชากร</p>
					
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
				<div class="col-md-2" >
                <div class="form-group">
                  <!--<label> ประเภทบุคลากร</label>-->
				  <br>
                  <select name="position2" class="form-control select2" id="position2" style="width: 100%;">
                    <option selected="selected" value="จิตแพทย์ผู้ใหญ่" >จิตแพทย์ผู้ใหญ่</option>
					<option value="จิตแพทย์เด็กและวัยรุ่น" >จิตแพทย์เด็กและวัยรุ่น</option>
                  </select>
                </div>
              </div>
				<div class="card-body">
					<div id="container"></div>
					
				</div>

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
			<?php echo $datamap ;?>
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
      "buttons": ["copy", "csv", "excel", "pdf"]
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
  });
</script>

<script>
        // JavaScript สำหรับปุ่มรีเซ็ต
        document.getElementById('resetButton').addEventListener('click', function() {
            // รีเซ็ตฟิลด์ในฟอร์ม
            //document.getElementById('myForm').reset();

           // window.location.reload();
           window.location.href = 'dashboard02ours.php'; 
        });

      
</script>

</body>
</html>
