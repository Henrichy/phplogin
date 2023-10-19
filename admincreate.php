<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
$servername = "localhost";
$username = "root";
$password = "";
$database = "village_db";

$connection = new mysqli($servername, $username, $password, $database);

$firstName = "";
$lastName = "";
$middleName = "";
$title = "";
$familyName = "";
$village = "";
$fatherName = "";
$motherName = "";
$phoneNumber = "";
$email = "";
$occupation = "";
$residentAddress = "";
$ageGrade = "";
$donation  = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $middleName = $_POST["middleName"];
    $title = $_POST["title"];
    $familyName = $_POST["familyName"];
    $village = $_POST["village"];
    $fatherName = $_POST["fatherName"];
    $motherName = $_POST["motherName"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    $occupation = $_POST["occupation"];
    $residentAddress = $_POST["residentAddress"];
    $ageGrade = $_POST["ageGrade"];
    $donation = $_POST["donation"];

    if (empty($firstName) || empty($lastName) || empty($middleName) || empty($title) || empty($familyName) || empty($village) || empty($fatherName) || empty($motherName) || empty($phoneNumber) || empty($email)
    || empty($occupation)|| empty($residentAddress)|| empty($ageGrade)) {
        $errorMessage = "All the fields are required";
    } else {
        $sql = "INSERT INTO users (firstName, lastName, middleName, title, familyName, village, fatherName, motherName, phoneNumber, email, occupation, residentAddress, ageGrade, donation) VALUES ('$firstName', '$lastName', '$middleName', '$title', '$familyName', '$village', '$fatherName', '$motherName', '$phoneNumber', '$email', '$occupation', '$residentAddress', '$ageGrade', '$donation')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $firstName = "";
            $lastName = "";
            $middleName = "";
            $title = "";
            $familyName = "";
            $village = "";
            $fatherName = "";
            $motherName = "";
            $phoneNumber = "";
            $email = "";
            $occupation = "";
            $residentAddress = "";
            $ageGrade = "";
            $donation  = "";

            $successMessage = "Client added Successfully";
            header("location: adminhome.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container my-5">
    <h2>New Client</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-warning alert-dismissable fade show' role='alert'>
           <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    if (!empty($successMessage)) {
        echo "
        <div class='alert alert-success alert-dismissable fade show' role='alert'>
           <strong>$successMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">First Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="firstName" value="<?php echo $firstName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Middle Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="middleName" value="<?php echo $middleName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Title</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Family Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="familyName" value="<?php echo $familyName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Village</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="village" value="<?php echo $village; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Father Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="fatherName" value="<?php echo $fatherName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Mother Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="motherName" value="<?php echo $motherName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Occupation</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Resident Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="residentAddress" value="<?php echo $residentAddress; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Age Grade</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ageGrade" value="<?php echo $ageGrade; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Donations</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="donation" value="<?php echo $donation; ?>">
            </div>
        </div>


        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="adminhome.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
    }else{
        header("Location: adminindex.php");
        exit();
    }
?>