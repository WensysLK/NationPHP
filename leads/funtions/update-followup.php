<?php
include '../../includes/db_config.php';

// Handle form submission to update follow-up
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $followup_id = $_POST['followup_id']; // ID of the follow-up record to update
    $followup_type = $_POST['followup_type']; // Updated follow-up type
    $message = $_POST['message']; // Updated message
    $clientId = $_POST['leadid']; // Client or lead ID
    $followup_date = $_POST['followup_date']; // Updated follow-up date

    // Update the follow-up record in the database
    $sql = "UPDATE follow_ups 
            SET followup_type = ?, message = ?, followup_date = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssi", $followup_type, $message, $followup_date, $followup_id);
        
        if ($stmt->execute()) {
            // Optionally update the lead status if necessary
            $conn->query("UPDATE leads SET status='follow-up' WHERE id='$followup_id'");
            
            // Redirect to the follow-up page
            header('Location: ../followups/followup.php?lead_id=' . $clientId);
            exit;
        } else {
            echo "Error updating follow-up: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }
}