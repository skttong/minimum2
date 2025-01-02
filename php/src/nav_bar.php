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
        <a href="detail-1.php" class="nav-link">หน้าแรก</a>
      </li>
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        รายงานผลโครงการ
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="https://checkin.dmh.go.th/dashboards" target="_blank">MHCI</a>
        <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="http://110.164.222.69/vcare/app/home/dashboard" target="_blank">V Care</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="" target="_blank">HERO</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://earlychildhood.dmh.go.th" target="_blank">Triple P</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://dtc.dmh.go.th/" target="_blank">DMH Data center</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://suicide.dmh.go.th/" target="_blank">ศูนย์เฝ้าระวังป้องกันการฆ่าตัวตาย</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://cms.srph.go.th/api/v2/public-dashboard-view" target="_blank">CMS</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="https://psywait.dmh.go.th/" target="_blank">psywait</a>
          
          
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>-->
        </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://hdcservice.moph.go.th/hdc/reports/page.php?cat_id=22710ed5db1ed6b12aab540a7b0753b3" class="nav-link" target="_blank">HDC สุขภาพจิต</a>
      </li>


 

<?php /*
	  <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">
		<?php
		if($_SESSION["TypeUser"] == "Admin"){
			echo 'แอดมินส่วนกลาง';
		}else{
			$sql_u 		= "SELECT HOS_NAME FROM hospitalnew WHERE hospitalnew.CODE5 = $HospitalID";
			$query_u 	= mysqli_query($con, $sql_u);
			$result_u 	= mysqli_fetch_array($query_u);
			echo $result_u['HOS_NAME']; 
		}
		?>
		</a>
      </li>
	 */?> 
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	<?php if($_SESSION["TypeUser"] <> ''){?>
		<li  class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
		<i class="far fa-user-circle"></i> 
		 <span><?php echo $Name;?></span>
		</a>
	  

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="detail-all.php">ลงข้อมูลทรัพยากร</a>
          <div class="dropdown-divider"></div>
          <!--<a class="dropdown-item" href="dashboard01.php">ตรวจสอบข้อมูล</a>-->
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="editmember.php?id=<?php echo $_SESSION["UserID"];?>">แก้ไขข้อมูล</a>
          <div class="dropdown-divider"></div>
          
          <!--<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>-->
        </div>
      </li>
      <li class="nav-item dropdown">
		<a class="nav-link"  href="contactus.php">
		<i class="fas fa-envelope"></i> 
		 <span><?php echo 'ติดต่อเรา';?></span>
		</a>
	  </li>
      <li class="nav-item dropdown">
		<a class="nav-link"  href="logout.php">
		<i class="fas fa-sign-out-alt"></i> 
		 <span><?php echo 'ออกจากระบบ';?></span>
		</a>
	  </li>
	<?php }elseif($_SESSION["TypeUser"] == ''){ ?>
	  <li class="nav-item dropdown">
		<a class="nav-link"  href="form_login.php">
		<i class="fas fa-sign-out-alt"></i> 
		 <span><?php echo 'เข้าสู่ระบบ';?></span>
		</a>
	  </li>	
	<?php } ?>
    </ul>
  </nav>