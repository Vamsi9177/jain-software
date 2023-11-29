<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}

// Include database connection
require_once "database.php";

// Fetch and display all brokers
$sql = "SELECT * FROM brokers";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h2>View Brokers</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Broker ID</th><th>Broker Name</th><th>Contact</th><th>Email</th><th>Experience</th><th>Property ID</th><th>Commission</th><th>Status</th><th>Action</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["broker_id"] . "</td>";
        echo "<td>" . $row["broker_name"] . "</td>";
        echo "<td>" . $row["broker_contact"] . "</td>";
        echo "<td>" . $row["broker_email"] . "</td>";
        echo "<td>" . $row["broker_experience"] . "</td>";
        echo "<td>" . $row["property_id"] . "</td>";
        echo "<td>" . $row["broker_commission"] . "</td>";
        echo "<td>" . ($row["broker_status"] == 1 ? 'Active' : 'Inactive') . "</td>";
        echo "<td><a href='edit_broker.php?id=" . $row["broker_id"] . "'>Edit</a> | <a href='delete_broker.php?id=" . $row["broker_id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Edit Broker Functionality
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    
    // Fetch broker details for the selected broker
    $sql = "SELECT * FROM brokers WHERE broker_id = $edit_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // Display a form with the broker details for editing
        ?>
        <h2>Edit Broker</h2>
        <!-- Include form fields with values pre-filled from $row -->
        <form action="update_broker.php" method="post">
            <label for="broker_name">Broker Name:</label>
            <input type="text" name="broker_name" value="<?php echo htmlspecialchars($row['broker_name']); ?>" required>
            
            <label for="broker_contact">Contact:</label>
            <input type="text" name="broker_contact" value="<?php echo htmlspecialchars($row['broker_contact']); ?>" required>
            
            <label for="broker_email">Email:</label>
            <input type="email" name="broker_email" value="<?php echo htmlspecialchars($row['broker_email']); ?>" required>
            
            <label for="broker_experience">Experience:</label>
            <input type="text" name="broker_experience" value="<?php echo htmlspecialchars($row['broker_experience']); ?>" required>
            
            <label for="property_id">Property ID:</label>
            <input type="text" name="property_id" value="<?php echo htmlspecialchars($row['property_id']); ?>" required>
            
            <label for="broker_commission">Commission:</label>
            <input type="text" name="broker_commission" value="<?php echo htmlspecialchars($row['broker_commission']); ?>" required>
            
            <label for="broker_status">Status:</label>
            <select name="broker_status" required>
                <option value="1" <?php echo ($row['broker_status'] == 1) ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?php echo ($row['broker_status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
            </select>
            
            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            
            <input type="submit" name="update_broker" value="Update Broker">
        </form>

        <?php
    } else {
        echo "Error fetching broker details: " . mysqli_error($conn);
    }
}

// Delete Broker Functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Delete the selected broker from the database
    $sql = "DELETE FROM brokers WHERE broker_id = $delete_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Broker deleted successfully.";
    } else {
        echo "Error deleting broker: " . mysqli_error($conn);
    }
}

// Fetch and display all brokers
$sql = "SELECT * FROM brokers";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<h2>View Brokers</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Broker ID</th><th>Broker Name</th><th>Contact</th><th>Email</th><th>Experience</th><th>Property ID</th><th>Commission</th><th>Status</th><th>Action</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["broker_id"] . "</td>";
        echo "<td>" . $row["broker_name"] . "</td>";
        echo "<td>" . $row["broker_contact"] . "</td>";
        echo "<td>" . $row["broker_email"] . "</td>";
        echo "<td>" . $row["broker_experience"] . "</td>";
        echo "<td>" . $row["property_id"] . "</td>";
        echo "<td>" . $row["broker_commission"] . "</td>";
        echo "<td>" . ($row["broker_status"] == 1 ? 'Active' : 'Inactive') . "</td>";
        echo "<td><a href='admin_panel.php?edit_id=" . $row["broker_id"] . "'>Edit</a> | <a href='admin_panel.php?delete_id=" . $row["broker_id"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
