<?php

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$ParentClientID = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$workposition = isset($_POST['workposition']) ? $_POST['workposition'] : '';
$CompanyName = isset($_POST['CompanyName']) ? $_POST['CompanyName'] : '';
$JobCountry = isset($_POST['JobCountry']) ? $_POST['JobCountry'] : '';
$yearstart = isset($_POST['yearstart']) ? $_POST['yearstart'] : '';
$yearEnd = isset($_POST['yearEnd']) ? $_POST['yearEnd'] : '';
$createdAt=date('y-m-d');
$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `worke`( 
        `workClinetID`, `workPosition`, 
        `workCompany`, `workCountry`,
        `workStart`,  `workEnd`,`createdAt`,
        `softdeletestatus`) 
        VALUES 
        ('$ParentClientID',
        '$workposition','$CompanyName',
        '$JobCountry','$yearstart','$yearEnd','$createdAt','$softdeletestatus')";
$stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$ParentClientID");

header("Location: ../application-profile-edit.php?client_id=$ParentClientID");
