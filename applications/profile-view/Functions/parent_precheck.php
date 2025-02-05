<?php

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$ParentClientID = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$parentId = isset($_POST['parentid']) ? $_POST['parentid'] : '';
$parentname = isset($_POST['parentFullName']) ? $_POST['parentFullName'] : '';
$parentcontact = isset($_POST['parentContactNumber']) ? $_POST['parentContactNumber'] : '';
$parentNic = isset($_POST['fatherNIC']) ? $_POST['fatherNIC'] : '';
$parentDob = isset($_POST['parentDOB']) ? $_POST['parentDOB'] : '';
$parent_Type=isset($_POST['parentType']) ? $_POST['parentType'] : '';
$softdeletestatus = 1;

$query = "UPDATE parents_details SET ParentClientID = ?, parentname = ?,parentcontact = ?,parentNic = ?,parentDob = ?,
                                   parent_Type = ?,softdeletestatus = ? WHERE parentId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssssssi", $ParentClientID,
    $parentname,
    $parentcontact,
    $parentNic,
    $parentDob,
    $parent_Type,
    $softdeletestatus,
    $parentId
);
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$ParentClientID");
