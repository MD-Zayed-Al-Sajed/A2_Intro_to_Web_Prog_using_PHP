<!-- this page provide a admin login page -->
<?php
// Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'includes/session.php'; 
include 'includes/functions.php';

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // filter input data
    $admin_username = sanitizeInput($_POST['admin_username']);
    $admin_password = sanitizeInput($_POST['admin_password']); // Sanitize input

    
    $admin_cred_username = 'zayed'; //predefined admin username
    $admin_cred_password = 'password'; //predefined admin password

    // Checks if the entered data match the predefined ones
    if ($admin_username === $admin_cred_username && $admin_password === $admin_cred_password) {
        // Set session variable to indicate admin is logged in
        $_SESSION['admin_logged_in'] = true;
        // goes to the admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    } 
    // show an error message if provided data are incorrect
    else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <title>Admin Login</title>
</head>
<body>
    <div class="slideshow-background"></div>
    <div class="content-container">
        <?php include 'includes/header.php'; ?> 

        <div class="content">
            <h2>Admin Login</h2>
            <?php
            // Display error message if login fails
            if (!empty($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <form action="admin_login.php" method="post">
                <label for="admin_username">Username:</label>
                <input type="text" id="admin_username" name="admin_username" required>
                
                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" name="admin_password" required>
                
                <button type="submit">Login</button>
            </form>

            <button onclick="window.location.href='index.php'">Home Page</button>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
