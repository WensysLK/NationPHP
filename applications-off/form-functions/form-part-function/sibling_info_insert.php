<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname']; // Assuming this is set correctly elsewhere
}
// Sample initialization for debugging
//$applicantId1 = $_SESSION['last_applicant_id'] = 120;
//$applicantName = $_SESSION['client_name'] = "Terrance";

if (isset($_POST['save'])) {
    // Database connection (Assumed to be initialized somewhere)
    // $conn = new mysqli("servername", "username", "password", "dbname");

    // Retrieve form data
    $childNames = $_POST['childName'];
    $childRelationships = $_POST['childRelationship'];
    $childDOBs = $_POST['childDOB'];
    $childSchools = $_POST['childSchoolAttended'];
    $childSchoolNames = $_POST['childSchoolName'];
    $childGrades = $_POST['childGrade'];
    $childNICs = $_POST['childNIC'];
    
    // Prepare the SQL statement for sibling details
    $sqlSibling = "INSERT INTO `sibilings_details` 
        (`sibilingClientID`, `SibilingName`, `SibilingType`, `SibilingDob`, `schoolAttended`, `schoolName`, `schoolGrade`, `sibilingNic`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtSibling = $conn->prepare($sqlSibling);

   
    if ($stmtSibling === false) {
        die("Prepare failed: " . $conn->error);
    }

    foreach ($childNames as $index => $childName) {
        $relationship = $childRelationships[$index];
        $dob = $childDOBs[$index];
        $schoolAttended = $childSchools[$index];
        $schoolName = $childSchoolNames[$index];
        $grade = $childGrades[$index];
        $nic = $childNICs[$index];

        // Only process if child name and relationship are provided
        if (empty($childName) || empty($relationship)) {
            continue;
        }

        // Bind parameters and execute the SQL statement
        $stmtSibling->bind_param("isssssss", $applicantId1, $childName, $relationship, $dob, $schoolAttended, $schoolName, $grade, $nic);

        if (!$stmtSibling->execute()) {
            echo "Error inserting Sibling Details: " . $stmtSibling->error;
        } else {
            $siblingId = $stmtSibling->insert_id; // Get the inserted sibling ID for further use
            $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
     $applicantLname = $_SESSION['applicantLname'];

            // Handle file uploads for NIC images
            if (!empty($_FILES['sibilingnicfront']['tmp_name'][$index])) {
                $fileTmpName = $_FILES['sibilingnicfront']['tmp_name'][$index];
                $fileName = basename($_FILES['sibilingnicfront']['name'][$index]);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                $newFileName = 'Sibling-NICfront-' . $siblingId . '.' . $fileExtension;
                uploadSiblingAttachment($conn, $fileTmpName, $newFileName, "../../uploads/sibling_nic/", $applicantId1, $siblingId, 'Sibling-NIC-Front');
            }

            if (!empty($_FILES['sibilingnicback']['tmp_name'][$index])) {
                $fileTmpName = $_FILES['sibilingnicback']['tmp_name'][$index];
                $fileName = basename($_FILES['sibilingnicback']['name'][$index]);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                $newFileName = 'Sibling-NICback-' . $siblingId . '.' . $fileExtension;
                uploadSiblingAttachment($conn, $fileTmpName, $newFileName, "../../uploads/sibling_nic/", $applicantId1, $siblingId, 'Sibling-NIC-Back');
            }
        }
    }

    $stmtSibling->close();

    // Redirect to the next page upon success
    
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadSiblingAttachment($conn, $fileTmpName, $fileName, $uploadDir, $clientId, $siblingId, $attachmentType) {
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
        $stmtAttachment = $conn->prepare("INSERT INTO attachemnts_data 
            (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
            VALUES (?, ?, ?, ?, ?)");

        // Check if the statement was prepared successfully
        if ($stmtAttachment) {
            $stmtAttachment->bind_param("iisss", $clientId, $siblingId, $attachmentType, $filePath, $fileName);
            if (!$stmtAttachment->execute()) {
                echo "Failed to execute attachment insertion: " . $stmtAttachment->error . "<br>";
            }
            $stmtAttachment->close();
        } else {
            die("Failed to prepare SQL statement: " . $conn->error);
        }
    } else {
        die("Failed to upload file: " . $fileTmpName);
    }
}

?>