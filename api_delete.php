<?php
// Set content type to JSON
header('Content-Type: application/json');

// Allow requests from any origin (CORS)
header('Access-Control-Allow-Origin: *');

// Allow POST method and necessary headers
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// Include database configuration
include "config.php";

// Decode incoming JSON request
$data = json_decode(file_get_contents("php://input"), true);

// Check if the 'id' field is provided
if (!isset($data['id'])) {
    echo json_encode([
        'message' => 'Missing student ID.',
        'status' => false
    ]);
    exit;
}

$id = $data['id'];

// SQL query to delete the student record
$sql = "DELETE FROM students WHERE id = {$id}";

// Execute the delete query
$result = mysqli_query($conn, $sql);

// Return appropriate response based on result
if ($result && mysqli_affected_rows($conn) > 0) {
    echo json_encode([
        'message' => 'Student record deleted successfully.',
        'status' => true
    ]);
} else {
    echo json_encode([
        'message' => 'Failed to delete record or ID not found.',
        'status' => false
    ]);
}
?>
