<?php
//include('../../../includes/db_config.php');
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname'];
    $applicantName = $_SESSION['client_name'] = $applicantFname . ' ' . $applicantLname;
    
    // Use $applicantId for further processing

    // Optionally, unset the session variable if no longer neede 
    } 
   /* $applicantId1 = $_SESSION['last_applicant_id'] = 120;
    $applicantName = $_SESSION['client_name'] = "Terrance";*/
    
/*if (isset($_POST['save'])) {

    // Sanitize input data
    $spouseName = htmlspecialchars(trim($_POST['spouseFullName']), ENT_QUOTES, 'UTF-8');

    // Check if spouse name is empty
    if (!empty($spouseName)) {
        $spouseType = htmlspecialchars(trim($_POST['relationship']), ENT_QUOTES, 'UTF-8');
        $spouseDob = htmlspecialchars(trim($_POST['spouseDOB']), ENT_QUOTES, 'UTF-8');
        $maritalStatus = htmlspecialchars(trim($_POST['maritalStatus']), ENT_QUOTES, 'UTF-8');
        $spouseContact = htmlspecialchars(trim($_POST['spouseContactNumber']), ENT_QUOTES, 'UTF-8');
        $spouseNIC = htmlspecialchars(trim($_POST['spouseNIC']), ENT_QUOTES, 'UTF-8');

        // Prepare the SQL statement
        $sqlSpouse = "INSERT INTO `spouce_details`
        (`spoceClientId`, `SpouceName`, `SpouceType`, `maritalStatus`, `spouceContact`, `spouceNic`, `spouceDob`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmtSpouse = $conn->prepare($sqlSpouse);
        $stmtSpouse->bind_param("issssss", $applicantId1, $spouseName, $spouseType, $maritalStatus, $spouseContact, $spouseNIC, $spouseDob);

        // Execute the statement
        if ($stmtSpouse->execute()) {
            // Redirect to home page on success
            $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname'];
            $spouseId = $stmtSpouse->insert_id;

            // Handle file uploads for spouse NIC front and back
            if (!empty($_FILES['spoucenicfront']['tmp_name'])) {
                $frontTmpName = $_FILES['spoucenicfront']['tmp_name'];
                $frontOriginalFileName = basename($_FILES['spoucenicfront']['name']);
                $frontFileExtension = pathinfo($frontOriginalFileName, PATHINFO_EXTENSION);
                $filesourceType = "SpouseNICFront";

                $newFrontFileName = 'nic-front-' . strtolower(str_replace(' ', '-', $spouseName)) . '-' . $spouseId . '.' . $frontFileExtension;
                uploadFile($conn, $frontTmpName, $newFrontFileName, $spouseId, $filesourceType, $applicantId1);
            }

            if (!empty($_FILES['spoucenicback']['tmp_name'])) {
                $backTmpName = $_FILES['spoucenicback']['tmp_name'];
                $backOriginalFileName = basename($_FILES['spoucenicback']['name']);
                $backFileExtension = pathinfo($backOriginalFileName, PATHINFO_EXTENSION);
                $filesourceType = "SpouseNICBack";

                $newBackFileName = 'nic-back-' . strtolower(str_replace(' ', '-', $spouseName)) . '-' . $spouseId . '.' . $backFileExtension;
                uploadFile($conn, $backTmpName, $newBackFileName, $spouseId, $filesourceType, $applicantId1);
            }

            
            
            
        } else {
            // Handle error
            echo "Error: " . $stmtSpouse->error;
        }
    } header("Location: ../view_all_applications.php");
}*/




