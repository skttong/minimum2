<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];


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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">

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
        <div class="col-sm-9">
            <!--<h4>แบบฟอร์มบันทึกข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h4>-->
			<?php
		if($_SESSION["TypeUser"] == "Admin"){
			//echo 'แอดมินส่วนกลาง';
		}else{
			$sql_u 		= "SELECT * FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
			$query_u 	= mysqli_query($con, $sql_u);
			$result_u 	= mysqli_fetch_array($query_u);
		  $HOS_NAME = $result_u['HOS_NAME']; 
      $TypeService = $_SESSION["TypeService"];
      $CODE_DISTRICT = $result_u['CODE_DISTRICT'];
			  $NO_PROVINCE = $result_u['NO_PROVINCE'];
		}
		?>
         <?php /* <h2 class="card-title">แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2> */ ?>
		 <?php if($TypeService <> ''){?>
			<h4>ข้อมูลเตียง  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลเตียง   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-2.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">เตียงจิตเวช</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card-body">
      <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
      <form class="form-valide" action="tables-bedall.php" method="post" id="myform1" name="foml">  
      <div class="row">
      <?php /*         
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
  */ ?>      
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
            }
        });
    }
}


</script>
      <?php }else{ ?>
			<form class="form-valide" action="tables-bedall.php" method="post" id="myform1" name="foml">  
            <div class="row">
            <?php /* ?>
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
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="เขต 01">เขต1</option>
                    <option value="เขต 02">เขต2</option>
                    <option value="เขต 03">เขต3</option>
					<option value="เขต 04">เขต4</option>
                    <option value="เขต 05">เขต5</option>
                    <option value="เขต 06">เขต6</option>
					<option value="เขต 07">เขต7</option>
                    <option value="เขต 08">เขต8</option>
                    <option value="เขต 09">เขต9</option>
					<option value="เขต 10">เขต10</option>
                    <option value="เขต 11">เขต11</option>
                    <option value="เขต 12">เขต12</option>
					<option value="เขต 13">เขต13</option>
                   </select>
                </div>
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
			   <?php */ ?>

<?php 

if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){

if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
?>  
			  <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction2()">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT DISTINCT *
					FROM userhospital 
					INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
					WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
					AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
					AND hospitalnew.CODE_HMOO = '$HosMOHP'
					GROUP BY hospitalnew.CODE_PROVINCE";
				
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
				
              </div>
             
			  <!-- /.form-group -->
			  <div class="col-md-3">
               <div class="form-group">
                  <label>หน่วยงานใน/ นอกสังกัดกระทรวงสาธารณสุข</label>
                  <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction15()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?PHP 
                       if($_POST['type_Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['type_Affiliation']; ?> "><?php echo $_POST['type_Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

                
              </div>
              <!-- /.col -->
          <div class="col-md-2">
			  <div class="form-group" id="labelservice" >
              <label>สังกัด</label>
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
             <!-- /.form-group -->  
            
            </div>
            <!-- /.col -->
            <div class="col-md-3">
<div class="form-group" id="labelservice">
                  <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction101()">
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
                
     
           </div>
           <!-- /.col -->
           <?php  }} ?>

           <?php   if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
            <div class="col-md-3">
               <div class="form-group">
                  <label>หน่วยงานใน/ นอกสังกัดกระทรวงสาธารณสุข</label>
                  <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction151()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?php $sql10 = "SELECT type_Affiliation 
                                  FROM hospitalnew
                                  WHERE CODE_PROVINCE = '".$codeprovince."'
                                  GROUP BY hospitalnew.type_Affiliation 
                                  ORDER BY hospitalnew.type_Affiliation DESC;"; 

                                  $obj10 = mysqli_query($con, $sql10);
       
                                  while($row10 = mysqli_fetch_array($obj10))
                           
                                  {
                                  
                    ?>
                    <?PHP 
                      
                     ?>
                    <option value="<?php echo $row10['type_Affiliation']; ?> "><?php echo $row10['type_Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
   
                    <?PHP 
                       if($_POST['type_Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['type_Affiliation']; ?> "><?php echo $_POST['type_Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

               
              </div>
              <!-- /.col -->
              
  <div class="col-md-2">
              <div class="form-group" id="labelservice" >
              <label>สังกัด</label>
                  <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction51()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>

                    <?PHP 
                       if($_POST['Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['Affiliation']; ?> "><?php echo $_POST['Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
             </div>
             <!-- /.form-group -->  
             
            </div>
            <!-- /.col -->
            <div class="col-md-3">
<div class="form-group" id="labelservice">
                  <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction10()">
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
               
           </div>
           <!-- /.col -->
			  
			  <?php }?>

			  <div class="col-md-6">
               <div class="form-group">
                  <label>หน่วยบริการ/หน่วยงาน</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlhos = "SELECT *
					FROM userhospital 
					INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
					WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
					AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
					AND hospitalnew.CODE_HMOO = '$HosMOHP'";

if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){					  
  $sqlhos = $sqlhos."AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
  }

  
  if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){					  
  $sqlhos = $sqlhos."AND hospitalnew.CODE_DISTRICT LIKE  '%$CODE_DISTRICT' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลชุมชน' AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขอำเภอ' " ;
  }
				
					$objhos = mysqli_query($con, $sqlhos);
					
					while($rowhos = mysqli_fetch_array($objhos))

					{
	
					?>
					  <option value="<?PHP echo $rowhos["CODE5"];?>" ><?PHP echo $rowhos["HOS_NAME"];?></option>
					  
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
				   <button type="reset" class="btn btn-default" id="resetButton"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>

    <script>
document.addEventListener("DOMContentLoaded", function () {
    myFunction3();
    myFunction4();
    myFunction5();
    myFunction51();
    myFunction15();
    myFunction151();
    myFunction2();
	  myFunction10();
    myFunction101();
});

function myFunction2() {
  const selectedValue = $('#CODE_PROVINCE').val();
      // alert(selectedValue);
  if (selectedValue) {
      $.ajax({
        url: 'get_affiliationtype.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { codeprovince: selectedValue },
        success: function(data) {
          $('#type_Affiliation').html(data);
        }
      });
    }
}

function myFunction101() {
  const selectedValue = $('#TYPE_SERVICE').val();
   //const Affiliation 		= document.getElementById("Affiliation").value;
   const Affiliation = $('#Affiliation').val();
    //const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
    const codeprovince = $('#CODE_PROVINCE').val();
  const HosMOHP 		    = <?PHP echo $HosMOHP;?>;
      //alert(HosMOHP);
  if (selectedValue) {
      $.ajax({
        url: 'get_service3.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, HosMOHP: HosMOHP},
        success: function(data) {
          $('#CODE_HOS').html(data);
        }
      });
    }
}


function myFunction15() {
  const selectedValue = $('#type_Affiliation').val();
  const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
      //alert(codeprovince);
  if (selectedValue) {
      $.ajax({
        url: 'get_affiliation2.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { typeAffiliation: selectedValue , codeprovince: codeprovince  },
        success: function(data) {
          $('#Affiliation').html(data);
        }
      });
    }
}

function myFunction151() {
  const selectedValue = $('#type_Affiliation').val();
  const codeprovince 		= <?php echo $NO_PROVINCE;?>;
      //alert(selectedValue);
  if (selectedValue) {
      $.ajax({
        url: 'get_affiliation2.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { typeAffiliation: selectedValue , codeprovince: codeprovince  },
        success: function(data) {
          $('#Affiliation').html(data);
        }
      });
    }
}

function myFunction5() {
  const selectedValue = $('#Affiliation').val();
  //const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
  const codeprovince = $('#CODE_PROVINCE').val();
      // alert(selectedValue);
  if (selectedValue) {
      $.ajax({
        url: 'get_servicetype.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { Affiliation: selectedValue , codeprovince: codeprovince  },
        success: function(data) {
          $('#TYPE_SERVICE').html(data);
        }
      });
    }
}

function myFunction51() {
  const selectedValue = $('#Affiliation').val();
  const codeprovince 		= <?PHP echo $NO_PROVINCE;?>;
      //alert(selectedValue);
  if (selectedValue) {
      $.ajax({
        url: 'get_servicetype.php', // ไฟล์ PHP ที่จะประมวลผล
        data: { Affiliation: selectedValue , codeprovince: codeprovince  },
        success: function(data) {
          $('#TYPE_SERVICE').html(data);
        }
      });
    }
}


function myFunction10() {
    const selectedValue = $('#TYPE_SERVICE').val();
    //const Affiliation 		= document.getElementById("Affiliation").value;
    const Affiliation = $('#Affiliation').val();
    //const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
    //const codeprovince = $('#CODE_PROVINCE').val();
    const codeprovince 		= <?php echo $NO_PROVINCE;?>;
    const HosMOHP 		    = <?PHP echo $HosMOHP;?>;

        //alert(HosMOHP);
    if (selectedValue) {
        $.ajax({
          url: 'get_service3.php', // ไฟล์ PHP ที่จะประมวลผล
          data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, HosMOHP: HosMOHP},
          success: function(data) {
            $('#CODE_HOS').html(data);
          }
        });
      }
}

</script>

    <?php } ?>
        </div>
        <!-- /.card -->	 
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <!--<div class="card-header bg-olive color-palette">
                <h3 class="card-title">ข้อมูลเตียงจิตเวช</h3>
              </div>-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th rowspan="2">#</th>
                      <th rowspan="2">ชื่อโรงพยาบาล</th>
					  <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
            <th colspan="2"><center>จำนวนเตียงจิตเวช</center></th>
          
            <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
            <th colspan="2"><center>มินิธัญญารักษ์จำนวนเตียงจิตเวช</center></th>
         
					  <!--<th>จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด</th>	
					  <th>ผลรวมจำนวน วันนอนผู้ป่วยใน</th>
					  <th>อัตราการครองเตียง</th>	-->		
					  <th rowspan="2"><center>แก้ไขข้อมูล</center></th>
					 
					</tr>
          <tr>
            <th><center>เตียงผู้หญิง</center></th>	
					  <th><center>เตียงผู้ชาย</center></th>
        
            <th><center>เตียงผู้หญิง</center></th>	
					  <th><center>เตียงผู้ชาย</center></th>
           
					  <!--<th>จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด</th>	
					  <th>ผลรวมจำนวน วันนอนผู้ป่วยใน</th>
					  <th>อัตราการครองเตียง</th>	-->		
				
					</tr>
                   </thead>
                   <tbody>
					 <?php
           	if($_SESSION["TypeUser"] == "Admin"){ 
							$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME, hospitalnew.HOS_TYPE  FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE bed.setbeddel = '1' 
							 ";
						}else{
					 if($HosType == "กรมสุขภาพจิต"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							AND bed.setbeddel = '1'
							 ";
	
			  		}elseif($HosType == "ศูนย์วิชาการ"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							AND bed.setbeddel = '1'
							 ";
	
			  		}elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'  
							AND bed.setbeddel = '1'
							";
            }elseif($HosType == "สำนักงานสาธารณสุขอำเภอ"){ 
                        $sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
                      WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'  
                      AND bed.setbeddel = '1'
                       ";
	
			  		}else{
					
							 $sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE bed.hospitalCode5 = '$HospitalID' 
							AND bed.setbeddel = '1'
							 ";
						}
					 }

           if(isset($_POST["CODE_HOS"])){	
						if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
						}
					}

          if(isset($_POST["type_Affiliation"])){	
            if(trim($_POST["type_Affiliation"]) <>'ทั้งหมด'){					  
              $sqlpersonnel = $sqlpersonnel."AND hospitalnew.type_Affiliation LIKE ('".trim($_POST['type_Affiliation'])."%')" ;
            }
          }
          
					if(isset($_POST["TYPE_SERVICE"])){	
						if(trim($_POST["TYPE_SERVICE"]) <>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.HOS_TYPE LIKE ('".$_POST['TYPE_SERVICE']."%')" ;
						}
					}

					if(isset($_POST["CODE_PROVINCE"])){	
						if($_POST["CODE_PROVINCE"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.NO_PROVINCE LIKE ('".$_POST['CODE_PROVINCE']."')" ;
						}
					}

          $sqlpersonnel = $sqlpersonnel." ORDER BY bed.bedDate DESC;" ;

          $sqlpersonnel2 = $sqlpersonnel;
					$objpersonnel = mysqli_query($con, $sqlpersonnel);
					$i = 1;
					while($rowpersonnel = mysqli_fetch_array($objpersonnel))
					{
					?>
					<tr>
						<td><?php echo $i++; ?></td>
                        <td>
							<?php echo $rowpersonnel['HOS_NAME'];?>
						</td>
					
						<td><center><?php echo $rowpersonnel['Wardall'];?></center></td>
						<td><center><?php echo $rowpersonnel['Unit']; ?></center></td>
						<td><center><?php echo $rowpersonnel['Unit_no'];?></center></td>
            

            <td><center><?php echo $rowpersonnel['TN2'];?></center></td>
						<td><center><?php echo $rowpersonnel['MM2']; ?></center></td>
						<td><center><?php echo $rowpersonnel['MM3'];?></center></td>

          
						<?php /* <td><center><?php echo $rowpersonnel['Unit_no']; ?></center></td>
						<td><center><?php echo $rowpersonnel['Integrate'];?></center></td>
						<td><center><?php echo $rowpersonnel['Integrate_no']; ?></center></td>*/ ?>
           
            <td><center> <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a class="btn btn-info btn-sm " href="form_bededit.php?bedID=<?php echo $rowpersonnel['bedID'];?>">
              แก้ไขข้อมูล/ลบ
							</a><?php } ?>
              <!--<a href="personnel_del.php?bedID=<?php //$rowpersonnel['bedID'];?>&&t=0;&&detail=bed">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>-->
              </center>

              <?php if($_SESSION["TypeUser"] == "Admin"){
                   if($rowpersonnel["HOS_TYPE"] == 'โรงพยาบาลชุมชน'){ 
                ?>
							<a class="btn btn-info btn-sm " href="form_bededit2.php?bedID=<?php echo $rowpersonnel['bedID'];?>">
              แก้ไขข้อมูล/ลบ
							</a>
              <?php }else{ ?>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a class="btn btn-info btn-sm " href="form_bededit.php?bedID=<?php echo $rowpersonnel['bedID'];?>">
              แก้ไขข้อมูล/ลบ
							</a>
			
						<?php } } ?>
            </td>
						
					</tr>
					<?php } ?>
				   </tbody>
				</table>

                
                <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                   <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">ชื่อโรงพยาบาล</th>
                        <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
                        <th colspan="2"><center>จำนวนเตียงจิตเวช</center></th>
                        <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
                        <th colspan="2"><center>มินิธัญญารักษ์จำนวนเตียงจิตเวช</center></th>       
				</tr>
                <tr>
                        <th><center>เตียงผู้หญิง</center></th>	
                        <th><center>เตียงผู้ชาย</center></th>
                        <th><center>เตียงผู้หญิง</center></th>	
                        <th><center>เตียงผู้ชาย</center></th>
                </tr>
                   </thead>
                   <tbody>
					 <?php
					

					$objpersonnel2 = mysqli_query($con, $sqlpersonnel2);
					$j = 1;
					while($rowpersonnel2 = mysqli_fetch_array($objpersonnel2))
					{
					?>
					<tr>
						<td><?php echo $j++; ?></td>
                        <td>
							<?php echo $rowpersonnel2['HOS_NAME'];?>
						</td>
					
						<td><center><?php echo $rowpersonnel2['Wardall'];?></center></td>
						<td><center><?php echo $rowpersonnel2['Unit']; ?></center></td>
						<td><center><?php echo $rowpersonnel2['Unit_no'];?></center></td>
            

                        <td><center><?php echo $rowpersonnel2['TN2'];?></center></td>
						<td><center><?php echo $rowpersonnel2['MM2']; ?></center></td>
						<td><center><?php echo $rowpersonnel2['MM3'];?></center></td>

                    </tr>
                    <?php } ?>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      //"buttons": [ "csv", "excel", "pdf"]
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
           window.location.href = 'tables-bedall.php'; 
        });

      
</script>

</body>
</html>
