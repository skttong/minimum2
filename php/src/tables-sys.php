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
		<meta http-equiv="Refresh" content="0;URL=tables-sysall.php">
	<?php }else if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-sysall.php">
	<?php }else if($_SESSION["HosType"] == 'ศูนย์วิชาการ'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-sysall.php">
	<?php }else if($_SESSION["HosType"] == 'กรมสุขภาพจิต'){ ?>
		<meta http-equiv="Refresh" content="0;URL=tables-sysall.php">
    <?php }else if($_SESSION["TypeUser"] == "Admin"){ ?>
      <meta http-equiv="Refresh" content="0;URL=tables-sysall.php">
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
			<h4>ข้อมูลระบบบริการจิตเวช  <?php echo $HOS_NAME ." ระดับ ".$TypeService ;?>  </h4>
          <?php }else{ ?>
			<h4>ข้อมูลระบบบริการจิตเวช  <?php echo $HOS_NAME ;?>  </h4>
         <?php } ?> 
        
		
		<!-- /.box-header -->
          </div>
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tables-2.php">รายละเอียดข้อมูล</a></li>
              <li class="breadcrumb-item active">บริการ</li>
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
                      <th>ข้อมูลระบบบริการจิตเวช</th>			
					  <th>เพิ่มปรับปรุงข้อมูล</th>
            <th>ลบข้อมูล</th>
            <th>ส่งข้อมูล</th>
					  <?php if($_SESSION["TypeUser"] == "Admin"){?>
					  <th>ลบข้อมูล</th>
					  <?php } ?>
					</tr>
                   </thead>
                   <tbody>
					 <?php
					 if($HosType == "กรมสุขภาพจิต"){ 
            $sqlpersonnel = "SELECT * 
            FROM serviceform
            join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID						
            WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
            ORDER BY serviceform.mhpsDate DESC; ";
	
			  		}elseif($HosType == "ศูนย์วิชาการ"){ 
				  			
              $sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID						
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							ORDER BY serviceform.mhpsDate DESC; ";
	
			  		}elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 
              $sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
							WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'  
							ORDER BY serviceform.mhpsDate DESC; ";
	
			  		}else{
						if($_SESSION["TypeUser"] == "Admin"){ 
							$sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
							ORDER BY serviceform.mhpsDate DESC; ";
						}else{
							$sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
							WHERE serviceform.HospitalID = '$HospitalID' 
							ORDER BY serviceform.mhpsDate DESC; ";
						}
					 }
					$objpersonnel = mysqli_query($con, $sqlpersonnel);
					$i = 1;
					while($rowpersonnel = mysqli_fetch_array($objpersonnel))
					{
            if($rowpersonnel['qustype']== '1'){
          ?>
            <tr>
						<td><?php echo $i++; ?></td>
						<td>
							<a href="hospital_center_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a></td>
          <?php if($rowpersonnel['statusfinal'] == '1'){ ?>
            <td colspan='3'>
            <i class="fa fa-edit" style="color:darkgreen; font-size: 16pt">ดำเนินการส่งข้อมูลแล้ว</i>
            </td>
					<?php	
					}else{
            ?>
						<td>
              <a href="hospital_center_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a></td>
             <?php } ?> 
             
						<?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
						<td><center>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>
						</center>
						</td>
						<?php } ?>
					</tr>
          <?php
            }elseif($rowpersonnel['qustype']== '2'){
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td>
							<a href="hospital_community_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a></td>
              <?php if($rowpersonnel['statusfinal'] == '1'){ ?>
                <td colspan='3'>
            <i class="fa fa-edit" style="color:darkgreen; font-size: 16pt">ดำเนินการส่งข้อมูลแล้ว</i>
            </td>
					
					<?php	
					}else{
            ?>
						<td>
              <a href="hospital_community_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a></td>
              <?php } ?>

             
						<?php if($_SESSION["TypeUser"] == "Admin"){?>
						<td><center>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a href="hospital_del.php?bedID=<?=$rowpersonnel['mhpsID'];?>&&t=0;&&detail=bed">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>
						</center>
						</td>
						<?php } ?>
					</tr>
          <?php
            }elseif($rowpersonnel['qustype']== '3'){
					?>
					<tr>
						<td><?php echo $i++; ?></td>
						<td>
							<a href="hospital_tambon_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a></td>
              <?php if($rowpersonnel['statusfinal'] == '1'){ ?>
                <td colspan='3'>
            <i class="fa fa-edit" style="color:darkgreen; font-size: 16pt">ดำเนินการส่งข้อมูลแล้ว</i>
            </td>
					
					<?php	
					}else{
					?>
						<td>
              <a href="hospital_tambon_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a></td>
              <td>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a></td>
					<?php	
					}
					?>
						

             
						<?php if($_SESSION["TypeUser"] == "Admin"){?>
						<td><center>
							<!--
							<a href="personnel_form_edit.php?personnelID=<?//=$rowpersonnel['personnelID'];?>&&positionAllID=<?//=$rowpersonnel['positiontypeName'];?>">
								<i class="fa fa-edit" style="color:darkgreen; font-size: 16pt"></i>
							</a> -->
							<a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>&&t=0;&&detail=bed">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt"></i>
							</a>
						</center>
						</td>
						<?php } ?>
					</tr>
					<?php 
        }
        } 
        ?>
				   </tbody>
				</table>

        <table id="example3" class="table table-bordered table-striped" hidden>
                  <thead>
                   <tr>
					  <th>#</th>
                      <th>ชื่อโรงพยาบาล</th>
                      <th>mhpsID</th>
                        <th>qus1_1</th>
                        <th>qus1_2</th>
                        <th>qus1_3</th>
                        <th>qus1_4</th>
                        <th>qus2_1</th>
                        <th>qus2_2</th>
                        <th>qus2_2_1</th>
                        <th>qus2_2_2</th>
                        <th>qus2_3</th>
                        <th>qus3_1</th>
                        <th>qus3_2</th>
                        <th>qus3_3</th>
                        <th>qus3_4</th>
                        <th>qus3_5</th>
                        <th>qus4_1</th>
                        <th>qus4_2</th>
                        <th>qus5_1</th>
                        <th>number_patients</th>
                        <th>problems_obstacles</th>
                        <th>feedback</th>
                        <th>DevelopmentPlan</th>
                        <th>statusfinal</th>
					</tr>
                   </thead>
                   <tbody>
					 <?php
					
                     $sqlpersonnel2 = $sqlpersonnel;
					$objpersonnel2 = mysqli_query($con, $sqlpersonnel2);
					$j = 1;
					while($rowpersonnel2 = mysqli_fetch_array($objpersonnel2))
					{

                        $mhpsID = $rowpersonnel2['mhpsID'];	
                        $qus1_1 = preg_split ("/\,/", $rowpersonnel2['qus1_1']); 	
                        $qus1_2 = preg_split ("/\,/", $rowpersonnel2['qus1_2']);
                        $qus1_3 = preg_split ("/\,/", $rowpersonnel2['qus1_3']);
                        $qus1_4 = preg_split ("/\,/", $rowpersonnel2['qus1_4']);
                        $qus2_1 = preg_split ("/\,/", $rowpersonnel2['qus2_1']);
                        $qus2_2 = preg_split ("/\,/", $rowpersonnel2['qus2_2']);
                        $qus2_2_1 = preg_split ("/\,/", $rowpersonnel2['qus2_2_1']);
                        $qus2_2_2 = preg_split ("/\,/", $rowpersonnel2['qus2_2_2']);
                        $qus2_3 = preg_split ("/\,/", $rowpersonnel2['qus2_3']);	
                        $qus3_1 = preg_split ("/\,/", $rowpersonnel2['qus3_1']);
                        $qus3_2 = preg_split ("/\,/", $rowpersonnel2['qus3_2']);
                        $qus3_3 = preg_split ("/\,/", $rowpersonnel2['qus3_3']);
                        $qus3_4 = preg_split ("/\,/", $rowpersonnel2['qus3_4']);
                        $qus3_5 = preg_split ("/\,/", $rowpersonnel2['qus3_5']);
                        $qus4_1 = preg_split ("/\,/", $rowpersonnel2['qus4_1']);
                        $qus4_2 = preg_split ("/\,/", $rowpersonnel2['qus4_2']);
                        $qus5_1 = preg_split ("/\,/", $rowpersonnel2['qus5_1']);

                        $number_patients = preg_split ("/\,/", $rowpersonnel2['number_patients']);
                        $problems_obstacles = $rowpersonnel2['problems_obstacles'];
                        $feedback			= $rowpersonnel2['feedback'];
                        $DevelopmentPlan 	= $rowpersonnel2['DevelopmentPlan'];
                        $statusfinal 		= $rowpersonnel2['statusfinal'];

                        ?>
            <tr>
						<td><?php echo $j++; ?></td>
                        <td>
							<?php echo $rowpersonnel2['HOS_NAME'];?>
						</td>
                        <td><?php print_r($mhpsID);?></td>
                        <td><?php print_r($qus1_1);?></td>
                        <td><?php print_r($qus1_2);?></td>
                        <td><?php print_r($qus1_3);?></td>
                        <td><?php print_r($qus1_4);?></td>
                        <td><?php print_r($qus2_1);?></td>
                        <td><?php print_r($qus2_2);?></td>
                        <td><?php print_r($qus2_2_1);?></td>
                        <td><?php print_r($qus2_2_2);?></td>
                        <td><?php print_r($qus2_3);?></td>
                        <td><?php print_r($qus3_1);?></td>
                        <td><?php print_r($qus3_2);?></td>
                        <td><?php print_r($qus3_3);?></td>
                        <td><?php print_r($qus3_4);?></td>
                        <td><?php print_r($qus3_5);?></td>
                        <td><?php print_r($qus4_1);?></td>
                        <td><?php print_r($qus4_2);?></td>
                        <td><?php print_r($qus5_1);?></td>
                        <td><?php print_r($number_patients);?></td>
                        <td><?php print_r($problems_obstacles);?></td>
                        <td><?php print_r($feedback);?></td>
                        <td><?php print_r($DevelopmentPlan);?></td>
                        <td><?php print_r($statusfinal);?></td>
					
						
					</tr>
					<?php 
        }
        ?>
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

<script>
        function showAlert() {
           if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) {
                alert("ข้อมูลถูก ลบแล้ว");
            } else {
                alert("การลบข้อมูลถูกยกเลิก");
            }
        }
        function showAlert2() {
           if (confirm("คุณต้องการส่งข้อมูลนี้ใช่หรือไม่?")) {
                alert("ข้อมูลถูก ส่งข้อมูลแล้ว");
            } else {
                alert("การส่งข้อมูลถูกยกเลิก");
            }
        }
    </script>



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
