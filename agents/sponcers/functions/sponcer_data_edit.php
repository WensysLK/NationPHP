<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $sponsorId = $_POST['sponserId'];
    $sponsorName = $_POST['clinetName'];
    $sponsorType= $_POST['flexRadioDefault'];
    $foreignAgentId = $_POST['foreignAgent'];
    $sponsorAddress = $_POST['clinetAddress'];
    $sponsorTel = $_POST['clinetTel'];
    $softdeletestatus = "1";
    $creatAt=date('y-m-d');

    if ($sponsorType == "LocalAgent"){
        $foreignAgentId=0;
        $query = "UPDATE sponcer_details SET employerId = ?, sponcerName = ?,address = ?,phone_number = ?,createdAt = ?,softdeletestatus = ? WHERE sponcerId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssssi", $foreignAgentId,$sponsorName,$sponsorAddress,$sponsorTel,$creatAt,$softdeletestatus,$sponsorId);
        $stmt->execute();
    }else{
        $query = "UPDATE sponcer_details SET employerId = ?, sponcerName = ?,address = ?,phone_number = ?,createdAt = ?,softdeletestatus = ? WHERE sponcerId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssssi", $foreignAgentId,$sponsorName,$sponsorAddress,$sponsorTel,$creatAt,$softdeletestatus,$sponsorId);
        $stmt->execute();
    }


    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_sponcer.php");

}