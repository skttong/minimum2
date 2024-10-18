<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType	 	= $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP		= $_SESSION["HostHMOO"];
$NO_DISTRICT	= $_SESSION["NO_DISTRICT"];

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
	    $CODE_DISTRICT = $result_u['CODE_DISTRICT'];
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
      <div class="card-body">

      <?php if($_SESSION["TypeUser"] == "Admin"){ ?>
      <form class="form-valide" action="tables-sysall.php" method="post" id="myform1" name="foml">  
            <div class="row">
              

              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;" onChange="myFunction3()">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="1">เขตสุขภาพ 1</option>
                    <option value="2">เขตสุขภาพ 2</option>
                    <option value="3">เขตสุขภาพ 3</option>
					          <option value="4">เขตสุขภาพ 4</option>
                    <option value="5">เขตสุขภาพ 5</option>
                    <option value="6">เขตสุขภาพ 6</option>
					          <option value="7">เขตสุขภาพ 7</option>
                    <option value="8">เขตสุขภาพ 8</option>
                    <option value="9">เขตสุขภาพ 9</option>
					          <option value="10">เขตสุขภาพ 10</option>
                    <option value="11">เขตสุขภาพ 11</option>
                    <option value="12">เขตสุขภาพ 12</option>
					          <option value="13">เขตสุขภาพ 13</option>
                   </select>
                </div>
                <script>
                   function myFunction3() {
                      const selectedValue = $('#area').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hmoo.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { moo_id: selectedValue },
                            success: function(data) {
                              $('#CODE_PROVINCE').html(data);
                            }
                          });
                    }
			    	</script> 
            
			   <!-- /.col -->
             
			 <!-- /.col -->
              
				<!-- /.form-group -->
         
               
              </div>
              <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction4()">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE_PROVINCE, NO_PROVINCE FROM hospitalnew 
