<?php
// Include your database connection code
include('../../includes/db_config.php');

// Get the current date
$current_date = date('Y-m-d'); // Adjust format if necessary

// Prepare response array
$responsemedical = [];

// Query to get count of pending applications
$sqlmedical = "SELECT COUNT(*) AS booked_count FROM medical_details WHERE medicalStatus = 'booked' AND allocationDate = '$current_date'";
$resultmedical = $conn->query($sqlmedical);

if ($resultmedical) {
    $rowmedical = $resultmedical->fetch_assoc();
    $booked_count = $rowmedical['booked_count'];
    // Store the count in the response array
    $responsemedical['total'] = $booked_count;
} else {
    // Store the error message in the response array
    $responsemedical['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsemedical);

$conn->close();
?>