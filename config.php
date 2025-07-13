<?php
// Define database connection parameters
$host = "localhost";     // Hostname (usually localhost)
$user = "root";          // Database username
$password = "";          // Database password (empty for local default XAMPP setup)
$database = "test";      // Name of the database to connect to

// Create connection using MySQLi
$conn = mysqli_connect($host, $user, $password, $database);

// Optional: Check connection (uncomment for debugging)
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully"; // For testing only

?>
