<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];

$PersonnelType	= $_GET['t'];
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
  padding-top: 50px;
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
          <div class="col-sm-6">
             <!--<h3>บุคลากรสุขภาพจิตและจิตเวช</h3>-->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-maindetail.php">สำหรับแอดมิน</a></li>
              <li class="breadcrumb-item active">รายชื่อผู้ประสานข้อมูล</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header bg-olive color-palette">
                <h3 class="card-title">รายชื่อผู้ประสานข้อมูลบุคลากรสุขภาพจิตและจิตเวช</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th width="2%">#</th>
					  <th width="12%">ชื่อ-นามสกุล</th>
					  <th width="5%">เบอร์โทร</th>
					  <th width="8%">ประเภท</th>
					  <th width="5%">รหัสหน่วยงาน</th>
					  <th width="10%">หน่วยงาน</th>
					  <th width="5%">จังหวัด</th>
					  <th width="5%">เขต</th>
					  <th width="8%">วันที่ลงทะเบียน</th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
					  <th width="5%">จัดการ</th>
					  <?php } ?>

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
					}
	
					$objservice = mysqli_query($con, $sqlservice);
					$i = 1;
					while($rowservice = mysqli_fetch_array($objservice))
					{
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $rowservice['prefixName'].$rowservice['Name'].' '.$rowservice['Lname'];?></td>
						<td><?php echo $rowservice['telephone'].' /<br> '.$rowservice['mobile'];?></td>
						<td><?php echo $rowservice['HOS_TYPE'];?></td>
						<td><?php echo $rowservice['HospitalID'];?></td>
						<td><?php echo $rowservice['HOS_NAME'];?></td>
						<td><?php echo $rowservice['CODE_PROVINCE'];?></td>
						<td><?php echo $rowservice['CODE_HMOO'];?></td>
						<td><?php echo $rowservice['D_Reg'].' '.$a_mthai[$rowservice['M_Reg']].' '.$rowservice['Y_Reg'];?></td>
						<?php/*<td></td>
						*/?>
						<?php if($_SESSION["TypeUser"] == "Admin"){ ?>
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
						<?php } ?>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
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
</body>
</html>
