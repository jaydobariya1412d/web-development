<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Registration Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Get user inputs
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (name, address, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $address, $email, $phone);

    // Execute and check if the insertion was successful
    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch all users for display
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Display</title>
</head>
<body>

    <!-- Registration Form -->
    <h2>Register User</h2>
    <form method="post" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Address:</label>
        <input type="text" name="address" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br><br>

        <input type="submit" name="register" value="Register">
    </form>

    <!-- Display Registration Status Message -->
    <p><?php echo $message; ?></p>

    <hr>

    <!-- Display All Registered Users -->
    <h2>Registered Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["phone"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the connection
    $conn->close();
    ?>

</body>
</html>
