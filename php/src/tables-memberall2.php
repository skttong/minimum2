<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

//$PersonnelType	= $_GET['t'];
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>   

  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">

  <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
    <meta http-equiv="Refresh" content="0;URL=tables-memberalladmin.php">
	<?php } ?>
	
	<?php include "header_font.php"; ?>
	
<style>
/* Float cancel and delete buttons and add an equal width */
.cancelbtn, .deletebtn {
  /*float: left;*/
  width: 100%;
}

/* Add a color to the cancel button */
.cancelbtn {
  background-color: #ccc;
  color: black;
}

/* Add a color to the delete button */
.deletebtn {
  background-color: #f44336;
}

/* Add padding and center-align text to the container */
.container {
  padding: 16px;
  text-align: center;
  width: 100%;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  /*left: 230px;*/
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 8%;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% 15% 15% auto; /* 5% from the top, 15% from the bottom and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 60%; /* Could be more or less, depending on screen size */
}

/* Style the horizontal ruler 
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}*/
 
/* The Modal Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
	
.flex-container {
  display: flex;
  flex-direction: row;
  font-size: 30px;
  text-align: center;
}

.flex-item-left {
  /*background-color: #f1f1f1;*/
  padding: 5px;
  flex: 50%;
}

.flex-item-right {
 /* background-color: dodgerblue;*/
  padding: 5px;
  flex: 50%;
}
	
