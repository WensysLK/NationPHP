<?php

include('../../../includes/db_config.php');


// var_dump($_POST);
if (isset($_POST['submit'])) {

    $applicationID = $_POST['appId'];
    $contractID = $_POST['contractId'];
    $muzanedId = $_POST['muzanedId'];
    $muzaned_date = $_POST['muzaned_date'];
    $payment = $_POST['paymentAmount'];
    $paymentMethod = $_POST['paymentTpe'];
    $paymentDate = $_POST['paymentDate'];
    $statusmedical = 'booked';
    $statusmedicalresult = 'pending';
    $current_date = date('Y-m-d');
    $user = 0;

    $sqlmedicalupdates = "UPDATE `muzaned_details` SET 
                            `paymentamount` = ?, 
                             `paymentMethod` = ?, 
                              `paymentDate` = ?, 
                            `muzanedStatus` = ?
                           
                          WHERE `muzanedId` = ?";


    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);
    var_dump($smtpmedicalupdate);
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