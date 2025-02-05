<?php

include('../../includes/db_config.php');
var_dump($_POST['jobOrderId']);die();
if (isset($_POST['jobOrderId'])) {
    $jobOrderId = $_POST['jobOrderId'];

    // Fetch visa details from job_orders table
    $query = "SELECT jobOrderId FROM job_positions WHERE jobOrderId = '$jobOrderId'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo json_encode(['error' => 'Error fetching visa details']);
        exit;
    }

    $jobOrderData = mysqli_fetch_assoc($result);
    var_dump($jobOrderData);die();
    if (!$jobOrderData) {
        echo json_encode(['error' => 'No visa details found']);
        exit;
    }

    // Fetch positions related to the selected job order
    $positionsQuery = "
    SELECT jp.positionId, GROUP_CONCAT(j.job_title SEPARATOR ', ') as job_titles
    FROM job_positions jp
    JOIN jobs j ON FIND_IN_SET(j.id, jp.positionName) > 0
    WHERE jp.jobOrderId = '$jobOrderId'
    GROUP BY jp.positionId";
    
    $positionsResult = mysqli_query($conn, $positionsQuery);

    // Prepare positions options
    $positionsOptions = '<option value="">Select Position</option>';
    while ($row = mysqli_fetch_assoc($positionsResult)) {
        $positionsOptions .= '<option value="' . $row['positionId'] . '">' . htmlspecialchars($row['job_titles']) . '</option>';
    }

    // Return JSON-encoded data
    echo json_encode([
        'positions' => $positionsOptions
    ]);
} else {
    echo json_encode(['error' => 'Job order ID not provided']);
}
?>
