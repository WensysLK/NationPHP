<?php 

/* File which search sub agent details from database to fill the form */
include('../../../includes/db_config.php');

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Prepare the SQL query to search sub-agents by name, NIC, or phone
    $stmt = $conn->prepare("SELECT localagentId, Local_Agent_Title, Local_Agent_Fname, Local_Agent_Lname, Local_Agent_Nic, Local_Agent_Phone FROM local_agent_details WHERE Local_Agent_Fname LIKE ? OR Local_Agent_Nic LIKE ? OR Local_Agent_Phone LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();

    $result = $stmt->get_result();
    $subAgents = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subAgents[] = [
                'id' => $row['localagentId'], // Correct field name from SQL query
                'name' => $row['Local_Agent_Fname'] . ' ' . $row['Local_Agent_Lname'], // Combine first and last name for full name
                'nic' => $row['Local_Agent_Nic'] // Correct field name from SQL query
            ];
        }
    }

    // Return the results as JSON
    echo json_encode($subAgents);
}