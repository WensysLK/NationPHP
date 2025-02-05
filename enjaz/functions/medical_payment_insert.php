<?php

include('../../includes/db_config.php');



if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
//    $contractID = $_POST['contractId'];
    $medicleID = $_POST['medcialId'];

    $payment = $_POST['payment'];
    $statusmedical = 'booked';
    $statusmedicalresult = 'pending';
    $current_date = date('Y-m-d');
    $user = 0;

    $sqlmedicalupdates = "UPDATE `enjaz_details` SET 
                            `1stPayment` = ?, 
                            `EnjazStatus` = ?, 
                             `updatedat` = ?, 
                            `updatedby` = ? 
                          WHERE `EnjazId` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);
    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("sssii",
            $payment,
            $statusmedical,     // medicalStatus (string)
               // medicalresult (string)
            $current_date,      // updateAt (string, date)
            $user,              // updatedBy (integer)
            $medicleID          // medicalId (integer)
        );

        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            header("Location: ../view_all_enjaz.php");
        } else {
            // Failure: Set session message and redirect
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to add the medical details.';
            header("Location: ../view_all_enjaz.php");
        }
        $smtpcontract->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }

    $conn->close();
}