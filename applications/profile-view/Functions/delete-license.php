<?php
include('../../../includes/db_config.php');
session_start();
$clientId = $_POST['clientId']; // The ID of the client or lead, used for redirection

// Prepare the UPDATE query to soft delete the follow-up by setting softdeletestatus = 0
$sql = "UPDATE driving_license_deatils SET softdeletStatus = 0 WHERE id = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $clientId);

    if ($stmt->execute()) {
        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../application-profile-edit.php?client_id=$clientId");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}