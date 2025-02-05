<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $medicalCentername = htmlspecialchars($_POST['medicalcentername']);
    $medicalCenteraddress1 = htmlspecialchars($_POST['addressline1']);
    $medicalCenteraddress2 = htmlspecialchars($_POST['addressline2']);
    $medicalCentercity = htmlspecialchars($_POST['medicalCity']);
    $medicalCenterphone = htmlspecialchars($_POST['phonenumber']);
    $medicalCenteremail = htmlspecialchars($_POST['medicalCenteremail']);
    $medicalCenterwebsite = htmlspecialchars($_POST['wesiteurl']);


    $sqlmedicalCenetr = "INSERT INTO `medical_center`(`MediName`, `AddressLine1`, `AddressLine2`, `mediCity`, `mediPhone`, `mediEmail`, `mediWebsite`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";

    $stmtmedicalcenter = $conn->prepare($sqlmedicalCenetr);

    $stmtmedicalcenter->bind_param("sssssss", 
    $medicalCentername,$medicalCenteraddress1,$medicalCenteraddress2,$medicalCentercity,$medicalCenterphone,$medicalCenteremail,$medicalCenterwebsite );

    if($stmtmedicalcenter->execute()){

        header("Location: ../medical-centers.php");


    }else{
        echo "Error Creating Medical Center";
    }
    $stmtmedicalcenter->close();

}