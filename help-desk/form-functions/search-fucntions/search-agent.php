<?php 

/* File which search sub agent details from database to fill the form */
include('../../../includes/db_config.php');

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Prepare the SQL query to search sub-agents by name, NIC, or phone
    $stmt = $conn->prepare("SELECT applicationID, applicantTitle, applicatFname, applicantMname, applicantLname, applicantPassno,applicantNICno FROM applications WHERE applicantPassno LIKE ? ");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();

    $result = $stmt->get_result();
    $subAgents = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subAgents[] = [
                'id' => $row['applicationID'], // Correct field name from SQL query
                'name' => $row['applicantTitle'] . ' ' . $row['applicatFname'] .' '.$row['applicantMname'].' '.$row['applicantLname'], // Combine first and last name for full name
                'nic' => $row['applicantNICno'],
                'passportNumber' => $row['applicantPassno']// Correct field name from SQL query
            ];
        }
    }

    // Return the results as JSON
    echo json_encode($subAgents);
}