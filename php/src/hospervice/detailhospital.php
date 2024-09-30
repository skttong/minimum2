<?php
include('config/connect.php');
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('header.php') ;?> 
  <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
  <style>
    body {
        font-family: 'Kanit';font-size: 22px;
    }
    .h_kanit {
        font-family: 'Kanit';
    }
    .btn-get-started2 {
      background-color: white;
      font-weight: 500;
      font-size: 16px;
      letter-spacing: 1px;
      display: inline-block;
      padding: 10px 30px;
      border-radius: 50px;
      transition: 0.5s;
      color: #3498db;
      border: 2px solid #3498db;
    }
  </style>

</head>

<body style="background-color:#cbf3f0;">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center" style="background-color:#2ec4b6;">
    <div class="container d-flex align-items-center justify-content-between">
    <?php include ('titlemenu.php'); ?>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -0->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="section-title" data-aos="fade-up">
          <h2>รายละเอียด</h2>
        </div>
        
      </div>
    </div>

  </section><0!-- End Hero -->

  <main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about" style="margin-top:70px;">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h1 class="h_kanit" data-aos="fade-up" style="font-size:36px;">ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช</h1>
          <h2 class="h_kanit">รายละเอียด</h2>
        </div>
      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150" style="margin-top: -120px;">
            <img src="img/hosicon-detail.png" alt="" class="img-fluid">
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center" style="margin-top: -90px;">
              <div class="row">
                <?php $result = mysqli_fetch_assoc($query); ?>
                
                <h3 class="h_kanit" style="color:#03045e"><i class="bi bi-geo-alt"></i> <?php echo $result['hospi_name']; ?></h3>
                <p> &nbsp;</p>
                <span><b>ที่อยู่ : </b><?php echo $result['hospi_address']; ?></span>
                <span><b>อำเภอ </b><?php echo $result['AmpName']; ?> <b><br>จังหวัด </b><?php echo $result['ProvName']; ?></span>
                <span><b>โทรศัพท์: </b><?php echo $result['hospi_phone']; ?></span>
                
                <p style="margin-top:20px;"><a class="getstarted scrollto" href="index.php">ย้อนกลับ</a></p>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->
     
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
      <?php include ('footercontact.php');?>

      </div>
    </section><!-- End Contact Section -->
  
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color:#2ec4b6;">
    <div class="container">
    <?php include('footer.php'); ?>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>