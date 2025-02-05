<?php
include('../../includes/db_config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $follupid = $_POST['follupid'];
    $followup_type = $_POST['followup_type'];
    $message = $_POST['message'];
    $date = $_POST['followup_date'];
    $status = "processing";
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
            $follupid          // medicalId (integer)
        );

//        $applicationId = $row["applicationID"];
//var_dump($smtpmedicalupdate->execute());die();
        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            $sql = "INSERT INTO `complains_follow_up` (`complainant_id`, `follow_up_type`, `message`,`status`, `create_date`, `softdeletestatus`) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $follupid, $followup_type,$message,$status, $date,$status_delete);
            $stmt->execute();
            // Prepare the second update statement for contract details
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = 'Help desk status updated successfully.';
            header("Location: ../help_desk_process_parts/followup.php?complain_id=$follupid");
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