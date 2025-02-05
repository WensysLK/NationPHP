<?php
// Include your database connection code
include('../../includes/db_config.php');

// Prepare response array
$responsecommedi = [];

// Query to get count of completed medical applications
$sqlmedicomp = "SELECT COUNT(*) AS medical_completed_count FROM medical_details WHERE medicalStatus = 'completed' AND softdeletestatus = 1";
$resultmedicomp = $conn->query($sqlmedicomp);

if ($resultmedicomp) {
    $rowmedicomp = $resultmedicomp->fetch_assoc();
    $completed_medicomp_count = $rowmedicomp['medical_completed_count'];
    // Store the count in the response array
    $responsecommedi['completed_medical_count'] =  $completed_medicomp_count;
} else {
    // Store the error message in the response array
    $responsecommedi['error'] = "Error fetching completed medical count: " . $conn->error;
}

// Query to get count of payment pending medical applications
$sqlmedifinance = "SELECT COUNT(*) AS medical_completed_count FROM medical_details WHERE medicalStatus = 'pending' AND softdeletestatus = 1";
$resultmedifinance = $conn->query($sqlmedifinance);

if ($resultmedifinance) {
    $rowmedifinance = $resultmedifinance->fetch_assoc();
    $finance_medicomp_count = $rowmedifinance['medical_completed_count'];
    // Store the count in the response array
    $responsefinancemedi['completed_medical_count'] =  $finance_medicomp_count;
} else {
    // Store the error message in the response array
    $responsefinancemedi['error'] = "Error fetching completed medical count: " . $conn->error;
}

// Query to get count of booked medical applications
$sqlbookedmedi = "SELECT COUNT(*) AS booked_medical_count FROM medical_details WHERE medicalStatus = 'booked' AND softdeletestatus = 1";
$resultbookedmedi = $conn->query($sqlbookedmedi);

if ($resultbookedmedi) {
    $rowbookedmedi = $resultbookedmedi->fetch_assoc();
    $booked_medi_count = $rowbookedmedi['booked_medical_count'];
    // Store the count in the response array
    $responsecommedi['booked_medical_count'] =  $booked_medi_count;
} else {
    // Store the error message in the response array
    $responsecommedi['error'] = "Error fetching booked medical count: " . $conn->error;
}

// Query to get count of unfit medical applications
$sqlunfitmedi = "SELECT COUNT(*) AS unfit_medical_count FROM medical_details WHERE medicalresult = 'unfit' AND softdeletestatus = 1";
$resultunfitmedi = $conn->query($sqlunfitmedi);

if ($resultunfitmedi) {
    $rowunfitmedi = $resultunfitmedi->fetch_assoc();
    $unfit_medi_count = $rowunfitmedi['unfit_medical_count'];
    // Store the count in the response array
    $responsecommedi['unfit_medical_count'] =  $unfit_medi_count;
} else {
    // Store the error message in the response array
    $responsecommedi['error'] = "Error fetching unfit medical count: " . $conn->error;
}

// Query to get count of Guarantee Issues medical applications
$sqlfinancemedi = "SELECT COUNT(*) AS guarantee_medical_count FROM medical_details WHERE medicalresult = 'gurantee' AND softdeletestatus = 1";
$resultfinancemedi = $conn->query($sqlfinancemedi);

if ($resultfinancemedi) {
    $rowfinancemedi = $resultfinancemedi->fetch_assoc();
    $finance_medi_count = $rowfinancemedi['guarantee_medical_count'];
    // Store the count in the response array
    $responsecommedi['finance_medical_count'] =  $finance_medi_count;
} else {
    // Store the error message in the response array
    $responsecommedi['error'] = "Error fetching finance medical count: " . $conn->error;
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($responsecommedi);

$conn->close();
?>
