<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responsecomfinger = [];

// Query to get count of completed fingerprint applications
$sqlfingercomp = "SELECT COUNT(*) AS finger_completed_count FROM fprint_details WHERE fprintStatus = 'completed' AND softdeletestatus = 1";
$resultfingercomp = $conn->query($sqlfingercomp);

if ($resultfingercomp) {
    $rowfingercomp = $resultfingercomp->fetch_assoc();
    $completed_finger_count = $rowfingercomp['finger_completed_count'];
    // Store the count in the response array
    $responsecomfinger['finger_completed_count'] = $completed_finger_count;
} else {
    // Store the error message in the response array
    $responsecomfinger['error'] = "Error fetching completed fingerprint count: " . $conn->error;
}

// Query to get count of pending fingerprint applications
$sqlfingerpending = "SELECT COUNT(*) AS finger_pending_count FROM fprint_details WHERE fprintStatus = 'pending' AND softdeletestatus = 1";
$resultfingerpending = $conn->query($sqlfingerpending);

if ($resultfingerpending) {
    $rowfingerpending = $resultfingerpending->fetch_assoc();
    $pending_finger_count = $rowfingerpending['finger_pending_count'];
    // Store the count in the response array
    $responsecomfinger['finger_pending_count'] = $pending_finger_count;
} else {
    // Store the error message in the response array
    $responsecomfinger['error'] = "Error fetching pending fingerprint count: " . $conn->error;
}

// Query to get count of booked fingerprint applications
$sqlfingerbooked = "SELECT COUNT(*) AS finger_booked_count FROM fprint_details WHERE fprintStatus = 'booked' AND softdeletestatus = 1";
$resultfingerbooked = $conn->query($sqlfingerbooked);

if ($resultfingerbooked) {
    $rowfingerbooked = $resultfingerbooked->fetch_assoc();
    $booked_finger_count = $rowfingerbooked['finger_booked_count'];
    // Store the count in the response array
    $responsecomfinger['finger_booked_count'] = $booked_finger_count;
} else {
    // Store the error message in the response array
    $responsecomfinger['error'] = "Error fetching booked fingerprint count: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsecomfinger);

$conn->close();
?>

