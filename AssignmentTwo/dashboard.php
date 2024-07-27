<?php
include 'includes/header.php';
include 'includes/session.php';
include 'includes/functions.php';
include 'includes/db.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$student_id = $_SESSION['student_id'];

// Fetch student data
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "Error fetching student data.";
    exit();
}
?>


<main>
    <h1>Welcome to your Dashboard</h1>
    <p>You are logged in as <?php echo $student['name']; ?></p>

    <h2>Your Information</h2>
    
    <form action="update_student.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required>
        
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $student['phone']; ?>">
        
        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo">
        
        <label for="sports">Sports:</label>
        <input type="text" id="sports" name="sports" value="<?php echo $student['sports']; ?>" required>
        
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="Male" <?php if ($student['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($student['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($student['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
        
        <br><button type="submit">Update Information</button>

    </form>

    <form action="delete_student.php" method="post">
        <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
        <button type="submit">Delete Account</button>
    </form>

    <button onclick="window.location.href='index.php'">Home Page</button>

</main>

<?php
$stmt->close();
$conn->close();
include 'includes/footer.php';
?>
<style>
    /* Main Container */
    main {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 800px;
        width: 90%;
        margin: 20px auto;
        text-align: center;
    }


    /* Form Styles */
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    form label {
        align-self: flex-start;
        font-weight: bold;
        margin: 10px 0 5px 0;
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="tel"],
    form input[type="file"],
    form select {
        width: calc(100% - 20px);
        max-width: 400px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="tel"]:focus,
    form input[type="file"]:focus,
    form select:focus {
        border-color: #00d1b2;
        outline: none;
    }

    /* Button Styles */
    button {
        background-color: black;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    button:hover {
        background-color: skyblue;
        color: black;
        transform: translateY(-2px);
    }

    button[type="submit"] {
        margin-top: 10px;
    }
    
footer {
    background-color: #333333; /* Dark background color */
    color: #ffffff; /* White text color */
    text-align: center;
    padding: 20px;
    border-top: 5px solid #00a897;
    width: 100%;
    flex-shrink: 0; /* Prevents footer from shrinking */
}

footer p {
    margin: 0;
    font-family: 'Coda', sans-serif;
    font-size: 1em;
}

</style>