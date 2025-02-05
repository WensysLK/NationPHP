<?php

include ('../../includes/db_config.php');

if(isset($_POST['submit'])){

    $applicantId = $_POST['appId'];
    $contractId = $_POST['contractId'];
    $muzanedDate = $_POST['muzaneddate'];
    $muzanedSerial = $_POST['muzanedserialno'];
    $createdBy = 1;

    $sqlmuzaned = "INSERT INTO `muzaned_details`(`clientId`, `contractId`, `muzaned_date`, `muzaned_SI`,`createdBy`) VALUES (?,?,?,?,?)";

    $smtpmuzaned = $conn->prepare($sqlmuzaned);
    $smtpmuzaned->bind_param("iissi",$applicantId,$contractId,$muzanedDate,$muzanedSerial,$createdBy);
    
    if($smtpmuzaned->execute()){
        $updatemuzaned = "UPDATE `contract_details` SET `MuzanedStatus` = 'processing' WHERE `contractId` = ?";
        $smtpmuzanedcontract = $conn->prepare($updatemuzaned);
        $smtpmuzanedcontract->bind_param("i",$contractId);
        if($smtpmuzanedcontract->execute()){
            header("Location: ../view_all_muzaned.php");
          }else{
            echo " contract status not updated.";
          }

          echo "not Sucessfull stored";
    }






}