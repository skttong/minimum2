<?php
session_start();
$timeout = 14400; //600 Number of seconds until it times out.
 
// Check if the timeout field exists.
if(isset($_SESSION['timeout'])) {
    // See if the number of seconds since the last
    // visit is larger than the timeout period.
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout) {
        // Destroy the session and restart it.
        session_destroy();
        session_start();
    }
}
 
// Update the timout field with the current time.
$_SESSION['timeout'] = time();
if($_SESSION['UserID'] == "")
	{
		//Header("Location: form_login.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 
        echo "<script type='text/javascript'>";
        //echo "alert('Error!!');";
        echo "window.location = 'form_login.php'; ";
        echo "</script>";
		exit();
	}
	$_SESSION["UserID"];
	$_SESSION["TypeUser"];
	$_SESSION["HosType"];

?>