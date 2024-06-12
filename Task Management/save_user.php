<?php
$servername = "localhost";
$username = "root"; 
$password = "root"; 
$database = "user_authentication"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Sql query
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        // Redirect to dashboard.html
        header("Location: dashboard.html");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid Request Method.";
}
$conn->close();
?>

