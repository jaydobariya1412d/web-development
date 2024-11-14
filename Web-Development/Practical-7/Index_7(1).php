<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Upload</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Directory where files will be uploaded
  $uploadDir = "uploads/";
  
  // Create the directory if it doesn't exist
  if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
  }

  // Get the uploaded file information
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $targetFilePath = $uploadDir . $fileName;
  $uploadOk = 1;
  $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

  // Check if file is actually an uploaded file and has no errors
  if (!is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
    echo "<p>Error: File was not uploaded properly.</p>";
    $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($targetFilePath)) {
    echo "<p>Error: File already exists.</p>";
    $uploadOk = 0;
  }

  // Limit file size (e.g., max 5 MB)
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "<p>Error: File is too large.</p>";
    $uploadOk = 0;
  }

  // Allow only certain file formats (e.g., jpg, png, pdf)
  $allowedTypes = array("jpg", "png", "jpeg", "gif", "pdf");
  if (!in_array($fileType, $allowedTypes)) {
    echo "<p>Error: Only JPG, JPEG, PNG, GIF, and PDF files are allowed.</p>";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<p>Sorry, your file was not uploaded.</p>";
  } else {
    // Try to move the file to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
      echo "<p>The file " . htmlspecialchars($fileName) . " has been uploaded successfully.</p>";
    } else {
      echo "<p>Sorry, there was an error uploading your file.</p>";
    }
  }
}
?>

<!-- HTML form for file upload -->
<form action="" method="post" enctype="multipart/form-data">
  <label>Select file to upload:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>

</body>
</html>
