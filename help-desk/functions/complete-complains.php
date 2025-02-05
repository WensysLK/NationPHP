<?php
include('../../includes/db_config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $passport_number = $_POST['passport_number'];
    $followup_type = $_POST['followup_type'];
    $message = $_POST['message'];
    $date = $_POST['followup_date'];
    $status = $_POST['status'];
    $procedure = $_POST['complete_processing'];
    $complain_id = $_POST['complain_id'];

    $date=date("Y-m-d");
    $applicationId="";
//    $status=1;


    // Prepare the UPDATE statement for medical details
    $sqlmedicalupdates = "UPDATE `complains` SET 
                          `last_procedure` = ?, 
                          `status` = ?
                          WHERE `id` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssi",
            $procedure,     // medicalStatus (string)
            $status,     // medicalresult (string)

            $complain_id          // medicalId (integer)
        );

        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            // Prepare the second update statement for contract details
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Help desk status updated successfully.';
            header("Location: ../view-all-complains.php");
        } else {
            // Failure: Set session message for medical details update failure
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to update the help desk details.';
            header("Location: ../view-all-complains.php");
        }

        // Close the first statement
        $smtpmedicalupdate->close();
    } else {
        die("Prepare failed for medical details: " . $conn->error);
    }

    // Close the database connection
    $conn->close();






    var_dump( $passport_number,$followup_type,$message,$date);die();
}