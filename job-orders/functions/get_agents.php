<?php
// Database connection
include('../../includes/db_config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the agent list from the table
$sqlagent = "SELECT fagentId,fagentType,fagentProfile,fagentTitle,fagentFname,fagentMname,fagentLname,fagentIqamaNo FROM foreign_agent_details WHERE softdeletestatus=1";
$result = $conn->query($sqlagent);

$agents = array();
while ($row = $result->fetch_assoc()) {
    $agents[] = $row;
}
//var_dump($agents);die();
// Return as JSON
header('Content-Type: application/json');
echo json_encode($agents);

$conn->close();
?>