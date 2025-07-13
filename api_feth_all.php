<?php
// Set response type to JSON
header('Content-Type: application/json');

// Allow requests from any origin (CORS policy)
header('Access-Control-Allow-Origin: *');

// Include database connection file
include "config.php";

// SQL query to fetch all student records
$sql = "SELECT * FROM students";

// Execute the query
$result = mysqli_query($conn, $sql);

// If query fails, return error message
if (!$result) {
    echo json_encode([
        'message' => 'SQL Query Failed.',
        'status' => false
    ]);
    exit;
}

// If records are found, return them as a JSON array
if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    echo json_encode($output);
} else {
    // If no records are found, return a message
    echo json_encode([
        'message' => 'No Record Found.',
        'status' => false
    ]);
}
?>
