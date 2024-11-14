<?php
// Start the session
session_start();

// Check if the page views session variable is already set
if (isset($_SESSION['page_views'])) {
    // Increment the page views count
    $_SESSION['page_views']++;
} else {
    // Initialize the page views count if it is the first visit
    $_SESSION['page_views'] = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Views Counter</title>
</head>
<body>

<h1>Welcome to the Page View Counter</h1>

<p>You have refreshed this page <?php echo $_SESSION['page_views']; ?> time(s).</p>

</body>
</html>
