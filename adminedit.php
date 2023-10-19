<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){
$servername = "localhost";
$username = "root";
$password = "";
$database = "village_db";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
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

$errormessage = "";
$successmessage = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location:adminhome.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: adminhome.php");
        exit;
    }

    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $middleName = $row["middleName"];
    $title = $row["title"];
    $familyName = $row["familyName"];
    $village = $row["village"];
    $fatherName = $row["fatherName"];
    $motherName = $row["motherName"];
    $phoneNumber = $row["phoneNumber"];
    $email = $row["email"];
    $occupation = $row["occupation"];
    $residentAddress = $row["residentAddress"];
    $ageGrade = $row["ageGrade"];
    $donation = $row["donation"];


} else {
    $id = $_POST["id"];
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


    if (empty($id) || empty($firstName) || empty($lastName) || empty($middleName) || empty($title) || empty($familyName) || empty($village) || empty($fatherName) || empty($motherName) || empty($phoneNumber) || empty($email)
    || empty($occupation)|| empty($residentAddress)|| empty($ageGrade)) {
        $errormessage = "All the fields are required";
    } else {
        $sql = "UPDATE users " .
            "SET firstName='$firstName', lastName='$lastName', middleName='$middleName', title='$title', familyName='$familyName', village='$village', fatherName='$fatherName', motherName='$motherName', phoneNumber='$phoneNumber',
            email='$email',  occupation='$occupation',  residentAddress='$residentAddress',  ageGrade='$ageGrade',  donation='$donation' " .
            "WHERE id = $id";
        $result = $connection->query($sql);

        if (!$result) {
            $errormessage = "Invalid query: " . $connection->error;
        } else {
            $successmessage = "Client updated Successfully";
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
    <h2>Edit Client</h2>

    <?php
    if (!empty($errormessage)) {
        echo "
        <div class='alert alert-warning alert-dismissable fade show' role='alert'>
           <strong>$errormessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">firstName</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="firstName" value="<?php echo $firstName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">lastName</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">middleName</label>
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
            <label class="col-sm-3 col-form-label">Mother Name</label>
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
                <input type="text" class="form-control" name="residentAddress" value="<?php echo $residentAddress
                ; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Age Grade</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ageGrade" value="<?php echo $ageGrade; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Donation</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="donation" value="<?php echo $donation; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Update</button>
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