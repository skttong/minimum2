<?php 
include('connect/conn.php');
$sql  = "SELECT HospitalID, positiontypeID, prename, firstname, lastname, birthday, age,
				r1, other_r1, r2, 
				congrat,
				training,
				statuscong,
				positionrole,
				regislaw,
				cogratyear,
				UserID,
				personnelDate 
			FROM
				personnel 
			WHERE
				positiontypeID = 1";
$query = mysqli_query($con,$sql);
while($result = mysqli_fetch_array($query)){
	 $HOSID 	= $result['HospitalID'];
	 $PRENAME	= $result['prename'];
	 $FIRSTNAME	= $result['firstname'];
	 $LASTNAME	= $result['lastname'];
}

?>
