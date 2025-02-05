<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responseappiccount = [];

// Query to get count of pending applications
$sqlappic = "SELECT COUNT(*) AS pending_app_count FROM applications WHERE applicantStatus = 'incomplete' AND softdeletStatus = 1";
$resultappic = $conn->query($sqlappic);

if ($resultappic) {
    $rowappic = $resultappic->fetch_assoc();
    $pending_app_incom_count = $rowappic['pending_app_count'];
    // Store the count in the response array
    $responseappiccount['total'] =  $pending_app_incom_count;
} else {
    // Store the error message in the response array
    $responseappiccount['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseappiccount);

$conn->close();
?>