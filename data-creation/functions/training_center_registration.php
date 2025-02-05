<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $trainingCenterName = htmlspecialchars($_POST['trainingCenterName']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $website = htmlspecialchars($_POST['website']);
    $date = date('Y-m-d');
    $status = 1;



    $sqlmedicalCenetr = "INSERT INTO `training_centers`(`centerName`, `address`, `phoneNumber`, `email`, `website`, `createdAt`, `softdeletestatus`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";

    $stmtmedicalcenter = $conn->prepare($sqlmedicalCenetr);

    $stmtmedicalcenter->bind_param("sssssss", 
    $trainingCenterName,$address,$phoneNumber,$email,$website,$date,$status );

    if($stmtmedicalcenter->execute()){

        header("Location: ../training-centers.php");


    }else{
        echo "Error Creating Training Center";
    }
    $stmtmedicalcenter->close();

}