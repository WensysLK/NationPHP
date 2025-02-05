<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responsecomenjaz = [];

// Query to get count of completed Enjaz applications
$sqlenjazcomp = "SELECT COUNT(*) AS enjaz_completed_count FROM enjaz_details WHERE EnjazStatus = 'completed' AND softdeletestatus = 1";
$resultenjazcomp = $conn->query($sqlenjazcomp);

if ($resultenjazcomp) {
    $rowenjazcomp = $resultenjazcomp->fetch_assoc();
    $completed_enjaz_count = $rowenjazcomp['enjaz_completed_count'];
    // Store the count in the response array
    $responsecomenjaz['enjaz_completed_count'] =  $completed_enjaz_count;
} else {
    // Store the error message in the response array
    $responsecomenjaz['error'] = "Error fetching completed Enjaz count: " . $conn->error;
}

// Query to get count of pending Enjaz applications
$sqlenjazpending = "SELECT COUNT(*) AS enjaz_pending_count FROM enjaz_details WHERE EnjazStatus = 'pending' AND softdeletestatus = 1";
$resultenjazpending = $conn->query($sqlenjazpending);

if ($resultenjazpending) {
    $rowenjazpending = $resultenjazpending->fetch_assoc();
    $pending_enjaz_count = $rowenjazpending['enjaz_pending_count'];
    // Store the count in the response array
    $responsependingenjaz['enjaz_pending_count'] =  $pending_enjaz_count;
} else {
    // Store the error message in the response array
    $responsependingenjaz['error'] = "Error fetching completed Enjaz count: " . $conn->error;
}

// Query to get count of booked Enjaz applications
$sqlenjazbooked = "SELECT COUNT(*) AS enjaz_booked_count FROM enjaz_details WHERE EnjazStatus = 'booked' AND softdeletestatus = 1";
$resultenjazbooked = $conn->query($sqlenjazbooked);

if ($resultenjazbooked) {
    $rowenjazbooked = $resultenjazbooked->fetch_assoc();
    $booked_enjaz_count = $rowenjazbooked['enjaz_booked_count'];
    // Store the count in the response array
    $responseenjaz['enjaz_booked_count'] =  $booked_enjaz_count;
} else {
    // Store the error message in the response array
    $responseenjaz['error'] = "Error fetching booked Enjaz count: " . $conn->error;
}




// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsecomenjaz);

$conn->close();
?>
