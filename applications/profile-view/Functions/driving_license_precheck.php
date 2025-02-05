<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted
$Input_File = $_FILES;
var_dump($_POST,$Input_File);die();
$LicneseClinetId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$License_Type = isset($_POST['license_type']) ? $_POST['license_type'] : '';
$document_Type = isset($_POST['document_type']) ? $_POST['document_type'] : '';
$License_Country = isset($_POST['country']) ? $_POST['country'] : '';
$License_Expiry = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : '';
$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `driving_license_deatils`( 
        `LicneseClinetId`, `License_Type`, 
        `document_Type`, `License_Country`,
        `License_Expiry`, 
        `softdeletestatus`) 
        VALUES 
        ('$LicneseClinetId',
        '$License_Type','$document_Type',
        '$License_Country','$License_Expiry','$softdeletestatus')";
           $stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$LicneseClinetId");
var_dump($LicneseClinetId,$License_Type,$document_Type,$License_Country,$License_Expiry,$softdeletestatus);die();
if (!empty($_FILES['licensefileattach']['tmp_name'][$index])) {
    $fileTmpName = $_FILES['licensefileattach']['tmp_name'][$index];
    $fileName = basename($_FILES['licensefileattach']['name'][$index]);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Create a new file name using the license ID
    $newFileName = 'license-' . $licenseId . '.' . $fileExtension;

    // Call the function to handle file uploads and insert into the attachments table
    uploadAndSavelicenseAttachment($conn, $fileTmpName, 'Driving_License', "../../uploads/licenses/", $applicantId1, $licenseId,$newFileName );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    $applicantTitle = isset($_POST['license_type']) ? $_POST['license_type'] : '';
    $applicantFname = isset($_POST['Cfname']) ? $_POST['Cfname'] : '';
    $applicantMname = isset($_POST['cmname']) ? $_POST['cmname'] : '';
    $applicantLname = isset($_POST['clname']) ? $_POST['clname'] : '';
    $applicantDob = isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
    $passportNumber = isset($_POST['passportNumber']) ? $_POST['passportNumber'] : '';
    $nicNumber = isset($_POST['nicNumber']) ? $_POST['nicNumber'] : '';

    if (isset($_POST['saveContineue'])) {
        // collect form data
        // Store data in session
        $_SESSION['form_data'] = [
            'applicantTitle' => $applicantTitle,
            'applicantFname' => $applicantFname,
            'applicantMname' => $applicantMname,
            'applicantLname' => $applicantLname,
            'applicantDob' => $applicantDob,
            'passportNumber' => $passportNumber,
            'nicNumber' => $nicNumber,
        ];

       
        // Redirect to registration page
        header("Location: ../../client_registration.php");
        exit();
    }
    elseif (isset($_POST['saveExit'])) {
        // collect form data
        $apptitle = $_POST['name-title'];
        $appFirstname = $_POST['Cfname'];
        $appMidname = $_POST['cmname'];
        $appLname = $_POST['clnam'];
        $appdatebirth = $_POST['dateofbirth'];
        $appPassport = $_POST['passportNumber'];
        $appNic = $_POST['nicNumber'];
        

        $saveandclose_sql = "INSERT INTO 
        `applications`( 
        `applicantTitle`, `applicatFname`, 
        `applicantMname`, `applicantLname`,
        `applicantDob`, 
        `applicantPassno`, `applicantNICno`) 
        VALUES 
        ('$applicantTitle',
        '$applicantFname','$applicantMname',
        '$applicantLname','$applicantDob','$passportNumber',
        '$nicNumber')";
    $conn->query($saveandclose_sql);
        // Redirect or perform any action needed for this button
        header("Location: ../view_all_applications.php"); // Example redirect
        exit;
    }
}