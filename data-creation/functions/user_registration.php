<?php
include('../../includes/db_config.php');
if(isset($_POST['submit'])){

    $userName = htmlspecialchars($_POST['userName']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $userRole = htmlspecialchars($_POST['userRole']);
    $date = date('Y-m-d');
    $status = 1;



    $sqlmedicalCenetr = "INSERT INTO `users`(`Username`, `Email`, `password`, `userRoleID`, `createdDate`, `softdeletestatus`) VALUES ( ?, ?, ?, ?, ?, ?)";

    $stmtmedicalcenter = $conn->prepare($sqlmedicalCenetr);

    $stmtmedicalcenter->bind_param("ssssss",
    $userName,$email,$password,$userRole,$date,$status );

    if($stmtmedicalcenter->execute()){

        header("Location: ../users.php");


    }else{
        echo "Error Creating Training Center";
    }
    $stmtmedicalcenter->close();

}