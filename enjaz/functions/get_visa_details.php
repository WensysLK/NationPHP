<?php

include('../../includes/db_config.php');


if(isset($_POST['joborderID'])) {
    $fAgentID = $_POST['joborderID'];

    // Query to fetch visa details based on fAgentID
    $sqlVisaDetails = "SELECT VisaCategoryID, Visanumber FROM job_orders WHERE JobOrderId = $fAgentID AND softdeletestatus=1";

    $result = mysqli_query($conn, $sqlVisaDetails);

    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row); // Return JSON response with visaCategory and visaNumber
        } else {
            echo json_encode(array('visaCategory' => '', 'visaNumber' => '')); // No visa categories found for the fAgentID
        }
    } else {
        echo json_encode(array('error' => 'Database query error: ' . mysqli_error($conn))); // Database query error
    }
} else {
    echo json_encode(array('visaCategory' => '', 'visaNumber' => '')); // fAgentID not set in POST data
}
?>