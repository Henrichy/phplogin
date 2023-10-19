<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate the input
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $em = "All fields are required";
    header("Location: login.php?error=$em");
    exit;
  }

  // Connect to the database
  $conn = new PDO('mysql:host=localhost;dbname=village_db', 'root', '');

  // Prepare the SQL statement
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);

  // Bind the parameters
  $stmt->bindParam(1, $_POST['email']);

  // Execute the SQL statement
  $stmt->execute();

  // Get the user data
  $user = $stmt->fetch();

  // Close the connection
  $conn = null;

  // If the user exists and the password is correct, log the user in
  if ($user && password_verify($_POST['password'], $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: home.php");
    exit;
  } else {
    // If the user does not exist or the password is incorrect, display an error message
    $em = "Invalid Email or password";
    header("Location: login.php?error=$em");
    exit;
  }

} else {

  // If the user is not logged in, display the login form
  if (!isset($_SESSION['user_id'])) {

    // If there is an error message, display it
    if (isset($_GET['error'])) {
      $em = $_GET['error'];
    } else {
      $em = "";
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
  body{
    background-color: #f2f2f2;

  }
  .container{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 30%;
  background-color: #f2f2f2;

  }
  @media screen and(max-width: 600px){
.container{
  width: 60%;

}
  }
  form{
    justify-content: center;
    display: flex;
    flex-direction: column;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.4);

  }
  a{
    text-decoration: none;
  }
  a:hover{
    color: red;
  }
</style>
</head>

    <body>
      <h2 style="margin:  30px;">LOGIN HERE</h2>
<div class="container">
    <form action="login.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input type="text" id="email" name="email" placeholder="Email Address" class="form-control">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" placeholder="Password" class="form-control">
  </div>
  <input type="submit" value="Login" class="btn btn-primary">
  <a href="index.php" class="link-secondary">Register Here</a>
</form>
<p style="color:red;"><?php echo $em; ?></p>

</div>

<script>
  $(document).ready(function() {
  // Focus on the phone number field when the page loads
  $('#email').focus();

  // Prevent the form from submitting when the user presses Enter in a password field
  $('input[type="password"]').keypress(function(e) {
    if (e.keyCode == 13) {
      e.preventDefault();
      // Submit the form here
      $('form').submit();
    }
  });
});

</script>
    </body>
    </html>

    <?php

  } else {

    // If the user is logged in, redirect them to the home page
    header("Location: home.php");
    exit;

  }

}

?>