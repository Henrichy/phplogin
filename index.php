<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Page</title>
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
  <h1 class="text-left">Registration Page</h1>

    <div class="row">
      <div class="col-md-6">


        <form action="php/registration.php" method="post" onsubmit="return validatePhoneNumber();">

          <div class="mb-3">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($_POST['firstName']) ? $_POST['firstName'] : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($_POST['lastName']) ? $_POST['lastName'] : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label for="middleName" class="form-label">Middle Name</label>
            <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo isset($_POST['middleName']) ? $_POST['middleName'] : ''; ?>">
          </div>

          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>">
          </div>

          <div class="mb-3">
            <label for="familyName" class="form-label">Family Name</label>
            <input type="text" class="form-control" id="familyName" name="familyName" value="<?php echo isset($_POST['familyName']) ? $_POST['familyName'] : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label for="village" class="form-label">Village</label>
            <input type="text" class="form-control" id="village" name="village" value="<?php echo isset($_POST['village']) ? $_POST['village'] : ''; ?>">
          </div>
          
          <div class="mb-3">
            <label for="fatherName" class="form-label">Father's Name</label>
            <input type="text" class="form-control" id="fatherName" name="fatherName" value="<?php echo isset($_POST['fatherName']) ? $_POST['fatherName'] : ''; ?>">
          </div>

          <div class="mb-3">
            <label for="motherName" class="form-label">Mother's Name</label>
            <input type="text" class="form-control" id="motherName" name="motherName" value="<?php echo isset($_POST['motherName']) ? $_POST['motherName'] : ''; ?>">
          </div>
          </div>
        <div class="col-md-6">

          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : ''; ?>" required>
            <span id="phoneError" style="color: red;"></span>

          </div>
         
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
          </div>
          <div class="mb-3">
            <label for="occupation" class="form-label">Occupation</label>
            <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo isset($_POST['occupation']) ? $_POST['occupation'] : ''; ?>" required>
          </div>
          <div class="mb-3">
            <label for="residentAddress" class="form-label">Resident Address</label>
            <input type="text" class="form-control" id="residentAddress" name="residentAddress" value="<?php echo isset($_POST['residentAddress']) ? $_POST['residentAddress'] : ''; ?>" required>
          </div>
          <div class="mb-3">
            <label for="ageGrade" class="form-label">Age grade</label>
            <input type="text" class="form-control" id="ageGrade" name="ageGrade" value="<?php echo isset($_POST['ageGrade']) ? $_POST['ageGrade'] : ''; ?>" required>
          </div>
          <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <span class="combinepb">
        <input type="password" class="form-control" id="password" name="password" required>
        <button type="button" class="btn btn-sm btn-secondary" id="show-password">Show</button>
        </span>
      </div>
          
          <button type="submit" class="btn btn-primary">Sign Up</button>
          <a href="login.php" class="link-secondary">Login</a>
        </form>
      </div>  
    </div>
  </div>  
  <script>
 $(document).ready(function() {
  $('#show-password').click(function() {
    var passwordField = $('#password');
    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      $('#show-password').text('Hide');
    } else {
      passwordField.attr('type', 'password');
      $('#show-password').text('Show');
    }
  });
});

  </script>
</body>
</html>