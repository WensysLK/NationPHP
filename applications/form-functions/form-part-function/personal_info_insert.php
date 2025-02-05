<?php

// Ensure the session is started

if (isset($_POST['save'])) {

    // Sanitize and retrieve form data
    $applicantTItile = htmlspecialchars(trim($_POST['name-title']), ENT_QUOTES, 'UTF-8');
    $applicantFname = htmlspecialchars(trim($_POST['Cfname']), ENT_QUOTES, 'UTF-8');
    $applicantMname = htmlspecialchars(trim($_POST['cmname']), ENT_QUOTES, 'UTF-8');
    $applicantLname = htmlspecialchars(trim($_POST['clname']), ENT_QUOTES, 'UTF-8');
    $passportNumner = htmlspecialchars(trim($_POST['cpassport']), ENT_QUOTES, 'UTF-8');
    $nicNumber = htmlspecialchars(trim($_POST['nicnumber']), ENT_QUOTES, 'UTF-8');
    $appheight = htmlspecialchars(trim($_POST['height']), ENT_QUOTES, 'UTF-8');
    $appweight = htmlspecialchars(trim($_POST['weight']), ENT_QUOTES, 'UTF-8');
    $appGnder = htmlspecialchars(trim($_POST['gender']), ENT_QUOTES, 'UTF-8');
    $appReligion = htmlspecialchars(trim($_POST['Religion']), ENT_QUOTES, 'UTF-8');
    $appRase = htmlspecialchars(trim($_POST['rase']), ENT_QUOTES, 'UTF-8');
    $appNationality = htmlspecialchars(trim($_POST['nationality']), ENT_QUOTES, 'UTF-8');
    $passportIssuedate = htmlspecialchars(trim($_POST['cpassportdate']), ENT_QUOTES, 'UTF-8');
    $appMeritalStatus = htmlspecialchars(trim($_POST['maritalstatus']), ENT_QUOTES, 'UTF-8');
    $appFilenumber = htmlspecialchars(trim($_POST['cffileno']), ENT_QUOTES, 'UTF-8');
    $howFoundus = htmlspecialchars(trim($_POST['findUs']), ENT_QUOTES, 'UTF-8');
    $subAgentID = htmlspecialchars(trim($_POST['subAgentId']), ENT_QUOTES, 'UTF-8');
    $applicntBirth = htmlspecialchars(trim($_POST['dateofbirth']), ENT_QUOTES, 'UTF-8');
    $applicantStatus = "Completed";


if ($subAgentID){
    $subagentId=$subagentId;
}else{
    $subagentId=1;
}

    // Prepare SQL statement for inserting personal information
    $sqlpersonalinfo = "INSERT INTO applications (
        applicantTitle, applicatFname, applicantMname, applicantLname, applicantDob, 
        applicantPassno, applicantNICno, applicantPassdate, applicantNationality, applicanthight, 
        applicantWeight, applicantGender, appReligion, appRase, 
        maritalestatus, how_foun_us, applicantStatus
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?)";



    // Prepare and bind parameters
    $stmt = $conn->prepare($sqlpersonalinfo);
    $stmt->bind_param("sssssssssssssssss",
        $applicantTItile, $applicantFname, $applicantMname, $applicantLname, $applicntBirth, 
        $passportNumner, $nicNumber, $passportIssuedate, $appNationality, $appheight, 
        $appweight, $appGnder, $appReligion, $appRase,  
        $appMeritalStatus, $howFoundus, $applicantStatus
    );
//    var_dump($stmt->execute());die();
    // Execute statement
    if ($stmt->execute()) {
        // Store last inserted applicant ID in session
        $last_person_id = $conn->insert_id;

        if ($last_person_id > 0) {
            $_SESSION['last_applicant_id'] = $last_person_id; // Save the ID in the session
            
            // Handle file uploads (NIC front, NIC back, passport, full photo)
            uploadFileapplicant($conn, $_FILES['clientNicFront'], "Client_NIC_front", $applicantFname, $last_person_id);
            uploadFileapplicant($conn, $_FILES['clientNicBack'], "Client_NIC_Back", $applicantFname, $last_person_id);
            uploadFileapplicant($conn, $_FILES['clientpassportCopy1'], "Cleint_Passport", $applicantFname, $last_person_id);
            uploadFileapplicant($conn, $_FILES['clinetfullphoto'], "Client_Full_Photo", $applicantFname, $last_person_id);
        } else {
            throw new Exception('Error: No personal ID generated after insert.');
        }
    } else {
        // Output detailed error message
        echo "Error inserting personal information: " . $stmt->error;
    }

    $stmt->close(); // Don't forget to close the statement
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadFileapplicant($conn, $file, $fileSourceType, $applicantFname, $last_person_id) {
    if (!empty($file['tmp_name'])) {
        $fileTmpName = $file['tmp_name'];
        $fileName = basename($file['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Create new file name based on applicant's name and ID
        $newFileName = $fileSourceType . '-' . strtolower(str_replace(' ', '-', $applicantFname)) . '-' . $last_person_id . '.' . $fileExtension;

        // Set upload directory
        $uploadDir = "../../uploads/applicant_data/";

        // Ensure upload directory exists
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                die("Failed to create directory: " . $uploadDir);
            }
        }

        // Full file path
        $filePath = $uploadDir . $newFileName;

        // Move uploaded file
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Insert into the attachments table
            $stmtAttachment = $conn->prepare("INSERT INTO attachemnts_data 
                (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
                VALUES (?, ?, ?, ?, ?)");

            $stmtAttachment->bind_param("iisss", $last_person_id, $last_person_id, $fileSourceType, $filePath, $newFileName);
            $stmtAttachment->execute();
            $stmtAttachment->close();
        } else {
            die("Failed to upload file: " . $file['tmp_name']);
        }
    }
}

