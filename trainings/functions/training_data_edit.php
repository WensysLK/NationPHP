<?php
include('../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $trainingId = $_POST['traningID'];
    $status="completed";
    $softdeletestatus = "1";
    $creatAt=date('y-m-d');

    $query = "UPDATE training_details SET  trainnigStatus = ? WHERE traingId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status,$trainingId);
    $stmt->execute();




    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_trainings.php");

}