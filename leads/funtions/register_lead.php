<?php
include('../../includes/db_config.php');

// Start output buffering
ob_start();

// Check if the form was submitted
if (isset($_POST['saveContinue'])) {
    // Capture form data
    $applicantTitle = $_POST['name-title'];
    $applicantFname = $_POST['Cfname'];
    $applicantMname = $_POST['cmname'];
    $applicantLname = $_POST['clname'];
    $applicantDob = $_POST['dateofbirth'];
    $passportNumber = $_POST['passportNumber'];
    $nicNumber = $_POST['nicNumber'];
    $leadId = $_POST['lead_id'];
    $source = $_POST['sourcelead'];

    // Prepare SQL query for insertion
    $insertQuery = "INSERT INTO Applications (applicantTitle, applicatFname, applicantMname, applicantLname, applicantDob, applicantPassno, applicantNICno, how_foun_us, leadId)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($insertQuery)) {
        // Bind parameters and execute the insert query
        $stmt->bind_param("ssssssssi", $applicantTitle, $applicantFname, $applicantMname, $applicantLname, $applicantDob, $passportNumber, $nicNumber, $source, $leadId);
        
        if ($stmt->execute()) {
            // Check if the insert was successful using affected_rows
            if ($conn->affected_rows > 0) {
                // Update the lead status to "registered"
                $updateQuery = "UPDATE leads SET status = 'registered' WHERE id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("i", $leadId);
                $updateStmt->execute();

                // Redirect to the next page
                header("Location: ../view_all_leads.php");
                exit();
            } else {
                echo "Error: Unable to insert application data.";
            }
        } else {
            echo "Error: Execution failed - " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the insert statement - " . $conn->error;
    }
}

// End output buffering and send output
ob_end_flush();
?>
