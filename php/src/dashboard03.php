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

$sql9 = "SELECT  
			SUM(b.Ward_no) AS Ward_no  , 
			SUM(b.Unit) AS Unit ,
			SUM(b.Unit_no) AS Unit_no
		FROM bed b  
    JOIN hospitalnew hn on hn.CODE5 = b.hospitalCode5 
    where 1 ";
 
 if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $sql9 = $sql9."AND b.Wardall = '".$position."'" ;
    } 
  }


if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sql9 = $sql9."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sql9 = $sql9."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $sql9 = $sql9."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sql1 = $sql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sql1 = $sql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

//echo $sql9;
$obj9 = mysqli_query($con, $sql9);
$row9 = mysqli_fetch_array($obj9);

$Ward_no = $row9['Ward_no'];
$Unit = $row9['Unit'];
$Unit_no = $row9['Unit_no'];

$sqlbed = "SELECT
  hn.CODE_HMOO,
  SUM(CASE WHEN b.Wardall = 'Psychiatric Ward' THEN 1 ELSE 0 END) AS Psychiatric_Ward_Count,
  SUM(CASE WHEN b.Wardall = 'Psychiatric Unit' THEN 1 ELSE 0 END) AS Psychiatric_Unit_Count,
  SUM(CASE WHEN b.Wardall = 'Integrated Bed' THEN 1 ELSE 0 END) AS Integrated_Bed_Count
FROM
  hospitalnew hn
LEFT JOIN bed b ON hn.CODE5 = b.hospitalCode5  -- Assuming CODE5 is the linking column

where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $sqlbed = $sqlbed."AND b.Wardall = '".$position."'" ;
    } 
  }

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $sqlbed = $sqlbed."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $sqlbed = $sqlbed."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $sqlbed = $sqlbed."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$sqlbed = $sqlbed."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$sqlbed = $sqlbed."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }


$sqlbed = $sqlbed."
GROUP BY
  hn.CODE_HMOO
ORDER BY
  hn.CODE_HMOO ASC;";
$objbed = mysqli_query($con, $sqlbed);
//$rowbed = mysqli_fetch_array($objbed);

$hmoo = '';
$b01 = '';
$b02 = '';
$b03 = '';


while($rowbed = mysqli_fetch_array($objbed))
{
	$hmoo = $hmoo."'เขตสุขภาพที่ ".$rowbed['CODE_HMOO']."',";
	$b01 = $b01."'".$rowbed['Psychiatric_Ward_Count']."',";
	$b02 = $b02."'".$rowbed['Psychiatric_Unit_Count']."',";
	$b03 = $b03."'".$rowbed['Integrated_Bed_Count']."',";
	
}


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
  count(b.Wardall) AS total_beds
FROM
  hospitalnew hn
left JOIN bed b ON hn.CODE5 = b.hospitalCode5
left JOIN mapdetail m ON hn.CODE_PROVINCE = m.CODE_PROVINCE
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $msql1 = $msql1."AND b.Wardall = '".$position."'" ;
    } 
  }

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $msql1 = $msql1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $msql1 = $msql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $msql1 = $msql1."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
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

$msql1 = $msql1."
GROUP BY
   m.CODE_map02,m.CODE_PROVINCETH 

";

$mobj1 = mysqli_query($con, $msql1);

$datamap ='';
while($mrow1 = mysqli_fetch_array($mobj1))
{
	if($mrow1['total_beds'] <> 0){
		//$datamap = $datamap."['".$mrow1['CODE_map02']."',".$mrow1['total_beds']."],";
    $datamap = $datamap."{'hc-key':'".$mrow1['CODE_map02']."',value:".$mrow1['total_beds'].",name:'".$mrow1['CODE_PROVINCETH']."'},";
	}
	//['th-ct', 10],
}


$bsql1 = "SELECT
  hn.CODE_HMOO,
  COUNT(DISTINCT b.Wardall) AS total_beds, 
  SUM(b.Ward_no) AS total_ward_no,
  SUM(b.Unit) AS total_unit,
  SUM(b.Unit_no) AS total_unit_no
FROM
  bed b
right JOIN hospitalnew hn ON hn.CODE5 = b.hospitalCode5
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsql1 = $bsql1."AND b.Wardall = '".$position."'" ;
    } 
  }

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsql1 = $bsql1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsql1 = $bsql1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $bsql1 = $bsql1."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsql1 = $bsql1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsql1 = $bsql1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$bsql1 = $bsql1."
GROUP BY
  hn.CODE_HMOO;";

$objb01 = mysqli_query($con, $bsql1);
//$rowb01 = mysqli_fetch_array($objb01);

