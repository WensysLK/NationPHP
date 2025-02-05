<?php

// Set header to return JSON
header('Content-Type: application/json');

include '../../includes/db_config.php';

// Fetch jobs from the database
$sql = "SELECT id, job_title FROM jobs";
$result = $conn->query($sql);

// Initialize an array to store job data
$jobs = [];

if ($result->num_rows > 0) {
    // Loop through the result and add each job to the array
    while ($row = $result->fetch_assoc()) {
        $jobs[] = [
            'id' => $row['id'],
            'title' => $row['job_title']
        ];
    }
}

// Return the array as a JSON object
echo json_encode(['jobs' => $jobs]);

// Close the database connection
$conn->close();
?>