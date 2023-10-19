<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "village_db";

$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="client_details.csv"');

$output = fopen("php://output", "w");

fputcsv($output, [
    'ID',
    'First Name',
    'Last Name',
    'Middle Name',
    'Title',
    'Family Name',
    'Village',
    'Father Name',
    'Mother Name',
    'Phone Number',
    'Email',
    'Occupation',
    'Resident Address',
    'Age Grade',
    'Donation'
]);

$sql = "SELECT * FROM users";
$result = $connection->query($sql);

if (!$result) {
    die("Query failed: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
?>
