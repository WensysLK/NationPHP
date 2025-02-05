<?php
include '../../includes/db_config.php';

// Check if the request is a POST request and contains the follow-up ID
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['followup_id'])) {
    $followup_id = $_POST['followup_id']; // The ID of the follow-up to soft delete
    $clientId = $_POST['clientId']; // The ID of the client or lead, used for redirection

    // Prepare the UPDATE query to soft delete the follow-up by setting softdeletestatus = 0
    $sql = "UPDATE follow_ups SET softdeletestatus = 0 WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('i', $followup_id);

        if ($stmt->execute()) {
            // Redirect back to the follow-up page after successful soft deletion
            header('Location: ../followups/followup.php?lead_id=' . $clientId);
            exit;
        } else {
            echo "Error performing soft delete: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the soft delete statement: " . $conn->error;
    }
}