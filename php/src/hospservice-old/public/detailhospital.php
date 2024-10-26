<?php
include('../config/connect.php');
$sql = "SELECT
			tb_hospital.hospi_id,
			tb_hospital.hospi_name,
			tb_hospital.hospi_phone,
			provinces.name_th AS ProvName,
			amphures.name_th AS AmpName,
			tb_hospital.hospi_address 
		FROM
			tb_hospital
			INNER JOIN provinces ON tb_hospital.hospi_province = provinces.`code`
			INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.`code`
        WHERE
			tb_hospital.hospi_id = '".$_GET['id']."'";
$query = mysqli_query($conn, $sql);

/*
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);
/*
if (isset($_POST['agency'])) {
  $agency = $_POST['agency'];
}else{
  $agency ='';
}

if (isset($_POST['province_id'])) {
  $province_id = $_POST['province_id'];
  $sql3 = "SELECT code , name_th FROM provinces where id = '".$province_id."'";  
  $query3 = mysqli_query($conn, $sql3); 
  $result3 = mysqli_fetch_array($query3);
  $PROVINCE = $result3['code'];
  $PROVINCE_name = $result3['name_th'];
}else{
  $PROVINCE ='';
}*/

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Hospital</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <!--<link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">-->
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets/css/theme.css" rel="stylesheet" />
	<style>
	.footer {
	   position: fixed;
	   left: 0;
	   bottom: 0;
	   width: 100%;
	   
	   color: white;
	   text-align: center;
	}
	</style>

  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="index.html"><!--<img src="assets/img/gallery/logo.png" width="118" alt="logo" /></a>-->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
              <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="#home"></a></li>
             <!-- <li class="nav-item px-2"><a class="nav-link" href="#departments">Departments</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Membership</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Help </a></li>
              <li class="nav-item px-2"><a class="nav-link" href="#findUs">Contact</a></li>-->
            </ul><!--<a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4" href="#!">Sign In</a>-->
          </div>
        </div>
      </nav><?php /*
      <section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/hero-bg.png);background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="assets/img/gallery/hero.png" alt="hero-header" /></div>
            <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-6">
             <!-- <h1 class="fw-light font-base fs-6 fs-xxl-7">We're <strong>determined </strong>for<br />your&nbsp;<strong>better life.</strong></h1>
              <p class="fs-1 mb-5">You can get the care you need 24/7 – be it online or in <br />person. You will be treated by caring specialist doctors. </p><a class="btn btn-lg btn-primary rounded-pill" href="#!" role="button">Make an Appointment</a>-->

              <h4>ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช (ภาพรวม)</h4>
			<br>
            <!--<form name="formindex" method="post" action="detail.php">-->
			<form method="post" name="myForm" action="<?php echo $_SERVER["PHP_SELF"];?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="province">จังหวัด</label>
                      
                        <select name="province_id" id="province" class="form-control">
                        <?php if (isset($_POST['province_id'])) { ?>
                          <option value="<?php echo $province_id ; ?>"><?php echo $PROVINCE_name ; ?></option>
                        <?php }else{ ?>
                          <option value="">เลือกจังหวัด</option>
                       <?php } ?>
                            
                            <?php while($result = mysqli_fetch_assoc($query)): ?>
                                <option value="<?=$result['id']?>"><?=$result['name_th']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-8">
                        <label for="province">สังกัด</label>
                        
                        <?php if ( $agency == '21000') { ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000" checked >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="27000">
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                        <?php }elseif( $agency == '27000'){ ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000"  >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="27000" checked>
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                        <?php }else{ ?>
                          <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="" checked>
                          <label class="form-check-label" for="agency0">
                              ทั้งหมด
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000" >
                          <label class="form-check-label" for="agency1">
                              ในสังกัดกรมสุขภาพจิต
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="agency" id="agency2" value="27000">
                          <label class="form-check-label" for="agency2">
                              อื่นๆ
                          </label>
                        </div>
                       <?php } ?>
                       

        
                    </div>
                </div> 
				<input type="submit" class="btn btn-lg btn-primary rounded-pil" name="submit" value="ค้นหา">  
				
            </form>
            </div>
          </div>
        </div>
      </section>
*/ ?>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-2" id="departments">
       

        <div class="container my-2">
  
			<div class="card">
			  <div class="card-header">

			  </div>
			  <div class="card-body">
						<?php $result = mysqli_fetch_assoc($query); ?>
						<p>
							<h3><?php echo $result['hospi_name']; ?></h3>
						</p>
						<p>
							<span><b>ที่อยู่ : </b></span><?php echo $result['hospi_address']; ?>
							<br>
							<?php echo $result['AmpName']; ?> <?php echo $result['ProvName']; ?>
						</p>
						<p>
							<span><b>โทรศัพท์: </b></span><?php echo $result['hospi_phone']; ?>
						</p>
					<p><a href="index.php">ย้อนกลับ</a></p>
			   </div>

			</div>
		</div>

		

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


      <section>
        <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/dot-bg.png);background-position:top left;background-size:auto;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row">

          
<?php 
			  $i = 1;
			  while($result2 = mysqli_fetch_array($query2))
			  {
			  ?>
          
            <div class="col-sm-6 col-lg-3 mb-4">
             <div class="card h-100 shadow card-span rounded-3">
                <div class="card-body"><span class="fs--1 text-primary me-3">Health</span>
                 
                  <h5 class="font-base fs-lg-0 fs-xl-1 my-3"><?php echo $result2['hospi_name']; ?></h5>
                    <p class="card-text"><?php echo $result2['ProvName']; ?></p>
                    <p class="card-text"><?php echo $result2['AmpName']; ?></p>
                    <p class="card-text"><?php echo $result2['hospi_phone']; ?></p>
                  <a class="stretched-link" href="detailhospital.php?id=<?php echo $result2['hospi_id']; ?>">รายละเอียด</a>
                </div>
              </div>
            </div>
             
                 
              
          <!--<div class="col-sm-6 col-lg-3 mb-4">
                <div class="card">
                   <!-- <img class="card-img-top" src="..." alt="Card image cap">-->
                  <!--  <div class="card-body">
                    <h5 class="card-title"><?php /*echo $result2['hospi_name']; ?></h5>
                    <p class="card-text"><?php echo $result2['ProvName']; ?></p>
                    <p class="card-text"><?php echo $result2['AmpName']; ?></p>
                    <p class="card-text"><?php echo $result2['hospi_phone']; ?></p>
                    <a href="detailhospital.php?id=<?php echo $result2['hospi_id'];*/ ?>">รายละเอียด</a>
                    </div>
                </div>-->
  <?php } ?>
  </div>
        </div>
      </section>
     
      


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 bg-primary footer">

           <div class="container">
            <div class="row justify-content-md-between justify-content-evenly py-4">
              <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
                <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; MHSO 2023</p>
              </div>
              <div class="col-12 col-sm-8 col-md-6">
                <p class="fs--1 my-2 text-center text-md-end text-200"> จัดทำโดย กองบริหารระบบบริการสุขภาพจิต กรมสุขภาพจิต 
                </p>
              </div>
            </div>
          </div>
          <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


      </section>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap" rel="stylesheet">
  </body>

</html>