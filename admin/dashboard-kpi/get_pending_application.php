<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$response = [];

// Query to get count of pending applications
$sql = "SELECT COUNT(*) AS pending_count FROM applications WHERE applicantStatus = 'incomplete' AND softdeletStatus = 1";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $pending_count = $row['pending_count'];
    // Store the count in the response array
    $response['total'] = $pending_count;
} else {
    // Store the error message in the response array
    $response['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>