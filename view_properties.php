<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}

// Include database connection
require_once "database.php";

// Fetch and display all properties
$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching properties: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary meta tags, CSS, and Bootstrap -->
</head>
<body>
    <div class="container">
        <h2>View Properties</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Property ID</th>
                    <th>Owner Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Kind of Property</th>
                    <th>Area</th>
                    <th>Total Valuation</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['property_id']}</td>";
                    echo "<td>{$row['owner_name']}</td>";
                    echo "<td>{$row['owner_contact']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "<td>{$row['city']}</td>";
                    echo "<td>{$row['zip_code']}</td>";
                    echo "<td>{$row['kind_of_property']}</td>";
                    echo "<td>{$row['area']}</td>";
                    echo "<td>{$row['total_valuation']}</td>";
                    echo "<td>{$row['property_status']}</td>";
                    echo "<td><a href='edit_property.php?id={$row['property_id']}'>Edit</a></td>";
                    echo "<td><a href='delete_property.php?id={$row['property_id']}'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
