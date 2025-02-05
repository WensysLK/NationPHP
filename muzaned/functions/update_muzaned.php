<?php
// Include your DB configuration file
include('../../includes/db_config.php');

if (isset($_POST['updatemuzaned'])) {
    // Retrieve the form data
    $muzanedID = $_POST['muzanedID'];
    $currentUser = $_POST['currentUser'];
    $enjazclientID = $_POST['cleintID'];
    $exptyp = $_POST['exptyp'];
    $sponsorID = $_POST['SponcerID'];
    $sponsorName = $_POST['sponcername'];
//    $empID = $_POST['empID'];
//    $contractNo = $_POST['contractno'];
    $visaNo = $_POST['visanumber'];
    $jobOrderID = $_POST['jobordername'];
    $positionID = $_POST['jobpositions'];
    $wakalaAgentID = $_POST['fagent'];
    $remark = $_POST['expremark'];
    $muzanedStatus = 'completed';
$date=date('Y-m-d');
$softdelete=1;
    // Update the Muzaned Details Table
    $sqlUpdateMuzaned = "UPDATE muzaned_details 
                         SET sponcerId = '$sponsorID',
                             SponcerName = '$sponsorName',
                             visaNo = '$visaNo',
                             wakalaagent = '$wakalaAgentID',
                             joborderId = '$positionID',
                             jobposition = '$sponsorID',
                             muzanedRemark = '$remark',
                             muzanedStatus = '$muzanedStatus'
                         WHERE muzanedID = '$muzanedID'";

    if (mysqli_query($conn, $sqlUpdateMuzaned)) {
        $sqlmuzaned = "INSERT INTO `sponcer_details`(`sponcerId`, `sponcerName`, `employerId`, `createdAt`,`softdeletestatus`) VALUES (?,?,?,?,?)";

        $smtpmuzaned = $conn->prepare($sqlmuzaned);
        $smtpmuzaned->bind_param("isiss",$sponsorID,$sponsorName,$enjazclientID,$date,$softdelete);
        $smtpmuzaned->execute();

        echo "Muzaned details updated successfully.<br>";
    } else {
        echo "Error updating muzaned details: " . mysqli_error($conn) . "<br>";
    }


    // 2. Handle File Upload and Insert in Attachment Table
    if (isset($_FILES['muzanedreport']) && $_FILES['muzanedreport']['error'] == 0) {
        $targetDir = "../../uploads/muzaned/"; // Corrected file path to ensure the file is uploaded correctly
        $fileName = basename($_FILES['muzanedreport']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $attachtype = 'muzaned';

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'pdf', 'doc', 'docx');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES['muzanedreport']['tmp_name'], $targetFilePath)) {
                // Insert a new record in the attachments table, since there is no previous attachment
                $sqlInsertAttachment = "INSERT INTO attachemnts_data (attachemnet_ClientID,attachmentsourceId,attachmentType, attachemnt,attachFilename) 
                                        VALUES ('$enjazclientID', '$muzanedID', '$attachtype', '$targetFilePath', '$fileName')";

                if (mysqli_query($conn, $sqlInsertAttachment)) {
                    echo "New attachment uploaded and inserted successfully.";
                } else {
                    echo "Error inserting new attachment: " . mysqli_error($conn) . "<br>";
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file format. Only JPG, PNG, PDF, DOC, DOCX are allowed.";
        }
    }
    header("Location: ../view_all_muzaned.php");
    // Close the connection
    mysqli_close($conn);
}
?>
