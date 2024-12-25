<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];
//$codeprovince	= $_SESSION["codeprovince"];

if (isset($_POST["positiontypeID"])) {
	$positiontypeID		= $_POST["positiontypeID"];
}


//$PersonnelType	= $_GET['t'];
/*

$sqlt 		= "SELECT PtypeID, Ptypename ,Ptype FROM personneltype WHERE PtypeStatus = 1 AND Ptype = $PersonnelType";
$objptype 	= mysqli_query($con, $sqlt);
$rowptype   = mysqli_fetch_array($objptype);*/
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
		}
		?>
         <?php /* <h2 class="card-title">แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2> */ ?>
		 <?php if($TypeService <> ''){?>
			<h4>ข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลทรัพยากร   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-maindetail.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">บุคลากรสุขภาพจิตและจิตเวช</li>
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
	  <form class="form-valide" action="tables-preall2.php" method="post" id="myform1" name="foml">  
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
                const type_AffiliationValue = '<?php echo isset($_POST['type_Affiliation']) ? $_POST['type_Affiliation'] : ''; ?>';
                  if (type_AffiliationValue) {
                    $('#type_Affiliation').val(type_AffiliationValue).trigger('change');
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
                const AffiliationValue = '<?php echo isset($_POST['Affiliation']) ? $_POST['Affiliation'] : ''; ?>';
                  if (AffiliationValue) {
                    $('#Affiliation').val(AffiliationValue).trigger('change');
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
                const TYPE_SERVICEValue = '<?php echo isset($_POST['TYPE_SERVICE']) ? $_POST['TYPE_SERVICE'] : ''; ?>';
                  if (TYPE_SERVICEValue) {
                    $('#TYPE_SERVICE').val(TYPE_SERVICEValue).trigger('change');
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
                const CODE_HOSValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                  if (CODE_HOSValue) {
                    $('#CODE_HOS').val(CODE_HOSValue).trigger('change');
                   }
            }
        });
    }
}


