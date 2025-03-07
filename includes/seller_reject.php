<?php
include("../includes/db.php"); // Ensure correct database connection

echo "<h2>Rejected Sellers</h2>";

$query = "SELECT * FROM sellers WHERE status='rejected'";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>";
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No rejected sellers found.</p>";
}
?>
