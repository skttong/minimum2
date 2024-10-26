<?php 
	session_start();

	include('connect/conn.php'); 
	session_destroy();
	
	$username = trim($_POST['txtUsername']);

	$sql1 = "SELECT
				*
			FROM
				userhospital
			WHERE
				Username = '".$username."' And
				mobile = '".trim($_POST['txtMobile'])."';";
	$obj1 = mysqli_query($con, $sql1);
	$row1 = mysqli_fetch_array($obj1);

/*

	if(!$row1)
	{
			echo "Not Found Username or Mobile!";
	}
	else
	{
			echo "Your password send successful.<br>Send to mail : ".$objResult["Email"];		

			$strTo = $objResult["txtEmail"];
			$strSubject = "Your Account information username and password.";
			$strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
			$strHeader .= "From: webmaster@thaicreate.com\nReply-To: webmaster@thaicreate.com";
			$strMessage = "";
			$strMessage .= "Welcome : ".$objResult["Name"]."<br>";
			$strMessage .= "Username : ".$objResult["Username"]."<br>";
			$strMessage .= "Password : ".$objResult["Password"]."<br>";
			$strMessage .= "=================================<br>";
			$strMessage .= "ThaiCreate.Com<br>";
			$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader); 

	}
*/
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
	  if(!$row1)
	{
		  echo "<br>";	
		  echo "<br>";	
		  echo "<br>";	
		  echo "<p style='color:red;' >Not Found Username or Mobile!</p>";
		  echo "<br>";	
		  echo "<br>";	
	?>
	 <!-- Login Form -->
	<form action="form_login.php" method="post" class="needs-validation" name="foml" novalidate> 
	  <input type="submit" class="" value="กลับไปหน้า login">
	</form>  
	  
	<?php
	}else{
	  ?>
    <!-- Login Form -->
	<form action="updatepassword.php" method="post" class="needs-validation" name="foml" novalidate>
		
		
		<input name="txtUsername" type="hidden" id="txtUsername"  value="<?php echo "$username"; ?>" >
		
		<input type="text" name="txtPassword01"  class="form-control" id="txtPassword01" placeholder="Password" autocomplete="on" required >
		<div class="invalid-feedback"> โปรดกรอก New password. </div>
		
		<input type="text" name="txtPassword02" class="form-control" id="txtPassword02" placeholder="Password" autocomplete="off" required>
		<div class="invalid-feedback"> โปรดกรอก New password. </div>
		 
		<input type="submit" class="" value="ตกลง">
	</form>
	  
	<?php } ?> 
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