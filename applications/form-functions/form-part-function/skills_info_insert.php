<?php
if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantName = $_SESSION['client_name'] = $applicantFname . ' ' . $applicantLname;
}
/*include('../../../includes/db_config.php');
$applicantId1 = $_SESSION['last_applicant_id'] = 105;
$applicantName = $_SESSION['client_name'] = 1;*/



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    
    $job_ids = isset($_POST['job_ids']) ? $_POST['job_ids'] : [];

    print_r($job_ids);

    // Insert applicant details
    
         // Get the last inserted applicant ID

        // Insert selected jobs into the applications table
        foreach ($job_ids as $job_id) {
            $sql = "INSERT INTO applied_jobs (applicantId,positionId) VALUES ('$applicantId1', '$job_id')";
            $conn->query($sql);
        }
        $applicantId1 = $_SESSION['last_applicant_id'];
        $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
         $applicantLname = $_SESSION['applicantLname'];
        echo "Application submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }



?>
