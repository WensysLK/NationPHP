<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$LangClientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$license_id = isset($_POST['license_id']) ? $_POST['license_id'] : '';
$LangName = isset($_POST['lanuagesnames']) ? $_POST['lanuagesnames'] : '';
$LangRead = isset($_POST['lanlangread']) ? $_POST['lanlangread'] : '';
$LangWrite = isset($_POST['langwrite']) ? $_POST['langwrite'] : '';
$LangSpeak = isset($_POST['langspeak']) ? $_POST['langspeak'] : '';
$softdeletestatus = 1;

$query = "UPDATE language_details SET LangClientId = ?, LangName = ?,LangRead = ?,LangWrite = ?,LangSpeak = ?,
                                   softdeletestatus = ? WHERE LangId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssi", $LangClientId,
    $LangName,
    $LangRead,
    $LangWrite,
    $LangSpeak,
    $softdeletestatus,
    $license_id
);
$stmt->execute();

header("Location: ../application-profile-edit.php?client_id=$LangClientId");
