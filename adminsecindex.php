<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/admincreate.php" role="button">New Client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Title</th>
                    <th>Family Name</th>
                    <th>Village</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Occupation</th>
                    <th>Resident Address</th>
                    <th>Age Grade</th>
                    <th>Donation</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "village_db";

                $connection = new mysqli($servername, $username, $password, $database);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Query failed: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['firstName']}</td>
                        <td>{$row['lastName']}</td>
                        <td>{$row['middleName']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['familyName']}</td>
                        <td>{$row['village']}</td>
                        <td>{$row['fatherName']}</td>
                        <td>{$row['motherName']}</td>
                        <td>{$row['phoneNumber']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['occupation']}</td>
                        <td>{$row['residentAddress']}</td>
                        <td>{$row['ageGrade']}</td>
                        <td>{$row['donation']}</td>

                        <td>
                            <a class='btn btn-primary btn-sm' href='/adminedit.php?id={$row['id']}'>Edit</a>
                            <a class='btn btn-primary btn-sm' href='/admindelete.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

