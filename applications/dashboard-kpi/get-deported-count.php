<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responseappdepotedcount = [];

// Query to get count of pending applications
$sqlappdepoted = "SELECT COUNT(*) AS pending_depoted_count FROM applications WHERE ContractCreated = 4 AND softdeletStatus = 1";
$resultappdepoted = $conn->query($sqlappdepoted);

if ($resultappdepoted) {
    $rowappdepoted = $resultappdepoted->fetch_assoc();
    $pending_app_depoted_count = $rowappdepoted['pending_depoted_count'];
    // Store the count in the response array
    $responseappdepotedcount['total'] =  $pending_app_depoted_count;
} else {
    // Store the error message in the response array
    $responseappdepotedcount['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseappdepotedcount);

$conn->close();
?>