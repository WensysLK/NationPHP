<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$clientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$SpouceName = isset($_POST['spouseFullName']) ? $_POST['spouseFullName'] : '';
$SpouceType = isset($_POST['relationship']) ? $_POST['relationship'] : '';
$maritalStatus = isset($_POST['maritalStatus']) ? $_POST['maritalStatus'] : '';
$spouceContact = isset($_POST['spouseContactNumber']) ? $_POST['spouseContactNumber'] : '';
$spouceNic = isset($_POST['spouseNIC']) ? $_POST['spouseNIC'] : '';
$spouceDob = isset($_POST['spouseDOB']) ? $_POST['spouseDOB'] : '';
$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `spouce_details`( 
        `spoceClientId`, `SpouceName`, 
        `SpouceType`, `maritalStatus`,
        `spouceContact`,`spouceNic`, `spouceDob`,
        `softdeletestatus`) 
        VALUES 
        ('$clientId',
        '$SpouceName','$SpouceType',
        '$maritalStatus','$spouceContact','$spouceNic','$spouceDob','$softdeletestatus')";
           $stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$clientId");
