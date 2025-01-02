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
  <?php if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){ 
     if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
        if($_SESSION["HosType"] <> 'ศูนย์วิชาการ'){ 
          if($_SESSION["TypeUser"] <> "Admin"){ 
            if($_SESSION["HosType"] <> 'กรมสุขภาพจิต'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-ect.php">
	<?php }}}}} ?>
 
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
			<h4>ข้อมูลการรักษาด้วยไฟฟ้า (ECT/TMS)  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลการรักษาด้วยไฟฟ้า (ECT/TMS)   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-2.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">ข้อมูลการรักษาด้วยไฟฟ้า</li>
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
      <form class="form-valide" action="tables-ectall.php" method="post" id="myform1" name="foml">  
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
			<form class="form-valide" action="tables-ectall.php" method="post" id="myform1" name="foml">  
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
                              AND hospitalnew.HOS_TYPE <> 'โรงพยาบาลเอกชน' ";
                            if($HospitalID =='13775'){
                              $sqlprovince = $sqlprovince."AND hospitalnew.CODE_HMOO in ('$HosMOHP','2') ";
                            }else if($HospitalID =='12246'){
                              $sqlprovince = $sqlprovince."AND hospitalnew.CODE_HMOO in ('$HosMOHP','3') ";
                            }else if($HospitalID =='12244'){
                              $sqlservice = $sqlservice."AND hospitalnew.CODE_HMOO in ('$HosMOHP','6') ";
                            }else if($HospitalID =='24746'){
                              $sqlprovince = $sqlprovince."AND hospitalnew.CODE_HMOO in ('$HosMOHP','8') ";
                            }else{
                              $sqlprovince = $sqlprovince."AND hospitalnew.CODE_HMOO = '$HosMOHP' ";
                            }
                            $sqlprovince = $sqlprovince."GROUP BY hospitalnew.CODE_PROVINCE";
            
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
            
            let HosMOHP; // ประกาศตัวแปรที่นี่

            // ตรวจสอบว่า codeprovince ตรงกับค่าที่ต้องการหรือไม่
            if (['53', '63', '64', '65', '67'].includes(codeprovince)) {
                HosMOHP = '2';
            }else if(['18','60','61','62','66'].includes(codeprovince)) {
                HosMOHP = '3';
            }else if(['11','20','21','22','23','24','25','27'].includes(codeprovince)) {
                HosMOHP = '6';
            }else if(['39','41','42','43','47','48','38'].includes(codeprovince)) {
                HosMOHP = '8';
            }else{
                HosMOHP = <?php echo $HosMOHP; ?>; // PHP ค่าที่ส่งมา
            }
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
              let HosMOHP; // ประกาศตัวแปรที่นี่

            // ตรวจสอบว่า codeprovince ตรงกับค่าที่ต้องการหรือไม่
            if (['53', '63', '64', '65', '67'].includes(codeprovince)) {
                HosMOHP = '2';
            }else if(['18','60','61','62','66'].includes(codeprovince)) {
                HosMOHP = '3';
            }else if(['11','20','21','22','23','24','25','27'].includes(codeprovince)) {
                HosMOHP = '6';
            }else if(['39','41','42','43','47','48','38'].includes(codeprovince)) {
                HosMOHP = '8';
            }else{
                HosMOHP = <?php echo $HosMOHP; ?>; // PHP ค่าที่ส่งมา
            }
            
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
              <!--<div class="card-header bg-olive color-palette">
                <h3 class="card-title">ข้อมูลเตียงจิตเวช</h3>
              </div>-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th>#</th>
                      <th><center>ชื่อโรงพยาบาล</center></th>
					  <th><center>จำนวน ECT</center></th>
                      <th><center>จำนวน TMS</center></th>			
					  <th><center>แก้ไขข้อมูล</center></th>
					  <?php /*if($_SESSION["TypeUser"] == "Admin"){?>
					  <th>ลบข้อมูล</th>
					  <?php }*/ ?>
					</tr>
                   </thead>
                   <tbody>
					 <?php
          if($_SESSION["TypeUser"] == "Admin"){ 
            $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
            WHERE ect.setectdel = '1'
             ";

            if(isset($_POST["CODE_HMOO"])){	
              if($_POST["CODE_HMOO"]<>'ทั้งหมด'){					  
                $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO = '".$_POST['CODE_HMOO']."'" ;
              }
            }
          }else{
					 
           if($HosType == "กรมสุขภาพจิต"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE 1  
               AND ect.setectdel = '1'
                ";	
                if($HospitalID =='13775'){
                  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO in ('$HosMOHP','2') ";
                }else if($HospitalID =='12246'){
                  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO in ('$HosMOHP','3') ";
                }else if($HospitalID =='12244'){
                  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO in ('$HosMOHP','6') ";
                }else if($HospitalID =='24746'){
                  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO in ('$HosMOHP','8') ";
                }else{
                  $sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE_HMOO = '$HosMOHP' ";
                }

             }elseif($HosType == "ศูนย์วิชาการ"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
               AND ect.setectdel = '1'
                ";	
             }elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE hospitalnew.CODE_PROVINCE = '$codeprovince' 
               AND ect.setectdel = '1'
                ";	
             }else{
             
               $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE ect.hospitalCode5 = '$HospitalID' 
               AND ect.setectdel = '1'
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

          $sqlpersonnel = $sqlpersonnel." ORDER BY ect.ectDate DESC; " ;

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
						<td><center><?php if($rowpersonnel['ect_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel['ect_no']; } ?></center></td>
						<td><center><?php if($rowpersonnel['tms_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel['tms_no']; } ?></center></td>
            <td><center> <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?><a class="btn btn-info btn-sm " href="form_ectedit.php?ectID=<?php echo $rowpersonnel['ID'];?>"">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a><?php } ?>
						<?php if($_SESSION["TypeUser"] == "Admin"){?>
              <a class="btn btn-info btn-sm " href="form_ectedit.php?ectID=<?php echo $rowpersonnel['ID'];?>"">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>	
						<?php } ?>
            </center></td>
					</tr>
					<?php } ?>
				   </tbody>
				</table>

               
                <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                   <tr>
					  <th>#</th>
                      <th><center>ชื่อโรงพยาบาล</center></th>
					  <th><center>จำนวน ECT</center></th>
                      <th><center>จำนวน TMS</center></th>			
					  
					  <?php /*if($_SESSION["TypeUser"] == "Admin"){?>
					  <th>ลบข้อมูล</th>
					  <?php }*/ ?>
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
						<td><center><?php if($rowpersonnel2['ect_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel2['ect_no']; } ?></center></td>
						<td><center><?php if($rowpersonnel2['tms_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel2['tms_no']; } ?></center></td>
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
     // "buttons": [ "csv", "excel", "pdf"]
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
           window.location.href = 'tables-ectall.php'; 
        });

      
</script>

</body>
</html>
