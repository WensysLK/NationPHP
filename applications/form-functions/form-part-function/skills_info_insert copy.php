<?php

$applicantId1 = $_SESSION['last_applicant_id'] = 120;
$applicantName = $_SESSION['client_name'] = "Terrance";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO `skills_details`(`clientId`, `MainSkillID`, `SubskillsID`) VALUES (?,?,?)");

// Debug POST data
error_log(print_r($_POST['skills'], true));

// Loop through the skills data
foreach ($_POST['skills'] as $skill) {
    $main_skill_id = $skill['main'];
    foreach ($skill['sub'] as $sub_skill_id) {
        error_log("Inserting: ClientID=$applicantId1, MainSkillID=$main_skill_id, SubskillsID=$sub_skill_id");
        // Bind parameters and execute
        $stmt->bind_param("iii", $applicantId1, $main_skill_id, $sub_skill_id);
        $stmt->execute();
    }
}

// Close statement and connection
$stmt->close();
echo json_encode(['success' => true]);
?>