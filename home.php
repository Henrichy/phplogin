<?php

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=shipedsp_codb', 'root', '');

// Start a session
session_start();

// Get the user's first name and last name from the session
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="style.css">
</head>
  
<body>
  <h1>Welcome, <?php echo $firstName . " " . $lastName; ?>!</h1>

  <p>This is your home page.</p>

  <div class="buttons">
    <a href="edit.php">Edit Profile</a>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>