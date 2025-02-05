<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responseappcount = [];

// Query to get count of pending applications
$sqlapp = "SELECT COUNT(*) AS pending_app_count FROM applications WHERE applicantStatus = 'Completed' AND softdeletStatus = 1";
$resultapp = $conn->query($sqlapp);

if ($resultapp) {
    $rowapp = $resultapp->fetch_assoc();
    $pending_app_count = $rowapp['pending_app_count'];
    // Store the count in the response array
    $responseappcount['total'] =  $pending_app_count;
} else {
    // Store the error message in the response array
    $responseappcount['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseappcount);

$conn->close();
?>