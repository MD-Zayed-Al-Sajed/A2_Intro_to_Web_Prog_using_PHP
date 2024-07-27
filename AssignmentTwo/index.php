<!-- The home page -->
<!-- this page have forms for registering new students in club, 
logging in students and provides an option for admin login page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student Sports Club</title>
</head>
<body>
    <div class="slideshow-background"></div>
    <div class="content-container">
        <?php include 'includes/header.php'; ?>
        <?php include 'includes/functions.php'; ?>

        <div class="content">
            <h2>Register in Student Sports Club</h2>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone">
                
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo">
                
                <label for="sports">Sports:</label>
                <input type="text" id="sports" name="sports" required>
                
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Register</button>
            </form>

            <button onclick="window.location.href='view_students.php'">View All Students</button>
            
            <h2>Student Login</h2>
            <form action="login.php" method="post">
                <label for="student_id_login">Student ID:</label>
                <input type="text" id="student_id_login" name="student_id" required>
                
                <label for="password_login">Password:</label>
                <input type="password" id="password_login" name="password" required>
                
                <button type="submit">Login</button>
            </form>
            
            <button onclick="window.location.href='admin_login.php'">Admin Login</button>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
