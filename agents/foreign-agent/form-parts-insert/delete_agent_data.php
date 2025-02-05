<?php

include('../../../includes/db_config.php');
session_start();


$agentId = $_POST['applicationID'];
$query = "SELECT * FROM forginagent_company_details WHERE fagentId = ?";

$stmtSiblings = $conn->prepare($query);
$stmtSiblings->bind_param("i", $agentId);
$stmtSiblings->execute();
$result = $stmtSiblings->get_result();
$guardian = $result->fetch_assoc();


//var_dump($clientId,$licneseClinetId);die();
// The ID of the client or lead, used for redirection
//var_dump($clientId);die();
// Prepare the UPDATE query to soft delete the follow-up by setting softdeletestatus = 0
$sql = "UPDATE forginagent_company_details SET softdeletestatus = 0 WHERE fagnetCompanyID = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $guardian['fagnetCompanyID']);

    if ($stmt->execute()) {


        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../view_all_foreign_agent.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}