<?php
// Set the response content type to JSON
header('Content-Type: application/json');

// Allow requests from any domain (CORS)
header('Access-Control-Allow-Origin: *');

// Allow POST method and required headers
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// Include database configuration
include "config.php";

// Decode JSON input into PHP array
$data = json_decode(file_get_contents("php://input"), true); // Accepts input from Android, iPhone, etc.

// Extract values from the JSON request
$name  = $data['sname'];
$age   = $data['sage'];
$city  = $data['scity'];

// Prepare SQL INSERT query
$sql = "INSERT INTO students(student_name, age, city) VALUES ('{$name}', {$age}, '{$city}')";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // If record inserted successfully, return success message
    echo json_encode([
        'message' => 'Student record inserted.',
        'status' => true
    ]);
} else {
    // If query fails, return error message
    echo json_encode([
        'message' => 'SQL Query Failed.',
        'status' => false
    ]);
}
?>
