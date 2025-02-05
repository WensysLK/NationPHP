<?php

include('../../../includes/db_config.php');
session_start();

$clientId = $_POST['clientId'];
$licneseClinetId=$_POST['licneseClinetId'];

// The ID of the client or lead, used for redirection
//var_dump($clientId);die();
// Prepare the UPDATE query to soft delete the follow-up by setting softdeletestatus = 0
$sql = "UPDATE driving_license_deatils SET softdeletestatus = 0 WHERE LicenseId = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $clientId);

    if ($stmt->execute()) {
        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../application-profile-edit.php?client_id=$licneseClinetId");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}