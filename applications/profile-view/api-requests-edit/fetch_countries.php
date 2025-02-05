<?php
// Database connection
include('../../includes/db_config.php');  // Make sure your db_config.php includes the connection to your database

header('Content-Type: application/json');

// Query to get the list of countries
$sql = "SELECT countryId,CountryName FROM list_of_countries";
$result = $conn->query($sql);

$countries = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $countries[] = [
            'id' => $row['countryId'],
            'name' => $row['CountryName']
        ];
    }
}

// Return the list of countries as a JSON response
echo json_encode(['countries' => $countries]);

$conn->close();
?>
