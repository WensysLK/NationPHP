<?php
include('../../includes/db_config.php');

if (isset($_POST['submit'])) {

    // Retrieve form values
    $applicationID = $_POST['appId'];
    $contractID = $_POST['contractId'];
    $medicalId = $_POST['medcialId'];
    $collecteddate = $_POST['medicalcollecteddate'];
    $collectedBy = $_POST['collectedby'];
    $remarks = $_POST['medicalRemark'];
    $medicalresult = $_POST['medicalstatus'];
    $statusmedical = 'completed';
    $current_date = date('Y-m-d');
    $user = 1;

    // Prepare the UPDATE statement for medical details
    $sqlmedicalupdates = "UPDATE `medical_details` SET 
                          `medicalStatus` = ?, 
                          `medicalresult` = ?, 
                          `CollectedDate` = ?, 
                          `collectedBy` = ?, 
                          `medicalRemark` = ?, 
                          `updateAt` = ?, 
                          `updatedBy` = ? 
                          WHERE `medicalId` = ?";
    
    $smtpmedicalupdate = $conn->prepare($sqlmedicalupdates);

    if ($smtpmedicalupdate) {
        // Bind the parameters
        $smtpmedicalupdate->bind_param("ssssssii", 
            $statusmedical,     // medicalStatus (string)
            $medicalresult,     // medicalresult (string)
            $collecteddate,     // CollectedDate (string)
            $collectedBy,       // collectedBy (string)
            $remarks,           // medicalRemark (string)
            $current_date,      // updateAt (string, date)
            $user,              // updatedBy (integer)
            $medicalId          // medicalId (integer)
        );
        
        // Execute the medical details update query
        if ($smtpmedicalupdate->execute()) {
            // Prepare the second update statement for contract details
            $updatemedical = "UPDATE `contract_details` SET `medicalStatus` = 'completed' WHERE `contractId` = ?";
            $smtpmedical = $conn->prepare($updatemedical);

            if ($smtpmedical) {
                // Bind the contract ID for the contract details update
                $smtpmedical->bind_param("i", $contractID);

                // Execute the contract status update query
                if ($smtpmedical->execute()) {
                    // Success: Both updates were successful
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = 'Medical details and contract status updated successfully.';
                    header("Location: ../view_all_medicals.php");
                } else {
                    // Failure: Set session message for contract update failure
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = 'Failed to update contract status.';
                    header("Location: ../view_all_medicals.php");
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
