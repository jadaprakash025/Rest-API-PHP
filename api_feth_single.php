<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Allow requests from any origin (CORS)
header('Access-Control-Allow-Origin: *');

// Include the database connection file
include "config.php";

// Get the raw POST data and decode it from JSON to an associative array
$data = json_decode(file_get_contents("php://input"), true);  // Accepts input from Android, iPhone, etc.

// Retrieve student ID from the input data
$student_id = $data['sid'];

// SQL query to select a specific student by ID
$sql = "SELECT * FROM students WHERE id = {$student_id}";

// Execute the query
$result = mysqli_query($conn, $sql);

// If the query fails, return an error message
if (!$result) {
    echo json_encode([
        'message' => 'SQL Query Failed.',
        'status' => false
    ]);
    exit;
}

// If the student record is found, return the data as JSON
if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    // If no student is found with the given ID
    echo json_encode([
        'message' => 'No Record Found.',
        'status' => false
    ]);
}
?>