$hmoo2 = '';
$b201 = '';
$b202 = '';
$b203 = '';
$b204 = '';

while($rowb01 = mysqli_fetch_array($objb01))
{
	$hmoo2 = $hmoo."'เขตสุขภาพที่ ".$rowb01['CODE_HMOO']."',";
	$b201 = $b201."'".$rowb01['total_beds']."',";
	$b202 = $b202."'".$rowb01['total_ward_no']."',";
	$b203 = $b203."'".$rowb01['total_unit']."',";
	$b204 = $b204."'".$rowb01['total_unit']."',";
}


$bsqlall1 = "SELECT
  hn.HOS_NAME ,
  b.Wardall,
  b.Ward_no,
  b.Unit,
  b.Unit_no 
FROM
  hospitalnew hn
JOIN bed b ON hn.CODE5 = b.hospitalCode5
where 1 ";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsqlall1 = $bsqlall1."AND b.Wardall = '".$position."'" ;
    } 
  }

if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsqlall1 = $bsqlall1."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsqlall1 = $bsqlall1."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $bsqlall1 = $bsqlall1."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsqlall1 = $bsqlall1."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsqlall1 = $bsqlall1."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$objb01all = mysqli_query($con, $bsqlall1);
//$rowb01all = mysqli_fetch_array($objb01all);

$bsqlall2 = "SELECT
  hn.HOS_NAME ,
  b.TN2,
  b.MM1 ,
  b.MM2 ,
  b.MM3 
FROM
  hospitalnew hn
JOIN bed b ON hn.CODE5 = b.hospitalCode5 
WHERE b.EY = 'ไม่มี'";

if (isset($_POST['position'])) {
  if ($_POST['position']<> 'ทั้งหมด') {
      $position = $_POST['position'];
      $bsqlall2 = $bsqlall2."AND b.Wardall = '".$position."'" ;
    } 
  }


if (isset($_POST['Year'])) {
  $Year = $_POST['Year']-543;
  $bsqlall2 = $bsqlall2."AND YEAR(b.bedDate) = '".$Year."'" ;
} 

if (isset($_POST['CODE_HMOO'])) {
  if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
    $CODE_HMOO = $_POST['CODE_HMOO'];
    $bsqlall2 = $bsqlall2."AND hn.CODE_HMOO = '".$CODE_HMOO."'" ;
  }
}

if (isset($_POST['mySelect'])) {
  if ($_POST['mySelect']<> 'ทั้งหมด') {
    $mySelect = $_POST['mySelect'];
    $bsqlall2 = $bsqlall2."AND hn.TYPE_SERVICE = '".$mySelect."'" ;
  }
}

if (isset($_POST['CODE_PROVINCE'])) {
	if ($_POST['CODE_PROVINCE']<> 'ทั้งหมด') {
	$CODE_PROVINCE = $_POST['CODE_PROVINCE'];
	$bsqlall2 = $bsqlall2."AND hn.NO_PROVINCE = '".$CODE_PROVINCE."'" ;
	}
  }
  
  if (isset($_POST['CODE_HOS'])) {
	if ($_POST['CODE_HOS']<> 'ทั้งหมด') {
	$CODE_HOS = $_POST['CODE_HOS'];
	$bsqlall2 = $bsqlall2."AND hn.CODE5 = '".$CODE_HOS."'" ;
	}
  }

