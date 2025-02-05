<?php

include ('../../../includes/db_config.php');
session_start();
// Check if the form was submitted


$clientID=isset($_POST['clientID']) ? $_POST['clientID'] : '';
$applicantTitle = isset($_POST['name-title']) ? $_POST['name-title'] : '';
$applicantFname = isset($_POST['Cfname']) ? $_POST['Cfname'] : '';
$applicantMname = isset($_POST['cmname']) ? $_POST['cmname'] : '';
$applicantLname = isset($_POST['clname']) ? $_POST['clname'] : '';
$applicantDob = isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
$passportNumber = isset($_POST['passportNumber']) ? $_POST['passportNumber'] : '';
$height=isset($_POST['height']) ? $_POST['height'] : '';
$weight=isset($_POST['weight']) ? $_POST['weight'] : '';
$nicNumber = isset($_POST['nicnumber']) ? $_POST['nicnumber'] : '';
$gender= isset($_POST['gender']) ? $_POST['gender'] : '';
$Religion=isset($_POST['Religion']) ? $_POST['Religion'] : '';
$rase=isset($_POST['rase']) ? $_POST['rase'] : '';
$nationality=isset($_POST['nationality']) ? $_POST['nationality'] : '';
$cpassport=isset($_POST['cpassport']) ? $_POST['cpassport'] : '';
$cpassportdate=isset($_POST['cpassportdate']) ? $_POST['cpassportdate'] : '';
$maritalstatus=isset($_POST['maritalstatus']) ? $_POST['maritalstatus'] : '';
$findUs=isset($_POST['findUs']) ? $_POST['findUs'] : '';
$subAgentId=isset($_POST['subAgentId']) ? $_POST['subAgentId'] : '';



$query = "UPDATE applications SET applicantTitle = ?, applicatFname = ?,applicantMname = ?,applicantLname = ?,applicantDob = ?,applicantPassno = ?,applicantNICno = ?,applicantPassdate = ?,
                        applicantNationality = ?,applicanthight = ?,applicantWeight = ?,applicantGender = ?,appReligion = ?,appRase = ?,maritalestatus = ?,how_foun_us = ? WHERE applicationID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssssssssssi", $applicantTitle,
    $applicantFname,
    $applicantMname,
    $applicantLname,
    $applicantDob,
    $cpassport,
    $nicNumber,
    $cpassportdate,
    $nationality,
    $height,
    $weight,
    $gender,
    $Religion,
    $rase,$maritalstatus,
    $findUs,
    $clientID);
$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$clientID");

