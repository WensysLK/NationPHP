<?php

include('../../../includes/db_config.php');


// var_dump($_POST);
if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
    $contractID = $_POST['contractId'];
    $muzanedId = $_POST['bureauId'];
    $muzaned_date = $_POST['muzaned_date'];
    $payment = $_POST['paymentAmount'];
    $paymentMethod = $_POST['paymentTpe'];
    $paymentDate = $_POST['paymentDate'];
    $statusmedical = 'completed';
    $statusmedicalresult = 'pending';
    $statusmedicalresultNew = 'completed';
    $current_date = date('Y-m-d');
    $user = 0;

    $sqlmedicalupdates = "UPDATE `bureau_details` SET 
                            `paymentAmount` = ?, 
                             `paymentMethod` = ?, 
                              `paymentdate` = ?, 
                            `bureaustatus` = ?
                           
                          WHERE `bureauId` = ?";


    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);
    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssi",
            $payment,
            $paymentMethod,
            $paymentDate,
            $statusmedical,     // medicalStatus (string)
              $muzanedId          // medicalId (integer)
        );

        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            $sqlmedicalupdatesNew = "UPDATE `contract_details` SET 
                            `BeauroStatus` = ?
                          WHERE `contractId` = ?";
            $smtpmedicalupdateNew = $conn->prepare($sqlmedicalupdatesNew);
            $smtpmedicalupdateNew->bind_param("si",
                $statusmedicalresultNew,
                   // medicalStatus (string)
                $contractID          // medicalId (integer)
            );
            $smtpmedicalupdateNew->execute();
            header("Location: ../view_all_payabel.php");
        } else {
            // Failure: Set session message and redirect
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to add the medical details.';
            header("Location: ../view_all_payabel.php");
        }
        $smtpcontract->close();
    } else {
        die("Prepare failed: " . $conn->error);
    }

    $conn->close();
}