if (isset($_POST['save'])) {

    // Sanitize input data
    $spouseName = htmlspecialchars(trim($_POST['spouseFullName']), ENT_QUOTES, 'UTF-8');

    if (!empty($spouseName)) {
        $spouseType = htmlspecialchars(trim($_POST['relationship']), ENT_QUOTES, 'UTF-8');
        $spouseDob = htmlspecialchars(trim($_POST['spouseDOB']), ENT_QUOTES, 'UTF-8');
        $maritalStatus = htmlspecialchars(trim($_POST['maritalStatus']), ENT_QUOTES, 'UTF-8');
        $spouseContact = htmlspecialchars(trim($_POST['spouseContactNumber']), ENT_QUOTES, 'UTF-8');
        $spouseNIC = htmlspecialchars(trim($_POST['spouseNIC']), ENT_QUOTES, 'UTF-8');

        // Insert spouse details into `spouce_details` table
        $sqlSpouse = "INSERT INTO `spouce_details`
        (`spoceClientId`, `SpouceName`, `SpouceType`, `maritalStatus`, `spouceContact`, `spouceNic`, `spouceDob`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtSpouse = $conn->prepare($sqlSpouse);
        $stmtSpouse->bind_param("issssss", $applicantId1, $spouseName, $spouseType, $maritalStatus, $spouseContact, $spouseNIC, $spouseDob);

        if ($stmtSpouse->execute()) {
            $spouseId = $stmtSpouse->insert_id; // Get the newly inserted spouse ID
            $applicantId1 = $_SESSION['last_applicant_id'];
            $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
            $applicantLname = $_SESSION['applicantLname'];
            // Handle NIC front file upload
            if (!empty($_FILES['spoucenicfront']['tmp_name'])) {
                $newFrontFileName = 'nic-front-' . $spouseId . '.' . pathinfo($_FILES['spoucenicfront']['name'], PATHINFO_EXTENSION);
                uploadspouceFile($conn, $_FILES['spoucenicfront']['tmp_name'], $newFrontFileName, $spouseId, "SpouseNICFront", $applicantId1);
            }

            // Handle NIC back file upload
            if (!empty($_FILES['spoucenicback']['tmp_name'])) {
                $newBackFileName = 'nic-back-' . $spouseId . '.' . pathinfo($_FILES['spoucenicback']['name'], PATHINFO_EXTENSION);
                uploadspouceFile($conn, $_FILES['spoucenicback']['tmp_name'], $newBackFileName, $spouseId, "SpouseNICBack", $applicantId1);
            }

            // Redirect to success page or handle success
            header("Location: ../view_all_applications.php");
            

        } else {
            echo "Error inserting spouse: " . $stmtSpouse->error;
        }
    }
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadspouceFile($conn, $fileTmpName, $fileName, $sourceId, $filesourceType, $clientId) {
    $uploadDir = "../../uploads/spouse_documents/"; // Ensure directory exists
    $filePath = $uploadDir . $fileName;

    // Check for file upload errors
    if ($_FILES['spoucenicfront']['error'] !== UPLOAD_ERR_OK) {
        error_log("File upload error: " . $_FILES['spoucenicfront']['error']);
        return false;
    }

    // Ensure the upload directory exists and is writable
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            error_log("Failed to create directory: " . $uploadDir);
            return false;
        }
    }

    // Move the uploaded file to the designated directory
    if (move_uploaded_file($fileTmpName, $filePath)) {
        // Prepare the SQL statement to insert into the attachments table
        $stmtAttachment = $conn->prepare("INSERT INTO attachemnts_data 
            (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
            VALUES (?, ?, ?, ?, ?)");

        if ($stmtAttachment) {
            $stmtAttachment->bind_param("iisss", $clientId, $sourceId, $filesourceType, $filePath, $fileName);
            if (!$stmtAttachment->execute()) {
                error_log("Error executing attachment insert: " . $stmtAttachment->error);
                return false;
            }
            $stmtAttachment->close();
        } else {
            error_log("Error preparing attachment SQL: " . $conn->error);
            return false;
        }
    } else {
        error_log("Failed to move uploaded file: " . $fileTmpName);
        return false;
    }

    return true;
}