<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the content type to JSON
header("Content-Type: application/json");

// Database connection settings
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Handle POST request to insert data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get raw POST data
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if required fields are present
    if (isset($data['username']) && isset($data['email'])) {
        // Sanitize inputs
        $username = $conn->real_escape_string($data['username']);
        $email = $conn->real_escape_string($data['email']);

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $email);

        // Execute and check if insertion was successful
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "User added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    }
}

// Close the database connection
$conn->close();
?>
