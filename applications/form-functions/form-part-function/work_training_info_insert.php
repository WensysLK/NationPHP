<?php
//include('../../../includes/db_config.php');
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = 1;
    $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
    $applicantLname = $_SESSION['applicantLname'];
    $applicantName = $_SESSION['client_name'] = $applicantFname . ' ' . $applicantLname;
    
}

 /*$applicantId1 = 343;
 $session_user_id = 1;*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Work Experience handling
    $hasWorkExperience = $_POST['hasWorkExperience'];
    $workpositions = $_POST['workposition'];
    $workCompany = $_POST['CompanyName'];
    $workCountry = $_POST['JobCountry'];
    $workStart = $_POST['yearstart'];
    $workEnd = $_POST['yearEnd'];

    // Handle Work Experience
    if ($hasWorkExperience === 'yes') {
        // Update applications table to reflect that work experience is present
        $stmtUpdate = $conn->prepare("UPDATE applications SET workExperiance = 0 WHERE applicationID = ?");
        if (!$stmtUpdate) {
            die("Update prepare failed: " . $conn->error);
        }
        $stmtUpdate->bind_param("i", $applicantId1);
        if (!$stmtUpdate->execute()) {
            die("Update execution failed: " . $stmtUpdate->error);
        }
        $stmtUpdate->close();

        // Insert work experience
        $stmt = $conn->prepare("INSERT INTO worke (workClinetID, workPosition, workCompany, workCountry, workStart, workEnd) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Work experience prepare failed: " . $conn->error);
        }

        foreach ($workpositions as $key => $position) {
            $company = $workCompany[$key];
            $country = $workCountry[$key];
            $jobStart = !empty($workStart[$key]) ? date('Y-m-d', strtotime($workStart[$key])) : NULL;
            $jobEnd = !empty($workEnd[$key]) ? date('Y-m-d', strtotime($workEnd[$key])) : NULL;

            if (!empty($position) || !empty($company) || !empty($country) || !empty($jobStart) || !empty($jobEnd)) {
                $stmt->bind_param("isssss", $applicantId1, $position, $company, $country, $jobStart, $jobEnd);
                if (!$stmt->execute()) {
                    die("Work experience execution failed: " . $stmt->error);
                }

                // Get the ID of the inserted work experience entry
                $workExperienceId = $stmt->insert_id;

                // Handle file upload for work experience, if provided
                if (!empty($_FILES['jobcertificate']['tmp_name'][$key])) {
                    $fileTmpName = $_FILES['jobcertificate']['tmp_name'][$key];
                    $originalFileName = basename($_FILES['jobcertificate']['name'][$key]);
                    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $filesourceType = "WorkExperience";

                    $companyNameClean = strtolower(str_replace(' ', '-', $company));

                    // Create a new file name
                    $newFileName = 'work-' . strtolower(str_replace(' ', '-', $applicantName)) . '-' . $companyNameClean . '-' . $workExperienceId . '.' . $fileExtension;
                    uploadworkjobFile($conn, $fileTmpName, $newFileName, $workExperienceId, $filesourceType, $applicantId1);
                }
            }
        }
        $stmt->close();
    } else if ($hasWorkExperience === 'no') {
        $stmt = $conn->prepare("UPDATE applications SET workExperiance = 1 WHERE applicationID = ?");
        if (!$stmt) {
            die("Work experience no prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $applicantId1);
        if (!$stmt->execute()) {
            die("Work experience no execution failed: " . $stmt->error);
        }
        $stmt->close();
    }

    // Handle Training Details
    $hasTraining = $_POST['hasTraining'];

    if ($hasTraining === 'yes') {
        $trainingDate = !empty($_POST['trainingDate']) ? date('Y-m-d', strtotime($_POST['trainingDate'])) : NULL;
        $trainingDuration = $_POST['trainingDuration'];
        $trainingCentre = $_POST['trainingCentre'];
        $trainingProgram = $_POST['trainingProgram'];
        $trainingRemarks = $_POST['trainingRemarks'];

        // Insert training details into the database
        $stmt = $conn->prepare("INSERT INTO training_details (clientId, traingCenter, trainingCourse, trainingRemark, trainigDate, createdBy) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Training prepare failed: " . $conn->error);
        }
        $stmt->bind_param("iiissi", $applicantId1, $trainingCentre, $trainingProgram, $trainingRemarks, $trainingDate, $session_user_id);
        if (!$stmt->execute()) {
            die("Training execution failed: " . $stmt->error);
        }

        // Get the inserted training ID
        $trainingId = $stmt->insert_id;
        $stmt->close();

        // Handle file upload for training certificate, if provided
        if (!empty($_FILES['trainingcertificate']['tmp_name'])) {
            $fileTmpName = $_FILES['trainingcertificate']['tmp_name'];
            $originalFileName = basename($_FILES['trainingcertificate']['name']);
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $filesourceType = "Training";

            // Create a new file name
            $newFileName = 'training-' . strtolower(str_replace(' ', '-', $applicantName)) . '-' . $trainingId . '.' . $fileExtension;
            uploadworkjobFile($conn, $fileTmpName, $newFileName, $trainingId, $filesourceType, $applicantId1);
        }
    } else {
        $stmt = $conn->prepare("UPDATE applications SET trainingCompleted = 1 WHERE applicationID = ?");
        if (!$stmt) {
            die("Training no prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $applicantId1);
        if (!$stmt->execute()) {
            die("Training no execution failed: " . $stmt->error);
        }
        $stmt->close();
    }

    // Redirect after processing
    //header("Location: https://tnr.wensys.lk/applications/view_all_applications.php");
    
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadworkjobFile($conn, $fileTmpName, $fileName, $sourceId, $filesourceType, $applicantId1) {
    $uploadDir = "../../uploads/"; // Ensure directory exists
    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the designated directory
    if (move_uploaded_file($fileTmpName, $filePath)) {
        // Prepare the SQL statement
        $stmtattachment = $conn->prepare("INSERT INTO attachemnts_data (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) VALUES (?, ?, ?, ?, ?)");
        if ($stmtattachment) {
            $stmtattachment->bind_param("iisss", $applicantId1, $sourceId, $filesourceType, $filePath, $fileName);
            if (!$stmtattachment->execute()) {
                die("Attachment execution failed: " . $stmtattachment->error);
            }
            $stmtattachment->close();
        } else {
            die("Attachment prepare failed: " . $conn->error);
        }
    } else {
        echo "Failed to upload file.";
    }
}
