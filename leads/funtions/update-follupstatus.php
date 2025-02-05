<?php
// followup.php
include '../../includes/db_config.php';


// Get lead_id from the URL
if (isset($_GET['lead_id'])) {
    $lead_id = $_GET['lead_id'];

    // Update the lead status to "Pending"
    $stmt = $conn->prepare("UPDATE Leads SET status = 'Pending' WHERE id = ?");
    $stmt->execute([$lead_id]);

    // Redirect to the follow-up form or display follow-up information
    // Here you could include a form or information about this specific lead
    // For now, you can redirect to the lead details page or load follow-up actions.
    header("Location: ../followups/followup.php?lead_id=$lead_id");
    exit();
} else {
    echo "No lead ID provided.";
}
