<?php

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$sibilingClientID = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$sibilingID = isset($_POST['sibilingId']) ? $_POST['sibilingId'] : '';

$SibilingName = isset($_POST['childName']) ? $_POST['childName'] : '';
$SibilingType = isset($_POST['childRelationship']) ? $_POST['childRelationship'] : '';
$SibilingDob = isset($_POST['childDOB']) ? $_POST['childDOB'] : '';
$schoolAttended = isset($_POST['childSchoolAttended']) ? $_POST['childSchoolAttended'] : '';
$schoolName = isset($_POST['childSchoolName']) ? $_POST['childSchoolName'] : '';
$schoolGrade=isset($_POST['childGrade']) ? $_POST['childGrade'] : '';
$sibilingNic=isset($_POST['childNIC']) ? $_POST['childNIC'] : '';

$softdeletestatus = 1;

$query = "UPDATE sibilings_details SET sibilingClientID = ?, SibilingName = ?,SibilingType = ?,SibilingDob = ?,schoolAttended = ?,
                                   schoolName = ?,schoolGrade = ?, sibilingNic = ? ,softdeletestatus = ? WHERE sibilingId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssssi", $sibilingClientID,
    $SibilingName,
    $SibilingType,
    $SibilingDob,
    $schoolAttended,
    $schoolName,
    $schoolGrade,
    $sibilingNic,
    $softdeletestatus,
    $sibilingID
);
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$sibilingClientID");
