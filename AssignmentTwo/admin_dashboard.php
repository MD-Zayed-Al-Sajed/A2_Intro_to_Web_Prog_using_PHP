<!-- In this page admin can see all student
 and can make a move for edit and delete -->
<?php
// to show error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// calling necessary files
include 'includes/header.php';
include 'includes/session.php';
include 'includes/functions.php';
include 'includes/db.php';

// Admin Authentication Check
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    redirect('admin_login.php');
}

// Fetch all student data
$stmt = $conn->prepare("SELECT * FROM students");
$stmt->execute();
$result = $stmt->get_result();

?>

<main>
    <h1>Admin Dashboard</h1>
    <button onclick="window.location.href='index.php'">Home Page</button>
    <h2>All Club Members</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Sports</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php while ($student = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['email']; ?></td>
            <td><?php echo $student['phone']; ?></td>
            <td><?php echo $student['sports']; ?></td>
            <td><?php echo $student['gender']; ?></td>
            <td>
                <form action="admin_edit_student.php" method="post" style="display:inline;">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <button type="submit">Edit</button>
                </form>
                <form action="admin_delete_student.php" method="post" style="display:inline;">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</main>


<?php
$stmt->close();
$conn->close();
include 'includes/footer.php';
?>

<!-- css for this file -->
<style>
    /* Main Container */
    main {
        background-color: #f7f7f7;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 1200px;
        width: 95%;
        margin: 20px auto;
    }


    /* Button Styling */
    button {
        background-color: #00d1b2;
        color: black;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        margin: 5px;
    }

    button:hover {
        background-color: antiquewhite;
        transform: translateY(-2px);
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: aquamarine;
        color: black;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #e9e9e9;
    }

    /* Form Styling */
    form {
        display: inline;
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

