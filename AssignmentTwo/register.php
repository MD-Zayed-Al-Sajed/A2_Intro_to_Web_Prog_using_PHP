// this page handles the registration process for new students
<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1); // Display all errors
ini_set('display_startup_errors', 1); // Display errors during PHP's startup sequence
error_reporting(E_ALL); // Report all errors and warning

// calling necessary files for database connection and utility functions
include 'includes/db.php';
include 'includes/functions.php';

// Check if the form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // filtering input data from the form
    $name = sanitizeInput($_POST['name']);
    $student_id = sanitizeInput($_POST['student_id']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $sports = sanitizeInput($_POST['sports']);
    $gender = sanitizeInput($_POST['gender']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Handle the uploaded photo
    $photo = $_FILES['photo']['name']; // Gets the uploaded file name
    $photo_tmp = $_FILES['photo']['tmp_name']; // // Gets the temporary file path
    $photo_path = "uploads/" . basename($photo); // Defining the upload path
    move_uploaded_file($photo_tmp, $photo_path); // Move the uploaded file to the diracted path (uploads)

    // making the SQL statement to insert data into the students table
    $stmt = $conn->prepare("INSERT INTO students (name, student_id, email, phone, photo, sports, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $student_id, $email, $phone, $photo_path, $sports, $gender, $password);
    
    // Execute the statement and check for errors
    if ($stmt->execute()) {
        redirect('index.php'); // Redirect to the index page, if registration successful 
    } else {
        echo "Error: " . $stmt->error; // Display error message if the query fails
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
