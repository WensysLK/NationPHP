<?php

include ('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$LicenseId = isset($_POST['license_id']) ? $_POST['license_id'] : '';
$LicneseClinetId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$License_Type = isset($_POST['license_type']) ? $_POST['license_type'] : '';
$document_Type = isset($_POST['document_type']) ? $_POST['document_type'] : '';
$License_Country = isset($_POST['country']) ? $_POST['country'] : '';
$License_Expiry = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : '';
$softdeletestatus = 1;


//var_dump($_POST);die();

$query = "UPDATE driving_license_deatils SET LicneseClinetId = ?, License_Type = ?,document_Type = ?,License_Country = ?,License_Expiry = ?,
                                   softdeletestatus = ? WHERE LicenseId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssi", $LicneseClinetId,
    $License_Type,
    $document_Type,
    $License_Country,
    $License_Expiry,
    $softdeletestatus,
    $LicenseId
 );
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$LicneseClinetId");