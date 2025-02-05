<?php
header('Content-Type: application/json');

// Include your database connection file
include '../../includes/db_config.php';

$province_id = isset($_GET['province_id']) ? intval($_GET['province_id']) : 0;

if ($province_id > 0) {
    $stmt = $conn->prepare("SELECT id, name FROM cities WHERE province_id = ?");
    $stmt->bind_param('i', $province_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $cities = [];
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row;
    }

    echo json_encode(['cities' => $cities]);
} else {
    echo json_encode(['error' => 'Invalid Province ID']);
}

$conn->close();
?>
