// this page updates a student's information in the database
<?php
// calling necessary files
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/session.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    redirect('login.php'); // Redirect to login page if the user is not logged in
}

// if the form is submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //filtering user inputs
    $student_id = $_POST['student_id'];
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $sports = sanitizeInput($_POST['sports']);
    $gender = sanitizeInput($_POST['gender']);
    
    //// Handle photo upload if a new photo is provided
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    if (!empty($photo)) {
        $photo_path = "uploads/" . basename($photo);
        if (move_uploaded_file($photo_tmp, $photo_path)) {
            // the SQL statement with photo
            $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, photo=?, sports=?, gender=? WHERE student_id=?");
            $stmt->bind_param("sssssss", $name, $email, $phone, $photo_path, $sports, $gender, $student_id);
        } 
        else {
            echo "Failed to upload photo.";
            exit();
        }
    } 
    else {
        // the SQL statement without photo
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, sports=?, gender=? WHERE student_id=?");
        $stmt->bind_param("ssssss", $name, $email, $phone, $sports, $gender, $student_id);
    }
    // Execute the SQL statement and check for errors
    if ($stmt->execute()) {
        redirect('dashboard.php'); // Redirect to dashboard after successful update
    } 
    else {
        echo "Error: " . $stmt->error; // Display error message if update fails
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} 
else {
    echo "Invalid request method."; // Display message if the request method is not POST
}
?>
