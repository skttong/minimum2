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
  <?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-ectall.php">
	<?php }else if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-ectall.php">
	<?php }else if($_SESSION["HosType"] == 'ศูนย์วิชาการ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-ectall.php">
	<?php }else if($_SESSION["HosType"] == 'กรมสุขภาพจิต'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-ectall.php">
	<?php } ?>

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
			$sql_u 		= "SELECT HOS_NAME FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
			$query_u 	= mysqli_query($con, $sql_u);
			$result_u 	= mysqli_fetch_array($query_u);
		  $HOS_NAME = $result_u['HOS_NAME']; 
      $TypeService = $_SESSION["TypeService"];
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
					  <th><center>จำนวน ECT</center></th>
            <th><center>จำนวน TMS</center></th>			
					  <th><center>แก้ไขข้อมูล</center></th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th>ลบข้อมูล</th>
					  <?php } ?>
					</tr>
                   </thead>
                   <tbody>
					 <?php
					 
           if($HosType == "กรมสุขภาพจิต"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
               AND ect.setectdel = '1'
               ORDER BY ect.ectDate DESC; ";	
             }elseif($HosType == "ศูนย์วิชาการ"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
               AND ect.setectdel = '1'
               ORDER BY ect.ectDate DESC; ";	
             }elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 	
                 $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE hospitalnew.CODE_PROVINCE = '$codeprovince' 
               AND ect.setectdel = '1'
               ORDER BY ect.ectDate DESC; ";	
             }else{
             if($_SESSION["TypeUser"] == "Admin"){ 
               $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE ect.setectdel = '1'
               ORDER BY ect.ectDate DESC; ";
             }else{
               $sqlpersonnel = "SELECT ect.ID, ect.hospitalCode5, ect.ect, ect.ect_no, ect.tms, ect.tms_no, ect.ectDate, hospitalnew.HOS_NAME FROM ect join hospitalnew ON hospitalnew.CODE5 = ect.hospitalCode5 
               WHERE ect.hospitalCode5 = '$HospitalID' 
               AND ect.setectdel = '1'
               ORDER BY ect.ectDate DESC; ";
           }
           }

           $sqlpersonnel2 = $sqlpersonnel;
           
           $objpersonnel = mysqli_query($con, $sqlpersonnel);
           $i = 1;
           while($rowpersonnel = mysqli_fetch_array($objpersonnel))
 
           {
           
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td><center><?php if($rowpersonnel['ect_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel['ect_no']; } ?></center></td>
						<td><center><?php if($rowpersonnel['tms_no'] == ''){ echo 'ไม่มี';}else{ echo $rowpersonnel['tms_no']; } ?></center></td>
            <td><center><a class="btn btn-info btn-sm " href="form_ectedit.php?ectID=<?php echo $rowpersonnel['ID'];?>"">
									<i class="fas fa-pencil-alt"></i> แก้ไขข้อมูล/ลบ
								  </a>	</center></td>
						<?php if($_SESSION["TypeUser"] == "Admin"){?>
						<td><center>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a href="personnel_del.php?bedID=<?=$rowpersonnel['bedID'];?>&&t=0;&&detail=bed">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>
						</center>
						</td>
						<?php } ?>
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
</body>
</html>
