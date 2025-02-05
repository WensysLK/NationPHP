<?php
include '../../includes/db_config.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the form data
    $lead_id = $_POST['lead_id'];
    $name = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $nic = $_POST['nic'];
    $passport = $_POST['passport'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $source = $_POST['source'];
//    $status = $_POST['status'];

    // Prepare the SQL query to update the lead
    $sql = "UPDATE leads SET name = ?,lname=?,nic=?,passportNumber=?, email = ?, phone = ?, source = ? WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters
        $stmt->bind_param('sssssssi', $name,$lastname,$nic,$passport, $email, $phone, $source, $lead_id);

        // Execute the query
        if ($stmt->execute()) {
//            var_dump($stmt->execute());die();
            // Redirect back to the leads page with success message
            header('Location: ../view_all_leads.php?update=success');
        } else {
            // Handle the error
            echo "Error updating lead: " . $conn->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle preparation error
        echo "Error preparing the query: " . $conn->error;
    }
}

// Close the database connection
$conn->close();