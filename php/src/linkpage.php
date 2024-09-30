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
            <h1>Dashboards</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboards</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

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
          <div class="col-md-12">
          <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>Mental Health Check-In</td>
                      <td>
                        <a class="btn btn-app bg-info" href="https://checkin.dmh.go.th/dashboards" target="_blank"> 
                           
                            <i class="fas fa-link"></i> Link
                        </a>
                      </td>
                     
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>ข้อมูล กพด</td>
                      <td>
                        
                        <a class="btn btn-app bg-info" href="https://lookerstudio.google.com/reporting/36d7f55b-33d0-4cfc-a458-d25a919917f2/page/q11kC?s=jgoZ_Hq9xvQ" target="_blank"> 
                            
                            <i class="fas fa-link"></i> Link
                        </a>  
                    </td>
                      
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>การเข้าถึงระบบบริการสุขภาพจิต</td>
                      <td>
                            <a class="btn btn-app bg-info" href="https://hdcservice.moph.go.th/hdc/reports/page.php?cat_id=ea11bc4bbf333b78e6f53a26f7ab6c89" target="_blank"> 
                                
                                <i class="fas fa-link"></i> Link
                            </a>
                        </td>
                      
                    </tr>
                    <tr>
                      <td>4.</td>
                      <td>ศูนย์ติดตามต่อเนื่องผู้ป่วยจิตเวชเรื้อรังในชุมชน(SMI-V Care)</td>
                      <td>
                            <a class="btn btn-app bg-info" href="https://smiv.jvkorat.go.th/loginsystem" target="_blank">      
                                
                                <i class="fas fa-link"></i> Link
                            </a>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>5.</td>
                      <td>ระบบเฝ้าระวังปัญหาสุขภาพจิตสำหรับผู้ประสบภาวะวิกฤต/ภัยพิบัติ (CMS)</td>
                      <td>
                            <a class="btn btn-app bg-info" href="https://cms.srph.go.th/login" target="_blank">    
                                
                                <i class="fas fa-link"></i> Link
                            </a>
                      </td>
                      
                    </tr>
                    <tr>
                      <td>6.</td>
                      <td>ระบบรายงานข้อมูลระยะเวลาการให้บริการผู้ป่วยจิตเวช (Psywait)</td>
                      <td>
                           
                            <a class="btn btn-app bg-info" href="https://psywait.dmh.go.th" target="_blank">
                                
                                <i class="fas fa-link"></i> Link
                            </a>
                      </td>
                      
                    </tr>
                  </tbody>
                </table>

            
          </div>
          <!-- /.col -->
          

           
        </div>
        <!-- /.row -->
        </div>
        <!-- /.card-body -->
       <!-- <div class="card-footer">
          Footer
        </div>-->
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
