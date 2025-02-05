<?php
include('../../includes/db_config.php');

$medicalCenterID = $_POST['medicalCenterID'];

$sql = "UPDATE medical_center SET softdeletestatus = 0 WHERE medicalCenterID = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $medicalCenterID);

    if ($stmt->execute()) {


        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../medical-centers.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}