<?php
header('Content-Type: application/json');

// Include your database connection file
include '../../includes/db_config.php';

$sql = "SELECT id, name FROM provinces";
$result = $conn->query($sql);

$provinces = [];
while ($row = $result->fetch_assoc()) {
    $provinces[] = $row;
}

echo json_encode(['provinces' => $provinces]);

$conn->close();
?>
