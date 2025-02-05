<?php
// get_job_orders.php

include('../../includes/db_config.php'); // Include your DB connection


if (isset($_POST['fagentId'])) {
    $sponsorId = $_POST['fagentId'];
    
    // Fetch job orders for the selected sponsor
    $query = "SELECT JobOrderId FROM job_orders WHERE AgentID = '$sponsorId'";
    $result = mysqli_query($conn, $query);
    
    echo '<option>Select Job Order</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['JobOrderId'] . '">' . $row['JobOrderId'] . '</option>';
    }
}
?>
