<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$response = [];

// Query to get count of pending applications
$sql = "SELECT
    COUNT(*) AS total_orders,
    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_count,
    SUM(CASE WHEN status = 'processing' THEN 1 ELSE 0 END) AS processing_count,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS completed_count
   
FROM
    complains  where softdeletestatus='1'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
//    var_dump($row);die();
    $total_orders = $row['total_orders'];
    $pending_count = $row['pending_count'];
    $processing_count = $row['processing_count'];
    $completed_count = $row['completed_count'];

    // Store the count in the response array
    $response['total'] = $total_orders;
    $response['pending_count'] = $pending_count;
    $response['processing_count'] = $processing_count;
    $response['completed_count'] = $completed_count;
} else {
    // Store the error message in the response array
    $response['error'] = "Error: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>