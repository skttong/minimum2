<?php
include('config/connect.php');
$sql = "SELECT * FROM provinces";
$query = mysqli_query($conn, $sql);

if (isset($_POST['agency'])) {
  $agency = $_POST['agency'];
}else{
  $agency ='';
}

if (isset($_POST['province_id'])) {
  $province_id    = $_POST['province_id'];
    $sql3     = "SELECT code , name_th FROM provinces where id = '".$province_id."'";  
    $query3   = mysqli_query($conn, $sql3); 
    $result3  = mysqli_fetch_array($query3);
  $PROVINCE       = $result3['code'];
  $PROVINCE_name  = $result3['name_th'];
}else{
  $PROVINCE ='';
}

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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          
          <h1 class="h_kanit" data-aos="fade-up" style="font-size:36px;">ข้อมูลโรงพยาบาลด้านสุขภาพจิตและจิตเวช</h1>
          <h2 class="h_kanit" data-aos="fade-up" data-aos-delay="400"></h2>
          <div data-aos="fade-up" data-aos-delay="800">
          <form method="post" name="myForm" action="#hospi">
      
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
                <br>
                <label for="province">สังกัด</label>
                
                <?php if ( $agency == '21000') { ?>
                <!-- <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                  <label class="form-check-label" for="agency0">
                      ทั้งหมด
                  </label>
                </div>-->
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000" checked >
                  <label class="form-check-label" for="agency1">
                      สังกัดกระทรวงสาธารณสุข
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency2" value="27000">
                  <label class="form-check-label" for="agency2">
                      อื่นๆ
                  </label>
                </div>
                <?php }elseif( $agency <> '21000'){ ?>
                  <!--<div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="" >
                  <label class="form-check-label" for="agency0">
                      ทั้งหมด
                  </label>
                </div>-->
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000"  >
                  <label class="form-check-label" for="agency1">
                      สังกัดกระทรวงสาธารณสุข
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency2" value="27000" checked>
                  <label class="form-check-label" for="agency2">
                      อื่นๆ
                  </label>
                </div>
                <?php }else{ ?>
                  <!--/*<div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="" checked>
                  <label class="form-check-label" for="agency0">
                      ทั้งหมด
                  </label>
                </div>*/-->
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="agency" id="agency1" value="21000" >
                  <label class="form-check-label" for="agency1">
                      สังกัดกระทรวงสาธารณสุข
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
            <p style="margin-top:20px">
            <input type="submit" class="btn-get-started2 scrollto" name="submit" value="ค้นหา">  
            </p>

          </form>
            
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="img/hosicon.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

        
                
    <!-- ======= Services Section ======= -->
    <?php
      $sql2 = "SELECT
                    tb_hospital.hospi_id,
                    tb_hospital.hospi_name,
                    tb_hospital.hospi_phone,
                    provinces.name_th AS ProvName,
                    amphures.name_th AS AmpName
                  FROM
                    tb_hospital
                  INNER JOIN provinces ON tb_hospital.hospi_province = provinces.`code`
                  INNER JOIN amphures ON tb_hospital.hospi_amphur = amphures.`code`
                  WHERE
                      tb_hospital.hospi_province = '$PROVINCE'
                  AND tb_hospital.hospi_status = 1"
                ;
          
      if ($agency!='') {
          $sql2 = $sql2." AND tb_hospital.agen_code = '$agency'";
      }
      $query2 = mysqli_query($conn, $sql2);
      $rownum = mysqli_num_rows($query2); 
	  ?>
    <section id="services" class="services">
      <div class="container" id="hospi">
        <div class="section-title" data-aos="fade-up">
          <h2 class="h_kanit">จำนวนโรงพยาบาล 
            <?php if($agency == '21000'){
              echo 'สังกัดกระทรวงสาธารณสุข'; 
            }else{
              echo 'อื่น ๆ';
            }
            ?>
          </h2>
          <p>
            <div class="count-box">
              <i class="bi bi-geo-alt"></i>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $rownum; ?>" data-purecounter-duration="1" class="purecounter"></span> แห่ง
                <!--<p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>-->
            </div>
          </p>
        </div>
        
        <div class="row">
          <?php 
          $i = 1;
          while($result2 = mysqli_fetch_array($query2))
          { ?>
          <div class="col-md-6 col-lg-4 align-items-stretch mb-5 mb-lg-3" style="margin-buttom:10px;">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-hospital"></i></div>
              <h4 class="title h_kanit"><a href=""><?php echo $result2['hospi_name']; ?></a></h4>
              <p class="description">
                <?php 
                  echo 'จังหวัด '.$result2['ProvName'].'<br>'; 
                  echo 'อำเภอ '.$result2['AmpName'].'<br>';
                  echo 'โทรศัพท์ '.$result2['hospi_phone'];
                ?>
              </p>
              <a class="stretched-link description" href="detailhospital.php?id=<?php echo $result2['hospi_id']; ?>">รายละเอียด</a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
      <?php include ('footercontact.php'); ?>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color:#2ec4b6;">
    <div class="container">
    <?php include ('footer.php'); ?>
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