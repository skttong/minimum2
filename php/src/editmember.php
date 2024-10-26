<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

//$PersonnelType	= $_GET['t'];

$UserID = $_GET['id'];

$SQL = "SELECT * 
FROM userhospital u 
JOIN hospitalnew h ON h.CODE5 = u.HospitalID
JOIN prefix p ON p.prefixID = u.prefixID
WHERE u.UserID = '$UserID'
;" ;

$result = mysqli_query($con, $SQL);
$row = mysqli_fetch_array($result);



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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
	  <div class="row mb-2">
		<div class="col-sm-6">

            <!--<h4>แบบฟอร์มบันทึกข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h4>-->
			<?php
		if($_SESSION["TypeUser"] == "Admin"){
			//echo 'แอดมินส่วนกลาง';
		}else{
			$sql_u 		= "SELECT HOS_NAME FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
			$query_u 	= mysqli_query($con, $sql_u);
			$result_u 	= mysqli_fetch_array($query_u);
		  $HOS_NAME = $result_u['HOS_NAME']; 
      $TypeService = $_SESSION["TypeService"];
		}
		?>
            
			<?php /* <h2 class="card-title">แบบบันทึกข้อมูลทรัพยากร   <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h2> */ ?>
		
			<h4>แก้ผู้ใช้งาน <br> 
      
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">แบบฟอร์ม</a></li>
              <li class="breadcrumb-item active"> แก้ผู้ใช้งาน</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<form class="form-valide" action="admin_edit_all.php" method="post" id="myform1" name="foml">
			<input type="hidden" name="UserID" value="<?php echo $UserID; ?>"> 

          

			  <!-- Default box -->
			  <div class="card card-success card-outline">
				<div class="card-header">
				  <h3 class="card-title" style="color: dimgray"> แก้ผู้ใช้งาน</h3>

				  <div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					  <i class="fas fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
					  <i class="fas fa-times"></i>
					</button>
				  </div>
				</div>
				<div class="card-body">

                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label>คำนำหน้า</label><b><span style="color:red;">*</span></b>
                                </div>
                               
                <select name="prename" class="form-control select2" style="width: 100%;" required>
                  <option selected value="<?php echo $row['prefixID']; ?>"><?php echo $row['prefixName']; ?></option>
					<?php
					$sqlprefix = "SELECT * FROM prefix";
					$objprefix = mysqli_query($con, $sqlprefix);
					while($rowrefix = mysqli_fetch_array($objprefix))
					{
					?>
					<option value="<?php echo $rowrefix['prefixID'];?>"><?php echo $rowrefix['prefixName'];?></option>
					<?php
					 }
					?>
                </select>
				<div class="invalid-feedback" style="font-size: 100%">
					โปรดเลือกคำนำหน้าชื่อ
			    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="firstname" class="form-label" style="text-align: left;">ชื่อ <b><small class="text-danger">*</small></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </div>
                                <input  type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $row['Name']; ?>" placeholder="กรอกชื่อ" onkeyup="isThaichar(this.value,this)" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกชื่อ (ภาษาไทยเท่านั้น) </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="lastname" class="form-label">นามสกุล</label> <b><small class="text-danger">*</small></b>
                                </div>
                                <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo $row['Lname']; ?>" placeholder="กรอกนามสกุล" onkeyup="isThaichar(this.value,this)" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกนามสกุล (ภาษาไทยเท่านั้น) </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="telephone" class="form-label" style="text-align: left;">telephone<b></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </div>
                                <input  type="text" name="telephone" class="form-control" id="telephone" value="<?php echo $row['telephone']; ?>" placeholder="telephone" onkeyup="isThaichar(this.value,this)" required>
                               
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="mobile" class="form-label">mobile</label> 
                                </div>
                                <input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $row['mobile']; ?>" placeholder="mobile" onkeyup="isThaichar(this.value,this)" required>
                               
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="useremail" class="form-label" style="text-align: left;">useremail<b></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </div>
                                <input  type="text" name="useremail" class="form-control" id="useremail" value="<?php echo $row['useremail']; ?>" placeholder="useremail" onkeyup="isThaichar(this.value,this)" required>
                               
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="mobile" class="form-label">position</label> 
                                </div>
                                <input type="text" name="position" class="form-control" id="position" value="<?php echo $row['position']; ?>" placeholder="position" onkeyup="isThaichar(this.value,this)" required>
                               
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="username" class="form-label" style="text-align: left;">Username <b><small class="text-danger">*</small></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                </div>
                                <input  type="text" name="username" class="form-control" id="username" value="<?php echo $row['Username']; ?>" placeholder="username" onkeyup="isThaichar(this.value,this)" required>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="password" class="form-label">password</label> <b><small class="text-danger">*</small></b>
                                </div>
                                <input type="text" name="password" class="form-control" id="password" value="<?php echo $row['Password']; ?>" placeholder="password" onkeyup="isThaichar(this.value,this)" required>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="HospitalID" class="form-label">จังหวัด</label>
                                </div>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                  <option selected value="<?php echo $row['NO_PROVINCE']; ?>"><?php echo $row['CODE_PROVINCE']; ?></option>
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
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="HospitalID" class="form-label">โรงพยาบาล</label>
                                </div>
                                <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                                <option selected value="<?php echo $row['CODE5']; ?>"><?php echo $row['HOS_NAME']; ?></option>
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
                    <?php if($row['TypeUser'] == 'Admin'){ ?>
                    <div class="container">
                        <div class="row" style="margin-bottom: 10px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label>ประเภทผู้ใช้งาน</label><b><span style="color:red;">*</span></b>
                                </div>
                               
                <select name="usertype" id="usertype" class="form-control select2" style="width: 100%;" required>
                  <?php if($row['TypeUser'] <> 'Admin'){ ?>
                    <option value="User_h"> ผู้ใช้งาน </option>
                  <?php }else{ ?>  
                    <option value="Admin"> ผู้ดูแลระบบ </option>
                  <?php } ?>  
                  <option value="User_h"> ผู้ใช้งาน </option>
                  <option value="Admin"> ผู้ดูแลระบบ </option>
                </select>
				<div class="invalid-feedback" style="font-size: 100%">
					โปรดเลือกคำนำหน้าชื่อ
			    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php } ?> 
				
				
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> บันทึกข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
			  	  <a href="tables-memberalladmin.php" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
				</div>
				<!-- /.card-footer-->
			  </div>
			  <!-- /.card -->
			
		</form>
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
