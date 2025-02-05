<?php
include('../../includes/db_config.php');

$contractID = $_POST['contractID'];
$applicationId = $_POST['applicationId'];



$sql = "UPDATE contract_details SET softdeletestatus = 0 WHERE contractId = ?";

$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param('i', $contractID);

    if ($stmt->execute()) {


        $updateapp = "UPDATE `applications` SET `ContractCreated` = 0 WHERE `applicationID` = ?";
        $smtpaplication = $conn->prepare($updateapp);
        if ($smtpaplication) {
            $smtpaplication->bind_param("i", $applicationId);
            $smtpaplication->execute();
            $smtpaplication->close();
//            var_dump("hello1");die();
        }
//        var_dump("hello");die();
        // Success: Set session message and redirect
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = 'Contract has been successfully added.';
        header("Location: ../view_all_Contracts.php");
        exit;
    } else {
        echo "Error performing soft delete: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing the soft delete statement: " . $conn->error;
}