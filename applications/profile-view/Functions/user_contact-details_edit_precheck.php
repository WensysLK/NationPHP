<?php

include ('../../../includes/db_config.php');
session_start();
// Check if the form was submitted


$applicant_id=isset($_POST['clientID']) ? $_POST['clientID'] : '';
$email = isset($_POST['cemail']) ? $_POST['cemail'] : '';
$phone = isset($_POST['clphone']) ? $_POST['clphone'] : '';
$phone2 = isset($_POST['cphone2']) ? $_POST['cphone2'] : '';
$phone3 = isset($_POST['cphone3']) ? $_POST['cphone3'] : '';
$address1 = isset($_POST['caddress1']) ? $_POST['caddress1'] : '';
$address2 = isset($_POST['caddress2']) ? $_POST['caddress2'] : '';
$province=isset($_POST['cprovince']) ? $_POST['cprovince'] : '';
$city=isset($_POST['ccity']) ? $_POST['ccity'] : '';
$gsdevision = isset($_POST['gsdevision']) ? $_POST['gsdevision'] : '';
$softdeletestatus=1;

$userID = $applicant_id; // Example user ID to search for

$query = "SELECT * FROM contact_information WHERE applicant_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userID); // 'i' is for integer
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
//var_dump($row['contactId']);die();

$query = "UPDATE contact_information SET applicant_email = ?, applicant_landphone = ?,applicant_phone = ?,applicant_phone2 = ?,applicant_add1 = ?,applicant_add2 = ?,applicant_province = ?,applicant_city = ?,
                        applicant_gsdevision = ?,softdeletestatus = ? WHERE contactId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssssi", $email,
    $phone,
    $phone2,
    $phone3,
    $address1,
    $address2,
    $province,
    $city,
    $gsdevision,
    $softdeletestatus,
    $row['contactId']);
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$userID");

