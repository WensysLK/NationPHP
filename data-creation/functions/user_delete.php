<?php
include('../../includes/db_config.php');

$userId = $_POST['userId'];

$sql = "UPDATE users SET softdeletestatus = 0 WHERE userID = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {


        // Redirect back to the follow-up page after successful soft deletion
        header("Location: ../users.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}