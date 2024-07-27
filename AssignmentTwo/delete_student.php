<!-- this page perform to delet account from student side -->
<?php
// calling necessary files
include 'includes/db.php';
include 'includes/functions.php';
include 'includes/session.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    redirect('login.php'); // Redirect to the login page if the user is not logged in
}

// Check if the form is submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id']; // Get the student ID from the POST data

    // the SQL statement to delete the student record
    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);

    // Execute the SQL statement
    if ($stmt->execute()) {
        session_destroy(); //finish the session after deleting the student record
        redirect('index.php'); // Redirect to the index page after operation
    } 
    else {
        echo "Error: " . $stmt->error; // Display an error message if the deletion fails
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
