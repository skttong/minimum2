<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');
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

</head>
<body class="hold-transition sidebar-mini" style="font-size: 16px;">
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
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
              <div class="card-header">
                <h3 class="card-title">รายงานจำนวนบุคลากร แบ่งตามเขต</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ตำแหน่ง</th>
					<th>เขต 1</th>
                    <th>เขต 2</th>
                    <th>เขต 3</th>
                    <th>เขต 4</th>
					<th>เขต 5</th>
                    <th>เขต 6</th>
					<th>เขต 7</th>
                    <th>เขต 8</th>
					<th>เขต 9</th>
                    <th>เขต 10</th>
					<th>เขต 11</th>
                    <th>เขต 12</th>
					<th>เขต 13</th>
                  </tr>
                  </thead>
					<?php 
					$sql = "SELECT
								 Posi.Ptypename,
								 Posi.Ptype,
								 (SELECT count(personnel.HospitalID)
								  FROM personnel
								  INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5
								  WHERE
										personnel.positiontypeID = Posi.Ptype
									AND hospitalnew.CODE_HMOO = 'เขต 02'
								  group BY personnel.positiontypeID ) as 'ket2',
								  
								 (SELECT count(personnel.HospitalID)
								  FROM personnel
								  INNER JOIN hospitalnew ON personnel.HospitalID = hospitalnew.CODE5
								  WHERE
										personnel.positiontypeID = Posi.Ptype
									AND hospitalnew.CODE_HMOO = 'เขต 03'
								  group BY
										personnel.positiontypeID ) as 'ket3'
										
							FROM
							 	personneltype AS Posi
							"; 
					$query	= mysqli_query($con, $sql);
					?>
                  <tbody>
				  <?php  
					  while($result = mysqli_fetch_array($query)){
						  
					  	  $HOS_POSITION		= $result['Ptypename'];
						  $COUNTY2 			= $result['ket2'];
						  $COUNTY3 			= $result['ket3'];
					?>
                  <tr>
                    <td><?php echo $HOS_POSITION ; ?></td>
					<td>-</td>
                    <td><?php if($COUNTY2 <> ''){ echo $COUNTY2 ; }else{ echo '-' ; } ?></td>
                    <td><?php if($COUNTY3 <> ''){ echo $COUNTY3 ; }else{ echo '-' ; } ?></td>
                    <td>-</td>
                    <td>-</td>
					<td>-</td>
                    <td>-</td>
					<td>-</td>
                    <td>-</td>
					<td>-</td>
                    <td>-</td>
					<td>-</td>
                    <td>-</td>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
