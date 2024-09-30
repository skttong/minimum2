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
			<h4>ข้อมูลเตียง  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลเตียง   <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-2.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">เตียงจิตเวช</li>
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
					  <th rowspan="2">#</th>
					  <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
            <th colspan="2"><center>จำนวนเตียงจิตเวช</center></th>
            <?php  if($HosType == "โรงพยาบาลชุมชน"){ ?>	
            <th rowspan="2"><center>ชนิดเตียงจิตเวช</center></th>
            <th colspan="2"><center>มินิธัญญารักษ์จำนวนเตียงจิตเวช</center></th>
            <?php  } ?>
					  <!--<th>จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด</th>	
					  <th>ผลรวมจำนวน วันนอนผู้ป่วยใน</th>
					  <th>อัตราการครองเตียง</th>	-->		
					  <th rowspan="2"><center>แก้ไขข้อมูล</center></th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th rowspan="2">ลบข้อมูล</th>
					  <?php } ?>
					</tr>
          <tr>
            <th><center>เตียงผู้หญิง</center></th>	
					  <th><center>เตียงผู้ชาย</center></th>
            <?php  if($HosType == "โรงพยาบาลชุมชน"){ ?>
            <th><center>เตียงผู้หญิง</center></th>	
					  <th><center>เตียงผู้ชาย</center></th>
            <?php  } ?>
					  <!--<th>จำนวนผู้ป่วยจิตเวชและยาเสพติดจำหน่ายทั้งหมด</th>	
					  <th>ผลรวมจำนวน วันนอนผู้ป่วยใน</th>
					  <th>อัตราการครองเตียง</th>	-->		
				
					</tr>
                   </thead>
                   <tbody>
					 <?php
					 if($HosType == "กรมสุขภาพจิต"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							AND bed.setbeddel = '1'
							ORDER BY bed.bedDate DESC; ";
	
			  		}elseif($HosType == "ศูนย์วิชาการ"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							AND bed.setbeddel = '1'
							ORDER BY bed.bedDate DESC; ";
	
			  		}elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 
				  			$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'  
							AND bed.setbeddel = '1'
							ORDER BY bed.bedDate DESC; ";
	
			  		}else{
						if($_SESSION["TypeUser"] == "Admin"){ 
							$sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE bed.setbeddel = '1' 
							ORDER BY bed.bedDate DESC; ";
						}else{
							 $sqlpersonnel = "SELECT bed.bedID, bed.hospitalCode5, bed.Wardall, bed.Ward_no, bed.Unit, bed.Unit_no, bed.Integrate, bed.Integrate_no, bed.bedDate ,bed.TN2, bed.MM1, bed.MM2, bed.MM3, hospitalnew.HOS_NAME FROM bed join hospitalnew ON hospitalnew.CODE5 = bed.hospitalCode5 
							WHERE bed.hospitalCode5 = '$HospitalID' 
							AND bed.setbeddel = '1'
							ORDER BY bed.bedDate DESC; ";
						}
					 }
					$objpersonnel = mysqli_query($con, $sqlpersonnel);
					$i = 1;
					while($rowpersonnel = mysqli_fetch_array($objpersonnel))
					{
					?>
					<tr>
						<td><?php echo $i++; ?></td>
					
						<td><center><?php echo $rowpersonnel['Wardall'];?></center></td>
						<td><center><?php echo $rowpersonnel['Unit']; ?></center></td>
						<td><center><?php echo $rowpersonnel['Unit_no'];?></center></td>
            <?php  if($HosType == "โรงพยาบาลชุมชน"){ ?>

            <td><center><?php echo $rowpersonnel['TN2'];?></center></td>
						<td><center><?php echo $rowpersonnel['MM2']; ?></center></td>
						<td><center><?php echo $rowpersonnel['MM3'];?></center></td>

            <?php } ?>
						<?php /* <td><center><?php echo $rowpersonnel['Unit_no']; ?></center></td>
						<td><center><?php echo $rowpersonnel['Integrate'];?></center></td>
						<td><center><?php echo $rowpersonnel['Integrate_no']; ?></center></td>*/ ?>
           
            <td><center>
              <a class="btn btn-info btn-sm " href="form_bededit.php?bedID=<?php echo $rowpersonnel['bedID'];?>">
              แก้ไขข้อมูล/ลบ
							</a>
              <!--<a href="personnel_del.php?bedID=<?php //$rowpersonnel['bedID'];?>&&t=0;&&detail=bed">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>-->
              </center>
            </td>
						<?php if($_SESSION["TypeUser"] == "Admin"){?>
						<td><center>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a href="personnel_del.php?bedID=<?=$rowpersonnel['bedID'];?>&&t=0;&&detail=bed">
								<!--<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>-->
                แก้ไขข้อมูล/ลบ
							</a>
						</center>
						</td>
						<?php } ?>
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
      "buttons": [ "csv", "excel", "pdf"]
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
