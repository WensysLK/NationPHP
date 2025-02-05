<?php 

include('../../includes/db_config.php');
session_start();
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which button was clicked
    $applicantTitle = isset($_POST['name-title']) ? $_POST['name-title'] : '';
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
        header("Location: ../client_registration.php");
        exit();
    } elseif (isset($_POST['saveExit'])) {
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