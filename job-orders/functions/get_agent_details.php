<?php
// Database connection
include('../../includes/db_config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the agent ID from the AJAX request
$agentId = $_GET['agentId'];  // This must match the JavaScript key 'agentId'

if (empty($agentId)) {
    echo json_encode(['error' => 'Agent ID is missing']);
    exit;
}

// Fetch agent details from the database
$sql = "SELECT fagentType, fagentTitle, fagentFname,fagentLname FROM foreign_agent_details WHERE fagentId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $agentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $agentDetails = $result->fetch_assoc();
    // Return agent details as JSON
    header('Content-Type: application/json');
    echo json_encode($agentDetails);
} else {
    echo json_encode(['error' => 'Agent not found']);
}

$stmt->close();
$conn->close();
?>