<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Value Transfer</title>
</head>
<body>

<?php
// Initialize the variable for storing the value
$value = "";

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form1Submit"])) {
  // Get the value from the first form
  $value = htmlspecialchars($_POST["inputValue"]);
}
?>

<!-- First Form: User Input -->
<form method="post" action="">
  <label>Enter a value:</label>
  <input type="text" name="inputValue" required>
  <input type="submit" name="form1Submit" value="Submit">
</form>

<br>

<!-- Second Form: Display the Submitted Value -->
<form method="post" action="">
  <label>Value from first form:</label>
  <input type="text" name="displayedValue" value="<?php echo $value; ?>" readonly>
</form>

</body>
</html>
