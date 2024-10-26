<?php 
	session_start();

	include('connect/conn.php'); 
	session_destroy();
	
	$sql1 = "update userhospital set `Password` = '".trim($_POST['txtPassword01'])."' WHERE Username = '".trim($_POST['txtUsername'])."';";

	$obj1 = mysqli_query($con, $sql1);
	//$row1 = mysqli_fetch_array($obj1);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ระบบทรัพยากรสุขภาพจิตและจิตเวช</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="dist/css/login_index.css">
<link href="dist/css/bootstrap523.min.css" rel="stylesheet">
<script src="dist/js/bootstrap523.bundle.min.js"></script>
</head>

<body class="bodylog" style="background: #FAA0A0;">
<div class="wrapper">
  <div id="formContent">
    <!-- Icon -->
    <div class="" style="margin-top: 20px;">
      <img src="images/DMH.png" id="icon" alt="User Icon">
    </div>
	  
	<!-- Tabs Titles -->
    <h2 class="tabtitle active">ระบบทรัพยากรสุขภาพจิตและจิตเวช</h2>
   <!-- <h2 class="inactive underlineHover">Sign Up </h2>-->
	  
	<?php

	  
     echo "<br>";	
		  echo "<br>";	
		  echo "<br>";	
		  echo "<p style='color:red;' >เปลี่ยน Password แล้วเรียบร้อย</p>";
		  echo "<br>";	
		  echo "<br>";	
	?>
	 <!-- Login Form -->
	<form action="form_login.php" method="post" class="needs-validation" name="foml" novalidate> 
		<input type="submit" class="" value="กลับไปหน้า login">
	</form>  

    <!-- Remind Passowrd -->
    <div id="formFooter">
      	<a class="linka underlineHover" href="http://www.mhso.dmh.go.th" target="_blank">กองบริหารระบบบริการสุขภาพจิต กรมสุขภาพจิต</a>
		<br>&copy; <?php echo date("Y"); ?> All rights reserved.
    </div>

  </div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()	

</script>
</body>
</html>