<?php
include ('../../includes/db_config.php');

if (isset($_POST['submit'])) {

    // Retrieve form values
    $applicationID = $_POST['applicantID'];
    $contractID = $_POST['appContract'];
    $fprintId = $_POST['fprintId'];
    $collecteddate = $_POST['collectiondate'];
    $collectedBy = $_POST['collectedBy'];
    $remarks = $_POST['fprintremarks'];
    $current_date = date('Y-m-d');
    $fingerprintstatus = 'completed';
    $user = 1;

    // Prepare the UPDATE statement for medical details
    $sqlmedicalupdates = "UPDATE `fprint_details` 
SET `fprintStatus`=?, `updateAt`=?, `updatedBy`=?, `CollectedDate`=?, `collectedBy`=?, `remarks`=? 
WHERE `fprintId`=?";
    
    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssisssi", 
        $fingerprintstatus,     // medicalStatus (string)
        $current_date,     // medicalresult (string)
        $user,     // CollectedDate (string)
        $collecteddate,       // collectedBy (string)
        $collectedBy,           // medicalRemark (string)
        $remarks,      // updateAt (string, date)
        $fprintId          // medicalId (integer)
        );
        
        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            // Prepare the second update statement for contract details
            $updatemedical = "UPDATE `contract_details` SET `fprintStatus` = 'completed' WHERE `contractId` = ?";
            $smtpmedical = $conn->prepare($updatemedical);

            if ($smtpmedical) {
                // Bind the contract ID for the contract details update
                $smtpmedical->bind_param("i", $contractID);

                // Execute the contract status update query
                if ($smtpmedical->execute()) {
                    // Success: Both updates were successful
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = 'Medical details and contract status updated successfully.';
                    header("Location: ../view_all_fprint.php");
                } else {
                    // Failure: Set session message for contract update failure
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'Failed to update contract status.';
                    header("Location: ../view_all_fprint.php");
                }

                // Close the second statement
                $smtpmedical->close();
            } else {
                // Failure in preparing the second query
                die("Prepare failed for contract update: " . $conn->error);
            }
        } else {
            // Failure: Set session message for medical details update failure
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = 'Failed to update the medical details.';
            header("Location: ../view_all_medicals.php");
        }
        
        // Close the first statement
        $smtpmedicalupdate->close();
    } else {
        die("Prepare failed for medical details: " . $conn->error);
    }

    // Close the database connection
    $conn->close();
}
?>
