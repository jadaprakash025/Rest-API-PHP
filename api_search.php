<?php
// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS from any origin
header('Access-Control-Allow-Origin: *');

// Allow POST method and necessary headers
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

// Include the database connection
include "config.php";

// Decode incoming JSON request
$data = json_decode(file_get_contents("php://input"), true);

// Extract search parameters
$search_name = isset($data['sname']) ? $data['sname'] : '';
$search_city = isset($data['scity']) ? $data['scity'] : '';

// Build the SQL query dynamically
$conditions = [];

if (!empty($search_name)) {
    $conditions[] = "student_name LIKE '%" . mysqli_real_escape_string($conn, $search_name) . "%'";
}

if (!empty($search_city)) {
    $conditions[] = "city LIKE '%" . mysqli_real_escape_string($conn, $search_city) . "%'";
}

$sql = "SELECT * FROM students";

// If any search conditions were added, append them to the SQL
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Limit the result to 1 record only
$sql .= " LIMIT 1";

// Execute the query
$result = mysqli_query($conn, $sql);

// Handle query result
if (!$result) {
    echo json_encode([
        'message' => 'SQL Query Failed.',
        'status' => false
    ]);
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_assoc($result); // Only fetch a single record
    echo json_encode([
        'status' => true,
        'data' => $output
    ]);
} else {
    echo json_encode([
        'message' => 'No matching record found.',
        'status' => false
    ]);
}
?>
