<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

//$PersonnelType	= $_GET['t'];

$SQL = "SELECT 
 SUM(CASE WHEN userhospital.stausloginfirst = '0' THEN 1 ELSE 0 END) AS TC01,
 SUM(CASE WHEN userhospital.stausloginfirst = '1' THEN 1 ELSE 0 END) AS TC02
FROM userhospital 
INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
left JOIN prefix ON userhospital.prefixID = prefix.prefixID
WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
;" ;

$result = mysqli_query($con, $SQL);
$row = mysqli_fetch_array($result);

 $TC01 = $row['TC01']; 
 $TC02 = $row['TC02']; 




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

  <?php /*if($_SESSION["TypeUser"] <> "Admin"){ ?>
    <meta http-equiv="Refresh" content="0;URL=tables-memberall.php">
	<?php } */ ?>
	
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
			<form class="form-valide" action="tables-memberalladmin.php" method="post" id="myform1" name="foml">  
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
            */ ?>
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
              <div class="col-md-2">
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
		<div class="col-md-12 col-sm-12 col-12">
        <div class="row justify-content-center" >
			<div class="col-lg-3">
				<!-- small card -->
				<div class="small-box" style="background-color: #f08080; color: black;">
				  <div class="inner">
                    
                    <p>ยังไม่ได้ลงทะเบียน</p>
                    <h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo $TC01;?></h3>
    
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
			  <div class="col-lg-3">
				<!-- small card -->
				<div class="small-box" style="background-color: #AADFEF; color: black;">
				  <div class="inner">
                    
                    <p>ลงทะเบียนแล้ว</p>
					          <h3><i class="fas fa-user" style="color:#FFFFFF;">&nbsp;</i><?php echo $TC02;?></h3>
					
				  </div>
				  
				 <!-- <a href="#" class="small-box-footer">
					More info <i class="fas fa-arrow-circle-right"></i>
				  </a>-->
				</div>
			  </div>
			  <!-- ./col -->
        </div>
			</div>
			<!-- ./row -->	
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <a href="addmember.php" class="btn btn-danger" onclick="showAlert()" > <i class="fa fas fa-plus"></i></a>&nbsp;&nbsp;เพิ่มผู้ใช้งาน &nbsp;
              </div>
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
            <th width="5%">online</th>
					  <!--<th width="5%">เขต</th>
					  <th width="8%">วันที่ลงทะเบียน</th>
            <th width="5%">จัดการ</th>-->
					  <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
					  <th width="5%">จัดการ</th>
            <th width="5%">แก้ไข</th>
            <th width="5%">ลบ</th>
					  <?php } ?>

					</tr>
                   </thead>
                  	<tbody>
				 	<?php
					if($_SESSION["TypeUser"] == "Admin"){
					$sqlservice	= "SELECT *
                            FROM userhospital 
                            INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
                            left JOIN prefix ON userhospital.prefixID = prefix.prefixID
                            WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
                            AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'";

if(isset($_POST["CODE_HOS"])){	
  if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
    $sqlservice = $sqlservice."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
  }
}
if(isset($_POST["TYPE_SERVICE"])){	
  if(trim($_POST["TYPE_SERVICE"]<>'ทั้งหมด')){					  
    $sqlservice = $sqlservice."AND hospitalnew.TYPE_SERVICE LIKE ('".$_POST['TYPE_SERVICE']."%')" ;
  }
}

if(isset($_POST["CODE_PROVINCE"])){	
  if($_POST["CODE_PROVINCE"]<>'ทั้งหมด'){					  
    $sqlservice = $sqlservice."AND hospitalnew.NO_PROVINCE LIKE ('".$_POST['CODE_PROVINCE']."')" ;
  }
}

if($_POST["CODE_HMOO"]==''){	  
    $sqlservice = $sqlservice."AND hospitalnew.NO_PROVINCE = '99' " ;
}else{
  if(isset($_POST["CODE_HMOO"])){	
    if($_POST["CODE_HMOO"]<>'ทั้งหมด'){					  
      $sqlservice = $sqlservice."AND hospitalnew.CODE_HMOO LIKE ('".$_POST['CODE_HMOO']."')" ;
    }
  }
 
}

$sqlservice = $sqlservice." ORDER BY
userhospital.stausloginfirst  DESC " ;

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
                           AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
                          if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){					  
                            $sqlservice = $sqlservice."AND hospitalnew.CODE_DISTRICT LIKE  '%$CODE_DISTRICT'" ;
                          }

                          if(isset($_POST["CODE_HOS"])){	
                            if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
                              $sqlservice = $sqlservice."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
                            }
                          }

                          $sqlservice = $sqlservice."ORDER BY
												    userhospital.stausloginfirst  DESC " ;
          }

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
             <td><?php echo $rowservice['lock'];?></td>
						<?php  if($_SESSION["TypeUser"] == "Admin"){ ?>
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
										   <button type="submit" onclick="document.getElementById('ids<?php echo $i; ?>').style.display='none'" class="deletebtn btn btn-danger btn-lg" >Reset</button>
										   </div>
										</div>	

								</div>
							  </form>

							</div>
						</td>
            <td>
                <a href="editmember.php?id=<?php echo $rowservice['UserID'];?>" onclick="showAlert()" ><button type="button" class="btn btn-block btn-info" >Edit</button></a>
            </td>
            <td>
                <a href="admin_del_all.php?id=<?php echo $rowservice['UserID'];?>" onclick="showAlert()" ><button type="button" class="btn btn-block btn-danger" >Delete</button></a>
            </td>
						<?php  } ?>
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



<table id="example3" class="table table-bordered table-striped" hidden >
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
</body>
</html>
