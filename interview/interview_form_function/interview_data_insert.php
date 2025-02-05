<?php
include('../../includes/db_config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert personal data into agentdetails
    $applicationId = $_POST['applicationNumber'];
    $appearance = $_POST['appearance'];
    $communications = $_POST['communications'];
    $confidence = $_POST['confidence'];
    $experience = $_POST['experience'];
    $attitude = $_POST['attitude'];
    $read = $_POST['read'];
    $understand = $_POST['understand'];
    $speak = $_POST['speak'];
    $status = $_POST['status'];
    $evaluatedBy =$_POST['evaluatedBy'];
    $date=date("Y-m-d");

    // Insert into foreign_agent_details table
    $sql = "INSERT INTO `interviews_details` (`application_id`, `appearance`, `communications`, `confidence`, `experience`, `attitude`, `read`, `understand`, `speak`, `status`,`evaluatedBy`,`register_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssssss", $applicationId, $appearance, $communications, $confidence, $experience, $attitude, $read, $understand, $speak, $status,$evaluatedBy,$date);

    if (!$stmt->execute()) {
        echo "Error inserting agent details: " . $stmt->error;
        exit;
    }

    $agent_id = $stmt->insert_id;

$sql = "SELECT * FROM contract_details  WHERE applicationID=$applicationId";
$res = mysqli_query($conn,$sql);
if($row = mysqli_fetch_assoc($res)){

    $contract_id=$row["contractId"];
    $sql = "UPDATE contract_details 
            SET interviewStatus='$status'
            WHERE contractId='$contract_id'";

    if ($conn->query($sql) === TRUE) {
        // If the update was successful
        header("Location: http://localhost/projects/PHPNation/interview/view_all_interviews.php");
        // Handle file upload

    } else {
        echo "Error updating Enjaz details: " . $conn->error;
    }
}

    // Get the last inserted ID for the agent to use in the other tables


    $stmt->close();


    // Redirect or show success message
    header("Location: http://localhost/projects/PHPNation/interview/view_all_interviews.php");
    exit;
}
?>
