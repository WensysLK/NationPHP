<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responseappdeparturecount = [];

// Query to get count of pending applications
$sqlappdeparture = "SELECT COUNT(*) AS pending_departure_count FROM applications WHERE ContractCreated = 3 AND softdeletStatus = 1";
$resultappdeaprture = $conn->query($sqlappdeparture);

if ($resultappdeaprture) {
    $rowappdeparture = $resultappdeaprture->fetch_assoc();
    $pending_app_departure_count = $rowappdeparture['pending_departure_count'];
    // Store the count in the response array
    $responseappdeparturecount['total'] =  $pending_app_departure_count;
} else {
    // Store the error message in the response array
    $responseappdeparturecount['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseappdeparturecount);

$conn->close();
?>