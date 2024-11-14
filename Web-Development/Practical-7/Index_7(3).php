<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Authentication</title>
</head>
<body>

<?php
// Initialize variables
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get username and password from the form
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Read credentials from the file
  $credentialsFile = "credentials.txt";

  if (file_exists($credentialsFile)) {
    $fileContent = file_get_contents($credentialsFile);
    list($storedUsername, $storedPassword) = explode(":", trim($fileContent));

    // Check if entered credentials match the stored credentials
    if ($username === trim($storedUsername) && $password === trim($storedPassword)) {
      $message = "Login successful! Welcome, " . htmlspecialchars($username) . ".";
    } else {
      $message = "Invalid username or password.";
    }
  } else {
    $message = "Error: Credentials file not found.";
  }
}
?>

<!-- Login Form -->
<form method="post" action="">
  <label>Username:</label>
  <input type="text" name="username" required><br><br>
  
  <label>Password:</label>
  <input type="password" name="password" required><br><br>
  
  <input type="submit" value="Login">
</form>

<!-- Display the message -->
<p><?php echo $message; ?></p>

</body>
</html>
