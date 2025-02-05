<?php

include ('../../includes/db_config.php');

if(isset($_POST['submit'])){

    $applicantId = $_POST['applicantID'];
    $contractId = $_POST['appContract'];
    $bookingDate = $_POST['bookingdate'];
    $enteredDate = $_POST['entereddate'];
    $systemType = $_POST['finegrsystem'];
    $createdBy = 1;

    $sqlfprint = "INSERT INTO `fprint_details`(`clientId`, `contractId`, `enterdDate`, `bookingDate`, `systemType`,  `cretaedBy`) VALUES (?,?,?,?,?,?)";

    $smtpfprint = $conn->prepare($sqlfprint);
    $smtpfprint->bind_param("iisssi",$applicantId,$contractId,$enteredDate,$bookingDate,$systemType,$createdBy);
    
    if($smtpfprint->execute()){
        $updatefprint = "UPDATE `contract_details` SET `fprintStatus` = 'finance' WHERE `contractId` = ?";
        $smtpfprint = $conn->prepare($updatefprint);
        $smtpfprint->bind_param("i",$contractId);
        if($smtpfprint->execute()){
            header("Location: ../view_all_fprint.php");
          }else{
            echo " contract status not updated.";
          }

          echo "not Sucessfull stored";
    }






}