<?php
// Database connection settings
$servername = "localhost";     // XAMPP always uses localhost
$username   = "root";          // Default XAMPP username
$password   = "";              // Leave empty (no password by default)
$database   = "pixelnplate_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    // Uncomment this line for testing only
    // echo "Connected successfully";
}
?>
