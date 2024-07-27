<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/session.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    redirect('admin_login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = sanitizeInput($_POST['student_id']);

    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    
    if ($stmt->execute()) {
        redirect('admin_dashboard.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
