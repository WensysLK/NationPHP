<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
        $applicantLname = $_SESSION['applicantLname'];
    $applicantName = $_SESSION['client_name'] = $applicantFname . ' ' . $applicantLname;
    
    // Use $applicantId for further processing

    // Optionally, unset the session variable if no longer neede 
    } 
    //$applicantId1 = $_SESSION['last_applicant_id'] = 120;
    //$applicantName = $_SESSION['client_name'] = "Terrance";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Father details
        $fatherName = htmlspecialchars(trim($_POST['fatherName']), ENT_QUOTES, 'UTF-8');
        $fatherDOB = htmlspecialchars(trim($_POST['fatherDOB']), ENT_QUOTES, 'UTF-8');
        $fatherContact = htmlspecialchars(trim($_POST['fatherContactNumber']), ENT_QUOTES, 'UTF-8');
        $fatherNIC = htmlspecialchars(trim($_POST['fatherNIC']), ENT_QUOTES, 'UTF-8');
        $parentType = 'Father';
    
        if (!empty($fatherName)) {
            // Insert father details into the database
            $sqlFather = "INSERT INTO parents_details 
            (ParentClientID, parentname, 
            parentcontact, parentNic, 
            parentDob, parent_Type) VALUES (?, ?, ?, ?, ?,?)";
            $stmtFather = $conn->prepare($sqlFather);
            $stmtFather->bind_param("isssss", $applicantId1, $fatherName, $fatherContact, $fatherNIC, $fatherDOB ,$parentType);
    
            if ($stmtFather->execute()) {
                $fatherId = $stmtFather->insert_id;
                $_SESSION['last_applicant_id'] = $applicantId1;
            $_SESSION['applicantFname'] = $applicantFname; // Ensure these values are already set or retrieved earlier
            $_SESSION['applicantLname'] = $applicantLname;
    
                // Handle file uploads for father's NIC front and back
                if (!empty($_FILES['fatherNICfrontcopy']['tmp_name'])) {
                    $frontTmpName = $_FILES['fatherNICfrontcopy']['tmp_name'];
                    $frontOriginalFileName = basename($_FILES['fatherNICfrontcopy']['name']);
                    $frontFileExtension = pathinfo($frontOriginalFileName, PATHINFO_EXTENSION);
                    $fileSourceType = "FatherNICFront";
    
                    $newFrontFileName = 'nic-front-father-' . strtolower(str_replace(' ', '-', $fatherName)) . '-' . $fatherId . '.' . $frontFileExtension;
                    uploadParentFile($conn, $frontTmpName, $newFrontFileName, $fatherId, $fileSourceType, $applicantId1);
                }
    
                if (!empty($_FILES['fatherNICbackcopy']['tmp_name'])) {
                    $backTmpName = $_FILES['fatherNICbackcopy']['tmp_name'];
                    $backOriginalFileName = basename($_FILES['fatherNICbackcopy']['name']);
                    $backFileExtension = pathinfo($backOriginalFileName, PATHINFO_EXTENSION);
                    $fileSourceType = "FatherNICBack";
    
                    $newBackFileName = 'nic-back-father-' . strtolower(str_replace(' ', '-', $fatherName)) . '-' . $fatherId . '.' . $backFileExtension;
                    uploadParentFile($conn, $backTmpName, $newBackFileName, $fatherId, $fileSourceType, $applicantId1);
                }
            } else {
                echo "Error: " . $stmtFather->error;
            }
        }
    
        // Mother details
        $motherName = htmlspecialchars(trim($_POST['MothertName']), ENT_QUOTES, 'UTF-8');
        $motherDOB = htmlspecialchars(trim($_POST['motherDOB']), ENT_QUOTES, 'UTF-8');
        $motherContact = htmlspecialchars(trim($_POST['motherContactNumber']), ENT_QUOTES, 'UTF-8');
        $motherNIC = htmlspecialchars(trim($_POST['motherNIC']), ENT_QUOTES, 'UTF-8');
        $parentType = 'Mother';
    
        if (!empty($motherName)) {
            // Insert mother details into the database
            $sqlMother = "INSERT INTO parents_details 
            (ParentClientID, parentname, 
            parentcontact, parentNic, 
            parentDob, parent_Type) VALUES (?, ?, ?, ?, ?,?)";
            $stmtMother = $conn->prepare($sqlMother);
            $stmtMother->bind_param("isssss", $applicantId1, $motherName, $motherContact, $motherNIC,$motherDOB, $parentType);
    
            if ($stmtMother->execute()) {
                $motherId = $stmtMother->insert_id;
                $_SESSION['last_applicant_id'] = $applicantId1;
            $_SESSION['applicantFname'] = $applicantFname; // Ensure these values are already set or retrieved earlier
            $_SESSION['applicantLname'] = $applicantLname;
                
    
                // Handle file uploads for mother's NIC front and back
                if (!empty($_FILES['motherNICfrontcopy']['tmp_name'])) {
                    $frontTmpName = $_FILES['motherNICfrontcopy']['tmp_name'];
                    $frontOriginalFileName = basename($_FILES['motherNICfrontcopy']['name']);
                    $frontFileExtension = pathinfo($frontOriginalFileName, PATHINFO_EXTENSION);
                    $fileSourceType = "MotherNICFront";
    
                    $newFrontFileName = 'nic-front-mother-' . strtolower(str_replace(' ', '-', $motherName)) . '-' . $motherId . '.' . $frontFileExtension;
                    uploadParentFile($conn, $frontTmpName, $newFrontFileName, $motherId, $fileSourceType, $applicantId1);
                }
    
                if (!empty($_FILES['motherNICbackcopy']['tmp_name'])) {
                    $backTmpName = $_FILES['motherNICbackcopy']['tmp_name'];
                    $backOriginalFileName = basename($_FILES['motherNICbackcopy']['name']);
                    $backFileExtension = pathinfo($backOriginalFileName, PATHINFO_EXTENSION);
                    $fileSourceType = "MotherNICBack";
    
                    $newBackFileName = 'nic-back-mother-' . strtolower(str_replace(' ', '-', $motherName)) . '-' . $motherId . '.' . $backFileExtension;
                    uploadParentFile($conn, $backTmpName, $newBackFileName, $motherId, $fileSourceType, $applicantId1);
                }
            } else {
                echo "Error: " . $stmtMother->error;
            }
        }
    
        // Redirect after processing
        
        header("Location: ../view_all_applications.php");
        
    }
    
    /**
     * Function to handle file upload and insert into attachments table.
     */
    function uploadParentFile($conn, $fileTmpName, $fileName, $sourceId, $fileSourceType, $clientId) {
        $uploadDir = "../../uploads/parent_documents/"; // Ensure directory exists
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
                (attachemnet_ClientID,attachmentsourceId, attachmentType, attachemnt, attachFilename) 
                VALUES (?, ?, ?, ?, ?)");
    
            if ($stmtAttachment) {
                $stmtAttachment->bind_param("iisss", $clientId, $sourceId, $fileSourceType, $filePath, $fileName);
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