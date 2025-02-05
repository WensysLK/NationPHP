<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$LangClientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$LangName = isset($_POST['lanuagesnames']) ? $_POST['lanuagesnames'] : '';
$LangRead = isset($_POST['lanlangread']) ? $_POST['lanlangread'] : '';
$LangWrite = isset($_POST['langwrite']) ? $_POST['langwrite'] : '';
$LangSpeak = isset($_POST['langspeak']) ? $_POST['langspeak'] : '';
$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `language_details`( 
        `LangClientId`, `LangName`, 
        `LangRead`, `LangWrite`,
        `LangSpeak`, 
        `softdeletestatus`) 
        VALUES 
        ('$LangClientId',
        '$LangName','$LangRead',
        '$LangWrite','$LangSpeak','$softdeletestatus')";
           $stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$LangClientId");