/* Responsive layout - makes a one column-layout instead of two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
}
}
	
/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}
	
/* Change styles for cancel button and delete button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .deletebtn {
     width: 100%;
  }
}
.modal-backdrop {
    z-index: 0  !important;
}
}
.modal-backdrop {
    --bs-backdrop-zindex: 1050 !important;
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
			<h4>ข้อมูลผู้ประสานข้อมูล   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลผู้ประสานข้อมูล   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
          

        
		
		<!-- /.box-header -->
          </div>
          
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">รายชื่อ</a></li>
              <li class="breadcrumb-item active">ผู้ประสานข้อมูล</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
 
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card-body">
			<form class="form-valide" action="tables-memberall2.php" method="post" id="myform1" name="myform1">  
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


        </div>
        <!-- /.card -->	 
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <!--<div class="card-header bg-olive color-palette">
                <h3 class="card-title">รายชื่อผู้ประสานข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h3>
              </div>-->
              <!-- /.card-header -->
              <div class="card-body">
				
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อสถานพยาบาล</th>
                      <th width="8%">อำเภอ</th>
					  <th width="5%">ระดับ</th>
					 
					  <th width="5%">สังกัด</th>
					  <th width="10%">ผู้ส่งข้อมูล</th>
					  <th width="5%">สถานะการลงทะเบียน</th>
					  <!--<th width="5%">เขต</th>
					  <th width="8%">วันที่ลงทะเบียน</th>
            <th width="5%">จัดการ</th>-->
					  <?php /*if($_SESSION["TypeUser"] == "Admin"){ ?>
					  <th width="5%">จัดการ</th>
					  <?php } */?>

					</tr>
                   </thead>
                  	<tbody>
				 	<?php
					if($_SESSION["TypeUser"] == "Admin"){
					$sqlservice	= "SELECT										
										prefix.prefixName, 
										userhospital.`Name`, 
										userhospital.Lname, 
										userhospital.telephone, 
										userhospital.mobile, 
										userhospital.HospitalID, 
										hospitalnew.HOS_NAME,
										hospitalnew.HOS_TYPE, 
										hospitalnew.CODE_PROVINCE, 
										hospitalnew.CODE_HMOO, 
										userhospital.`regupdate`,
                    userhospital.`position`,
										DATE_FORMAT(regupdate,'%d') AS D_Reg,
										DATE_FORMAT(regupdate,'%c') AS M_Reg,
										DATE_FORMAT(regupdate,'%Y')+543 AS Y_Reg
									FROM
									userhospital
									INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
									INNER JOIN prefix ON userhospital.prefixID = prefix.prefixID 
									WHERE
										userhospital.stausloginfirst = 1
									ORDER BY
										userhospital.regupdate DESC";
					}elseif($_SESSION["TypeUser"] == "User_h09"){ 
						 	$sqlservice	= "SELECT
												prefix.prefixName, 
												userhospital.`Name`, 
												userhospital.Lname, 
												userhospital.telephone, 
												userhospital.mobile, 
												userhospital.HospitalID, 
												hospitalnew.HOS_NAME, 
												hospitalnew.HOS_TYPE, 
												hospitalnew.CODE_PROVINCE, 
												hospitalnew.CODE_HMOO, 
												userhospital.regupdate, 
                        userhospital.position,
												DATE_FORMAT( regupdate, '%d' ) AS D_Reg, 
												DATE_FORMAT( regupdate, '%c' ) AS M_Reg, 
												DATE_FORMAT( regupdate, '%Y' )+ 543 AS Y_Reg
											FROM
												userhospital
												INNER JOIN
												hospitalnew
												ON 
													userhospital.HospitalID = hospitalnew.CODE5
												INNER JOIN
												prefix
												ON 
													userhospital.prefixID = prefix.prefixID
											WHERE
												userhospital.stausloginfirst = 1 AND
												hospitalnew.CODE_HMOO = 'เขต 09'
											ORDER BY
												userhospital.regupdate DESC";
					}else{
              $sqlservice	= "SELECT *
                            FROM userhospital 
                            INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
                            left JOIN prefix ON userhospital.prefixID = prefix.prefixID
                            WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
                            AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
                            AND hospitalnew.CODE_HMOO = '$HosMOHP'";
                           if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){					  
                            $sqlservice = $sqlservice."AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
                          }
                          // AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
                          if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){					  
                            $sqlservice = $sqlservice."AND hospitalnew.CODE_DISTRICT LIKE  '%$CODE_DISTRICT'
                            AND hospitalnew.HOS_TYPE <>'โรงพยาบาลชุมชน' AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขอำเภอ'  AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขจังหวัด'
				                    AND hospitalnew.HOS_TYPE <>'ศูนย์วิชาการ' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลทั่วไป' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลศูนย์'
                            
                            " ;
                          }

                         
          }

          if(isset($_POST["CODE_HOS"])){	
            if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
              $sqlservice = $sqlservice."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
            }
          }

          if(isset($_POST["type_Affiliation"])){	
            if(trim($_POST["type_Affiliation"]) <>'ทั้งหมด'){					  
              $sqlservice = $sqlservice."AND hospitalnew.type_Affiliation LIKE ('".trim($_POST['type_Affiliation'])."%')" ;
            }
          }
          
					if(isset($_POST["TYPE_SERVICE"])){	
						if(trim($_POST["TYPE_SERVICE"]) <>'ทั้งหมด'){					  
							$sqlservice = $sqlservice."AND hospitalnew.HOS_TYPE LIKE ('".$_POST['TYPE_SERVICE']."%')" ;
						}
					}

					if(isset($_POST["CODE_PROVINCE"])){	
						if($_POST["CODE_PROVINCE"]<>'ทั้งหมด'){					  
							$sqlservice = $sqlservice."AND hospitalnew.NO_PROVINCE LIKE ('".$_POST['CODE_PROVINCE']."')" ;
						}
					}

          $sqlservice = $sqlservice." ORDER BY stausloginfirst DESC " ;

          $sqlservice2 =$sqlservice;
	
					$objservice = mysqli_query($con, $sqlservice);
					$i = 1;
					while($rowservice = mysqli_fetch_array($objservice))
					{
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $rowservice['HOS_NAME'];?></td>
                        <td><?php echo $rowservice['CODE_DISTRICT'];?></td>
                        <td><?php echo $rowservice['TYPE_SERVICE'];?></td>
                        <td><?php echo $rowservice['Affiliation'];?></td>
                        <td><center><?php //echo $rowservice['UserID'];?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i; ?>">
                        รายละเอียด
                        </button>
                        <div class="modal fade" id="exampleModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">   

                            

                                <h5 class="modal-title" id="exampleModalLabel">รายชื่อ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">   

                                ชื่อ : <?php echo $rowservice['prefixName'].$rowservice['Name'].' '.$rowservice['Lname'];?>
                                <br>
                                ตำแหน่ง :<?php echo $rowservice['position'];?>
                                <br>
                                เบอร์โทรสำนักงาน :<?php echo $rowservice['telephone'];?>
                                <br>
                                เบอร์โทรมือถือ :<?php echo $rowservice['mobile'];?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                            </div>
                            </div>
                        </div>
                        </div>
                        </center>
                    </td>
                        <td><?php if($rowservice['stausloginfirst'] == 1){
                                    echo "ลงทะเบียนแล้ว";
                                }else{
                                    echo "ยังไม่ได้ลงทะเบียน";
                                }?></td>
            
                        
                        <?php /* 			<td><?php echo $rowservice['telephone'].' /<br> '.$rowservice['mobile'];?></td>
					 
         <td><?php echo $rowservice['HospitalID'];?></td>
						<td><?php echo $rowservice['HOS_NAME'];?></td>
						<td><?php echo $rowservice['CODE_PROVINCE'];?></td>
						<td><?php echo $rowservice['CODE_HMOO'];?></td>
						<td><?php echo $rowservice['D_Reg'].' '.$a_mthai[$rowservice['M_Reg']].' '.$rowservice['Y_Reg'];?></td>
            */ ?>
						<?php /* if($_SESSION["TypeUser"] == "Admin"){ ?>
						<td>
							<button type="button" class="btn btn-block btn-primary" onclick="document.getElementById('id<?php echo $i; ?>').style.display='block'">Reset</button>
							<?php //echo $i; ?>
							<div id="id<?php echo $i; ?>" class="modal">
							  <span onclick="document.getElementById('id<?php echo $i; ?>').style.display='none'" class="close" title="Close Modal">×</span>

							  <form class="modal-content" action="update_resetaccount.php" method="post">
								<div class="container">
								  <h3>Reset Account</h3>
								  <input type="hidden" name="HospitalID" value="<?php echo $rowservice['HospitalID']?>">
								  <p>
									  ต้องการรีเซ็ตข้อมูลของ &nbsp;<b><?php echo $rowservice['prefixName'].$rowservice['Name'].' '.$rowservice['Lname'];?></b><br>
									  <?php echo $rowservice['HospitalID'].' '.$rowservice['HOS_NAME'].' '.$rowservice['CODE_HMOO'].' '.$rowservice['CODE_PROVINCE'];?>
								  </p>
								  <p><b>ยืนยันรีเซ็ตข้อมูล ?</b></p>

									   <div class="flex-container">
										  <div class="flex-item-left" style="al">
											  <button type="reset" onclick="document.getElementById('id<?php echo $i; ?>').style.display='none'" class="cancelbtn btn btn-secondary  btn-lg">Cancel</button>
										   </div>
										  <div class="flex-item-right">
										   <button type="submit" onclick="document.getElementById('id<?php echo $i; ?>').style.display='none'" class="deletebtn btn btn-danger btn-lg" disabled>Reset</button>
										   </div>
										</div>	

								</div>
							  </form>

							</div>
						</td>
						<?php /* } */?>
					</tr>
					
					<?php } ?> 	
					</tbody>
				  </table>
				    <script>
					// Get the modal
					var modal = document.getElementById('id01');

					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					  if (event.target == modal) {
						modal.style.display = "none";
					  }
					}
					</script>	


