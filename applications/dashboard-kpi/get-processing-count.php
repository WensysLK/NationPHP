<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responseappprocesscount = [];

// Query to get count of pending applications
$sqlappprocessing = "SELECT COUNT(*) AS pending_porcess_count FROM applications WHERE ContractCreated = 1 AND softdeletStatus = 1";
$resultappprocessing = $conn->query($sqlappprocessing);

if ($resultappprocessing) {
    $rowappprocessing = $resultappprocessing->fetch_assoc();
    $pending_app_processing_count = $rowappprocessing['pending_porcess_count'];
    // Store the count in the response array
    $responseappprocesscount['total'] =  $pending_app_processing_count;
} else {
    // Store the error message in the response array
    $responseappprocesscount['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseappprocesscount);

$conn->close();
?>