</script>
		<?php }else{ ?>
			<form class="form-valide" action="tables-preall2.php" method="post" id="myform1" name="foml">  
            <div class="row">
            
            <?php 
            
            if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){
            
            if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
            ?>  
                          <!-- จังหวัด -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>จังหวัด</label>
                            <select class="form-control select2" name="CODE_PROVINCE" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction2()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['CODE_PROVINCE']) && $_POST['CODE_PROVINCE'] == 'ทั้งหมด' || !isset($_POST['CODE_PROVINCE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
            
                                <?PHP
                        $sqlprovince = "SELECT DISTINCT *
                                        FROM userhospital 
                                        INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
                                        WHERE hospitalnew.HOS_TYPE <> 'คลินิกเอกชน'
                                          AND hospitalnew.HOS_TYPE <> 'โรงพยาบาลเอกชน'
                                          AND hospitalnew.CODE_HMOO = '$HosMOHP'
                                        GROUP BY hospitalnew.CODE_PROVINCE";
            
                        $objprovince = mysqli_query($con, $sqlprovince);
            
                        while ($rowprovince = mysqli_fetch_array($objprovince)) { ?>
                            <option value="<?PHP echo $rowprovince["NO_PROVINCE"]; ?>" 
                                <?php echo (isset($_POST['CODE_PROVINCE']) && $_POST['CODE_PROVINCE'] == $rowprovince["NO_PROVINCE"]) ? 'selected' : ''; ?>>
                                <?PHP echo $rowprovince["CODE_PROVINCE"]; ?>
                            </option>
                        <?PHP } ?>
                            </select>
                        </div>
                    </div>
            
                    <!-- หน่วยงานใน/นอกสังกัด -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>หน่วยงานใน/นอกสังกัดกระทรวงสาธารณสุข</label>
                            <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction151()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['type_Affiliation']) && $_POST['type_Affiliation'] == 'ทั้งหมด' || !isset($_POST['type_Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
            
                    <!-- สังกัด -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>สังกัด</label>
                            <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction5()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['Affiliation']) && $_POST['Affiliation'] == 'ทั้งหมด' || !isset($_POST['Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
            
                    <!-- ประเภทหน่วยบริการ -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                            <select class="form-control select2" name="TYPE_SERVICE" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction101()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['TYPE_SERVICE']) && $_POST['TYPE_SERVICE'] == 'ทั้งหมด' || !isset($_POST['TYPE_SERVICE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
                         
                       <?php  }} ?>
            
                       <?php   if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
            
                        <!-- หน่วยงานใน/นอกสังกัด -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>หน่วยงานใน/นอกสังกัดกระทรวงสาธารณสุข</label>
                                <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction151()">
                                    <option value="ทั้งหมด" <?php if (isset($_POST['type_Affiliation']) && $_POST['type_Affiliation'] == 'ทั้งหมด' || !isset($_POST['type_Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
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
                                </select>
                            </div>
                        </div>
            
                        <!-- สังกัด -->
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>สังกัด</label>
                            <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction51()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['Affiliation']) && $_POST['Affiliation'] == 'ทั้งหมด' || !isset($_POST['Affiliation'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
            
                     <!-- ประเภทหน่วยบริการ -->
                     <div class="col-md-3">
                        <div class="form-group">
                            <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
                            <select class="form-control select2" name="TYPE_SERVICE" id="TYPE_SERVICE" style="width: 100%;" onChange="myFunction10()">
                                <option value="ทั้งหมด" <?php if (isset($_POST['TYPE_SERVICE']) && $_POST['TYPE_SERVICE'] == 'ทั้งหมด' || !isset($_POST['TYPE_SERVICE'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
            
                    
                    <?php }?>
            
                    <?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){?>  
            
                      <!-- หน่วยบริการ -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>หน่วยบริการ/หน่วยงาน</label>
                            <select class="form-control select2" name="CODE_HOS" id="CODE_HOS" style="width: 100%;">
                                <option value="ทั้งหมด" <?php if (isset($_POST['CODE_HOS']) && $_POST['CODE_HOS'] == 'ทั้งหมด' || !isset($_POST['CODE_HOS'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                                <?PHP 
                                    $sqlprovince = "SELECT *
                                    FROM userhospital 
                                    INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
                                    WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
                                    AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
                                    AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
                                    if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){					  
                                      $sqlprovince = $sqlprovince."AND hospitalnew.CODE_DISTRICT LIKE  '%$CODE_DISTRICT' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลชุมชน' AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขอำเภอ' AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขจังหวัด' 
                                  AND hospitalnew.HOS_TYPE <>'ศูนย์วิชาการ' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลทั่วไป' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลศูนย์' " ;
                                    }
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
            
              
                   <?php }else{ ?>
            
                    <!-- หน่วยบริการ -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>หน่วยบริการ/หน่วยงาน</label>
                            <select class="form-control select2" name="CODE_HOS" id="CODE_HOS" style="width: 100%;">
                                <option value="ทั้งหมด" <?php if (isset($_POST['CODE_HOS']) && $_POST['CODE_HOS'] == 'ทั้งหมด' || !isset($_POST['CODE_HOS'])){?> selected="selected" <?php } ?>>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
            
            
                    
                    <?php } ?>	
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
                myFunction5();
                myFunction51();
                myFunction15();
                myFunction151();
                myFunction2();
                myFunction10();
                myFunction101();
            
                // ค่า preselected จาก PHP
                const provinceValue = '<?php echo isset($_POST['CODE_PROVINCE']) ? $_POST['CODE_PROVINCE'] : ''; ?>';
            
                // ตั้งค่า dropdown และกระตุ้น event
                if (provinceValue) {
                    $('#CODE_PROVINCE').val(provinceValue).trigger('change');
                }
            
                // ส่งค่าจาก PHP $_SESSION["HosType"] ไปยัง JavaScript
                const hosType = '<?php echo isset($_SESSION["HosType"]) ? $_SESSION["HosType"] : ""; ?>';
            
                // เช็คค่า hosType
                if (hosType === 'สำนักงานสาธารณสุขจังหวัด') {
                    // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                    const type_AffiliationValue = '<?php echo isset($_POST['type_Affiliation']) ? $_POST['type_Affiliation'] : ''; ?>';
                    if (type_AffiliationValue) {
                        $('#type_Affiliation').val(type_AffiliationValue).trigger('change');
                    }
                }
                
                if (hosType === 'สำนักงานสาธารณสุขอำเภอ') {
                    // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                    const CODE_HOSValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                    if (CODE_HOSValue) {
                      $('#CODE_HOS').val(CODE_HOSValue).trigger('change');
                      }
                }
            });
            
            
            // Function for จังหวัด -> หน่วยงานใน/นอกสังกัด
            function myFunction2() {
                const selectedValue = $('#CODE_PROVINCE').val();
                //console.log("Selected Province: " + selectedValue); // Debugging
                if (selectedValue) {
                    $.ajax({
                        url: 'get_affiliationtype.php',
                        data: { codeprovince: selectedValue },
                        success: function(data) {
                            // เติมข้อมูลใน type_Affiliation
                            $('#type_Affiliation').html(data);
            
                            // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                            const type_AffiliationValue = '<?php echo isset($_POST['type_Affiliation']) ? $_POST['type_Affiliation'] : ''; ?>';
                            if (type_AffiliationValue) {
                                $('#type_Affiliation').val(type_AffiliationValue).trigger('change');
                            }
                        }
                    });
                }
            }
            
            function myFunction101() {
              const selectedValue = $('#TYPE_SERVICE').val();
               //const Affiliation 		= document.getElementById("Affiliation").value;
               const Affiliation = $('#Affiliation').val();
                //const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                let codeprovince = $('#CODE_PROVINCE').val();
            
            if (typeof codeprovince === 'undefined') {
              let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
              if (provinceValue !== null) {
                  codeprovince = provinceValue;
              } else {
                  console.error("PHP variable NO_PROVINCE is not set");
              }
            }
            
              const HosMOHP 		    = <?PHP echo $HosMOHP;?>;
                  //alert(HosMOHP);
              if (selectedValue) {
                  $.ajax({
                    url: 'get_service3.php', // ไฟล์ PHP ที่จะประมวลผล
                    data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, HosMOHP: HosMOHP},
                    success: function(data) {
                      $('#CODE_HOS').html(data);
            
                       // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                        const CODE_HOSValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                        if (CODE_HOSValue) {
                          $('#CODE_HOS').val(CODE_HOSValue).trigger('change');
                        }
            
                    }
                  });
                }
            }
            
            
            
            
            function myFunction15() {
              let selectedValue = $('#type_Affiliation').val();
              let codeprovince = $('#CODE_PROVINCE').val();
            
              if (typeof codeprovince === 'undefined') {
                let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
                if (provinceValue !== null) {
                    codeprovince = provinceValue;
                } else {
                    console.error("PHP variable NO_PROVINCE is not set");
                }
              }
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
              let selectedValue = $('#type_Affiliation').val();
              let codeprovince = $('#CODE_PROVINCE').val();
            
              if (typeof codeprovince === 'undefined') {
                let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
                if (provinceValue !== null) {
                    codeprovince = provinceValue;
                } else {
                    console.error(<?php echo json_encode($NO_PROVINCE); ?>);
                }
              }
            
                if (selectedValue) {
                    $.ajax({
                        url: 'get_affiliation2.php',
                        data: { typeAffiliation: selectedValue, codeprovince: codeprovince },
                        success: function(data) {
                            $('#Affiliation').html(data);
            
                            // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                            const AffiliationValue = '<?php echo isset($_POST['Affiliation']) ? $_POST['Affiliation'] : ''; ?>';
                              if (AffiliationValue) {
                                $('#Affiliation').val(AffiliationValue).trigger('change');
                               }
                        }
                    });
                }
                
            }
            
            function myFunction5() {
                const selectedValue = $('#Affiliation').val();
                let codeprovince = $('#CODE_PROVINCE').val();
            
              if (typeof codeprovince === 'undefined') {
                let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
                if (provinceValue !== null) {
                    codeprovince = provinceValue;
                } else {
                    console.error(<?php echo json_encode($NO_PROVINCE); ?>);
                }
              }
                if (selectedValue) {
                    $.ajax({
                        url: 'get_servicetype.php',
                        data: { Affiliation: selectedValue, codeprovince: codeprovince },
                        success: function(data) {
                            $('#TYPE_SERVICE').html(data);
            
                            // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                            const TYPE_SERVICEValue = '<?php echo isset($_POST['TYPE_SERVICE']) ? $_POST['TYPE_SERVICE'] : ''; ?>';
                              if (TYPE_SERVICEValue) {
                                $('#TYPE_SERVICE').val(TYPE_SERVICEValue).trigger('change');
                               }
                        }
                    });
                }
            }
            
            function myFunction51() {
              const selectedValue = $('#Affiliation').val();
              let codeprovince = $('#CODE_PROVINCE').val();
            
              if (typeof codeprovince === 'undefined') {
                let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
                if (provinceValue !== null) {
                    codeprovince = provinceValue;
                } else {
                    console.error("PHP variable NO_PROVINCE is not set");
                }
              }
                 // alert(selectedValue);
              if (selectedValue) {
                  $.ajax({
                    url: 'get_servicetype.php', // ไฟล์ PHP ที่จะประมวลผล
                    data: { Affiliation: selectedValue , codeprovince: codeprovince  },
                    success: function(data) {
                      $('#TYPE_SERVICE').html(data);
            
                       // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                       const TYPE_SERVICEValue = '<?php echo isset($_POST['TYPE_SERVICE']) ? $_POST['TYPE_SERVICE'] : ''; ?>';
                              if (TYPE_SERVICEValue) {
                                $('#TYPE_SERVICE').val(TYPE_SERVICEValue).trigger('change');
                               }
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
                let codeprovince = $('#CODE_PROVINCE').val();
            
              if (typeof codeprovince === 'undefined') {
                let provinceValue = <?php echo isset($NO_PROVINCE) ? $NO_PROVINCE : 'null'; ?>;
                if (provinceValue !== null) {
                    codeprovince = provinceValue;
                } else {
                    console.error("PHP variable NO_PROVINCE is not set");
                }
              }
                const HosMOHP 		    = <?PHP echo $HosMOHP;?>;
            
                 //   alert(codeprovince);
                if (selectedValue) {
                    $.ajax({
                      url: 'get_service3.php', // ไฟล์ PHP ที่จะประมวลผล
                      data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, HosMOHP: HosMOHP},
                      success: function(data) {
                        $('#CODE_HOS').html(data);
            
                        // ดึงค่า POST ที่สัมพันธ์และเซ็ตกลับ
                        const CODE_HOSValue = '<?php echo isset($_POST['CODE_HOS']) ? $_POST['CODE_HOS'] : ''; ?>';
                              if (CODE_HOSValue) {
                                $('#CODE_HOS').val(CODE_HOSValue).trigger('change');
                               }
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
             <div class="card-header">
                <!--<h3 class="card-title">ข้อมูลจำนวนบุคลากรสุขภาพจิตและจิตเวช</h3>-->
				

				
              </div>
              <!-- /.card-header -->

			  
              <div class="card-body">
				<?php   
		if (isset($_POST["positiontypeID"])) {
				           $sqlpersonnel = "SELECT 
											personnel.personnelID, 
											personnel.positiontypeID,
											personnel.prename, 
											personnel.firstname, 
											personnel.lastname,  
											personnel.age,
											personnel.r1 , 
											personnel.r2 , 
											hospitalnew.HOS_NAME,
											personnel.positionrole, 
											personneltype.Ptypename,
											personnel.congrat, 
											personnel.training, 
											personnel.cogratyear, 
											personnel.statuscong,
											personnel.regislaw,
                                            personneltype.Ptypename,
											personnel.positiontypeID,
											personnel.Mcatt1
										FROM 
											personnel 
                                        JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
                                        JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
										WHERE 
											hospitalnew.CODE5 = '$HospitalID' 
										AND setdel = '1'
										AND personnel.positiontypeID = '$positiontypeID'
										ORDER BY 
											personnelID DESC; ";
		}else{
			if($_SESSION["HospitalID"]=='12244'){

				$sqlpersonnel = "SELECT *
								  FROM userhospital 
								  INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
								  WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
								  AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
                                  AND hospitalnew.CODE_HMOO in ('$HosMOHP','6')";

				if(isset($_POST["CODE_HOS"])){	
					if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
						$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
					}
				}
				
				if(isset($_POST["type_Affiliation"])){	
					if(trim($_POST["type_Affiliation"]) <>'ทั้งหมด'){					  
						$sqlpersonnel = $sqlpersonnel."AND hospitalnew.type_Affiliation LIKE ('".$_POST['type_Affiliation']."%')" ;
					}
				}

				if(isset($_POST["Affiliation"])){	
					if(trim($_POST["Affiliation"]) <>'ทั้งหมด'){					  
					  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.Affiliation LIKE ('".trim($_POST['Affiliation'])."%')" ;
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

			}else{

			 if($_SESSION["TypeUser"] == "Admin"){ 

            $sqlpersonnel = "SELECT *
								  FROM userhospital 
								  INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
								  INNER JOIN personnel ON personnel.HospitalID = hospitalnew.CODE5
								  INNER JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
								  WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
								  AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
                                ";

						if(isset($_POST["CODE_HMOO"])){	
							if($_POST["CODE_HMOO"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO = '".$_POST['CODE_HMOO']."'" ;
							}
						}				

					if(isset($_POST["CODE_HOS"])){	
						if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
						}
					}
					if(isset($_POST["type_Affiliation"])){	
						if(trim($_POST["type_Affiliation"]) <>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.type_Affiliation LIKE ('".$_POST['type_Affiliation']."%')" ;
						}
					}

					if(isset($_POST["Affiliation"])){	
						if(trim($_POST["Affiliation"]) <>'ทั้งหมด'){					  
						  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.Affiliation LIKE ('".trim($_POST['Affiliation'])."%')" ;
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
					$sqlpersonnel2 = $sqlpersonnel; 

					$sqlpersonnel = $sqlpersonnel." GROUP BY hospitalnew.CODE5 " ;

			 }else{

				$sqlpersonnel = "SELECT *
				FROM userhospital 
				INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
				INNER JOIN personnel ON personnel.HospitalID = hospitalnew.CODE5
				INNER JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
				WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
				AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
				AND hospitalnew.CODE_HMOO = '$HosMOHP'";

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
	
				if(isset($_POST["Affiliation"])){	
					if(trim($_POST["Affiliation"]) <>'ทั้งหมด'){					  
					  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.Affiliation LIKE ('".trim($_POST['Affiliation'])."%')" ;
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
				$sqlpersonnel2 = $sqlpersonnel; 

				$sqlpersonnel = $sqlpersonnel." GROUP BY hospitalnew.CODE5 " ;

			 }

				
			}

		   /* echo  $sqlpersonnel = "SELECT 
			personnel.personnelID, 
			personnel.positiontypeID,
			personnel.prename, 
			personnel.firstname, 
			personnel.lastname,  
			personnel.age,
			personnel.r1 as 'positionAllName', 
			personnel.r2 as 'fixpositionAllName', 
			hospitalnew.HOS_NAME,
			personnel.positionrole, 
			personnel.congrat, 
			personnel.training, 
			personnel.cogratyear, 
			personnel.statuscong,
			personnel.regislaw,
			personneltype.Ptypename,
			personnel.positiontypeID,
			personnel.Mcatt1
		FROM 
			personnel 
		JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
		JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
		WHERE 
			hospitalnew.CODE_PROVINCE  = '$codeprovince' 
		AND setdel = '1'
		ORDER BY 
			personnelID DESC; ";

            */

		}

		//echo $sqlpersonnel ;

					//echo $sqlpersonnel = "SELECT * FROM personnel JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID WHERE hospitalnew.CODE5 = '$HospitalID' ";

					

				
				
				$objpersonnel = mysqli_query($con, $sqlpersonnel);
				$i = 1;

				$objpersonnel2 = mysqli_query($con, $sqlpersonnel2);
				$j = 1;
				//echo $PersonnelType; 
	
				/*if($PersonnelType == 1){*/?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">ชื่อสถานพยาบาล</th>
					  <th width="10%">อำเภอ</th>
					  <th width="10%">ระดับ</th>
					  <th width="10%">สังกัด</th>
					  <th width="15%">ข้อมูลบุคลากร</th>
					  <?php /*<th width="5%">ปีที่คาดว่าจะจบ</th>
					  <th width="15%">หน่วยงาน</th> */?>
					  <!--
					  <th width="5%">						  
						  <center>แก้ไข</center></th>-->
					  <?php /*if($_SESSION["TypeUser"] == "Admin"){?>
					  <!--<th width="5%"><center>ลบข้อมูล</center></th>-->
					  <th width="5%"></th>
					  <th width="5%"></th>
					  <?php }else{?>
					  <th width="15%">แก้ไขข้อมูล</th>
					  <?php } */?>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))
						{ 
						?>
						<tr>
							<td><?php echo $i++; ?></td>
                            <td><?php echo $rowpersonnel['HOS_NAME'];?></td>
                        <td><?php echo $rowpersonnel['CODE_DISTRICT'];?></td>
                        <td><?php echo $rowpersonnel['TYPE_SERVICE'];?></td>
                        <td><?php echo $rowpersonnel['Affiliation'];?></td>
                        <?php /* ?><td><?php echo $rowpersonnel['UserID'];?></td> <?php  */?>
                        
                    
                        <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){						
							?>
							<td><center><a class="btn btn-info btn-sm" href="tables-prealldetail2.php?code=<?php echo $rowpersonnel['CODE5'];?>" >รายละเอียด</a></center></td>
						<?php }else{ 	
							?>
                        	<td><center><a class="btn btn-info btn-sm" href="tables-prealldetail.php?code=<?php echo $rowpersonnel['CODE5'];?>" >รายละเอียด</a></center></td>
                        <?php } ?>
						
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>

				  <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                  <tr align="center">
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  <th width="10%">วิชาชีพ</th>
					  <th width="10%">ปฏิบัติงานวิกฤตสุขภาพจิต (MCATT)</th>
					  <th width="10%">อายุ</th>
					  <th width="15%">แพททย์จิตเวช</th>
					  <th width="15%">การปฏิบัติงาน</th>
					  <th width="10%">ชื่อโรงพยาบาล</th>
					  <th width="15%">วิชาชีพ</th>
					  <th width="15%">ปริญญา</th>
					  <th width="10%">จบหลักสูตร</th>
					  <th width="15%">ปีที่จบ</th>
					  <th width="15%">ศึกษา</th>
					  <th width="15%">อื่นๆ</th>
					  <th width="15%">รหัสวิชาชีพ</th>
					  <th width="15%">รหัสสถานพยาบาล</th>
					  <th width="15%">ตำแหน่ง</th>
					  <th width="15%">ตำแหน่งอื่น</th>
					  <th width="15%">วันเกิด</th>
					  <th width="15%">อื่นๆ</th>
					  <th width="15%">ระบุ</th>
					  <th width="15%">หลักสูตรการช่วยเหลือเยียวยาจิตใจผู้ประสบภาวะวิกฤต (ทีม MCATT)</th>
					  <th width="15%">Psychotraumatology & Stabilization Techniques</th>
					  <th width="15%">การปฐมพยาบาลทางใจ (Psychological First Aid, PFA)</th>
					  <th width="15%">การเจรจาต่อรองในภาวะวิกฤต</th>
					  <th width="15%">ระบบฐานข้อมูลเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภัยในภาวะวิกฤต/ภัยพิบัติ (Crisis Mental Health Surveillance System: CMS)</th>
					  <th width="15%">หลักสูตร ICS100</th>
					  <th width="15%">หลักสูตร ทีมปฏิบัติการฉุกเฉินทางการแพทย์ประเทศไทย EMT Thailand</th>
					  <th width="15%">อื่น ๆ</th>
					  <th width="15%">การอบรมMcatt</th>
					  <th width="15%">ระบุ</th>
				   </tr>
                   </thead>
                  <tbody>
				  <?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel2 = mysqli_fetch_array($objpersonnel2))
						{ 
						?>
						<tr>
							<td><?php echo $j++; ?></td>
							<td>
								<?php 
								echo $rowpersonnel2['prename'].$rowpersonnel2['firstname']." ".$rowpersonnel2['lastname'];
								?>
							</td>
						
						 	<td><?php echo $rowpersonnel2['Ptypename']; ?></td>
							<td><?php echo $rowpersonnel2['Mcatt1']; ?></td>
							<td><?php echo $rowpersonnel2['age']; ?></td>
							<td><?php echo $rowpersonnel2['r1']; ?></td>
							<td><?php echo $rowpersonnel2['r2']; ?></td>
							<td><?php echo $rowpersonnel2['HOS_NAME']; ?></td>
							<td><?php echo $rowpersonnel2['Ptypename']; ?></td>
							<td><?php echo $rowpersonnel2['congrat']; ?></td>
							<td><?php echo $rowpersonnel2['training']; ?></td>
							<td><?php echo $rowpersonnel2['cogratyear']; ?></td>
							<td><?php echo $rowpersonnel2['statuscong']; ?></td>
							<td><?php echo $rowpersonnel2['regislaw']; ?></td>
							<td><?php echo $rowpersonnel2['positiontypeID']; ?></td>
							<td><?php echo $rowpersonnel2['HospitalID']; ?></td>
							<td><?php echo $rowpersonnel2['position_other']; ?></td>
							<td><?php echo $rowpersonnel2['positionrole']; ?></td>			
							<td><?php echo $rowpersonnel2['birthday']; ?></td>
							<td><?php echo $rowpersonnel2['other_r1']; ?></td>
							<td><?php echo $rowpersonnel2['other_training']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_1']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_2']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_3']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_4']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_5']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_6']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_7']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_8']; ?></td>
							<td><?php echo $rowpersonnel2['MWac1_9']; ?></td>
							<td><?php echo $rowpersonnel2['other2_mcatt']; ?></td>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>


				<?php /*} 
				elseif($PersonnelType == 2){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  
					  <th width="8%">วุฒิการศึกษา</th>
					  <th width="15%">การอบรมเฉพาะทาง</th>
					  <th width="15%">กำลังศึกษา</th>
					  <th width="5%">ปีที่คาดว่าจะจบ</th>
					  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))
						{ 
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td>
								<?php 
								echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];
								?>
							</td>
							 
							
							<td><?php 
								//-----CONGRAT
								if($rowpersonnel['congrat'] != ''){ 
									echo $CongratCer = $rowpersonnel['congrat']; 
								}else{ 
									echo $CongratCer = '-';
								}
								?>
							</td>
							<td>
								<?php
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training_);
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2].'<br>';}
								if($Training[3] !=''){echo '- '.$Training[3].'<br>';}
								?>
							</td>
							<td>
								<?php
								//-----LEARNING?
								$Learning 	= explode(",", $rowpersonnel['statuscong']);
								if($Learning[0] !=''){echo '- '.$Learning[0].'<br>';}
								if($Learning[1] !=''){echo '- '.$Learning[1].'<br>';}
								if($Learning[2] !=''){echo '- '.$Learning[2].'<br>';}
								if($Learning[3] !=''){echo '- '.$Learning[3].'<br>';}
								if($Learning[4] !=''){echo '- '.$Learning[4].'<br>';}
								?>
							</td>
							<td><?php echo $rowpersonnel['cogratyear'];  ?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m2_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				<?php } 
				elseif($PersonnelType == 3){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  
					  <th width="10%">การอบรมเฉพาะทาง</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							<td><?php 
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training);
							/*
							
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2];}
							*//*
								if($Training[2] !=''){
									echo $Training[2];
								}else{
									if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
									if($Training[1] !=''){echo '- '.$Training[1];}
								}
								
								
								?>
							</td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m3_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				<?php } 
				elseif($PersonnelType == 4){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  <th width="15%">ตำแหน่ง</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td>
								<?php echo $rowpersonnel['positionrole'];/*
								$TypeForm = $rowpersonnel['positiontypeID'] ;
								if($TypeForm == 1){echo 'แพทย์เฉพาะทาง';}
								elseif($TypeForm == 2){echo 'พยาบาลเฉพาะทาง';}
								elseif($TypeForm == 3){echo 'เภสัชกร';}
								elseif($TypeForm == 4){echo $rowpersonnel['positionrole'];}
								elseif($TypeForm == 5){echo 'นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต';} 
								elseif($TypeForm == 6){echo 'นักกิจกรรมบำบัด';}*/
								/*?>
							</td>
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m4_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 5){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
					  <!--<th width="12%">ตำแหน่ง</th>-->
					  <th width="10%">การอบรมเฉพาะทาง</th>
					  <th width="10%">ขึ้นทะเบียนนักสังคมสงเคราะห์</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<!--<td>
								<?php /*echo $rowpersonnel['positionrole'];/*
								$TypeForm = $rowpersonnel['positiontypeID'] ;
								if($TypeForm == 1){echo 'แพทย์เฉพาะทาง';}
								elseif($TypeForm == 2){echo 'พยาบาลเฉพาะทาง';}
								elseif($TypeForm == 3){echo 'เภสัชกร';}
								elseif($TypeForm == 4){echo $rowpersonnel['positionrole'];}
								elseif($TypeForm == 5){echo 'นักสังคมสงเคราะห์จิตเวช/นักสังคมสงเคราะห์ที่ปฏิบัติงานสุขภาพจิต';} 
								elseif($TypeForm == 6){echo 'นักกิจกรรมบำบัด';}*/
								/*?>
							</td>-->
							<td><?php 
								//-----TRAINIG?
								$Training 	= explode(",", $rowpersonnel['training']);
								//print_r ($Training_);
								if($Training[0] !=''){echo '- '.$Training[0].'<br>';}
								if($Training[1] !=''){echo '- '.$Training[1].'<br>';}
								if($Training[2] !=''){echo '- '.$Training[2].'<br>';}
								if($Training[3] !=''){echo '- '.$Training[3].'<br>';}
								?>
							</td>
							<td><?php 
								if($rowpersonnel['regislaw'] <> ''){
									echo '<i class="fa fa-check" style="color: green"></i>';
								}
								?> 
							</td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m5_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 6){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 7){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
				  <?php } 
				  elseif($PersonnelType == 8){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							
							
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php }  
				  elseif($PersonnelType == 9){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="10%"><center>จังหวัด</center></th>
					  <?php } ?>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php echo $rowpersonnel['CODE_PROVINCE'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php } 
				  elseif($PersonnelType == 10){?>
					<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
					  <th width="2%">#</th>
					  <th width="10%">ชื่อ-นามสกุล</th>
				  	  <th width="10%">หน่วยงาน</th>
				      <th width="10%"><center>ตำแหน่ง</center></th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="10%"><center>จังหวัด</center></th>					  
					  <?php } ?>
					  <th width="5%"><center>แก้ไข</center></th>	
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th width="5%"><center>ลบข้อมูล</center></th>
					  <?php } ?>
					</tr>
					</thead>
					<tbody>
					<?php
						//echo $rowpersonnel['positiontypeID'] ;
						while($rowpersonnel = mysqli_fetch_array($objpersonnel))

						{
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rowpersonnel['prename']."".$rowpersonnel['firstname']." ".$rowpersonnel['lastname'];?></td>
							<td><?php echo $rowpersonnel['HOS_NAME'];?></td>
							<td><?php echo $rowpersonnel['position_other'];?></td>
							<td><?php echo $rowpersonnel['CODE_PROVINCE'];?></td>
							<td><?php if($HosType == "กรมสุขภาพจิต"){?>
							<center>
								  <a class="btn btn-info btn-sm disabled" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>">
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
								<!--
								<a href="forms_m1_edit.php?personnelID=<?php//echo $rowpersonnel['personnelID'];?>&&type=<?php// echo $PersonnelType;?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>	
								</a>-->
							</center>
							<?php }elseif($HosType != "กรมสุขภาพจิต"){?>
								<center>
								  <a class="btn btn-info btn-sm" href="forms_m6_edit.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&type=<?php echo $PersonnelType;?>" >
									<i class="fas fa-pencil-alt"></i> แก้ไข
								  </a>
							</center>
							<?php }?>
							</td>
							<?php if($_SESSION["TypeUser"] == "Admin"){?>
							<td><center>
								<!--
								<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
									<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
								</a> -->
								<a class="btn btn-danger btn-sm" href="personnel_del.php?personnelID=<?php echo $rowpersonnel['personnelID'];?>&&t=<?php echo $PersonnelType;?>">
									<i class="fas fa-trash"></i> ลบ
								</a>
								<!--
								<a href="personnel_del.php?personnelID=<?php// echo $rowpersonnel['personnelID'];?>&&t=<?php// echo $PersonnelType;?>">
									<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
								</a>-->
							</center>
							</td>
							<?php } ?>
						</tr>
						<?php } ?> 	
					</tbody>
				  </table>
			      <?php } */?>
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
      //"buttons": ["copy", "csv", "excel", "pdf"]
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
           window.location.href = 'tables-preall2.php'; 
        });

      
</script>

</body>
</html>
