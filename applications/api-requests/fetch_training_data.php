<?php
// Database connection
include('../../includes/db_config.php');  // Ensure you have the correct path to your DB config

header('Content-Type: application/json');

// Fetch training centers
$sqlCenters = "SELECT centerID, centerName FROM training_centers ORDER BY centerName ASC";
$resultCenters = $conn->query($sqlCenters);

$centers = [];
if ($resultCenters->num_rows > 0) {
    while ($row = $resultCenters->fetch_assoc()) {
        $centers[] = $row;
    }
}

// Fetch training programs
$sqlPrograms = "SELECT programID, programName FROM training_programs ORDER BY programName ASC";
$resultPrograms = $conn->query($sqlPrograms);

$programs = [];
if ($resultPrograms->num_rows > 0) {
    while ($row = $resultPrograms->fetch_assoc()) {
        $programs[] = $row;
    }
}

// Return the list of training centers and programs as a JSON response
echo json_encode([
    'centers' => $centers,
    'programs' => $programs
]);

$conn->close();
?>
