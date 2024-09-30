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
	
    <!-- Login Form -->
	<form action="form_changepassword.php" method="post" class="needs-validation" name="foml" novalidate>
		<input type="text" name="txtUsername"  class="form-control" id="username" placeholder="Username" autocomplete="on" required >
		<div class="invalid-feedback"> โปรดกรอก username. </div>
		
		<input type="text" name="txtMobile" class="form-control" id="txtMobile" placeholder="Mobile" autocomplete="off" required>
		<div class="invalid-feedback"> โปรดกรอกหมายเลขโทรศัพท์. </div>
		 
		<input type="submit" class="" value="ยืนยันข้อมูล">
	</form>
	 
    <!-- Remind Passowrd -->
    <div id="formFooter">
      	<a class="linka underlineHover" href="https://mhso.dmh.go.th" target="_blank">กองบริหารระบบบริการสุขภาพจิต กรมสุขภาพจิต</a>
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