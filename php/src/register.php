<?php 
session_start();
include('connect/conn.php'); 
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

<style>
	
/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -5px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -5px;
  content: "✖";
}

</style>
	
</head>

<body style="background: #FAA0A0;">
<div class="wrapper">
  <div id="formContentRegis">
    <!-- Icon -->
    <div class="" style="margin-top: 20px;">
      <img src="images/DMH.png" id="iconRegis" alt="User Icon">
    </div>
	  
	<!-- Tabs Titles -->
   <!-- <h2 class="tabtitle active">ระบบทรัพยากรสุขภาพจิตและจิตเวช</h2>-->
   <!-- <h2 class="inactive underlineHover">Sign Up </h2>-->
	<p><b>ลงทะเบียนผู้ใช้งาน</b></p>
	<p></p>
    <!-- Login Form -->
	
	<form action="updateuserfirstlogin.php" method="post" class="needs-validation" name="formregister" novalidate >
	 <div class="container">
	 	<div class="row">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="newpassword" class="form-label">คำนำหน้าชื่อ</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <select style="width: 85%;" name="prename" class="select2"  required>
                  <option selected="selected" value="">-- เลือกคำนำหน้าชื่อ --</option>
					<?php
					$sqlprefix = "SELECT * FROM prefix";
					$objprefix = mysqli_query($con, $sqlprefix);
					while($rowrefix = mysqli_fetch_array($objprefix))
						{?>
				  <option value="<?php echo $rowrefix['prefixID'];?>"><?php echo $rowrefix['prefixName'];?></option>
				<?php } ?>
                </select>	
              </div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
                  &nbsp;
              </div>
		  </div>
		</div>
	 </div>
	 <div class="container">
	 	<div class="row" style="margin-bottom: 10px;">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="firstname" class="form-label" style="text-align: left;">ชื่อ <b><small class="text-danger">*</small></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				  </div>
                  <input  type="text" name="firstname" class="form-control" id="firstname" placeholder="กรอกชื่อ" onkeyup="isThaichar(this.value,this)" required>
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกชื่อ (ภาษาไทยเท่านั้น) </div>
              </div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
                  <label for="lastname" class="form-label">นามสกุล</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="กรอกนามสกุล" onkeyup="isThaichar(this.value,this)" required>
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกนามสกุล (ภาษาไทยเท่านั้น) </div>
              </div>
		  </div>
		</div>
	  </div>
	  <div class="container">
	 	<div class="row" style="margin-bottom: 10px;">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="position" class="form-label" style="text-align: left;">ตำแหน่ง<b><small class="text-danger">*</small></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				  </div>
                  <input  type="text" name="position" class="form-control" id="position" placeholder="กรอกตำแหน่ง" onkeyup="isThaichar(this.value,this)" required>
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกตำแหน่ง (ภาษาไทยเท่านั้น) </div>
              </div>
		  </div>
		</div>
	  </div>
	  <div class="container">
	 	<div class="row" style="margin-bottom: 10px;">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="telaphone" class="form-label">เบอร์โทรสำนักงาน</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input  type="text" name="telaphone" class="form-control" id="telaphone" placeholder="กรอกเบอร์โทรสำนักงาน" onkeypress="check_key_number();" onkeyup="autoTab2(this)" required >
				  <br><div align="left" style="margin-left: 28px;"><small class="text-danger">โปรดกรอกเฉพาะตัวเลขเท่านั้น ไม่ต้องใส่ขีด (-)</small></div>
				  <!--<div class="invalid-feedback"> โปรดกรอกเบอร์โทรสำนักงาน (เฉพาะตัวเลขเท่านั้น) </div>-->
              </div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
                  <label for="telaphone2" class="form-label">เบอร์ต่อ</label>
				  </div>
                  <input type="text" name="telaphone2" class="form-control" id="telaphone2" placeholder="กรอกเบอร์ต่อ (ถ้ามื)" onkeypress="check_key_number();">
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกเบอร์ต่อ (เฉพาะตัวเลขเท่านั้น) </div>
              </div>
		  </div>
		</div>
	  </div>
	  <div class="container">
	 	<div class="row" style="margin-bottom: 10px;">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
                  <label for="moblie" class="form-label">เบอร์มือถือ</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input type="text" name="moblie" class="form-control" id="moblie" placeholder="กรอกเบอร์มือถือ 10 หลัก" onkeypress="check_key_number();" onkeyup="autoTab(this)" required>
				  <br><div align="left" style="margin-left: 28px;"><small class="text-danger">โปรดกรอกเฉพาะตัวเลขเท่านั้น ไม่ต้องใส่ขีด (-)</small></div>
				  <!--<div class="invalid-feedback"> โปรดกรอกเบอร์มือถือ (เฉพาะตัวเลขเท่านั้น) </div>-->
              </div>
		  </div>
		 
		</div>
	  </div>
	  <div class="container">
	 	<div class="row" style="margin-bottom: 10px;">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
                 <!-- <label for="Affiliation" class="form-label">สังกัด</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input type="text" name="Affiliation" class="form-control" id="Affiliation" placeholder="กรอกสังกัด" onkeyup="isThaichar(this.value,this)"  required>
				 <!-- <br><div align="left" style="margin-left: 28px;"><small class="text-danger">โปรดกรอกเฉพาะตัวเลขเท่านั้น ไม่ต้องใส่ขีด (-)</small></div>-->
				  <!--<div class="invalid-feedback"> โปรดกรอกเบอร์มือถือ (เฉพาะตัวเลขเท่านั้น) </div>-->
				 <!-- <div class="form-group col-6">-->
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="Affiliation" class="form-label">สังกัด</label> <b><small class="text-danger">*</small></b>
				  </div>
                  		<select style="width: 85%;" name="Affiliation" class="select2"  required>
						<option value="<?php echo $_SESSION["Affiliation"];?>"><?php echo $_SESSION["Affiliation"];?></option>	
						<option value="">-- เลือกสังกัด --</option>
						<option value="กระทรวงสาธารณสุข">กระทรวงสาธารณสุข</option>
						<option value="กระทรวงมหาดไทย">กระทรวงมหาดไทย</option>
                	</select>	
              	</div>
              </div>
			</div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
                  <div align="left" style="margin-left: 28px;">
				  <label for="HospitalID" class="form-label">หน่วยบริการ</label>
				  </div>
                  <input  type="hidden" name="HospitalID" class="form-control" id="HospitalID" value="<?php echo $_SESSION["HospitalID"];?>" readonly>
				  <input  type="text" name="HOS_NAME" class="form-control" id="HOS_NAME" value="<?php echo $_SESSION["HOS_NAME"];?>" readonly>
              </div>
		  </div>
	  </div>
	    <div class="container">
	 	<div class="row">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
                  <label for="email" class="form-label">อีเมล์</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input type="text" name="email" class="form-control" id="moblie" placeholder="กรอกอีเมล์" required>
				  <br><!--<small class="text-danger">กรอกอีเมล์</small>-->
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกอีเมล์ </div>
              </div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
                  <div align="left" style="margin-left: 28px;">
				  <label for="HospitalID" class="form-label">ระดับสังกัดสถานพยาบาล</label>
				  </div>
                
				  <input  type="text" name="TYPESERVICE" class="form-control" id="TYPESERVICE" value="<?php echo $_SESSION["TypeService"];?>" readonly>
              </div>
			  
		  </div>
		  </div>
		  <div class="form-group col-6">
			 &nbsp;
		  </div>
		</div>
	  </div>
	  <br>
	  <p><b>*โปรด<u>เปลี่ยนรหัสผ่านใหม่</u>เพื่อเข้าสู่ระบบ*</b></p>
	  <div class="container">
	 	<div class="row">
		  <div class="form-group col-6">
			  <div class="form-group">
				  <div align="left" style="margin-left: 28px;">
				  <label for="newpassword" class="form-label">รหัสผ่านใหม่</label> <b><small class="text-danger">*</small></b>
				  </div>
                  <input type="text" name="newpassword" class="form-control" id="newpassword" placeholder="กรอกรหัสผ่านใหม่" 
						 pattern="(?=.*\d)(?=.*[a-z]).{8,}" 
						 title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
						 onkeypress="return bannedKey(event)" required>
				  <div class="invalid-feedback" align="left" style="margin-left: 28px;"> โปรดกรอกรหัสผ่านใหม่อย่างน้อย 8 หลัก </div>
				  
					<div id="message" align="left" style="margin-left: 30px;display: none;">
					  <br>
					  <p><b>การตั้งรหัสผ่านต้องมีองค์ประกอบต่อไปนี้:</b></p>
					  <p id="letter" class="invalid">ต้องเป็น <b>ภาษาอังกฤษ</b> เท่านั้น</p>
					  <!--<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>-->
					  <p id="number" class="invalid">ต้องมี <b>ตัวเลข</b> เป็นองค์ประกอบ</p>
					  <p id="length" class="invalid">ต้องมีความยาว <b>อย่างน้อย 8 ตัวอักษร</b></p>
					</div>
				  
				  	<script>
					var myInput = document.getElementById("newpassword");
					var letter 	= document.getElementById("letter");
					//var capital = document.getElementById("capital");
					var number 	= document.getElementById("number");
					var length 	= document.getElementById("length");

					// When the user clicks on the password field, show the message box
					myInput.onfocus = function() {
					  document.getElementById("message").style.display = "block";
					}

					// When the user clicks outside of the password field, hide the message box
					myInput.onblur = function() {
					  document.getElementById("message").style.display = "none";
					}

					// When the user starts to type something inside the password field
					myInput.onkeyup = function() {
					  // Validate lowercase letters
					  var lowerCaseLetters = /[a-z,A-Z]/g;
					  if(myInput.value.match(lowerCaseLetters)) {  
						letter.classList.remove("invalid");
						letter.classList.add("valid");
					  } else {
						letter.classList.remove("valid");
						letter.classList.add("invalid");
					  }

					  // Validate capital letters
					/*	
					  var upperCaseLetters = /[A-Z]/g;
					  if(myInput.value.match(upperCaseLetters)) {  
						capital.classList.remove("invalid");
						capital.classList.add("valid");
					  } else {
						capital.classList.remove("valid");
						capital.classList.add("invalid");
					  }*/
					  	
					  // Validate numbers
					  var numbers = /[0-9]/g;
					  if(myInput.value.match(numbers)) {  
						number.classList.remove("invalid");
						number.classList.add("valid");
					  } else {
						number.classList.remove("valid");
						number.classList.add("invalid");
					  }

					  // Validate length
					  if(myInput.value.length >= 8) {
						length.classList.remove("invalid");
						length.classList.add("valid");
					  } else {
						length.classList.remove("valid");
						length.classList.add("invalid");
					  }
					}
					</script>
				  
              </div>
		  </div>
		  <div class="form-group col-6">
			  <div class="form-group">
                  &nbsp;
              </div>
		  </div>
		</div>
	  </div>
		
		<input type="submit" class="" value="ลงทะเบียน/เข้าสู่ระบบ" style="font-size: 16px;">
	</form>
	  
    <!-- Remind Passowrd -->
    <div id="formFooter">
      	<a class="linka underlineHover" href="http://www.mhso.dmh.go.th" target="_blank">กองบริหารระบบบริการสุขภาพจิต กรมสุขภาพจิต</a>
		<br>&copy; <?php echo date("Y"); ?> All rights reserved.
    </div>

  </div>
