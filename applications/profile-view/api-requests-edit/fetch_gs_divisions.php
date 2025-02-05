<?php
header('Content-Type: application/json');

// Include your database connection file
include '../../../includes/db_config.php';

$city_id = isset($_GET['city_id']) ? intval($_GET['city_id']) : 0;

if ($city_id > 0) {
    $stmt = $conn->prepare("SELECT id, name FROM gs_divisions WHERE city_id = ?");
    $stmt->bind_param('i', $city_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $gs_divisions = [];
    while ($row = $result->fetch_assoc()) {
        $gs_divisions[] = $row;
    }

    echo json_encode(['gs_divisions' => $gs_divisions]);
} else {
    echo json_encode(['error' => 'Invalid City ID']);
}

$conn->close();
?>