$objb02all = mysqli_query($con, $bsqlall2);
//$rowb02all = mysqli_fetch_array($objb02all);






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
            <h3>เตียงจิตเวช</h3>
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
			<form class="form-valide" action="dashboard03.php" method="post" id="myform1" name="foml">  
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
                    <option value="<?PHP echo ((date("Y")+543))-$i?>"><?PHP echo ((date("Y")+543))-$i?></option>
                    <?PHP }?>
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
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;" onChange="myFunction3()">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="1">เขต1</option>
                    <option value="2">เขต2</option>
                    <option value="3">เขต3</option>
					          <option value="4">เขต4</option>
                    <option value="5">เขต5</option>
                    <option value="6">เขต6</option>
					          <option value="7">เขต7</option>
                    <option value="8">เขต8</option>
                    <option value="9">เขต9</option>
					          <option value="10">เขต10</option>
                    <option value="11">เขต11</option>
                    <option value="12">เขต12</option>
					          <option value="13">เขต13</option>
                   </select>
                </div>
                <script>
                   function myFunction3() {
                      const selectedValue = $('#area').val();
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
				<!-- /.form-group -->
                <div class="form-group" id="labelservice" hidden="none">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" hidden="none" onChange="myFunction2()">
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
                <script>
                   function myFunction2() {
                      const selectedValue = $('#service').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue },
                            success: function(data) {
                              $('#CODE_PROVINCE').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>

                <script>
                   function myFunction4() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hos.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { CODE_PROVINCE: selectedValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	


              <div class="col-md-2">
               <div class="form-group">
                  <label>โรงพยาบาล</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["CODE5"];?>" ><?PHP echo $rowprovince["HOS_NAME"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->			
 
			  <div class="col-md-2">
               <div class="form-group">
                  <label> เตียงจิตเวช</label>
                  <select name="position" class="form-control select2" id="position" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<option value="Psychiatric Ward" >Psychiatric Ward</option>
					<option value="Psychiatric Unit/ Co-Ward" >Psychiatric Unit</option>
					<option value="Integrated Bed" >Integrated Bed</option>
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

	  <div class="row">
          <div	div class="col-md-6">
            
          	</div>
          	<!-- /.col -->
		  	<div class="col-md-6">
            
		  	</div>
			<!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

    
	

	  <!-- Default box -->
      <div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">ชนิดเตียงจิตเวช</h3>
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
								labels: [<?php echo $hmoo;?>],
								datasets: [{
									label: 'Psychiatric Ward',
									data: [<?php echo $b01;?>],
									backgroundColor: '#6ce5e8',
									borderColor: '#6ce5e8',
									borderWidth: 1,
									stack: 'combined' // Enable stacking for this dataset
								},
								{
									label: 'Psychiatric Unit',
									data: [<?php echo $b02;?>],
									backgroundColor: '#41b8d5',
									borderColor: '#41b8d5',
									borderWidth: 1,
									stack: 'combined' // Enable stacking for this dataset
								},
								{
									label: 'Integrated Bed',
									data: [<?php echo $b03;?>],
									backgroundColor: '#2d8bba',
									borderColor: '#2d8bba',
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
					<h3 class="card-title">จำนวนเตียงจิตเวช</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button2" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart5" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx5 = document.getElementById('myChart5');
        
        
        const downloadButton2 = document.getElementById('download-button2');

        const myChart5 = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: [<?php echo $hmoo2; ?>],
                datasets: [{
                    label: 'จำนวนเตียง (ผู้หญิง)',
                    data: [<?php echo $b203; ?>],
                    backgroundColor: '#9ce7fa',
                    borderColor: '#9ce7fa',
                    borderWidth: 1,
                    stack: 'combined' // Enable stacking for this dataset
                },
                {
                    label: 'จำนวนเตียง (ผู้ชาย)',
                    data: [<?php echo $b204; ?>],
                    backgroundColor: '#ffb9c2',
                    borderColor: '#ffb9c2',
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

downloadButton2.addEventListener('click', function() {
    const chartData = myChart5.toBase64Image(); // Get chart image data
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
					<h3 class="card-title">อัตราการครองเตียง</h3>
					<div align="right">
						<button class="btn btn-navbar" id="download-button4" align="right" ><img width="10%" src="images/downloand.png"></button>
					</div>
				</div>
				<div class="card-body">
					<a href="#"><canvas id="myChart4" style="min-height: 100%; height: 500px; max-height: 380px; max-width: 100%;"></canvas></a>
					<script>
        const ctx4 = document.getElementById('myChart4');
        
        
        const downloadButton4 = document.getElementById('download-button4');

        const myChart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['เขตสุขภาพที่ 1', 'เขตสุขภาพที่ 2', 'เขตสุขภาพที่ 3', 'เขตสุขภาพที่ 4', 'เขตสุขภาพที่ 5', 'เขตสุขภาพที่ 6', 'เขตสุขภาพที่ 7', 'เขตสุขภาพที่ 8', 'เขตสุขภาพที่ 9', 'เขตสุขภาพที่ 10', 'เขตสุขภาพที่ 11', 'เขตสุขภาพที่ 12', 'เขตสุขภาพที่ 13'],
                datasets: [{
                    label: 'อัตราการครองเตียง',
                    data: [],
                    backgroundColor: '#6ce5e8',
                    borderColor: '#6ce5e8',
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

downloadButton4.addEventListener('click', function() {
    const chartData = myChart5.toBase64Image(); // Get chart image data
    const link = document.createElement('a');
    link.href = chartData;
    link.download = 'stacked-barchart.png'; // Set download filename
    link.click();
});
    </script>
					
				</div>
				

			</div>


		  
		
		</div>
		<div class="col-md-6">


		<div class="row">
			<div class="col-lg-6">
				<!-- small card -->
				<div class="small-box" style="background-color: #C9ECFF; color: black;">
                <div class="inner">
                    
				<p>จำนวน เตียง</p> 
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php echo number_format($Ward_no, 0, '.', ',');?> เตียง</h3>
                    <p><?php echo number_format((($Ward_no / $Total)*100000), 2, '.', ',');?> : 1แสน ประชากร</p>
					
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
                    
                    
				<p>อัตราการครองเตียง</p>
					<h3><i class="fas fa-bed" style="color:#FFFFFF;">&nbsp;</i><?php //echo number_format((($Ward_no / $Total)*100000), 0, '.', ',');?> 0 %</h3>
                    <p> <small>&nbsp;</small></p>
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

			  <div class="col-lg-12">
			  <div class="card">
				<div class="card-header">
					<h3 class="card-title">ชนิดเตียงจิตเวช</h3>
				</div>
				<div class="card-body">
					<div id="container"></div>
					
				</div>

			</div>
			  </div>
			  <!-- ./col -->

			  <div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">อัตราการครองเตียง</h3>
				</div>
				<div class="card-body">
					<div id="container2"></div>
					
				</div>

			</div>
            

		</div>
			   
			 
			</div>

			<!-- ./row -->	
			 
			</div>
	  </div>
      <!-- /.card -->	
      <?php /* ?>
	  <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th rowspan="2" width="2%">#</th>
					  <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
					  <th rowspan="2" width="15%">ชนิดเตียง</th>
					  <th colspan="2" width="6%">จำนวนเตียง</th>
					  <th rowspan="2" width="15%">อัตราการครองเตียง</th>
				   </tr>
				   <tr align="center">
					  <th width="6%">ผู้หญิง</th>
					  <th width="6%">ผู้ชาย</th>
				   </tr>
                   </thead>
                  <tbody>
				  <tr align="center">
						<td width="6%">วิชาชีพเฉพาะ</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">วิชาชีพเฉพาะ</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">ปฏิบัติงาน</td>
						<td width="6%">ปฏิบัติงาน</td>
				   </tr>
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
<?php */ ?>
	  <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">เตียงจิตเวช</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
                    <th rowspan="2" width="2%">#</th>
                    <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                    <th rowspan="2" width="15%">ชนิดเตียง</th>
                    <th colspan="2" width="6%">จำนวนเตียง</th>
                    <th rowspan="2" width="15%">อัตราการครองเตียง</th>
                  </tr>
                  <tr align="center">
                      <th width="6%">ผู้หญิง</th>
                      <th width="6%">ผู้ชาย</th>
                  </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$i = 0;

						while($rowb01all = mysqli_fetch_array($objb01all)){
							$i++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowb01all['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb01all['Wardall'];?></td>
           <?php /* ?> <td width="12%"><?php echo $rowb01all['Ward_no'];?></td>  <?php */ ?>
            <td width="12%"><?php echo $rowb01all['Unit'];?></td>
            <td width="12%"><?php echo $rowb01all['Unit_no'];?></td>
            <td width="12%"></td>
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

	  <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">มินิธัญญารักษ์</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <th rowspan="2" width="2%">#</th>
                      <th rowspan="2" width="12%">โรงพยาบาล/หน่วยงาน</th>
                      <th rowspan="2" width="12%">มินิธัญญารักษ์ ชนิดเตียง</th>
                      <th colspan="2" width="12%">จำนวนเตียง</th>
                      <th rowspan="2" width="12%">อัตราการครองเตียง</th>
                    </tr>
                    <tr align="center">
                        <th width="6%">ผู้หญิง</th>
                        <th width="6%">ผู้ชาย</th>
                    </tr>
                   </thead>
                  <tbody>
                  <?php
				  		$i = 0;

						while($rowb02all = mysqli_fetch_array($objb02all)){
							$i++;
				  ?>
          <tr align="center">
						<td width="2%"><?php echo $i;?></td>
						<td width="12%"><?php echo $rowb02all['HOS_NAME'];?></td>
						<td width="12%"><?php echo $rowb02all['TN2'];?></td>
            <?php /* ?><td width="12%"><?php echo $rowb02all['MM1'];?></td><?php */ ?>
            <td width="12%"><?php echo $rowb02all['MM2'];?></td>
            <td width="12%"><?php echo $rowb02all['MM3'];?></td>
            <td width="12%"></td>
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
			   */ 
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
	   <script>
		   
	   (async () => {
	   
		   const topology = await fetch(
			   'https://code.highcharts.com/mapdata/countries/th/th-all.topo.json'
		   ).then(response => response.json());
	   
		   // Prepare demo data. The data is joined to map using value of 'hc-key'
		   // property by default. See API docs for 'joinBy' for more info on linking
		   // data and map.
		   const data = [
			  
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


<script>
   $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	$("#example2").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
	$("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example4').DataTable({
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

</body>
</html>