</div>
<script language="JavaScript" type="text/JavaScript">
function check_key_number() {
	use_key=event.keyCode
	if (use_key != 13 && (use_key < 48) || (use_key > 57)) {
		alert("กรุณากรอกเป็นตัวเลขเท่านั้น");
		event.returnValue = false;
	}
}

	
function isThaichar(str,obj){
    var orgi_text="ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ";
    var str_length=str.length;
    var str_length_end=str_length-1;
    var isThai=true;
    var Char_At="";
    for(i=0;i<str_length;i++){
        Char_At=str.charAt(i);
        if(orgi_text.indexOf(Char_At)==-1){
            isThai=false;
        }   
    }
    if(str_length>=1){
        if(isThai==false){
			alert("กรุณากรอกภาษาไทยเท่านั้น");
            obj.value=str.substr(0,str_length_end);
        }
    }
    return isThai; // ถ้าเป็น true แสดงว่าเป็นภาษาไทยทั้งหมด
}

function bannedKey(evt){
	var allowedEng = true; //อนุญาตให้คีย์อังกฤษ
	var allowedThai = false; //อนุญาตให้คีย์ไทย
	var allowedNum = true; //อนุญาตให้คีย์ตัวเลข
	var k = event.keyCode;/* เช็คตัวเลข 0-9 */
	if (k>=48 && k<=57) { return allowedNum; }

	/* เช็คคีย์อังกฤษ a-z, A-Z */
	if ((k>=65 && k<=90) || (k>=97 && k<=122)) { return allowedEng; }

	/* เช็คคีย์ไทย ทั้งแบบ non-unicode และ unicode */
	if ((k>=161 && k<=255) || (k>=3585 && k<=3675)) {
		alert("กรอกได้เฉพาะตัวเลขและตัวอักษรภาษาอังกฤษเท่านั้น"); 
		return allowedThai; 
	}
}
	
function autoTab(obj){ 
/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย 
หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน 
4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__ 
รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____ 
หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__ 
ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน 
*/ 
var pattern = new String("__________"); // กำหนดรูปแบบในนี้ 
var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้ 
var returnText = new String(""); 
var obj_l=obj.value.length; 
var obj_l2=obj_l-1; 
	
for(i=0;i<pattern.length;i++){
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
		returnText+=obj.value+pattern_ex; 
		obj.value=returnText;
	} 
} 
	if(obj_l>=pattern.length){
		obj.value=obj.value.substr(0,pattern.length);
	} 
} 

function autoTab2(obj){ 
/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย 
หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน 
4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__ 
รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____ 
หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__ 
ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน 
*/ 
var pattern = new String("_________"); // กำหนดรูปแบบในนี้ 
var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้ 
var returnText = new String(""); 
var obj_l=obj.value.length; 
var obj_l2=obj_l-1; 
	
for(i=0;i<pattern.length;i++){
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
		returnText+=obj.value+pattern_ex; 
		obj.value=returnText;
	} 
} 
	if(obj_l>=pattern.length){
		obj.value=obj.value.substr(0,pattern.length);
	} 
} 
</script>

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