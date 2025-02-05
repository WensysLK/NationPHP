<?php
include('../../includes/db_config.php');

$centerID = $_POST['centerID'];

$sql = "UPDATE training_centers SET softdeletestatus = 0 WHERE centerID = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $centerID);

    if ($stmt->execute()) {


        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../training-centers.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}