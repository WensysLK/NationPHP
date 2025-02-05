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

if (isset($_POST['save'])) {
    // Retrieve and sanitize license data
    $licenseTypes = $_POST['licensetype'];
    $countries = $_POST['licensecountry'];
    $documentType = $_POST['licensecopy'];
    $licenseExpiry = $_POST['licenseexpirey'];

    // If no license types are provided or if the first license type is empty, stop processing
    if (empty($licenseTypes) || empty($licenseTypes[0])) {
        echo "License type is required.";
        
    }

    // Insert license details only if license type is not empty
    $sqldriving = "INSERT INTO 
    `driving_license_deatils`
    (`LicneseClinetId`, 
    `License_Type`, `document_Type`, 
    `License_Country`, `License_Expiry`) VALUES 
    (?,?,?,?,?)";

   
    $stmtdriving = $conn->prepare($sqldriving);

    if ($stmtdriving === false) {
        die("Prepare failed: " . $conn->error);
    }

    foreach ($licenseTypes as $index => $type) {
        if (!empty($type)) {  // Check if the license type is not empty
            $country = $countries[$index];
            $docType = $documentType[$index];
            $expiry = $licenseExpiry[$index];

            $stmtdriving->bind_param("issss", $applicantId1, $type, $docType, $country, $expiry);

            if ($stmtdriving->execute()) {
                $licenseId = $stmtdriving->insert_id; // Get the ID of the inserted license record

                // Handle file uploads for attachments
                if (!empty($_FILES['licensefileattach']['tmp_name'][$index])) {
                    $fileTmpName = $_FILES['licensefileattach']['tmp_name'][$index];
                    $fileName = basename($_FILES['licensefileattach']['name'][$index]);
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Create a new file name using the license ID
                    $newFileName = 'license-' . $licenseId . '.' . $fileExtension;

                    // Call the function to handle file uploads and insert into the attachments table
                    uploadAndSavelicenseAttachment($conn, $fileTmpName, 'Driving_License', "../../uploads/licenses/", $applicantId1, $licenseId,$newFileName );
                }
            } else {
                echo "Error inserting driving license details: " . $stmtdriving->error;
            }
        }
    }

    

    // Redirect or handle success
    header("Location: ../view_all_applications.php");
    
}

/**
 * Function to handle file upload and insert into attachments table.
 */
function uploadAndSavelicenseAttachment($conn, $fileTmpName, $fileName, $uploadDir, $clientId, $sourceId, $attachmentType) {
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
            (attachemnet_ClientID, attachmentsourceId, attachFilename, attachemnt, attachmentType) 
            VALUES (?, ?, ?, ?, ?)");

        // Check if the statement was prepared successfully
        if ($stmtattachment) {
            $stmtattachment->bind_param("iisss", $clientId, $sourceId, $attachmentType, $filePath, $fileName);
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