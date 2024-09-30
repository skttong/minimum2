<?php
include('connect/sessiontimeout.php');
include('connect/conn.php');
include('session_permission.php');

$HosType        = $_SESSION["HosType"];
$codeprovince   = $_SESSION["codeprovince"];
$HosMOHP        = $_SESSION["HostHMOO"];
$codeprovince   = $_SESSION["codeprovince"];
$HospitalID = $_SESSION["HospitalID"];

// Connect to dompdf
require '../vendor/autoload.php';

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

// Generate HTML content for PDF (replace with your desired layout)
$html = '
<!DOCTYPE html>
<html>
<head>
<title>Personnel Report</title>
</head>
<body>
<h1>Personnel Report</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            </tr>
    </thead>
    <tbody>';

while($objResult = mysqli_fetch_array($objQuery)) {
    $html .= '
        <tr>
            <td>' . $objResult['personnelID'] . '</td>
            <td>' . $objResult['prename'] . ' ' . $objResult['firstname'] . ' ' . $objResult['lastname'] . '</td>
            </tr>';
}

$html .= '
    </tbody>
</table>
</body>
</html>';

// Initialize dompdf
$dompdf = new dompdf();

// Set content
$dompdf->load_html($html);

// Set paper size and orientation
$dompdf->set_paper('A4', 'landscape');

// Render PDF
$dompdf->render();

// Set download headers
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="personnel_report.pdf"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . strlen($dompdf->output()));

// Output PDF
echo $dompdf->output(); 

?>