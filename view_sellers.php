<?php

include("../includes/db.php"); // Ensure correct database connection

if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "<h2>Approved Sellers</h2>";

$query = "SELECT * FROM sellers WHERE status='approved'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($con)); // Debugging
}

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' width='100%' cellpadding='5' cellspacing='0' style='border-collapse: collapse;'>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No approved sellers found.</p>";
}
?>
