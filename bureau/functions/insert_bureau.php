<?php

include ('../../includes/db_config.php');

if(isset($_POST['submit'])){

    $applicantId = $_POST['applicantID'];
    $contractId = $_POST['appContract'];
    $enjazId = $_POST['enjazId'];
    $remarks = $_POST['bureaRemark'];
    $currentDate = date('Y-m-d');
    $createdBy = 1;

    $sqlburea = "INSERT INTO `bureau_details`(`clientId`, `contractId`, `enjazId`, `remark`, `createdAt`, `createdBy`) VALUES (?,?,?,?,?,?)";

    $smtpburea = $conn->prepare($sqlburea);
    $smtpburea->bind_param("iiissi",$applicantId,$contractId,$enjazId,$remarks,$currentDate,$createdBy);
    
    if($smtpburea->execute()){
        $updatefprint = "UPDATE `contract_details` SET `BeauroStatus` = 'finance' WHERE `contractId` = ?";
        $smtpfprint = $conn->prepare($updatefprint);
        $smtpfprint->bind_param("i",$contractId);
        if($smtpfprint->execute()){
            header("Location: ../view_all_bureau.php");
          }else{
            echo " contract status not updated.";
          }

          echo "not Sucessfull stored";
    }

}