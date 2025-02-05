<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
    $applicantLname = $_SESSION['applicantLname'];
    $applicantName = $_SESSION['client_name'] = $applicantFname . ' ' . $applicantLname;
    
    // Use $applicantId for further processing

    // Optionally, unset the session variable if no longer neede 
    } 
//$applicantId1 = $_SESSION['last_applicant_id'] = 120;
//$applicantName = $_SESSION['client_name'] = "Terrance";
    
if(isset($_POST['save'])){

    // Sanitize input data
    
    $applicanemail = htmlspecialchars(trim($_POST['cemail']), ENT_QUOTES, 'UTF-8');
    $applicantlandphone = htmlspecialchars(trim($_POST['clphone']), ENT_QUOTES, 'UTF-8');
    $applicantmobile1 = htmlspecialchars(trim($_POST['cphone']), ENT_QUOTES, 'UTF-8');
    $applicantmobile2 = htmlspecialchars(trim($_POST['cphone2']), ENT_QUOTES, 'UTF-8');
    $applicantaddress1 = htmlspecialchars(trim($_POST['caddress1']), ENT_QUOTES, 'UTF-8');
    $applicantaddress2 = htmlspecialchars(trim($_POST['caddress2']), ENT_QUOTES, 'UTF-8');
    $applicantprovince = htmlspecialchars(trim($_POST['cprovince']), ENT_QUOTES, 'UTF-8');
    $applicantcity = htmlspecialchars(trim($_POST['ccity']), ENT_QUOTES, 'UTF-8');
    $applicantgsdevision = htmlspecialchars(trim($_POST['gsdevision']), ENT_QUOTES, 'UTF-8');


    // Prepare the SQL statement
    $sqlcontactinfo = "INSERT INTO contact_information 
    (applicant_id, applicant_email, 
    applicant_landphone, applicant_phone, 
    applicant_phone2, applicant_add1,
    applicant_add2, applicant_province, 
    applicant_city, applicant_gsdevision) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmtcontact = $conn->prepare($sqlcontactinfo);
    $stmtcontact->bind_param("isssssssss", 
    $applicantId1, $applicanemail, $applicantlandphone, $applicantmobile1, $applicantmobile2, 
    $applicantaddress1, $applicantaddress2, $applicantprovince, $applicantcity, $applicantgsdevision);

    // Execute the statement
    if ($stmtcontact->execute()) {
        $_SESSION['last_applicant_id'] = $applicantId1;
        $_SESSION['applicantFname'] = $applicantFname; // Ensure these values are already set or retrieved earlier
        $_SESSION['applicantLname'] = $applicantLname;
   
        // Redirect to home page on success
        header("Location: ../view_all_applications.php");
    
    } else {
        // Handle error
        echo "Error: " . $stmtcontact->error;
    }

    
}