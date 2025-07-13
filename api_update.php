<?php
// Set content type to JSON so client expects a JSON response
header('Content-Type: application/json');

// Allow requests from any origin (CORS)
header('Access-Control-Allow-Origin: *');

// Specify allowed HTTP methods and headers
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// Include database connection file
include "config.php";

// Read the raw POST data and decode the JSON into an associative array
$data = json_decode(file_get_contents("php://input"), true);

// Check if all required fields are provided
if (!isset($data['id']) || !isset($data['sname']) || !isset($data['sage']) || !isset($data['scity'])) {
    echo json_encode([
        'message' => 'Missing required fields.',
        'status' => false
    ]);
    exit;
}

// Extract values from the input
$id    = $data['id'];
$name  = $data['sname'];
$age   = $data['sage'];
$city  = $data['scity'];

// SQL query to update the student record with the given ID
$sql = "UPDATE students SET student_name = '{$name}', age = {$age}, city = '{$city}' WHERE id = {$id}";

// Execute the update query
$result = mysqli_query($conn, $sql);

// Send appropriate JSON response based on query success or failure
if ($result) {
    echo json_encode([
        'message' => 'Student record updated successfully.',
        'status' => true
    ]);
} else {
    echo json_encode([
        'message' => 'Failed to update record.',
        'status' => false
    ]);
}
?>
