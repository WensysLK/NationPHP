<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname'];
}

// Assuming these session variables have been set elsewhere in the application
// Assuming these session variables have been set elsewhere in the application
// Assuming these session variables have been set elsewhere in the application
//$applicantId1 = $_SESSION['last_applicant_id'] = 120;
//$applicantName = $_SESSION['client_name'] = "Terrance";

if (isset($_POST['save'])) {
    // Retrieve and sanitize education data
    $schoolNames = $_POST['schoolname'];
    $examtype = $_POST['edulevel'];
    $examyear = $_POST['eduyear'];
    
    // Prepare SQL for inserting education details
    $sqleducation = "INSERT INTO `education_details`
    (`educationClientId`, `schoolName`, `edutype`, `educationYear`) 
    VALUES (?,?,?,?)";

    $stmteducation = $conn->prepare($sqleducation);

    if ($stmteducation === false) {
        die("Prepare failed: " . $conn->error);
    }

    foreach ($schoolNames as $index => $school) {
        if (empty($school)) {
            continue;
        }

        $exam = $examtype[$index];
        $year = $examyear[$index];

        // Bind parameters and execute the insert query
        $stmteducation->bind_param("isss", $applicantId1, $school, $exam, $year);

        if (!$stmteducation->execute()) {
            echo "Error inserting Education Details: " . $stmteducation->error;
        } else {
            $educationId = $stmteducation->insert_id;

            // Handle file uploads for attachments only if a school name was provided
            if (!empty($_FILES['certificate']['name'][$index])) {
                $educationfileTmpName = $_FILES['certificate']['tmp_name'][$index];
                $educationfileName = basename($_FILES['certificate']['name'][$index]);
                $educationfileExtension = pathinfo($educationfileName, PATHINFO_EXTENSION);
                $newFileName = 'Education-' . $educationId . '.' . $educationfileExtension;

                // Validate file type and size
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
                if (!in_array($educationfileExtension, $allowedExtensions)) {
                    die("File type not allowed.");
                }

                if ($_FILES['certificate']['size'][$index] > 5000000) { // Max 5MB
                    die("File size exceeds limit.");
                }

                // Call the function to handle file uploads
                handleeducationattachments($conn, $educationfileTmpName, $newFileName, "../../uploads/education_certificates/", $applicantId1, $educationId, 'Education-Certificate');
            }
        }
    }

    // Redirect to another page after processing
    
}

/**
 * Function to handle file uploads for education attachments
 */
function handleeducationattachments($conn, $fileTmpName, $fileName, $uploadDir, $applicantId1, $educationId, $attachmentType) {
    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Failed to create directory: " . $uploadDir);
        }
    }

    $filePath = $uploadDir . basename($fileName);

    if (move_uploaded_file($fileTmpName, $filePath)) {
        $sqlattachments = "INSERT INTO attachemnts_data 
        (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
        VALUES (?,?,?,?,?)";

        $stmtattachments = $conn->prepare($sqlattachments);
        if ($stmtattachments) {
            $stmtattachments->bind_param("iisss", $applicantId1, $educationId, $attachmentType, $filePath, $fileName);

            if (!$stmtattachments->execute()) {
                echo "Error inserting attachment details: " . $stmtattachments->error;
            }
            $stmtattachments->close();
        } else {
            die("Failed to prepare SQL statement for attachments: " . $conn->error);
        }
    } else {
        die("Failed to upload file: " . $fileTmpName);
    }
}
?>