<?PHP
session_start();


include('connect/conn.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>

  	
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.highcharts.com/maps/highmaps.js"></script>
  <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>	
	

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/fonts-googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- Control by jel -->
  <link rel="stylesheet" href="dist/css/fontcontrol.css">

	<?php include "header_font.php"; ?>

  <style>
	
	  .divinfo{
		 /* background-color: #e7f3fe;*/
		  border-left: 3px solid #68AADF;
	  }
	  .top-right {
		  position: absolute;
		  top: 8px;
		  right: 16px;
	  }
	  .callout2
	  {
		  margin: 0 0 0 0 ;
		  padding: 15px 30px 7px 15px;
	  }

.tooltip2 {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/
}

.tooltip2 .tooltiptext {
  visibility: hidden;
  width: 500px;
  background-color: #5C7EAB;
  color: #fff;
  text-align: left;
  border-radius: 6px;
  padding: 5px 0;
  
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
  top: -5px;
  left: 105%;
}

.tooltip2:hover .tooltiptext {
  visibility: visible;
}

.tooltip2 {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/
}

</style>
</head>
<body class="hold-transition sidebar-mini bodychange">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include "nav_bar2.php" ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu2.php" ?>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h3>ติดต่อเรา</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Blank Page</li>-->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	   <!-- Main content -->
    <section class="content">
    <form class="form-valide" action="sendmail.php" method="post" id="myform1" name="foml">
		

            

			  <!-- Default box -->
			  <div class="card card-success card-outline">
				<div class="card-header">
				  <h3 class="card-title" style="color: dimgray"> ติดต่อเรา</h3>

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
                        <div class="row" >
                        <div class="form-group col-12">
                            <div class="form-group">
                            <strong>
                                ติดต่อเรา <br>
                                <a href="https://mhso.dmh.go.th" target="_blank">กองบริหารระบบบริการสุขภาพจิต กรมสุขภาพจิต</a>.<br>
                                เลขที่ 88/20 หมู่ 4 ตำบลตลาดขวัญ 
                                อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000 <br>
                                โทรศัพท์: 0 2590 8577
                            </strong>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="container">
                        <div class="row" style="margin-bottom: 2px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="email" class="form-label" style="text-align: left;">email </label>
                                </div>
                                <input  type="text" name="email" class="form-control" id="email" placeholder="กรอกemail" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> email </div>
                            </div>
                        </div>
                       
                    </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 2px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="title" class="form-label" style="text-align: left;">ชื่อเรื่อง </label>
                                </div>
                                <input  type="text" name="title" class="form-control" id="title" placeholder="ชื่อเรื่อง" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> ชื่อเรื่อง (ภาษาไทยเท่านั้น) </div>
                            </div>
                        </div>
                       
                    </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 2px;">
                        <div class="form-group col-12">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="remark" class="form-label" style="text-align: left;">เรื่อง </label>
                                </div>
                                <textarea class="form-control" rows="5" id="remark" name="remark" required></textarea>
                               
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> เรื่อง (ภาษาไทยเท่านั้น) </div>
                            </div>
                        </div>
                       
                    </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-bottom: 2px;">
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="names" class="form-label" style="text-align: left;">ชื่อผู้ส่ง </label>
                                </div>
                                <input  type="text" name="names" class="form-control" id="names" placeholder="เรื่อง" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> ชื่อผู้ส่ง (ภาษาไทยเท่านั้น) </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <div class="form-group">
                                <div align="left" style="margin-left: 28px;">
                                <label for="Tel" class="form-label" style="text-align: left;">เบอร์โทร </label>
                                </div>
                                <input  type="text" name="Tel" class="form-control" id="Tel" placeholder="เบอร์โทร" required>
                                <div class="invalid-feedback" align="left" style="margin-left: 28px;"> เบอร์โทร  </div>
                            </div>
                        </div>

                       
                    </div>
                    </div>

                   
	   
				
				
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ส่งข้อมูล &nbsp;<i class="fa fas fa-plus"></i></button>
			  	  <a href="tables-memberalladmin.php" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>
				</div>
				<!-- /.card-footer-->
			  </div>
			  <!-- /.card -->
			
		</form>
    </div>
    </section>
 

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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


</body>
</html>
