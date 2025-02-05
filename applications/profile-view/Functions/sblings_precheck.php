<?php

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$sibilingClientID = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$SibilingName = isset($_POST['childName']) ? $_POST['childName'] : '';
$SibilingType = isset($_POST['childRelationship']) ? $_POST['childRelationship'] : '';
$SibilingDob = isset($_POST['childDOB']) ? $_POST['childDOB'] : '';
$schoolAttended = isset($_POST['childSchoolAttended']) ? $_POST['childSchoolAttended'] : '';
$schoolName = isset($_POST['childSchoolName']) ? $_POST['childSchoolName'] : '';
$schoolGrade=isset($_POST['childGrade']) ? $_POST['childGrade'] : '';
$sibilingNic=isset($_POST['childNIC']) ? $_POST['childNIC'] : '';

$softdeletestatus = 1;


$saveandclose_sql = "INSERT INTO 
        `sibilings_details`( 
        `sibilingClientID`, `SibilingName`, 
        `SibilingType`, `SibilingDob`,
        `schoolAttended`,`schoolName`, `schoolGrade`,`sibilingNic`,
        `softdeletestatus`) 
        VALUES 
        ('$sibilingClientID',
        '$SibilingName','$SibilingType',
        '$SibilingDob','$schoolAttended','$schoolName','$schoolGrade','$sibilingNic','$softdeletestatus')";
$stmt= $conn->query($saveandclose_sql);
header("Location: ../application-profile-edit.php?client_id=$sibilingClientID");
