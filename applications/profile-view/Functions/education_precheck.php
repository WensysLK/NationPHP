<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$LangClientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$schoolname = isset($_POST['schoolname']) ? $_POST['schoolname'] : '';
$edulevel = isset($_POST['edulevel']) ? $_POST['edulevel'] : '';
$eduyear = isset($_POST['eduyear']) ? $_POST['eduyear'] : '';

$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `education_details`( 
        `educationClientId`, `schoolName`, 
        `edutype`, `educationYear`,
         `softdeletestatus`) 
        VALUES 
        ('$LangClientId',
        '$schoolname','$edulevel',
        '$eduyear','$softdeletestatus')";
           $stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$LangClientId");
