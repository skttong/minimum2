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
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">
	<?php include "header_font.php"; ?>
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
             <!--<h3>ข้อมูลบริการสุขภาพจิตและจิตเวช</h3>-->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables_detailservice.php">ข้อมูลด้านบริการ</a></li>
              <li class="breadcrumb-item active">บริการสุขภาพจิตและจิตเวช</li>
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
              <div class="card-header bg-lightblue color-palette">
                <h3 class="card-title">ข้อมูลบริการสุขภาพจิตและจิตเวช</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
					  <th width="2%">#</th>
					  <th width="15%">โรงพยาบาล/หน่วยงาน</th>
					  <th width="10%">จังหวัด</th>
					  <th width="10%">สถานะ</th>
					  <th width="8%">รายละเอียด</th>
					</tr>
                   </thead>
                   <tbody>
					 <?php
					/*if($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 	
				  
				  			$sqlpersonnel = "SELECT ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 WHERE hospitalnew.CODE_PROVINCE = '$codeprovince' ORDER BY bed.hospitalCode5 ASC; ";		  
	
			  		}else{
						if($_SESSION["TypeUser"] == "Admin"){ 
							$sqlpersonnel = "SELECT ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 ORDER BY ect.hospitalCode5 ASC; ";
						}else{
							$sqlpersonnel = "SELECT ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 WHERE ect.hospitalCode5 = '$HospitalID' ORDER BY ect.hospitalCode5 ASC; ";
					}
					//}*/
					if($HosType == "ศูนย์วิชาการ"){ 
						$sqlservice	= "SELECT
											serviceform.mhpsID,
											serviceform.HospitalID,
											hospitalnew.HOS_NAME,
											hospitalnew.CODE_PROVINCE,
											serviceform.statusfinal,
											serviceform.qustype
										FROM
											serviceform
											INNER JOIN hospitalnew ON serviceform.HospitalID = hospitalnew.CODE5
										WHERE hospitalnew.CODE_HMOO = '$HosMOHP'
										ORDER BY
											serviceform.mhpsID DESC";
					}elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 
						$sqlservice	= "SELECT
											serviceform.mhpsID,
											serviceform.HospitalID,
											hospitalnew.HOS_NAME,
											hospitalnew.CODE_PROVINCE,
											serviceform.statusfinal,
											serviceform.qustype
										FROM
											serviceform
											INNER JOIN hospitalnew ON serviceform.HospitalID = hospitalnew.CODE5
										WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'
										ORDER BY
											serviceform.mhpsID DESC";
					}elseif($HosType == "กรมสุขภาพจิต"){
						if($_SESSION["TypeUser"] == "User_h09"){ 
						 	$sqlservice	= "SELECT
												serviceform.mhpsID, 
												serviceform.HospitalID, 
												hospitalnew.HOS_NAME, 
												hospitalnew.CODE_PROVINCE, 
												serviceform.statusfinal, 
												serviceform.qustype
											FROM
												serviceform
												INNER JOIN
												hospitalnew
												ON 
													serviceform.HospitalID = hospitalnew.CODE5
											WHERE
												hospitalnew.CODE_HMOO = 'เขต 09'
											ORDER BY
												serviceform.mhpsID DESC";
						}
					}else{
						if($_SESSION["TypeUser"] == "Admin"){ 
							$sqlservice	= "SELECT
												serviceform.mhpsID,
												serviceform.HospitalID,
												hospitalnew.HOS_NAME,
												hospitalnew.CODE_PROVINCE,
												serviceform.statusfinal,
												serviceform.qustype
											FROM
												serviceform
												INNER JOIN hospitalnew ON serviceform.HospitalID = hospitalnew.CODE5
											ORDER BY
											serviceform.mhpsID DESC";
						}
					}
					$objservice = mysqli_query($con, $sqlservice);
					$i = 1;
					while($rowservice = mysqli_fetch_array($objservice))
					{	
						$FID = $rowservice['mhpsID'];
						$HOS = $rowservice['HospitalID'];
					 
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><?php echo $rowservice['HOS_NAME'];?></td>
						<td><?php echo $rowservice['CODE_PROVINCE'];?></td>
						<td>
							<?php 
							if($rowservice['statusfinal'] == 1){
								echo '<i class="fa fa-check" style="color: green"></i>'; 
							}else{
								echo'<i class="fa fa-times" style="color: red"></i>';
							}
							?>
						</td>
						
						<td>
							<?php 
							if($rowservice['qustype'] == 3){//echo 'ตำบล';
								if($rowservice['statusfinal'] == 1){?>
								<a href="hospital_tambon_report.php?FID=<?php echo $FID;?>">ดูรายละเอียด</a>
							<?php }else{ echo '<font color="red">ยังไม่ส่งข้อมูล</font>'; }
							  
							}elseif($rowservice['qustype'] == 2){//echo 'ชุมชน';
								if($rowservice['statusfinal'] == 1){?>
								<a href="hospital_community_report.php?FID=<?php echo $FID;?>">ดูรายละเอียด</a>
							<?php }else{ echo '<font color="red">ยังไม่ส่งข้อมูล</font>'; }
									
							}elseif($rowservice['qustype'] == 1){//echo 'ทั่วไป';
								if($rowservice['statusfinal'] == 1){?>
								<a href="hospital_center_report.php?FID=<?php echo $FID;?>">ดูรายละเอียด</a>
							<?php }else{ echo '<font color="red">ยังไม่ส่งข้อมูล</font>'; }
							} ?>
						</td>
						
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
      "buttons": ["copy", "csv", "excel","print"]
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
