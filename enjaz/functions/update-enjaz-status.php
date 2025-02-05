<?php
include ('../../includes/db_config.php');

if (isset($_POST['updateenjaz'])) {
    // Database connection (use your actual database credentials)
    

    // Get form data
    $EnjazID = $_POST['EnjazID'];
    $enjazclientID = $_POST['enjazapplicantID'];
    $expremark = $_POST['expremark'];
    $updateddate = date('Y-m-d'); // Get current date
    $updatedby = 1; // Assuming this is the ID of the user updating the record
    $enjazstatus = 'completed';
   

    // Update payment data into the enjaz_details table
    $sql = "UPDATE enjaz_details 
            SET EnjazStatus='$enjazstatus',remarkEnjaz='$expremark', updatedat='$updateddate', updatedby=$updatedby 
            WHERE EnjazId=$EnjazID";

    if ($conn->query($sql) === TRUE) {
        // If the update was successful

        // Handle file upload
        if (isset($_FILES['enjazreport']) && $_FILES['enjazreport']['error'] == 0) {
            $targetDir = "../../uploads/enjaz"; // Define your upload directory
            $fileName = basename($_FILES['enjazreport']['name']);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $attachtype = 'enjaz';

            // Check if the file is a valid type (adjust types as necessary)
            $allowTypes = array('jpg', 'png', 'pdf', 'doc', 'docx');
            if (in_array($fileType, $allowTypes)) {
                // Move the file to the target directory
                if (move_uploaded_file($_FILES['enjazreport']['tmp_name'], $targetFilePath)) {
                    // Insert file information into the attachment table
                    $sqlAttach = "INSERT INTO attachemnts_data (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt,attachFilename,createdAt)VALUES ('$enjazclientID', '$EnjazID','$attachtype', '$targetFilePath', '$fileName' , '$updateddate')";

                    if ($conn->query($sqlAttach) === TRUE) {
                        header("Location: ../view_all_enjaz.php");
                        echo "Payment and attachment uploaded successfully!";
                    } else {
                        echo "Error inserting attachment record: " . $conn->error;
                    }
                } else {
                    echo "Error uploading the file.";
                }
            } else {
                echo "Invalid file type. Only JPG, PNG, PDF, DOC, DOCX are allowed.";
            }
        }
    } else {
        echo "Error updating Enjaz details: " . $conn->error;
    }

    $conn->close();
}
?>
