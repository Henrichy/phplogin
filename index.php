<?php
// Connect to the database

$sName = "localhost";
$uName = "shipedsp_codb";
$pass = "Jumong25";
$db_name = "shipedsp_codb";
$db = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);

// Validate the user input
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$middleName = $_POST['middleName'];
$title = $_POST['title'];
$familyName = $_POST['familyName'];
$village = $_POST['village'];
$fatherName = $_POST['fatherName'];
$motherName = $_POST['motherName'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$occupation = $_POST['occupation'];
$residentAddress = $_POST['residentAddress'];
$ageGrade = $_POST['ageGrade'];

// Check if the email address is already in use
$sql = 'SELECT * FROM users WHERE email = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  // The email address is already in use
  header('Location: register.php?error=Email address already in use');
  exit();
}

// Hash the password
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insert the user into the database
$sql = 'INSERT INTO users (firstName, lastName, middleName, title, familyName, village, fatherName, motherName, phoneNumber, email, occupation, residentAddress, ageGrade, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $firstName);
$stmt->bindParam(2, $lastName);
$stmt->bindParam(3, $middleName);
$stmt->bindParam(4, $title);
$stmt->bindParam(5, $familyName);
$stmt->bindParam(6, $village);
$stmt->bindParam(7, $fatherName);
$stmt->bindParam(8, $motherName);
$stmt->bindParam(9, $phoneNumber);
$stmt->bindParam(10, $email);
$stmt->bindParam(11, $occupation);
$stmt->bindParam(12, $residentAddress);
$stmt->bindParam(13, $ageGrade);
$stmt->bindParam(14, $password);
$stmt->execute();

// Redirect the user to the login page
header('Location: login.php');

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign Up</title>
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
<h1>Sign Up</h1>

<form action="register.php" method="post">
  <input type="text" name="firstName" placeholder="First name">
  <input type="text" name="lastName" placeholder="Last name">
  <input type="text" name="middleName" placeholder="Middle name">
  <input type="text" name="title" placeholder="Title">
  <input type="text" name="familyName" placeholder="Family name">
  <input type="text" name="village" placeholder="Village">
  <input type="text" name="fatherName" placeholder="Father's name">
  <input type="text" name="motherName" placeholder="Mother's name">
  <input type="text" name="phoneNumber" placeholder="Phone number">
  <input type="email" name="email" placeholder="Email address">
  <input type="text" name="occupation" placeholder="Occupation">
  <input type="text" name="residentAddress" placeholder="Resident address (state, country, city)">
  <input type="text" name="ageGrade" placeholder="Age grade">
  <button type="submit">Sign Up</button>
</form>
</body>
</html>


