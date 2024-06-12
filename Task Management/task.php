<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "user_authentication";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if task_name is set and not empty
    if (isset($_POST['task_name']) && !empty($_POST['task_name'])) {
        $task_name = $conn->real_escape_string($_POST['task_name']);

        // Inserting data to database
        $sql = "INSERT INTO tasks (task_name) VALUES ('$task_name')";
        if ($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'New task added successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error: ' . $conn->error;
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Task name not set or empty in POST request';
    }

    // Close connection
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
