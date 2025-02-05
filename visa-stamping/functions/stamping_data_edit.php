<?php
include('../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $contractId = $_POST['contractId'];
    $status="completed";
    $softdeletestatus = "1";
    $creatAt=date('y-m-d');

    $query = "UPDATE contract_details SET  visa_status = ? WHERE contractId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status,$contractId);
    $stmt->execute();




    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_visa_stamping.php");

}