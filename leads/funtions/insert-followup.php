<?php
include '../../includes/db_config.php';



// Handle form submission to save follow-up
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $followup_type = $_POST['followup_type'];
    $message = $_POST['message'];
    $clientId = $_POST['follupid'];
    $followup_date = $_POST['followup_date'];
    $status = $_POST['status'];

    // Insert follow-up record into the database
    $sql = "INSERT INTO follow_ups (lead_id, followup_type, message, followup_date) 
            VALUES ('$clientId', '$followup_type', '$message', '$followup_date')";

    if ($conn->query($sql) === TRUE) {
        // Update the lead status to 'follow-up'
        $conn->query("UPDATE leads SET status='processing' WHERE id='$clientId'");
        header('Location: ../followups/followup.php?lead_id=' . $clientId);
    } else {
        echo "Error: " . $conn->error;
    }
}