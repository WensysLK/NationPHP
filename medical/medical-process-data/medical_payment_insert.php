<?php

include('../../includes/db_config.php');


var_dump($_POST);
if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
    $contractID = $_POST['contractId'];
    $medicleID = $_POST['medcialId'];
    $medicalCenter = $_POST['medicalCenter'];
    $allocationDate = $_POST['allocationdate'];
    $gccDate = $_POST['gccDate'];
    $payment = $_POST['payment'];
    $statusmedical = 'booked';
    $statusmedicalresult = 'pending';
    $current_date = date('Y-m-d');
    $user = 0;

    $sqlmedicalupdates = "UPDATE `medical_details` SET 
                            `paymentamount` = ?, 
                            `medicalStatus` = ?, 
                             `medicalresult` = ?, 
                             `updateAt` = ?, 
                            `updatedBy` = ? 
                          WHERE `medicalId` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);
    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssii",
            $payment,
            $statusmedical,     // medicalStatus (string)
            $statusmedicalresult,     // medicalresult (string)
            $current_date,      // updateAt (string, date)
            $user,              // updatedBy (integer)
            $medicleID          // medicalId (integer)
        );

        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
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