<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
    $applicantLname = $_SESSION['applicantLname'];
    
}

/*$applicantId1 = $_SESSION['last_applicant_id'] = 120;
$applicantName = $_SESSION['client_name'] = "Terrance";*/

if (isset($_POST['save'])) {
    // Retrieve and sanitize professional qualification data
    $institueNames = $_POST['institueName'];
    $courseName = $_POST['CourseName'];
    $profStatus = $_POST['CourseStatus'];
    $profDuration = $_POST['duration'];

    // Prepare the SQL statement for professional qualifications
    $sqlprofessional = "INSERT INTO `professional_qualifications`
        (`QulificationClientID`, `institueName`, `courseName`, `Qualification_Duration`, `Qualification_Status`) 
        VALUES (?,?,?,?,?)";

    $stmtprofessional = $conn->prepare($sqlprofessional);

    if ($stmtprofessional === false) {
        die("Prepare failed: " . $conn->error);
    }

    foreach ($institueNames as $index => $institue) {
        $course = $courseName[$index];
        $status = $profStatus[$index];
        $duration = $profDuration[$index];

        // Only process if both institute name and course name are provided
        if (empty($institue) || empty($course)) {
            continue; // Skip this iteration if any required data is missing
        }

        // Bind parameters and execute the SQL statement
        $stmtprofessional->bind_param("issss", $applicantId1, $institue, $course, $status, $duration);

        if (!$stmtprofessional->execute()) {
            echo "Error inserting Professional Qualification Details: " . $stmtprofessional->error;
        } else {
            $qualificationId = $stmtprofessional->insert_id; // Get the inserted qualification ID for further use
            $applicantId1 = $_SESSION['last_applicant_id'];
            $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
            $applicantLname = $_SESSION['applicantLname'];
            // Handle file uploads for each professional qualification
            if (!empty($_FILES['courcecertificate']['tmp_name'][$index])) {
                $fileTmpName = $_FILES['courcecertificate']['tmp_name'][$index];
                $fileName = basename($_FILES['courcecertificate']['name'][$index]);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                // Create a new file name using the qualification ID
                $newFileName = 'certificate-' . $qualificationId . '.' . $fileExtension;

                // Call the function to handle file uploads and insert into the attachments table
                uploadQualificationAttachment($conn, $fileTmpName, $newFileName, "../../uploads/professional_certificate/", $applicantId1, $qualificationId, 'qualification');
            }
        }
    }

    $stmtprofessional->close();

    // Redirect to the next page upon success
   
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadQualificationAttachment($conn, $fileTmpName, $fileName, $uploadDir, $clientId, $qualificationId, $attachmentType) {
    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Failed to create directory: " . $uploadDir);
        }
    }

    $filePath = $uploadDir . $fileName;

    // Move the uploaded file to the designated directory
    if (move_uploaded_file($fileTmpName, $filePath)) {
        // Prepare the SQL statement to insert into the attachments table
        $stmtattachment = $conn->prepare("INSERT INTO attachemnts_data 
            (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
            VALUES (?, ?, ?, ?, ?)");

        // Check if the statement was prepared successfully
        if ($stmtattachment) {
            $stmtattachment->bind_param("iisss", $clientId, $qualificationId, $attachmentType, $filePath, $fileName);
            if (!$stmtattachment->execute()) {
                echo "Failed to execute attachment insertion: " . $stmtattachment->error . "<br>";
            }
            $stmtattachment->close();
        } else {
            die("Failed to prepare SQL statement: " . $conn->error);
        }
    } else {
        die("Failed to upload file: " . $fileTmpName);
    }
}
?>