<?php
// Include your database connection code
include('../../includes/db_config.php');

// Get the current date
$current_date = date('Y-m-d'); // Adjust format if necessary

// Prepare response array
$responsecontract = [];

// Query to get count of pending applications
$sqlcontract = "SELECT COUNT(*) AS contract_count FROM contract_details WHERE ContractStartus = 'Started' AND softdeletestatus = 1";
$resultcontract = $conn->query($sqlcontract);

if ($resultcontract) {
    $rowcontract = $resultcontract->fetch_assoc();
    $contract_count = $rowcontract['contract_count'];
    // Store the count in the response array
    $responsecontract['total'] = $contract_count;
} else {
    // Store the error message in the response array
    $responsecontract['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsecontract);

$conn->close();
?>