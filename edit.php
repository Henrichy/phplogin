<?php

if (!isset($_SESSION['isLoggedIn'])) {
  // The user is not logged in, so redirect them to the login page
  header('Location: login.php');
  exit();
}
// Connect to the database
$sName = "localhost";
$uName = "shipedsp_codb";
$pass = "Jumong25";
$db_name = "shipedsp_codb";

$db = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);

// Get the user ID from the URL
$userId = $_GET['user_id'];

// Get the user data from the database
$sql = 'SELECT * FROM users WHERE id = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If the user does not exist, redirect the user to the home page
if (!$user) {
  header('Location: home.php');
  exit();
}

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

// Validate the email address
$sql = 'SELECT * FROM users WHERE email = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $email);
$stmt->execute();

if ($stmt->rowCount() > 0 && $stmt->fetch(PDO::FETCH_ASSOC)['id'] != $userId) {
  $errors['email'] = 'Email address is already in use.';
}

// Validate the phone number
$sql = 'SELECT * FROM users WHERE phoneNumber = ?';
$stmt = $db->prepare($sql);
$stmt->bindParam(1, $phoneNumber);
$stmt->execute();

if ($stmt->rowCount() > 0 && $stmt->fetch(PDO::FETCH_ASSOC)['id'] != $userId) {
  $errors['phoneNumber'] = 'Phone number is already in use.';
}

// If there are any errors, redirect the user back to the edit page
if (count($errors) > 0) {
  header('Location: edit.php?user_id=' . $userId);
  exit();
}

// Update the user in the database
$sql = 'UPDATE users SET firstName = ?, lastName = ?, middleName = ?, title = ?, familyName = ?, village = ?, fatherName = ?, motherName = ?, phoneNumber = ?, email = ?, occupation = ?, residentAddress = ?, ageGrade = ? WHERE id = ?';
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
$stmt->bindParam(14, $userId);
$stmt->execute();

// Redirect the user to the home page
header('Location: home.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit User</title>
  <link rel="stylesheet" href="style.css">
</head>
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
  border: 1px solid #ccc;
  border-radius: 4px;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 10px;
  margin-bottom: 10px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

label {
  font-weight: bold;
}

.error {
  color: red;
}

  </style>
<body>
  <h1>Edit User</h1>

  <form action="edit.php" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

    <label for="firstName">First name:</label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $user['firstName']; ?>">

    <label for="lastName">Last name:</label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $user['lastName']; ?>">

    <label for="middleName">Middle name:</label>
    <input type="text" name="middleName" id="middleName" value="<?php echo $user['middleName']; ?>">

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" value="<?php echo $user['title']; ?>">

    <label for="familyName">Family name:</label>
    <input type="text" name="familyName" id="familyName" value="<?php echo $user['familyName']; ?>">

    <label for="village">Village:</label>
    <input type="text" name="village" id="village" value="<?php echo $user['village']; ?>">

    <label for="fatherName">Father's name:</label>
    <input type="text" name="fatherName" id="fatherName" value="<?php echo $user['fatherName']; ?>">

    <label for="motherName">Mother's name:</label>
    <input type="text" name="motherName" id="motherName" value="<?php echo $user['motherName']; ?>">

    <label for="phoneNumber">Phone number:</label>
    <input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo $user['phoneNumber']; ?>">

    <label for="email">Email address:</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>">

    <label for="occupation">Occupation:</label>
    <input type="text" name="occupation" id="occupation" value="<?php echo $user['occupation']; ?>">

    <label for="residentAddress">Resident address:</label>
    <input type="text" name="residentAddress" id="residentAddress" value="<?php echo $user['residentAddress']; ?>">

    <label for="ageGrade">Age grade:</label>
    <input type="text" name="ageGrade" id="ageGrade" value="<?php echo $user['ageGrade']; ?>">

    <button type="submit">Update</button>
  </form>
</body>
</html>
