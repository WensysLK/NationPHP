<?php


header('Content-Type: application/json'); // Set JSON header

// Enable error logging for debugging (ensure PHP has write permissions to the log file location)
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log"); // Or use "/var/log/php-error.log" on Linux

// Get JSON data
$data = json_decode(file_get_contents("php://input"), true);
var_dump($data);die();

if (!$data) {
    error_log("Invalid JSON data received");
    echo json_encode(['success' => false, 'error' => 'Invalid JSON data received']);
    exit;
}

// Validate required fields
if (!isset($data['title'], $data['firstName'], $data['lastName'], $data['phoneNumber'], $data['nicNumber'], $data['regStatus'])) {
    error_log("Missing required fields");
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Database connection details (replace with your actual details)
include('../../../includes/db_config.php');

// Check if the connection succeeded
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// Prepare SQL statement with error handling
$stmt = $conn->prepare("INSERT INTO local_agent_details (Local_Agent_Title, Local_Agent_Fname, Local_Agent_Lname, Local_Agent_Phone, Local_Agent_Nic, regStatus) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Statement preparation failed: " . $conn->error);
    echo json_encode(['success' => false, 'error' => 'Statement preparation failed']);
    $conn->close();
    exit;
}

// Bind parameters
$stmt->bind_param("ssssss", $data['title'], $data['firstName'], $data['lastName'], $data['phoneNumber'], $data['nicNumber'], $data['regStatus']);

// Execute query and handle errors
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    error_log("Database insertion failed: " . $stmt->error);
    echo json_encode(['success' => false, 'error' => 'Database insertion failed']);
}

// Close connections
$stmt->close();
$conn->close();
?>