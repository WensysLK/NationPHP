<?php
// Include your database connection code
include('../../includes/db_config.php');

// Get the current date
$current_date = date('Y-m-d'); // Adjust format if necessary

// Prepare response array
$responseenjaz = [];

// Query to get count of pending applications
$sqlenjaz = "SELECT COUNT(*) AS enjaz_count FROM enjaz_details WHERE EnjazStatus = 'processing' AND softdeletestatus = 1";
$resultenjaz = $conn->query($sqlenjaz);

if ($resultenjaz) {
    $rowenjaz = $resultenjaz->fetch_assoc();
    $enjaz_count = $rowenjaz['enjaz_count'];
    // Store the count in the response array
    $responseenjaz['total'] = $enjaz_count;
} else {
    // Store the error message in the response array
    $responseenjaz['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responseenjaz);

$conn->close();
?>