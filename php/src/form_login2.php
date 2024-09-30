<?php 
	session_start();

	include('connect/conn.php'); 
	session_destroy();
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

<body class="bodylog" style="background: #56baed;">
<div class="wrapper">
  <div id="formContent">
    <!-- Icon -->
    <div class="" style="margin-top: 20px;">
      <img src="images/DMH.png" id="icon" alt="User Icon">
    </div>
	  
	<!-- Tabs Titles -->
    <h2 class="tabtitle active">ระบบทรัพยากรสุขภาพจิตและจิตเวช</h2>
   <!-- <h2 class="inactive underlineHover">Sign Up </h2>-->
	
    <!-- Login Form -->
	<form action="toRegister.php" method="post" class="needs-validation" name="foml" novalidate>
		<input type="text" name="txtUsername"  class="form-control" id="username" placeholder="Username" autocomplete="on" required >
		<div class="invalid-feedback"> โปรดกรอก username. </div>
		
		<input type="password" name="txtPassword" class="form-control" id="password" placeholder="Password" autocomplete="off" required>
		<div class="invalid-feedback"> โปรดกรอก password. </div>
		 
		<input type="submit" class="" value="เข้าสู่ระบบ">
	</form>
	<a class="linka underlineHover" style="color: red;" href="form_forgotpassword.php"> Forgot Lost Password?</a>  
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