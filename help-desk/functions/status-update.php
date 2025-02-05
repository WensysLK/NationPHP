<?php
include('../../includes/db_config.php');



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $complain_id= $_GET['complain_id'];

    $status = "completed";
    $status_delete=1;

    $date=date("Y-m-d");
    $applicationId="";




    // Prepare the UPDATE statement for medical details
    $sqlmedicalupdates = "UPDATE `complains` SET 
                          `status` = ?
                          WHERE `id` = ?";

    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);
//var_dump($status,$follupid);
    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("si",
            $status,     // medicalresult (string)
            $complain_id          // medicalId (integer)
        );

//        $applicationId = $row["applicationID"];
//var_dump($smtpmedicalupdate->execute());die();
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