<?php
require('connect/conn.php');

//$PERTYPE 	= $_GET['t'];
//$DETAILTYPE	= $_GET['detail'];
/*
if (!empty($_POST['ispostback']) && $_POST['ispostback'] == 'true') {
    if (!empty($_POST['del']) && count($_POST['del']) > 0) {
        $ids = implode(',', $_POST['del']);
        $sql = "DELETE FROM todo WHERE ID IN ({$ids})";
        $con->query($sql);
    }
}
 */
 $sqluser = "DELETE FROM bed WHERE bedID = '".$_GET['id']."'";
 $resultuser = mysqli_query($con, $sqluser);
/*
if($PERTYPE != 0){
  	 $sqluser = "UPDATE personnel SET setdel = '2' WHERE personnelID = '".$_REQUEST['personnelID']."'";
	 $resultuser = mysqli_query($con, $sqluser);

	 if(!$resultuser){
	  echo "Delete Error [".mysqli_error()."]";
	 }else{
		echo "<script type='text/javascript'>";
		echo "alert('ลบข้อมูลเรียบร้อย');";
		echo "window.location = 'tables-1.php?t=$PERTYPE'; ";
		echo "</script>";

	}
}elseif($PERTYPE == 0){
	if($DETAILTYPE == 'bed'){
		$sqluser = "UPDATE bed SET setbeddel = '2' WHERE bedID = '".$_REQUEST['bedID']."'";
		$resultuser = mysqli_query($con, $sqluser);

		 if(!$resultuser){
		  echo "Delete Error [".mysqli_error()."]";
		 }else{
			echo "<script type='text/javascript'>";
			echo "alert('ลบข้อมูลเรียบร้อย');";
			echo "window.location = 'tables-2.php';";
			echo "</script>";

		}
	}elseif($DETAILTYPE == 'ect'){
		$sqluser = "UPDATE ect SET setectdel = '2' WHERE ID = '".$_REQUEST['ectID']."'";
		$resultuser = mysqli_query($con, $sqluser);

		 if(!$resultuser){
		  echo "Delete Error [".mysqli_error()."]";
		 }else{
			echo "<script type='text/javascript'>";
			echo "alert('ลบข้อมูลเรียบร้อย');";
			echo "window.location = 'tables-3.php';";
			echo "</script>";

		}
	}
		
}
	*/

	echo "<script type='text/javascript'>";
			echo "alert('ลบข้อมูลเรียบร้อย');";
			echo "window.location = 'tables-bed.php';";
			echo "</script>";
?>