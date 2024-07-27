<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_sports_club"; // Ensure this is the correct database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
