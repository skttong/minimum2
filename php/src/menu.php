<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      
	  <img src="images/DMH.png" alt="User Image" class="brand-image  img-circle ">
      <span class="brand-text font-weight-light">Minimum Data set</span>
    </a>
	
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>-->

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		  <!--<li class="nav-header">แสดงผล</li>-->
          <!--<li class="nav-item">
            <!--<a href="report-1.php" class="nav-link">-->
			<!--<a href="dashboardi.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               <!-- <i class="right fas fa-angle-left"></i>-->
             <!-- </p>
            </a>
         </li>-->
		 <?php /*
		 <li class="nav-item">
            <!--<a href="report-1.php" class="nav-link">-->
			<a href="dashboardi_bottom.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard-2
               <!-- <i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <!--<a href="report-1.php" class="nav-link">-->
			
			<a href="dashboardi_onerow.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard-3
               <!-- <i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <!--<a href="report-1.php" class="nav-link">-->			
			<a href="dashboardi_top.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard-4
               <!-- <i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
		   */ ?>
		 
		 <!-- <li class="nav-item">
            <a href="#tables_4.php" class="nav-link">
              <i class="nav-icon fas fa-user-md"></i>
              <p>รายละเอียดบุคลากร<br>สุขภาพจิตและจิตเวช</p>
            </a>
          </li>-->

	<?php if($_SESSION["TypeUser"] <> ''){
		//echo $_SESSION["HosType"];
		?>
		
		
		  <!--<li class="nav-header">แบบฟอร์มบันทึกข้อมูล</li>-->
		  	<li class="nav-item">
			 
				<a href="detail-1.php" class="nav-link">
					<i class="nav-icon fas fa-user-md"></i>
					<p>
					แบบบันทึกข้อมูลทรัพยากรบุคลากร 
					<!--<i class="fas fa-angle-left right"></i>-->
					</p>
				</a>
				
				<ul class="nav nav-treeview">
					<li class="nav-item">
					<a href="forms_m1.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>แพทย์</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m2.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>พยาบาล</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m3.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>เภสัชกร</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m4.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>นักจิตวิทยา</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m5.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>นักสังคมสงเคราะห์</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m6.php?type=6" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>นักกิจกรรมบำบัด</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m6.php?type=7" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>เวชศาสตร์สื่อความหมาย</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m6.php?type=8" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>นักวิชาการศึกษาพิเศษ</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m6.php?type=9" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>นักวิชาการสาธารณสุข</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="forms_m6.php?type=10" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>วิชาชีพอื่นๆ</p>
					</a>
					</li>
				</ul>
			</li>
	<?php 
						if($_SESSION["HosType"] <> 'ศูนย์วิชาการ'){ 
							if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){
								if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){ ?>
			<li class="nav-item">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-bed"></i>
					<p>
					แบบบันทึกข้อมูลทรัพยากรบริการ
					<!--<i class="fas fa-angle-left right"></i>-->
					</p>
				</a>

				<ul class="nav nav-treeview">
				<?php 
					if($_SESSION["HosType"] <> 'ศูนย์บริการสาธารณสุข อปท.'){
						if($_SESSION["HosType"] <> 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){
							if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){
								if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){ ?>
					<li class="nav-item">
					<a href="form_bed.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>เตียงจิตเวช</p>
					</a>
					</li>
					<?php }}}} ?>
					<!--<li class="nav-item">
					<a href="form_bed2.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>เตียงจิตเวช รพ.ชุมชน</p>
					</a>
					</li>-->
					<?php 	if($_SESSION["HosType"] <> 'ศูนย์บริการสาธารณสุข อปท.'){
							if($_SESSION["HosType"] <> 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){
							if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){
								if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){ ?>
					<li class="nav-item">
					<a href="form_ect.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>การรักษาด้วย ECT/ TMS</p>
					</a>
					</li>
					<?php }}}} ?>
					<li class="nav-header"></li>
			<?php 
			if($_SESSION["HosType"] == 'ศูนย์บริการสาธารณสุข อปท.'){?>
			  <li class="nav-item">
				<a href="hospital_tambon.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ส่งเสริมสุขภาพตำบล</p>
				</a>
			  </li>
			<?php }elseif($_SESSION["HosType"] == 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){?>
			  <li class="nav-item">
				<a href="hospital_tambon.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ส่งเสริมสุขภาพตำบล</p>
				</a>
			  </li>
			<?php }elseif($_SESSION["HosType"] == 'โรงพยาบาลชุมชน'){?>
			  <li class="nav-item">
				<a href="hospital_community.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ชุมชน</p>
				</a>
			  </li>
			 <?php }elseif(($_SESSION["HosType"] == 'โรงพยาบาลศูนย์')||($_SESSION["HosType"] == 'โรงพยาบาลทั่วไป')){?>
			  <li class="nav-item">
				<a href="hospital_center.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ศูนย์/รพ.ทั่วไป</p>
				</a>
			  </li>
			<?php }elseif($_SESSION["HosType"] == 'กรมสุขภาพจิต'){?>
			  <li class="nav-item">
				<a href="hospital_center.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ศูนย์/รพ.ทั่วไป</p>
				</a>
			  </li>
			  <?php }elseif($_SESSION["HosType"] == 'โรงพยาบาล นอก สป.สธ.'){?>
			  <li class="nav-item">
				<a href="hospital_center.php" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>รพ.ศูนย์/รพ.ทั่วไป</p>
				</a>
			  </li>
			<?php }else{ 
			if($_SESSION["TypeUser"] == 'Admin'){
		  		?>
			<li class="nav-item">
            <a href="hospital_tambon.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>รพ.ส่งเสริมสุขภาพตำบล</p>
            </a>
          </li>
			
		  <li class="nav-item">
            <a href="hospital_community.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>รพ.ชุมชน</p>
            </a>
          </li>
			
		  <li class="nav-item">
            <a href="hospital_center.php" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>รพ.ศูนย์/รพ.ทั่วไป</p>
            </a>
          </li>
			<?PHP 
			}
		  }?>
				</ul>
			</li>

			<?php }}} ?>
			<!--<li class="nav-item">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-file-medical-alt"></i>
					<p>
					การรักษาด้วย ECT/TMS
					<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
					<a href="form_ect.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>แบบฟอร์มบันทึกข้อมูล</p>
					</a>
					</li>
					<li class="nav-item">
					<a href="tables-3.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>ตรวจสอบข้อมูล</p>
					</a>
					</li>
				</ul>
			</li>-->
			
		  
		 <?php if($_SESSION["TypeUser"] == "User_h09"){?>	
		 <!--<li class="nav-header">รายงานข้อมูลเขต 9</li>-->
		  <li class="nav-item">
            <a href="tables_detailservice.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>ข้อมูลบริการสุขภาพจิตและจิตเวช (เขต 9)</p>
            </a>
          </li>
		<li class="nav-header">สำหรับแอดมิน</li>
		  <li class="nav-item">
            <a href="tables-1.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>รายชื่อผู้ประสานข้อมูล</p>
            </a>
         </li>
		<?php } ?>
		<?php /* if($_SESSION["TypeUser"] == "Admin"){?>
		<li class="nav-header">ข้อมูลด้านบริการ</li>
		  <li class="nav-item">
            <a href="tables_detailservice.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>บริการสุขภาพจิตและจิตเวช</p>
            </a>
        </li>
		<li class="nav-header">สำหรับแอดมิน</li>
		  <li class="nav-item">
            <a href="tables-memberall.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>รายชื่อผู้ประสานข้อมูล</p>
            </a>
         </li>
		<?php } */ ?> 
		 <li class="nav-header"></li>
		 <?php
					if($_SESSION["TypeUser"] == "Admin"){
		?>
          <li class="nav-item">
            <a href="tables-surveyapp.php" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                สรุปสำรวจความพึงพอใจ
              </p>
            </a>
          </li>
		  <?php }else{ ?>
		  <li class="nav-item">
            <a href="surveyapp.php" class="nav-link">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                แบบสำรวจความพึงพอใจ
              </p>
            </a>
          </li>
		  <?php } ?>
		  <li class="nav-header"></li>
		 
          <li class="nav-item">
		 	 <?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
				<a href="tables-memberall2.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>

		<?php }elseif($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){?>
						<a href="tables-memberall2.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>
		<?php }elseif($_SESSION["HosType"] == 'กรมสุขภาพจิต'){?>
						<a href="tables-memberall2.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>
			  <?php }elseif($_SESSION["HosType"] == 'ศูนย์วิชาการ'){?>
				<a href="tables-memberall2.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>
			  <?php }elseif($_SESSION["TypeUser"] == 'Admin'){?>
				<a href="tables-memberalladmin.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>
					
					<?php } else{ ?>	
						<a href="tables-memberall.php" class="nav-link">
		  <i class="nav-icon fa fa-tachometer-alt " ></i>
              <p>
			  สถานะผู้ลงทะเบียน
              </p>
			<?php } ?>	
		 
	
            </a>
          </li>
	
		  <li class="nav-header"></li>
		  
          <li class="nav-item">
		  <?php if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>
		  				<a href="tables-preall.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
					    </a>

					<?php }elseif($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){?>
						<a href="tables-preall.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
					    </a>

					<?php }elseif($_SESSION["HosType"] == 'กรมสุขภาพจิต'){?>
						<a href="tables-preall2.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
					    </a>

					<?php }elseif($_SESSION["HosType"] == 'ศูนย์วิชาการ'){?>
						<a href="tables-preall2.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
					    </a>

					<?php }elseif($_SESSION["TypeUser"] == "Admin"){ ?>
						<a href="tables-preall2.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
					    </a>
					
					<?php } else{ ?>	
						<a href="tables-pre.php" class="nav-link">
						<i class="nav-icon fa fa-tasks" ></i>
						<p>ตรวจสอบข้อมูลทรัพยากรบุคลากร</p>
						
					</a>
			<?php } ?>	
          </li>
		  <li class="nav-header"></li>
		  <?php /*
				if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){
					if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){
						if($_SESSION["HosType"] == 'ศูนย์วิชาการ'){
						*/
				?> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
			  ตรวจสอบข้อมูลทรัพยากรบริการ
              </p>
            </a>
			<ul class="nav nav-treeview">
				
			<?php if($_SESSION["HosType"] <> 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){
				if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
								if($_SESSION["HosType"] <> 'ศูนย์บริการสาธารณสุข อปท.'){?>
					<li class="nav-item">
					<a href="tables-bed.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>เตียงจิตเวช</p>
						
					</a>
					</li>
					<?php }}} ?>
					<?php if($_SESSION["HosType"] <> 'โรงพยาบาลส่งเสริมสุขภาพตำบล'){
						if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
									if($_SESSION["HosType"] <> 'ศูนย์บริการสาธารณสุข อปท.'){?> 
					<li class="nav-item">
					<a href="tables-ect.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>การรักษาด้วย ECT / TMS</p>
						
					</a>
					</li>
					<?php }}} ?>
					<li class="nav-item">
					<a href="tables-sys.php" class="nav-link">
						<i class="fas fa-minus nav-icon" style="font-size:12px;"></i>
						<p>ระบบบริการจิตเวช</p>
						
					</a>
					</li>
					
					
				</ul>
          </li>
		  <?php /*}}}*/ ?>
		
        <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>