<?php
// Database connection
include('../../includes/db_config.php');  // Make sure your db_config.php includes the connection to your database

header('Content-Type: application/json');

// Query to get the list of countries and area codes
$sql = "SELECT CountryName, country_code FROM list_of_countries";
$result = $conn->query($sql);

$areaCodes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $areaCodes[] = [
            'country' => $row['CountryName'],
            'area_code' => $row['country_code']
        ];
    }
}

// Return the list of area codes as a JSON response
echo json_encode(['area_codes' => $areaCodes]);

$conn->close();
?>
