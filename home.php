<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <style>
    body{
      font-family: sans-serif;
      background-color: #f2f2f2;
      height: auto;
      margin-left:20px;
    }
    .firstcon {
      text-align: center;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 0;
      height: 100%;
    }
    .firstly {
      font-size: 2.5em;
    }
    .container  h1 {
      font-size: 1.9em;
    }

    .container {
      max-width: 600px;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    @media screen(max-width: 700px) {
      .container {
      max-width: 80%;
       display: none;
      }
    }

    .container a {
      display: inline-block;
      color: #fff;
      background-color: blue;
      text-decoration: none;
      margin: 10px;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .container a:hover {
      background-color: #0073e6; /* Change color on hover */
    }
  </style>
</head>
<body>
<h1 class="firstly">WELCOME TO THE HOMEPAGE </h1>
<div class="firstcon">
<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the user data
$conn = new PDO('mysql:host=localhost;dbname=village_db', 'root', '');
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch();
$conn = null;

?>

<div class="container">
  <h1>Welcome, <?php echo "{$user['firstName']} {$user['lastName']}"; ?>!</h1>

  <!-- Display the edit profile button and logout button -->
  <a href='edit.php'>Edit Profile</a>
  <a href='logout.php'>Logout</a>
</div>
</div>
</body>
</html>
