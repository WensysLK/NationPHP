<?php 

include('../../../includes/db_config.php');
session_start();
// Check if the form was submitted

$LangClientId = isset($_POST['client_id']) ? $_POST['client_id'] : '';
$institueName = isset($_POST['institueName']) ? $_POST['institueName'] : '';
$CourseName = isset($_POST['CourseName']) ? $_POST['CourseName'] : '';
$CourseStatus = isset($_POST['CourseStatus']) ? $_POST['CourseStatus'] : '';
$duration = isset($_POST['duration']) ? $_POST['duration'] : '';
$createdAt=date('y-m-d');
$softdeletestatus = 1;

$saveandclose_sql = "INSERT INTO 
        `professional_qualifications`( 
        `QulificationClientID`, `institueName`, 
        `courseName`, `Qualification_Duration`,
        `Qualification_Status`,`cretedAt`,
        `softdeletestatus`) 
        VALUES 
        ('$LangClientId',
        '$institueName','$CourseName',
        '$CourseStatus','$duration','$createdAt','$softdeletestatus')";
           $stmt= $conn->query($saveandclose_sql);
//$stmt->execute();
header("Location: ../application-profile-edit.php?client_id=$LangClientId");
