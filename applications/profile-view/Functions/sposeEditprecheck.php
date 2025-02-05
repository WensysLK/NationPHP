<?php

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted


$spouceId = isset($_POST['spoceId']) ? $_POST['spoceId'] : '';
$clientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$SpouceName = isset($_POST['spouseFullName']) ? $_POST['spouseFullName'] : '';
$SpouceType = isset($_POST['relationship']) ? $_POST['relationship'] : '';
$maritalStatus = isset($_POST['maritalStatus']) ? $_POST['maritalStatus'] : '';
$spouceContact = isset($_POST['spouseContactNumber']) ? $_POST['spouseContactNumber'] : '';
$spouceNic = isset($_POST['spouseNIC']) ? $_POST['spouseNIC'] : '';
$spouceDob = isset($_POST['spouseDOB']) ? $_POST['spouseDOB'] : '';
$softdeletestatus = 1;

$query = "UPDATE spouce_details SET spoceClientId = ?, SpouceName = ?,SpouceType = ?,maritalStatus = ?,spouceContact = ?,
                                   spouceNic = ?, spouceDob = ? ,softdeletestatus = ? WHERE spouceId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssi", $clientId,
    $SpouceName,
    $SpouceType,
    $maritalStatus,
    $spouceContact,
    $spouceNic,
    $spouceDob,
    $softdeletestatus,
    $spouceId
);
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$clientId");
