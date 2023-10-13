<?php

$sName = "localhost";
$uName = "shipedsp_codb";
$pass = "Jumong25";
$db_name = "shipedsp_codb";

// Connect to the database
$db = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);

// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn'])) {
  // The user is not logged in, so redirect them to the login page
  header('Location: login.php');
  exit();
}

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
<style>
  body {
    font-family: sans-serif;
  }

  h1 {
    text-align: center;
  }

  .buttons {
    text-align: center;
  }

  .buttons a {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    cursor: pointer;
    border-radius: 4px;
  }
</style>
<body>
  <h1>Welcome, <?php echo $firstName . " " . $lastName; ?>!</h1>

  <p>This is your home page.</p>

  <div class="buttons">
    <a href="edit.php">Edit Profile</a>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
