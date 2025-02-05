<?php

include ('../../includes/db_config.php');

if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
    $newContractType = $_POST['contractType'];
    $countryType = $_POST['countryType'];

     $count=count($_POST['contractType']);


           if($newContractType[0]!= "none"){
               $contractType = $newContractType[0];
           }elseif ($newContractType[1]!= "none"){
               $contractType = $newContractType[1];
           }elseif ($newContractType[2]!= "none"){
               $contractType = $newContractType[2];
           }elseif ($newContractType[3]!= "none"){
               $contractType = $newContractType[3];
           }


    // Validate contract type
    if ($contractType == 'none') {
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'Please select a valid contract type.';
        header("Location: ../view_all_Contracts.php");
        exit();
    }

    // Default values for options
    $hasMuzaned = 0;
    $hasEnjaze = 0;
    $hasFingerprint = 0;

    // Check if options are selected
    if (isset($_POST['options'])) {
        $options = $_POST['options']; // This will be an array of selected options

        if (in_array('muzaned', $options)) {
            $hasMuzaned = 1;
        }
        if (in_array('enjaze', $options)) {
            $hasEnjaze = 1;
        }
        if (in_array('fingerprint', $options)) {
            $hasFingerprint = 1;
        }
    }

    // Prepare SQL query to insert contract
    $sqlContracts = "INSERT INTO `contract_details` (`applicationID`, `contractType`, `country`, `hasMuzaned`, `hasEnjaze`, `hasFingerprint`) VALUES (?, ?, ?, ?, ?,?)";
    $smtpcontract = $conn->prepare($sqlContracts);

    if ($smtpcontract) {
        $smtpcontract->bind_param("issiii", $applicationID, $contractType,$countryType, $hasMuzaned, $hasEnjaze, $hasFingerprint);

        if ($smtpcontract->execute()) {
            // Update the application to indicate that the contract has been created
            $updateapp = "UPDATE `applications` SET `ContractCreated` = 1 WHERE `applicationID` = ?";
            $smtpaplication = $conn->prepare($updateapp);
            if ($smtpaplication) {
                $smtpaplication->bind_param("i", $applicationID);
                $smtpaplication->execute();
                $smtpaplication->close();
            }

            // Success: Set session message and redirect
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Contract has been successfully added.';
            header("Location: ../view_all_Contracts.php");
        } else {
            // Failure: Set session message and redirect
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to add the contract.';
            header("Location: ../view_all_Contracts.php");
        }

        $smtpcontract->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }

    $conn->close();
}
?>