<table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                   <tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อสถานพยาบาล</th>
                      <th width="8%">อำเภอ</th>
					  <th width="5%">ระดับ</th>
					 
					  <th width="5%">สังกัด</th>
					  <th width="10%">ชื่อ</th>
            <th width="10%">ตำแหน่ง</th>
            <th width="10%">เบอร์โทรสำนักงาน</th>
					  <th width="5%">สถานะการลงทะเบียน</th>
					  

					</tr>
                   </thead>
                  	<tbody>
				 	<?php
					
	
					$objservice2 = mysqli_query($con, $sqlservice2);
					$j = 1;
					while($rowservice2 = mysqli_fetch_array($objservice2))
					{
					?>
					<tr>
						<td><?php echo $j++; ?></td>
						<td><?php echo $rowservice['HOS_NAME'];?></td>
            <td><?php echo $rowservice2['CODE_DISTRICT'];?></td>
            <td><?php echo $rowservice2['TYPE_SERVICE'];?></td>
            <td><?php echo $rowservice2['Affiliation'];?></td>
            <td><?php echo $rowservice2['prefixName'].$rowservice2['Name'].' '.$rowservice2['Lname'];?></td>
            <td><?php echo $rowservice2['position'];?></td>
            <td><?php echo $rowservice2['telephone'].' /<br> '.$rowservice2['mobile'];?></td>
            <td><?php if($rowservice2['stausloginfirst'] == 1){
                                                echo "ลงทะเบียนแล้ว";
                                            }else{
                                                echo "ยังไม่ได้ลงทะเบียน";
                                            }?></td>		
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
      //"buttons": ["copy", "csv", "excel", "pdf", "print"]
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
           window.location.href = 'tables-memberall2.php'; 
        });

      
</script>

</body>
</html>
