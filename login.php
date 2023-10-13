<?php


$sName = "localhost";
$uName = "shipedsp_codb";
$pass = "Jumong25";
$db_name = "shipedsp_codb";

$db = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);

// Validate the user input
$phoneNumber = $_POST['phone_number'];
$password = $_POST['password'];

// Check if the user exists in the database
$sql = 'SELECT * FROM users WHERE phone_number = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $phoneNumber);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If the user does not exist, redirect the user back to the login page with an error message
if (!$user) {
  header('Location: login.php?error=User does not exist');
  exit();
}

// Check if the password is correct
if (!password_verify($password, $user['password'])) {
  header('Location: login.php?error=Incorrect password');
  exit();
}

// Redirect the user to the home page
header('Location: /home.php');

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body {
  font-family: sans-serif;
}

h1 {
  text-align: center;
}

form {
  width: 500px;
  margin: 0 auto;
}

input {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  margin-bottom: 10px;
  border: none;
  cursor: pointer;
}
</style>
</head>
<body>
<h1>Login</h1>

<form action="login.php" method="post">
  <input type="text" name="phone_number" placeholder="Phone number">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
</form>
</body>
</html>




