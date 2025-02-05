<?php
// Include database configuration
include('../../includes/db_config.php');

// Prepare and execute the query
$query = "SELECT id, job_title FROM jobs";
$result = $conn->query($query);

// Initialize an array to hold the positions
$positions = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $positions[] = $row; // Push each row to the positions array
    }
}

// Set the content type to application/json and echo the positions array as JSON
header('Content-Type: application/json');
echo json_encode($positions);
?>