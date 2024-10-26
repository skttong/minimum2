<?php
session_start();
include('connect/conn.php');

$sqllogon 		= "UPDATE userhospital SET `lock` = '0' WHERE UserID = '".$_SESSION["UserID"]."';" ;
$resultlogon  	= mysqli_query($con, $sqllogon);

session_destroy();
header("Location: index.php");	
?>