GROUP BY CODE_PROVINCE 
ORDER BY NO_PROVINCE ASC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>

                <script>
                   function myFunction4() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hos.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { CODE_PROVINCE: selectedValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>
              <!-- /.col -->	

              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2"  style="width: 100%;">
                    <option selected="selected"  value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="ในสังกัด">ในสังกัด</option>
                    <option value="นอกสังกัด">นอกสังกัด</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->

              <div class="col-md-2">
              <div class="form-group" id="labelservice">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" onChange="myFunction2()">
                     <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					          <option value="F2">F2</option>
					          <option value="F3">F3</option>  
                  </select>
                </div>
                <!-- /.form-group -->  
                <script>
                   function myFunction2() {
                      const selectedValue = $('#service').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 

              </div>
              <!-- /.col -->	


              <div class="col-md-2">
               <div class="form-group">
                  <label>โรงพยาบาล</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT CODE5,HOS_NAME FROM hospitalnew 
WHERE HOS_TYPE <> 'คลินิกเอกชน'
ORDER BY hospitalnew.CODE_HMOO DESC;";
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["CODE5"];?>" ><?PHP echo $rowprovince["HOS_NAME"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->		

              



            </div>
            <!-- /.row -->
		
			<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
				   <button type="reset" class="btn btn-default"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>
      <?php }else{ ?>

			<form class="form-valide" action="tables-sysall.php" method="post" id="myform1" name="foml">  
            <div class="row">
              <?php /* ?>
              <div class="col-md-2">
               <div class="form-group">
                  <label>หน่วยงานใน/นอกสังกัด</label>
                  <select class="form-control select2"  style="width: 100%;">
                    <option selected="selected"  value="ทั้งหมด" >ทั้งหมด</option>
                    <option value="ในสังกัด">ในสังกัด</option>
                    <option value="นอกสังกัด">นอกสังกัด</option>
                  </select>
                </div>
              </div>
              <!-- /.col -->
			   <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group">
                  <label>เขตพื้นที่/Service Plan</label>
                  <select class="form-control select2" style="width: 100%;" id="mySelect" onChange="myFunction()">
                    <option selected="selected" value="ทั้งหมด"> ทั้งหมด</option>
                    <option value="เขตพื้นที่">เขตพื้นที่</option>
                    <option value="ServicePlan">Service Plan</option>
                    <option value="รายโรงพยาบาล">รายโรงพยาบาล</option>
                  </select>
				   
				<script>
					function myFunction() {
						let elementarea 		= document.getElementById("area");
						let elementlabelarea 	= document.getElementById("labelarea");
						let elementservice 		= document.getElementById("service");
						let elementlabelservice = document.getElementById("labelservice");
						
						selectElement = document.querySelector('#mySelect');	
        				output = selectElement.value;
						
						if(output === "ServicePlan"){
							//alert(output);
							elementservice.removeAttribute("hidden");
							elementlabelservice.removeAttribute("hidden");
							
							elementarea.setAttribute("hidden", "hidden");
							elementlabelarea.setAttribute("hidden", "hidden");
							
						}else{
							elementarea.removeAttribute("hidden");
							elementlabelarea.removeAttribute("hidden");
							
							elementservice.setAttribute("hidden", "hidden");
							elementlabelservice.setAttribute("hidden", "hidden");
						
							//alert("tong");
						}
						
					}
				</script> 
				   
                </div>
              </div>
              <!-- /.col -->	
			 <!-- /.col -->
              <div class="col-md-2">
               <div class="form-group" id="labelarea">
                  <label>เขตสุขภาพ</label>
                  <select name="CODE_HMOO" class="form-control select2" id="area" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="เขต 01">เขต1</option>
                    <option value="เขต 02">เขต2</option>
                    <option value="เขต 03">เขต3</option>
					<option value="เขต 04">เขต4</option>
                    <option value="เขต 05">เขต5</option>
                    <option value="เขต 06">เขต6</option>
					<option value="เขต 07">เขต7</option>
                    <option value="เขต 08">เขต8</option>
                    <option value="เขต 09">เขต9</option>
					<option value="เขต 10">เขต10</option>
                    <option value="เขต 11">เขต11</option>
                    <option value="เขต 12">เขต12</option>
					<option value="เขต 13">เขต13</option>
                   </select>
                </div>
				<!-- /.form-group -->
                <div class="form-group" id="labelservice" hidden="none">
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" hidden="none">
                     <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					<option value="F2">F2</option>
					<option value="F3">F3</option>  
                  </select>
                </div>
                <!-- /.form-group -->  
              </div>
              <!-- /.col -->
			   <?php */ ?>

<?php 

        if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขจังหวัด'){

  if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){
    ?>  
			  <div class="col-md-4">
               <div class="form-group">
                  <label>จังหวัด</label>
                  <select name="CODE_PROVINCE" class="form-control select2" id="CODE_PROVINCE" style="width: 100%;" onChange="myFunction2()">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlprovince = "SELECT DISTINCT *
					FROM userhospital 
					INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
					WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
					AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
					AND hospitalnew.CODE_HMOO = '$HosMOHP'
					GROUP BY hospitalnew.CODE_PROVINCE";
				
					$objprovince = mysqli_query($con, $sqlprovince);
					
					while($rowprovince = mysqli_fetch_array($objprovince))

					{
	
					?>
					  <option value="<?PHP echo $rowprovince["NO_PROVINCE"];?>" ><?PHP echo $rowprovince["CODE_PROVINCE"];?></option>
					  
					<?PHP
					}
					?>


                  </select>
                </div>
				<script>
                   function myFunction2() {
                      const selectedValue = $('#CODE_PROVINCE').val();
                         // alert(selectedValue);
                          $.ajax({
                            url: 'get_hos.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { CODE_PROVINCE: selectedValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
              </div>

                <?php  }} ?>
			  <!-- /.form-group -->
        <?php if($_SESSION["HosType"] <> 'สำนักงานสาธารณสุขอำเภอ'){?>
			  <div class="form-group" id="labelservice" >
                  <label>Service Plan Level</label>
                  <select name="TYPE_SERVICE" class="form-control select2" id="service" style="width: 100%;" onChange="myFunction3()">
                     <option selected="selected" value="ทั้งหมด">ทั้งหมด</option>
                    <option value="A">A</option>
                    <option value="S">S</option>
                    <option value="M1">M1</option>
                    <option value="M2">M2</option>
                    <option value="F1">F1</option>
					<option value="F2">F2</option>
					<option value="F3">F3</option>  
                  </select>
                </div>
                <!-- /.form-group -->  
             <?php   if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){ ?>

              <script>
                   function myFunction3() {
                      const selectedValue = $('#service').val();
					  var codeprovinceValue = "<?php echo $codeprovince; ?>";
                         // alert(codeprovinceValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue ,codeprovince: codeprovinceValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 

              <?php }else if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){?>  
                
                <script>
                   function myFunction3() {
                      const selectedValue = $('#service').val();
					  var codeprovinceValue = "<?php echo $codeprovince; ?>";
                          //alert(codeprovinceValue);
                          $.ajax({
                            url: 'get_service.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue ,codeprovince: codeprovinceValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 

                <?php }else{?>   
                <script>
                   function myFunction3() {
                      const selectedValue = $('#service').val();
					  const codeprovinceValue = $('#CODE_PROVINCE').val();
                          //alert(codeprovinceValue);
                          $.ajax({
                            url: 'get_service2.php', // ไฟล์ PHP ที่จะประมวลผล
                            data: { service_id: selectedValue ,codeprovince: codeprovinceValue },
                            success: function(data) {
                              $('#CODE_HOS').html(data);
                            }
                          });
                    }
			    	</script> 
            <?php }} ?>

			  <div class="col-md-6">
               <div class="form-group">
                  <label>โรงพยาบาล</label>
                  <select name="CODE_HOS" class="form-control select2" id="CODE_HOS" style="width: 100%;">
                    <option selected="selected" value="ทั้งหมด" >ทั้งหมด</option>
					<?PHP
					$sqlhos = "SELECT *
					FROM userhospital 
					INNER JOIN hospitalnew ON userhospital.HospitalID = hospitalnew.CODE5
					WHERE hospitalnew.HOS_TYPE <>'คลินิกเอกชน'
					AND hospitalnew.HOS_TYPE <>'โรงพยาบาลเอกชน'
					AND hospitalnew.CODE_HMOO = '$HosMOHP'";

        if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){					  
          $sqlhos = $sqlhos."AND hospitalnew.CODE_PROVINCE LIKE  '%$codeprovince'" ;
          }

          
          if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){					  
          $sqlhos = $sqlhos."AND hospitalnew.NO_DISTRICT LIKE  '%$NO_DISTRICT' AND hospitalnew.HOS_TYPE <>'โรงพยาบาลชุมชน' AND hospitalnew.HOS_TYPE <>'สำนักงานสาธารณสุขอำเภอ' " ;
          }
				
					$objhos = mysqli_query($con, $sqlhos);
					
					while($rowhos = mysqli_fetch_array($objhos))

					{
	
					?>
					  <option value="<?PHP echo $rowhos["CODE5"];?>" ><?PHP echo $rowhos["HOS_NAME"];?></option>
					  
					<?PHP
					}
					?>

                  </select>
                </div>
              </div>
              <!-- /.col -->			
            </div>
            <!-- /.row -->
		
			<div class="card-footer">
				  <button type="submit" class="btn btn-primary"> ค้นข้อมูล &nbsp;<i class="fa fas fa-search"></i></button>
				   <button type="reset" class="btn btn-default"> รีเซต &nbsp;<i class="fa fas fa-undo"></i></button>	
			  	  <!--<a href="#" class="btn btn-default"> กลับหน้าหลัก &nbsp;<i class="fa fas fa-undo"></i></a>-->
			</div>  
		</form>

    
    <?php  } ?>
        </div>

        
        <!-- /.card -->	 
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
                      <th>ชื่อโรงพยาบาล</th>
                      <th>ข้อมูลระบบบริการจิตเวช</th>			
					  <th>เพิ่มปรับปรุงข้อมูล</th>
                      <th>ลบข้อมูล</th>
                      <th>ส่งข้อมูล</th>
					
					</tr>
                   </thead>
                   <tbody>
					 <?php
           if($_SESSION["TypeUser"] == "Admin"){ 
            $sqlpersonnel = "SELECT * 
            FROM serviceform
            join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
             ";
          }else{
					 if($HosType == "กรมสุขภาพจิต"){ 
            $sqlpersonnel = "SELECT * 
            FROM serviceform
            join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID						
            WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
             ";
	
			  		}elseif($HosType == "ศูนย์วิชาการ"){ 
				  			
              $sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID						
							WHERE hospitalnew.CODE_HMOO = '$HosMOHP' 
							 ";
	
			  		}elseif($HosType == "สำนักงานสาธารณสุขจังหวัด"){ 
              $sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
							WHERE hospitalnew.CODE_PROVINCE = '$codeprovince'  
							 ";
              }elseif($HosType == "สำนักงานสาธารณสุขอำเภอ"){ 
                $sqlpersonnel = "SELECT * 
                FROM serviceform
                join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
                              WHERE hospitalnew.CODE_PROVINCE = '$codeprovince' 
                              AND hospitalnew.NO_DISTRICT ='$NO_DISTRICT' 
                              ";
      
	
			  		}else{
						
							$sqlpersonnel = "SELECT * 
              FROM serviceform
              join hospitalnew ON hospitalnew.CODE5 = serviceform.HospitalID
							WHERE serviceform.HospitalID = '$HospitalID' 
							 ";
						}
					 }

           if(isset($_POST["CODE_HOS"])){	
						if($_POST["CODE_HOS"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.CODE5 = '".$_POST['CODE_HOS']."'" ;
						}
					}
					if(isset($_POST["TYPE_SERVICE"])){	
						if($_POST["TYPE_SERVICE"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.TYPE_SERVICE LIKE ('".$_POST['TYPE_SERVICE']."%')" ;
						}
					}

					if(isset($_POST["CODE_PROVINCE"])){	
						if($_POST["CODE_PROVINCE"]<>'ทั้งหมด'){					  
							$sqlpersonnel = $sqlpersonnel."AND hospitalnew.NO_PROVINCE LIKE ('".$_POST['CODE_PROVINCE']."')" ;
						}
					}
         $sqlpersonnel = $sqlpersonnel." ORDER BY serviceform.mhpsDate DESC; " ;

          //echo $sqlpersonnel;
					$objpersonnel = mysqli_query($con, $sqlpersonnel);
					$i = 1;
					while($rowpersonnel = mysqli_fetch_array($objpersonnel))
					{
            if($rowpersonnel['qustype']== '1'){
          ?>
            <tr>
						<td><?php echo $i++; ?></td>
            <td>
							<?php echo $rowpersonnel['HOS_NAME'];?>
						</td>
					
						<td>
							<a href="hospital_center_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a></td>

						<td>
            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_center_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a>
              
						<?php } ?>

                            <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
                             <a href="hospital_center_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a>
                        <? } ?>
                        </td>
              <td>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
                            <? } ?>


                            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
						<?php } ?>
            
                        </td>
              <td>
              <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
              
						<?php } ?>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
                            <? } ?>
                        </td>
              
             
						
					</tr>
          <?php
            }else if($rowpersonnel['qustype']== '2'){
					?>
					<tr>
						<td><?php echo $i++; ?></td>
                        <td>
							<?php echo $rowpersonnel['HOS_NAME'];?>
						</td>
						<td>
							<a href="hospital_community_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a></td>
						<td>
            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_center_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a>
              
						<?php } ?>
                        <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_community_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a><?php } ?></td>
              <td>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
                            <?php } ?>
                          
                            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
						<?php } ?>
            
                          
                          </td>
              <td>
              <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
              
						<?php } ?>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
                            <?php } ?></td>
              

            
					</tr>
          <?php
            }else if($rowpersonnel['qustype']== '3'){
					?>
					<tr>
						<td><?php echo $i++; ?></td>
                        <td>
							<?php echo $rowpersonnel['HOS_NAME'];?>
						</td>
						<td>
                   
							<a href="hospital_tambon_view.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkyellow; font-size: 16pt">รายละเอียด</i>
							</a>
                           </td>
						<td>
            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_center_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a>
              
						<?php } ?>
                        <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_tambon_edit.php?FID=<?php echo $rowpersonnel['mhpsID'];?>" >
								<i class="fa fa-edit" style="color:darkblue; font-size: 16pt">เพิ่มปรับปรุงข้อมูล</i>
							</a>
                            <?php } ?></td>
              <td>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
                            <?php } ?>
                            <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
              <a href="hospital_del.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert()">
								<i class="far fa-trash-alt" style="color: darkred; font-size: 16pt">ลบข้อมูล</i>
							</a>
              
						<?php } ?>
            
                          
                          
                          </td>
              <td>
              <?php 
              if($_SESSION["TypeUser"] == "Admin"){?>
		
    <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
              
						<?php } ?>
              <?php if($rowpersonnel['HOS_NAME'] == $_SESSION["HOS_NAME"]){	?>
              <a href="hospital_send.php?mhpsID=<?=$rowpersonnel['mhpsID'];?>" onclick="showAlert2()">
								<i class="far fa-edit" style="color: darkgreen; font-size: 16pt">ส่งข้อมูลข้อมูล</i>
							</a>
                            <?php } ?></td>

             
						
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
                        <td><?php echo implode(',',$qus1_1);?></td>
                        <td><?php echo implode(',',$qus1_2);?></td>
                        <td><?php echo implode(',',$qus1_3);?></td>
                        <td><?php echo implode(',',$qus1_4);?></td>
                        <td><?php echo implode(',',$qus2_1);?></td>
                        <td><?php echo implode(',',$qus2_2);?></td>
                        <td><?php echo implode(',',$qus2_2_1);?></td>
                        <td><?php echo implode(',',$qus2_2_2);?></td>
                        <td><?php echo implode(',',$qus2_3);?></td>
                        <td><?php echo implode(',',$qus3_1);?></td>
                        <td><?php echo implode(',',$qus3_2);?></td>
                        <td><?php echo implode(',',$qus3_3);?></td>
                        <td><?php echo implode(',',$qus3_4);?></td>
                        <td><?php echo implode(',',$qus3_5);?></td>
                        <td><?php echo implode(',',$qus4_1);?></td>
                        <td><?php echo implode(',',$qus4_2);?></td>
                        <td><?php echo implode(',',$qus5_1);?></td>
                        <td><?php echo implode(',',$number_patients);?></td>
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