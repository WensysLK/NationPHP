<?php
include('../../../includes/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $sponcerName = $_POST['clinetName'];
    $sponserType = $_POST['flexRadioDefault'];
    $foreignAgentId = $_POST['foreignAgent'];
    $sponcerAddress = $_POST['clinetAddress'];
    $sponcerTel = $_POST['clinetTel'];
    $data=date('Y-m-d');
    $softdeletestatus =1;

    if ($sponserType == "ThroughAForeignAgent"){
        $sql = "INSERT INTO `sponcer_details`(`employerId`, `sponcerName`, `address`, `phone_number`,`createdAt`,`softdeletestatus`) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $foreignAgentId, $sponcerName,$sponcerAddress,$sponcerTel,$data,$softdeletestatus);
        $stmt->execute();

    }else{
        $foreignAgentId=0;
        $sql = "INSERT INTO `sponcer_details`(`employerId`, `sponcerName`, `address`, `phone_number`,`createdAt`,`softdeletestatus`) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $foreignAgentId, $sponcerName,$sponcerAddress,$sponcerTel,$data,$softdeletestatus);
        $stmt->execute();
    }


    $conn->close();

    // Redirect or show success message
    header("Location: ../view_all_sponcer.php");

}