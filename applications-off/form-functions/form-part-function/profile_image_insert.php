<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
    $applicantLname = $_SESSION['applicantLname'];
    
}
// Assume this is the form processing logic when the user clicks "Save" or "Finish"
//$applicantId1 = $_SESSION['last_applicant_id'] = 123;
//$applicantName = $_SESSION['client_name'] = "Terrance";

if (isset($_POST['save']) || isset($_POST['finish'])) {
    $profileImagePath = '';

    // Check if a camera photo was captured (base64 data)
    if (!empty($_POST['capturedPhoto'])) {
        $base64Image = $_POST['capturedPhoto'];
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $uploadDir = "../../uploads/profile_images/";
        $newFileName = 'profile-' . time() . '.png';
        $uploadFilePath = $uploadDir . $newFileName;

        // Ensure the directory exists, if not create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Save the image to the file system and log success/failure
        if (file_put_contents($uploadFilePath, $imageData)) {
            $profileImagePath = $uploadFilePath;
        }
    }
    // If no camera photo, then check if a file was uploaded via file input
    elseif (!empty($_FILES['profileImage']['tmp_name'])) {
        $uploadDir = "../../uploads/profile_images/";
        $fileName = basename($_FILES['profileImage']['name']);
        $fileTmpName = $_FILES['profileImage']['tmp_name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = 'profile-' . time() . '.' . $fileExtension;
        $uploadFilePath = $uploadDir . $newFileName;

        // Ensure the directory exists, if not create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
            $profileImagePath = $newFileName;
        }
    }
    // If neither file was uploaded nor camera photo was captured, use the fallback image
    else {
        $profileImagePath = '../../uploads/img/fallback-image.png';
    }

    // Update the profile image in the database
    $sql = "UPDATE applications SET profile_image = ? WHERE applicationID = ?";
    $stmt = $conn->prepare($sql);

    // Bind the profile image path and user ID
    $stmt->bind_param("si", $profileImagePath, $applicantId1);

    if ($stmt->execute()) {
        // If "Finish" was clicked, redirect to main page
        if (isset($_POST['finish'])) {
            header("Location: ../view_all_applications.php");
        } else {
            // If "Save" was clicked, remain on the current page and repopulate the form fields
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            // Repopulate other fields as needed
            header("Location: ../client_registration.php");
            // Optionally, reload the page to reflect saved data
            // header("Refresh:0");
        }
    } else {
        echo "Error updating profile image: " . $stmt->error;
    }
}

