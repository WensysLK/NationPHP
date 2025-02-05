<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname'];
    
    // Use $applicantId for further processing

    // Optionally, unset the session variable if no longer neede 
    } 
//$applicantId1 = $_SESSION['last_applicant_id'] = 120;
//$applicantName = $_SESSION['client_name'] = "Terrance";

    
if(isset($_POST['save'])){

    // Sanitize input data
    
    $guardianName = htmlspecialchars(trim($_POST['guardianName']), ENT_QUOTES, 'UTF-8');

    if(!empty($guardianName)){

        $guardianContact = htmlspecialchars(trim($_POST['guardianContact']), ENT_QUOTES, 'UTF-8');
        $guardiaType = htmlspecialchars(trim($_POST['guardianRelationship']), ENT_QUOTES, 'UTF-8');
        $GuardianDob = htmlspecialchars(trim($_POST['guardiandob']), ENT_QUOTES, 'UTF-8');
        $GuardianNic = htmlspecialchars(trim($_POST['guardianNIC']), ENT_QUOTES, 'UTF-8');
        
        // Prepare the SQL statement
    $sqlguardian = "INSERT INTO `guardian_details`
    (`GuardianClient`, `GuardianName`, 
    `GuardianContact`, `GuardianType`, 
    `GuardianDob`, `GuargdianNic`) 
    VALUES (?,?,?,?,?,?)";

    // Prepare and bind
    $stmtguardian = $conn->prepare($sqlguardian);
    $stmtguardian->bind_param("isssss", 
    $applicantId1, $guardianName, $guardianContact,$guardiaType,
    $GuardianDob, $GuardianNic);

    // Execute the statement
    if ($stmtguardian->execute()) {

        $guardianID = $stmtguardian->insert_id;

        if (!empty($_FILES['guardiannicfront']['tmp_name'])) {
            $GuardianFrontTmpName = $_FILES['guardiannicfront']['tmp_name'];
            $GuardianFrontFileName = basename($_FILES['guardiannicfront']['name']);
            $GuardianFrontExtension = pathinfo($GuardianFrontFileName, PATHINFO_EXTENSION);
            $GuardiansourceType = "GuardianNIC-front";

            $newGFrontFileName = 'GuardianNIC-front-' . strtolower(str_replace(' ', '-', $guardianName)) . '-' . $guardianID . '.' . $GuardianFrontExtension;
            uploadFileguardian($conn, $GuardianFrontTmpName, $GuardianFrontFileName, $guardianID, $GuardiansourceType, $applicantId1);
        }

        if (!empty($_FILES['guardiannicback']['tmp_name'])) {
            $GuardianbackTmpName = $_FILES['guardiannicback']['tmp_name'];
            $GuardianbackFileName = basename($_FILES['guardiannicback']['name']);
            $GuardianbackExtension = pathinfo($GuardianbackFileName, PATHINFO_EXTENSION);
            $GuardianBsourceType = "GuardianNIC-Back";

            $GuardianBackType = 'GuardianNIC-Back' . strtolower(str_replace(' ', '-', $guardianName)) . '-' . $guardianID . '.' . $GuardianbackExtension;
            uploadFileguardian($conn, $GuardianbackTmpName, $GuardianbackFileName, $guardianID, $GuardianBsourceType, $applicantId1);
        }

        if (!empty($_FILES['guardianletter']['tmp_name'])) {
            $fbrTmpName = $_FILES['guardianletter']['tmp_name'];
            $fbrOriginalFileName = basename($_FILES['guardianletter']['name']);
            $fbrFileExtension = pathinfo($fbrOriginalFileName, PATHINFO_EXTENSION);
            $fbrsourceType = "FB-Letter";

            $newfbrFileName = 'FB-Letter' . strtolower(str_replace(' ', '-', $guardianName)) . '-' . $guardianID . '.' . $fbrFileExtension;
            uploadFileguardian($conn, $fbrTmpName, $newfbrFileName, $guardianID, $fbrsourceType, $applicantId1);
        }

      
        // Redirect to home page on success
        header("Location: ../view_all_applications.php");
  
    }

    }else {
        // Handle error
        echo "Error: " . $stmtguardian->error;
    }

    
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadFileguardian($conn, $fileTmpName, $fileName, $sourceId, $filesourceType, $clientId) {
    $uploadDir = "../../uploads/guardian_Documents/"; // Ensure directory exists
    $filePath = $uploadDir . $fileName;

    // Ensure the upload directory exists
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Failed to create directory: " . $uploadDir);
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
            $stmtAttachment->execute();
            $stmtAttachment->close();
        } else {
            die("Failed to prepare SQL statement: " . $conn->error);
        }
    } else {
        die("Failed to upload file: " . $fileTmpName);
    }
}
?>