<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType        = $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP        = $_SESSION["HostHMOO"];
$codeprovince   = $_SESSION["codeprovince"];
$HospitalID = $_SESSION["HospitalID"];

?>

<html>
<head>
<title>ThaiCreate.Com PHP & MySQL To CSV</title>
</head>
<body>

<?php
// Define filename and open for writing
$filName = "customer.csv";
$objWrite = fopen("customer.csv", "w");

// Set Content-Type and Download headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=' . $filName);

$strSQL = "SELECT 
            personnel.personnelID, 
            personnel.positiontypeID,
            personnel.prename, 
            personnel.firstname, 
            personnel.lastname,  
            personnel.age,
            personnel.r1 as 'positionAllName', 
            personnel.r2 as 'fixpositionAllName', 
            hospitalnew.HOS_NAME,
            personnel.positionrole, 
            personnel.congrat, 
            personnel.training, 
            personnel.cogratyear, 
            personnel.statuscong,
            personnel.regislaw,
            personneltype.Ptypename,
            personnel.positiontypeID,
            personnel.Mcatt1
        FROM 
            personnel 
        JOIN hospitalnew on hospitalnew.CODE5 = personnel.HospitalID 
        JOIN personneltype ON personneltype.PtypeID = personnel.positiontypeID
        WHERE 
            hospitalnew.CODE5 = '$HospitalID' 
        AND setdel = '1'
        ORDER BY 
            personnelID DESC; ";

$objQuery = mysqli_query($con, $strSQL);

while($objResult = mysqli_fetch_array($objQuery)) {

  fwrite($objWrite, "\"$objResult[personnelID]\",\"$objResult[positiontypeID]\",\"$objResult[prename]\",");
  fwrite($objWrite, "\"$objResult[firstname]\",\"$objResult[lastname]\",\"$objResult[age]\" \n");
}

fclose($objWrite);

// No download link needed as automatic download is set
echo "<br>Generate CSV Done.<br><a href=$filName>Download</a>";

?>
</table>
</body>
</html>