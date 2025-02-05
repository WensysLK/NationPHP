<?php

include('../../../includes/db_config.php');
session_start();

$agentId = $_POST['applicationID'];
//var_dump($clientId,$licneseClinetId);die();
// The ID of the client or lead, used for redirection
//var_dump($clientId);die();
// Prepare the UPDATE query to soft delete the follow-up by setting softdeletestatus = 0
$sql = "UPDATE local_agent_details SET softdeletestatus = 0 WHERE localagentId = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $agentId);

    if ($stmt->execute()) {
        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../view_all_local_agent.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}