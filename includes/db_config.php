<?php
// Dynamically determine the protocol (HTTP or HTTPS)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Get the host (e.g., localhost or domain.com)
$host = $_SERVER['HTTP_HOST'];

// Get the current folder path
$folder = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// Find the position of 'nationscrm' in the folder path
$position = strpos($folder, 'nationscrm');

// If 'nationscrm' is found in the folder path
if ($position !== false) {
    // Truncate the folder path up to and including 'nationscrm'
    $folder = substr($folder, 0, $position + strlen('nationscrm'));
}



// Define the base URL dynamically
//$baseUrl = $protocol . $host . $folder;
$baseUrl = "http://localhost/projects/PHPNation";


// Database connection settings
define('DB_SERVER', 'localhost'); // Your database server (usually localhost)
define('DB_USERNAME', 'root'); // Your database username
define('DB_PASSWORD', 'f-420248'); // Your database password
define('DB_NAME', 'nationscrm'); // Your database name

// Create a connection using the constants
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}