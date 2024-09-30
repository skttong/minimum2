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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
	<?php include "header_font.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php //include "nav_bar.php" ?>
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li><!--
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>-->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
	  <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">
		<?php echo 'แอดมินส่วนกลาง'; ?>
		</a>
      </li>
	  
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <?php /*?><li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
		<i class="far fa-user-circle"></i> 
		 <span><?php echo $Name;?></span>
		</a>
	  </li>	<?php */?>
	  <li class="nav-item dropdown">
		<a class="nav-link"  href="logout.php">
		<i class="fas fa-sign-out-alt"></i> 
		 <span><?php echo 'ออกจากระบบ';?></span>
		</a>
	  </li>	

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "menu_ow.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <!--<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">การส่งเริมป้องกันสุขภาพจิต</h3>

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
			<div class="row">
				<div class="col-sm-4">
					<div class="position-relative p-3 bg-green" style="height: 180px">
					<div class="ribbon-wrapper">
					
					</div>
					<h5>การประเมินสุขภาพจิตคนไทย</h5>
					<a href="https://checkin.dmh.go.th/dashboards" target="_blank" class="nav-link">
						<i class='fas fa-link'></i> ระบบ Mental Health Check-In
						</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="position-relative p-3 bg-gray" style="height: 180px">
					<div class="ribbon-wrapper ribbon-lg">
					<div class="ribbon bg-info">
					Ribbon Large
					</div>
					</div>
					Ribbon Large <br>
					<small>.ribbon-wrapper.ribbon-lg .ribbon</small>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="position-relative p-3 bg-gray" style="height: 180px">
					<div class="ribbon-wrapper ribbon-xl">
					<div class="ribbon bg-secondary">
					Ribbon Extra Large
					</div>
					</div>
					Ribbon Extra Large <br>
					<small>.ribbon-wrapper.ribbon-xl .ribbon</small>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-4">
				<div class="position-relative p-3 bg-gray" style="height: 180px">
				<div class="ribbon-wrapper ribbon-lg">
				<div class="ribbon bg-success text-lg">
				Ribbon
				</div>
				</div>
				Ribbon Large <br> with Large Text <br>
				<small>.ribbon-wrapper.ribbon-lg .ribbon.text-lg</small>
				</div>
				</div>
				<div class="col-sm-4">
				<div class="position-relative p-3 bg-gray" style="height: 180px">
				<div class="ribbon-wrapper ribbon-xl">
				<div class="ribbon bg-warning text-lg">
				Ribbon
				</div>
				</div>
				Ribbon Extra Large <br> with Large Text <br>
				<small>.ribbon-wrapper.ribbon-xl .ribbon.text-lg</small>
				</div>
				</div>
				<div class="col-sm-4">
				<div class="position-relative p-3 bg-gray" style="height: 180px">
				<div class="ribbon-wrapper ribbon-xl">
				<div class="ribbon bg-danger text-xl">
				Ribbon
				</div>
				</div>
				Ribbon Extra Large <br> with Extra Large Text <br>
				<small>.ribbon-wrapper.ribbon-xl .ribbon.text-xl</small>
				</div>
				</div>
			</div>
			<div class="row mt-4">
			<div class="col-sm-4">
			<div class="position-relative">
			<img src="../../dist/img/photo1.png" alt="Photo 1" class="img-fluid">
			<div class="ribbon-wrapper ribbon-lg">
			<div class="ribbon bg-success text-lg">
			Ribbon
			</div>
			</div>
			</div>
			</div>
			<div class="col-sm-4">
			<div class="position-relative">
			<img src="../../dist/img/photo2.png" alt="Photo 2" class="img-fluid">
			<div class="ribbon-wrapper ribbon-xl">
			 <div class="ribbon bg-warning text-lg">
			Ribbon
			</div>
			</div>
			</div>
			</div>
			<div class="col-sm-4">
			<div class="position-relative" style="min-height: 180px;">
			<img src="../../dist/img/photo3.jpg" alt="Photo 3" class="img-fluid">
			<div class="ribbon-wrapper ribbon-xl">
			<div class="ribbon bg-danger text-xl">
			Ribbon
			</div>
			</div>
			</div>
			</div>
			</div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
