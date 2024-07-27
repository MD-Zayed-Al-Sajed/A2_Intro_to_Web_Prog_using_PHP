<!-- this page displays a list of all students from the database on a webpage 
it dont show any students phone number and student id, as considered sensitive info -->
<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>


<main>
    <h2>All Students</h2>
    <table>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Sports</th>
        </tr>
        <?php
        // Retrieve students' data from the database
        $result = $conn->query("SELECT name, email, photo, sports FROM students");

        // Check if any results were returned
        if ($result && $result->num_rows > 0) {
            // Loop through all student record
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='" . htmlspecialchars($row['photo']) . "' alt='Photo' class='table-image'></td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['sports']) . "</td>";
                echo "</tr>";
            }
        } else {
            // if no results from database then shows No students found
            echo "<tr><td colspan='4'>No students found.</td></tr>";
        }
        ?>
    </table>
</main>

<?php include 'includes/footer.php'; ?>

 <!-- css for this page start here  -->
<style>

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th, td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
        overflow: hidden; 
        white-space: nowrap;
        text-overflow: ellipsis; 
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* Image Styles */
    .table-image {
        width: 100px;
        height: auto; 
        max-height: 100px; 
        object-fit: cover; 
        display: block;
    }

    footer {
    background-color: black; 
    color: white;
    text-align: center;
    padding: 20px;
    border-top: 5px solid #00a897;
    width: 100%;
    flex-shrink: 0;
}

footer p {
    margin: 0;
    font-family: 'Coda', sans-serif;
    font-size: 1em;
}
</style>
