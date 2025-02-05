<?php
include('../../../../includes/db_config.php');

if (isset($_POST['submit'])) {
    $licenseId = $_POST['license_id'];
    $licenseType = $_POST['license_type'];
    $clientId = $_POST['client_id'];
    $documentType = $_POST['document_type'];
    $country = $_POST['country'];
    $expiryDate = $_POST['expiry_date'];

    // Check for file upload
    $attachment = isset($_FILES['attachment']) ? $_FILES['attachment'] : null;

    // Call the update function
    updateDrivingLicenseWithAttachment($conn, $licenseId, $clientId, $licenseType, $documentType, $country, $expiryDate, $attachment);
}


/**
 * Updates driving license details in the database and handles file uploads for attachments.
 * 
 * @param mysqli $conn Database connection
 * @param int $licenseId ID of the driving license to update
 * @param int $clientId ID of the applicant/client
 * @param string $licenseType License type
 * @param string $documentType Document type (Original/Copy)
 * @param string $country Country of license
 * @param string $expiryDate Expiry date of license
 * @param array|null $attachment File upload information (if any)
 */
function updateDrivingLicenseWithAttachment($conn, $licenseId, $clientId, $licenseType, $documentType, $country, $expiryDate, $attachment = null) {
    // Prepare SQL statement to update driving license details
    $sql = "UPDATE driving_license_deatils 
            SET License_Type = ?, document_Type = ?, License_Country = ?, License_Expiry = ? 
            WHERE LicenseId = ? AND LicneseClinetId = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssii", $licenseType, $documentType, $country, $expiryDate, $licenseId, $clientId);
  
    if ($stmt->execute() === false) {
        echo "Error updating license details: " . $stmt->error;
    } else {
        echo "License details updated successfully.";
        echo "Affected rows: " . $stmt->affected_rows;
    }

    // Handle new file attachment if provided
    if ($attachment && isset($attachment['tmp_name']) && $attachment['error'] === UPLOAD_ERR_OK) {
        $fileTmpName = $attachment['tmp_name'];
        $fileName = basename($attachment['name']);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Create a unique file name for the new attachment
        $newFileName = 'license-' . $licenseId . '.' . $fileExtension;
        $uploadDir = "../../uploads/licenses/";
        $filePath = $uploadDir . $newFileName;

        // Ensure the upload directory exists
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
            die("Failed to create directory: " . $uploadDir);
        }

        // Move uploaded file to the specified directory
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // Insert the new attachment into attachments_data table without soft-deleting any existing ones
            $insertAttachmentSql = "INSERT INTO attachments_data (attachemnet_ClientID, attachmentsourceId, attachmentType, attachemnt, attachFilename) 
                                    VALUES (?, ?, ?, ?, ?)";
            $stmtAttachment = $conn->prepare($insertAttachmentSql);
            if ($stmtAttachment) {
                $attachmentType = 'Driving_License';
                $stmtAttachment->bind_param("iisss", $clientId, $licenseId, $attachmentType, $filePath, $newFileName);
                if (!$stmtAttachment->execute()) {
                    echo "Error inserting new attachment: " . $stmtAttachment->error;
                }
                $stmtAttachment->close();
            } else {
                die("Failed to prepare attachment insertion: " . $conn->error);
            }
        } else {
            die("Failed to upload file: " . $fileTmpName);
        }
    }

    // Redirect to the profile edit page
    header("Location: http://localhost/nationscrm/applications/profile-view/application-profile-edit.php?client_id=" . urlencode($clientId));
    exit;

    // Close the statement
    $stmt->close();
}
?>
