<?php 
include ('../../includes/db_config.php');
//var_dump($_POST);die();

if(isset($_POST['submit'])){

  $clientId = $_POST['applicantID'];
  $contractId = $_POST['appContract'];
  $sponcerId = $_POST['fagent'];
  $jobOrderId = $_POST['jobordername'];
  $jobPositionsId = $_POST['jobpositions'];
  $enjazRef = $_POST['enjazref'];
  $enjazDate = $_POST['ejazappdate'];
  $createdby = 1;

  $sqlenjaz = "INSERT INTO `enjaz_details`(`CleintId`,`contractId`, `sponcerId`, `jobOrderId`, `jobpositionId`,`EnjazRef`, `EnjazDate`, `CreateBy`) VALUES ( ?, ?,?, ?, ?, ?, ?, ? )";

  $smtpenjaz = $conn->prepare($sqlenjaz);
  $smtpenjaz->bind_param("iiiiissi",$clientId,$contractId,$sponcerId,$jobOrderId,$jobPositionsId,$enjazRef,$enjazDate,$createdby);
  
  if($smtpenjaz->execute()){
    $updateenjza = "UPDATE `contract_details` SET `EnjazSatus` = 'finance' WHERE `contractId` = ?";
    $smtpenjazcontract = $conn->prepare($updateenjza);
    $smtpenjazcontract->bind_param("i",$contractId);
    if($smtpenjazcontract->execute()){
      header("Location: ../view_all_enjaz.php");
    }else{
      echo " contract status not updated.";
    }
   
  }else{
    echo "not Sucessfull stored";
  }
  //$smtpenjaz = $conn->prepare($sqlenjaz);
 



}