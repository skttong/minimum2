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
			<h4>แบบสำรวจความพึ่งพอใจ   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>แบบสำรวจความพึ่งพอใจ   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
          

        
		
		<!-- /.box-header -->
          </div>
          
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">แบบสำรวจความพึ่งพอใจ</a></li>
              <li class="breadcrumb-item active">สรุปแบบสำรวจความพึ่งพอใจ</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
 
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card-body">
			<form class="form-valide" action="tables-surveyapp.php" method="post" id="myform1" name="foml">  
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
                          //alert(selectedValue);
                          $.ajax({
                            url: 'get_affiliationtype.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { codeprovince: selectedValue },
                            success: function(data) {
                              $('#type_Affiliation').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	

              <div class="col-md-3">
               <div class="form-group">
                  <label>หน่วยงานใน/ นอกสังกัดกระทรวงสาธารณสุข</label>
                  <select class="form-control select2" name="type_Affiliation" id="type_Affiliation" style="width: 100%;" onChange="myFunction5()" >
                    <option value="ทั้งหมด" >ทั้งหมด</option>
                    <?PHP 
                       if($_POST['type_Affiliation'] <> ''){
                     ?>
                    <option selected="selected"  value="<?php echo $_POST['type_Affiliation']; ?> "><?php echo $_POST['type_Affiliation']; ?> </option>
                    <?php } ?>
                    <!-- <option value="นอกสังกัด">นอกสังกัด</option>-->
                  </select>
                </div>

                <script>
                   function myFunction5() {
                      const selectedValue = $('#type_Affiliation').val();
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_affiliation2.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { typeAffiliation: selectedValue , codeprovince: codeprovince  },
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
                  <label>สังกัด</label>
                  <select class="form-control select2" name="Affiliation" id="Affiliation" style="width: 100%;" onChange="myFunction15()" >
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
                   function myFunction15() {
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
              <div class="col-md-3">
              <div class="form-group" id="labelservice">
                  <label>ระดับหน่วยงาน/ประเภทหน่วยบริการ</label>
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
                      const Affiliation 		= document.getElementById("Affiliation").value;
                      const codeprovince 		= document.getElementById("CODE_PROVINCE").value;
                      const HostHMOO 		    = document.getElementById("CODE_HMOO").value;
                          //alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue , codeprovince: codeprovince, Affiliation: Affiliation, CODE_HMOO: HostHMOO },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
</div>

              <div class="col-md-4">
               <div class="form-group">
                  <label>หน่วยบริการ/หน่วยงาน</label>
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
				   <button type="reset" class="btn btn-default" id="resetButton"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>
        </div>
        <!-- /.card -->	 
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <!--<div class="card-header">
                <a href="addmember.php" class="btn btn-danger" onclick="showAlert()" > <i class="fa fas fa-plus"></i></a>&nbsp;&nbsp;เพิ่มผู้ใช้งาน &nbsp;
              </div>-->
              <!-- /.card-header -->
              <div class="card-body">
             
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อสถานพยาบาล</th>
                      <th width="5%">1.1</th>
                      <th width="5%">1.2</th>
                      <th width="5%">1.3</th>
                      <th width="5%">1.4</th>
                      <th width="5%">1.5</th>
                      <th width="5%">1.6</th>
                      <th width="5%">1.7</th>
                      <th width="5%">1.8</th>
					  <th width="5%">2.1</th>
                      <th width="5%">2.2</th>
                      <th width="5%">2.3</th>
                      <th width="5%">2.4</th>
                      <th width="5%">2.5</th>
                      <th width="5%">2.6</th>
                      <th width="5%">2.7</th>
                      <th width="5%">2.8</th>
                      <th width="5%">2.9</th>
                      <th width="5%">2.10</th>
                      <th width="5%">3.1</th>
                      <th width="5%">3.2</th>
                      <th width="5%">3.3</th>
                      <th width="5%">3.4</th>
                      <th width="5%">4</th>
                      <th width="50%">5</th>
                      <th width="5%">ลบ</th>

					</tr>
                   </thead>
                  	<tbody>

                    
				 	<?php
					if($_SESSION["TypeUser"] == "Admin"){
					$sqlservice	= "SELECT *
                                    FROM surveyapp s 
                                    JOIN hospitalnew h ON h.CODE5 = s.hospID
                                    WHERE 1 ";

                                    if(isset($_POST["CODE_HOS"])){	
                                        if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
                                            $sqlservice = $sqlservice."AND h.CODE5 = '".$_POST['CODE_HOS']."'" ;
                                        }
                                    }

                                    if(isset($_POST["type_Affiliation"])){	
                                      if(trim($_POST["type_Affiliation"]) <>'ทั้งหมด'){					  
                                          $sqlservice = $sqlservice."AND h.type_Affiliation LIKE ('".$_POST['type_Affiliation']."%')" ;
                                      }
                                  }

                                    if(isset($_POST["TYPE_SERVICE"])){	
                                        if(trim($_POST["TYPE_SERVICE"]) <>'ทั้งหมด'){					  
                                            $sqlservice = $sqlservice."AND h.HOS_TYPE LIKE ('".$_POST['TYPE_SERVICE']."%')" ;
                                        }
                                    }

                                    if(isset($_POST["CODE_PROVINCE"])){	
                                        if($_POST["CODE_PROVINCE"]<>'ทั้งหมด'){					  
                                            $sqlservice = $sqlservice."AND h.NO_PROVINCE LIKE ('".$_POST['CODE_PROVINCE']."')" ;
                                        }
                                    }

                                    if (isset($_POST['CODE_HMOO'])) {
                                        if ($_POST['CODE_HMOO']<> 'ทั้งหมด') {
                                            $sqlservice = $sqlservice."AND h.CODE_HMOO LIKE ('".$_POST['CODE_HMOO']."')" ;    
                                        }
                                    }
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
                        <td><?php echo $rowservice['sur_design1'];?></td>
                        <td><?php echo $rowservice['sur_design2'];?></td>
                        <td><?php echo $rowservice['sur_design3'];?></td>
                        <td><?php echo $rowservice['sur_design4'];?></td>
                        <td><?php echo $rowservice['sur_design5'];?></td>
                        <td><?php echo $rowservice['sur_design6'];?></td>
                        <td><?php echo $rowservice['sur_design7'];?></td>
                        <td><?php echo $rowservice['sur_design8'];?></td>
                        <td><?php echo $rowservice['sur_content1'];?></td>
                        <td><?php echo $rowservice['sur_content2'];?></td>
                        <td><?php echo $rowservice['sur_content3'];?></td>
                        <td><?php echo $rowservice['sur_content4'];?></td>
                        <td><?php echo $rowservice['sur_content5'];?></td>
                        <td><?php echo $rowservice['sur_content6'];?></td>
                        <td><?php echo $rowservice['sur_content7'];?></td>
                        <td><?php echo $rowservice['sur_content8'];?></td>
                        <td><?php echo $rowservice['sur_content9'];?></td>
                        <td><?php echo $rowservice['sur_content10'];?></td>
                        <td><?php echo $rowservice['sur_nextstep1'];?></td>
                        <td><?php echo $rowservice['sur_nextstep2'];?></td>
                        <td><?php echo $rowservice['sur_nextstep3'];?></td>
                        <td><?php echo $rowservice['sur_nextstep4'];?></td>
                        <td><?php echo $rowservice['sur_allaroud'];?></td>
                        <td><?php echo $rowservice['sur_other5'];?></td>
            <td>
                <a href="surveyappdel.php?id=<?php echo $rowservice['serveyid'];?>" onclick="showAlert()" ><button type="button" class="btn btn-block btn-danger" >Delete</button></a>
            </td>
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
                      <th width="5%">1.1 Dashboard มีความสวยงาม ทันสมัย น่าสนใจ</th>
                      <th width="5%">1.2 การจัดรูปแบบในเว็บไซต์ง่ายต่อการอ่านและการใช้งาน</th>
                      <th width="5%">1.3 สีสันในการออกแบบเว็บไซต์มีความเหมาะสม</th>
                      <th width="5%">1.4 เมนูง่ายต่อการใช้งาน</th>
                      <th width="5%">1.5 สีพื้นหลังกับสีตัวหนังสือมีความเหมาะสมต่อการอ่าน</th>
                      <th width="5%">1.6 ขนาด และรูปแบบตัวอักษรชัดเจน อ่านง่ายและสวยงาม</th>
                      <th width="5%">1.7 ภาพที่ใช้สามารถสื่อความหมายได้</th>
                      <th width="5%">1.8 โดยภาพรวมท่านมีความพึงพอใจในการออกแบบเว็บไซต์ในระดับใด</th>
					            <th width="5%">2.1 	การเชื่อมโยงข้อมูลภายในเว็บไซต์ถูกต้อง และสะดวกในการใช้งาน</th>
                      <th width="5%">2.2 ข้อมูลมีการปรับปรุงอยู่เสมอ ถูกต้องและน่าเชื่อถือ</th>
                      <th width="5%">2.3 	ภาษาเข้าใจง่าย กระชับ อธิบายชี้แจงข้อมูลได้ชัดเจน</th>
                      <th width="5%">2.4 ข้อความในเว็บไซต์ถูกต้องตามหลักภาษาและไวยากรณ์</th>
                      <th width="5%">2.5 เนื้อหาเพียงพอกับความต้องการในการนำไปใช้</th>
                      <th width="5%">2.6 การจัดลำดับเนื้อหาเป็นขั้นตอน มีความต่อเนื่อง เข้าใจง่าย</th>
                      <th width="5%">2.7 มีการจัดหมวดหมู่ให้ง่ายต่อการค้นหาและทำความเข้าใจ</th>
                      <th width="5%">2.8 ความเหมาะสมของข้อมูลภายในเว็บไซต์</th>
                      <th width="5%">2.9 	ความรวดเร็วในการดาวน์โหลดข้อมูล</th>
                      <th width="5%">2.10 โดยภาพรวมท่านมีความพึงพอใจในคุณภาพของเนื้อหาระดับใด</th>
                      <th width="5%">3.1 	เนื้อหามีประโยชน์ต่อผู้ใช้งาน และสามารถนำไปประยุกต์ใช้ได้</th>
                      <th width="5%">3.2 เป็นสื่อในการเผยแพร่ข้อมูล ประชาสัมพันธ์ และงานวิจัย</th>
                      <th width="5%">3.3 สามารถเป็นแหล่งความรู้ได้</th>
                      <th width="5%">3.4 เป็นแหล่งข้อมูลที่ตรงกับความต้องการของผู้ใช้งาน</th>
                      <th width="5%">4 ความพึงพอใจโดยภาพรวมเว็บไซต์ทรัพยากรสุขภาพจิตและจิตเวช</th>
                      <th width="5%">5 ข้อเสนอแนะอื่น ๆ ที่ต้องการให้มีการปรับปรุงและพัฒนา</th>

					</tr>
                   </thead>
                  	<tbody>

                    
				 	<?php
					
	
					$objservice2 = mysqli_query($con, $sqlservice2);
					$j = 0;
					while($rowservice2 = mysqli_fetch_array($objservice2))
					{
					?>
					<tr>
						<td><?php echo $j++; ?></td>
						<td><?php echo $rowservice2['HOS_NAME'];?></td>
                        <td><?php echo $rowservice2['sur_design1'];?></td>
                        <td><?php echo $rowservice2['sur_design2'];?></td>
                        <td><?php echo $rowservice2['sur_design3'];?></td>
                        <td><?php echo $rowservice2['sur_design4'];?></td>
                        <td><?php echo $rowservice2['sur_design5'];?></td>
                        <td><?php echo $rowservice2['sur_design6'];?></td>
                        <td><?php echo $rowservice2['sur_design7'];?></td>
                        <td><?php echo $rowservice2['sur_design8'];?></td>
                        <td><?php echo $rowservice2['sur_content1'];?></td>
                        <td><?php echo $rowservice2['sur_content2'];?></td>
                        <td><?php echo $rowservice2['sur_content3'];?></td>
                        <td><?php echo $rowservice2['sur_content4'];?></td>
                        <td><?php echo $rowservice2['sur_content5'];?></td>
                        <td><?php echo $rowservice2['sur_content6'];?></td>
                        <td><?php echo $rowservice2['sur_content7'];?></td>
                        <td><?php echo $rowservice2['sur_content8'];?></td>
                        <td><?php echo $rowservice2['sur_content9'];?></td>
                        <td><?php echo $rowservice2['sur_content10'];?></td>
                        <td><?php echo $rowservice2['sur_nextstep1'];?></td>
                        <td><?php echo $rowservice2['sur_nextstep2'];?></td>
                        <td><?php echo $rowservice2['sur_nextstep3'];?></td>
                        <td><?php echo $rowservice2['sur_nextstep4'];?></td>
                        <td><?php echo $rowservice2['sur_allaroud'];?></td>
                        <td><?php echo $rowservice2['sur_other5'];?></td>
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
      "responsive": false, "lengthChange": false, "autoWidth": false,
   	  "scrollX": 300,
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
           window.location.href = 'tables-surveyapp.php'; 
        });

      
</script>

</body>
</html>
