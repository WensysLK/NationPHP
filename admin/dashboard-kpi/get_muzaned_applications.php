<?php
// Include your database connection code
include('../../includes/db_config.php');

// Get the current date
$current_date = date('Y-m-d'); // Adjust format if necessary

// Prepare response array
$responsemuzaned = [];

// Query to get count of pending applications
$sqlmuzaned = "SELECT COUNT(*) AS muzaned_count FROM contract_details WHERE muzanedStatus = 'processing' AND softdeletestatus = 1";
$resultmuzaned = $conn->query($sqlmuzaned);

if ($resultmuzaned) {
    $rowmuzaned = $resultmuzaned->fetch_assoc();
    $muzaned_count = $rowmuzaned['muzaned_count'];
    // Store the count in the response array
    $responsemuzaned['total'] = $muzaned_count;
} else {
    // Store the error message in the response array
    $responsemuzaned['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsemuzaned);

$conn->close();
?>