<?php

session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

// Get the user's current details from the database
$conn = new PDO('mysql:host=localhost;dbname=village_db', 'root', '');
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->fetch();
$conn = null;

// Display a form to the user with their current details

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate the input
  if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['phoneNumber'])) {
    $em = "All fields are required";
    header("Location: edit.php?error=$em");
    exit;
  }

  // Connect to the database
  $conn = new PDO('mysql:host=localhost;dbname=village_db', 'root', '');

  // Prepare the SQL statement to update the user's details
  $sql = "UPDATE users SET firstName = ?, lastName = ?, middleName = ?, title = ?, familyName = ?, village = ?, fatherName = ?, motherName = ?, phoneNumber = ?, email = ?, occupation = ?, residentAddress = ?, ageGrade = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);

  // Bind the parameters
  $stmt->bindParam(1, $_POST['firstName']);
  $stmt->bindParam(2, $_POST['lastName']);
  $stmt->bindParam(3, $_POST['middleName']);
  $stmt->bindParam(4, $_POST['title']);
  $stmt->bindParam(5, $_POST['familyName']);
  $stmt->bindParam(6, $_POST['village']);
  $stmt->bindParam(7, $_POST['fatherName']);
  $stmt->bindParam(8, $_POST['motherName']);
  $stmt->bindParam(9, $_POST['phoneNumber']);
  $stmt->bindParam(10, $_POST['email']);
  $stmt->bindParam(11, $_POST['occupation']);
  $stmt->bindParam(12, $_POST['residentAddress']);
  $stmt->bindParam(13, $_POST['ageGrade']);
  $stmt->bindParam(14, $_SESSION['user_id']);
  
  // Execute the SQL statement
  $stmt->execute();
  
  // Close the connection
  $conn = null;
  
  // Redirect the user to the success page
  header("Location: home.php?success=Your profile has been updated successfully");
  exit;
  }
?>

<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      .combinepb{
        position: relative;
      }
      .combinepb button{
        position: absolute;
        right: 0;
        top:47%;
        height: 36px;
        width: auto;
      }
      .link-secondary{
        float: right;
        padding:5px 10px; 
        color: #fff;
        background: #818181;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
      }
    </style>
    <script>
        function validatePhoneNumber() {
            var phoneNumber = document.getElementById("phoneNumber").value;

            // Define a regular expression pattern for a valid phone number
            var phonePattern = /^\d{11}$/; // Change this pattern to match your requirements

            if (phonePattern.test(phoneNumber)) {
                document.getElementById("phoneError").innerHTML = ""; // Clear error message
                return true; // Phone number is valid
            } else {
                document.getElementById("phoneError").innerHTML = "Invalid phone number";
                return false; // Phone number is invalid
            }
        }
    </script>
  </head>
  <body>
  
    <div class="container">
    <h1 class="text-left">Edit Profile</h1>
  
      <div class="row">
        <div class="col-md-6">
  
        <form action="edit.php" method="post" onsubmit="return validatePhoneNumber();">
          
            <div class="mb-3">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" name="firstName" placeholder="First Name" value="<?php echo $user['firstName']; ?>">
              </div>
  
            <div class="mb-3">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="lastName" placeholder="Last Name" value="<?php echo $user['lastName']; ?>">
              </div>
  
            <div class="mb-3">
              <label for="middleName" class="form-label">Middle Name</label>
              <input type="text" class="form-control" name="middleName" placeholder="Middlename" value="<?php echo $user['middleName']; ?>">
              </div>
  
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $user['title']; ?>">
              </div>
  
            <div class="mb-3">
              <label for="familyName" class="form-label">Family Name</label>
              <input type="text" class="form-control" name="familyName" placeholder="Family name" value="<?php echo $user['familyName']; ?>">
              </div>
  
            <div class="mb-3">
              <label for="village" class="form-label">Village</label>
              <input type="text" class="form-control" name="village" placeholder="Village" value="<?php echo $user['village']; ?>">
              </div>
            
            <div class="mb-3">
              <label for="fatherName" class="form-label">Father's Name</label>
              <input type="text" class="form-control" name="fatherName" placeholder="Father Name" value="<?php echo $user['fatherName']; ?>">
              </div>
  
            
            </div>
          <div class="col-md-6">
          <div class="mb-3">
              <label for="motherName" class="form-label">Mother's Name</label>
              <input type="text" class="form-control" name="motherName" placeholder="Mother Name" value="<?php echo $user['motherName']; ?>">
              </div>

            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" value="<?php echo $user['phoneNumber']; ?>">
              <span id="phoneError" style="color: red;"></span>

            </div>
           
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $user['email']; ?>">
              </div>
            <div class="mb-3">
              <label for="occupation" class="form-label">Occupation</label>
              <input type="text" class="form-control" name="occupation" placeholder="Occupation" value="<?php echo $user['occupation']; ?>">
              </div>
            <div class="mb-3">
              <label for="residentAddress" class="form-label">Resident Address</label>
              <input type="text" class="form-control" name="residentAddress" placeholder="Resident Address" value="<?php echo $user['residentAddress']; ?>">
              </div>
            <div class="mb-3">
              <label for="ageGrade" class="form-label">Age grade</label>
              <input type="text" class="form-control" name="ageGrade" placeholder="Age Grade" value="<?php echo $user['ageGrade']; ?>">
              </div>
         
            
            <button type="submit" class="btn btn-primary">Update Profile</button>
          </form>
        </div>  
      </div>
    </div>  
    
  </body>
  </html>  


  