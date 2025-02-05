<?php

include('../../includes/db_config.php');


if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
    $contractID = $_POST['contractId'];
    $medicalCenter = $_POST['medicalCenter'];
    $allocationDate = $_POST['allocationdate'];
    $gccDate = $_POST['gccDate'];
    $statusmedical = 'pending';
    $current_date = date('Y-m-d');

    // Prepare the INSERT statement for medical details
    $sqlContracts = "INSERT INTO `medical_details`
    (`MedicalAppId`, `MedicalContractId`, `MedicalCenter`, 
    `allocationDate`, `gccDate`, `medicalStatus`,`createdAt`) VALUES (?,?,?,?,?,?,?)";

    $smtpcontract = $conn->prepare($sqlContracts);

    if ($smtpcontract) {
        $smtpcontract->bind_param("iiissss", $applicationID, $contractID, $medicalCenter, $allocationDate, $gccDate, $statusmedical,$current_date);

        if ($smtpcontract->execute()) {
            // Prepare the UPDATE statement for contract details
            $updateapp = "UPDATE `contract_details` SET `medicalStatus` = 'processing' WHERE `contractId` = ?";
            $smtpaplication = $conn->prepare($updateapp);

            if ($smtpaplication) {
                $smtpaplication->bind_param("i", $contractID);
                if ($smtpaplication->execute()) {
                    // Success: Set session message and redirect
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = 'Contract has been successfully added.';
                } else {
                    // Failure in updating the contract status
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'Failed to update contract status.';
                }
                $smtpaplication->close();
            } else {
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = 'Failed to prepare contract update statement.';
            }
            header("Location: ../view_all_medicals.php");
        } else {
            // Failure: Set session message and redirect
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to add the medical details.';
            header("Location: ../view_all_medicals.php");
        }
        $smtpcontract->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }

    $conn->close();

}