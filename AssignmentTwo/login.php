<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';
include 'includes/session.php';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = sanitizeInput($_POST['student_id']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student && password_verify($password, $student['password'])) {
        $_SESSION['student_id'] = $student['student_id'];
        redirect('dashboard.php'); // Change this to the appropriate page
    } else {
        echo "Invalid credentials";
    }

    $stmt->close();
    $conn->close();
}
?>
