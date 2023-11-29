<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}

// Include database connection
require_once "database.php";

// Add Broker Form Submission
if (isset($_POST["addBroker"])) {
    // Process form data and insert into the database
    $brokerName = mysqli_real_escape_string($conn, $_POST["brokerName"]);
    $brokerContact = mysqli_real_escape_string($conn, $_POST["brokerContact"]);
    $brokerEmail = mysqli_real_escape_string($conn, $_POST["brokerEmail"]);
    $brokerExperience = mysqli_real_escape_string($conn, $_POST["brokerExperience"]);
    $propertyId = mysqli_real_escape_string($conn, $_POST["propertyId"]);
    $brokerCommission = mysqli_real_escape_string($conn, $_POST["brokerCommission"]);
    $brokerStatus = mysqli_real_escape_string($conn, $_POST["brokerStatus"]);

    // Example query
    $sql = "INSERT INTO addBroker (broker_name, broker_contact, broker_email, broker_experience, property_id, broker_commission, broker_status) VALUES ('$brokerName', '$brokerContact', '$brokerEmail', '$brokerExperience', '$propertyId', '$brokerCommission', '$brokerStatus')";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        header("Location: success.php"); // Redirect to success page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); // Display an error message (for debugging)
    }
}

// Add Property Form Submission
if (isset($_POST["addProperty"])) {
    // Process form data and insert into the database
    $ownerName = $_POST["ownerName"];
    $ownerContact = $_POST["ownerContact"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zipCode = $_POST["zipCode"];
    $kindOfProperty = $_POST["kindOfProperty"];
    $area = $_POST["area"];
    $totalValuation = $_POST["totalValuation"];
    $propertyStatus = $_POST["propertyStatus"];

    // Implement your database insertion logic for properties
    $sql = "INSERT INTO properties (owner_name, owner_contact, address, city, zip_code, kind_of_property, area, total_valuation, property_status) VALUES ('$ownerName', '$ownerContact', '$address', '$city', '$zipCode', '$kindOfProperty', '$area', '$totalValuation', '$propertyStatus')";
    $result = mysqli_query($conn, $sql);

    // Redirect to a success page or display a success message
    if ($result) {
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary meta tags, CSS, and Bootstrap -->
</head>
<body>
    <div class="container">
        <h2>Add Broker</h2>
        <form action="admin_panel.php" method="post">
            <!-- Broker form fields -->
            <!-- Example: -->
            <input type="text" name="brokerName" placeholder="Broker Name" required>
            <input type="text" name="brokerContact" placeholder="Broker Contact" required>
            <!-- Add other broker fields as needed -->
            <input type="submit" class="btn btn-primary" name="addBroker" value="Add Broker">
        </form>

        <h2>Add Property</h2>
        <form action="admin_panel.php" method="post">
            <!-- Property form fields -->
            <!-- Example: -->
            <input type="text" name="ownerName" placeholder="Owner Name" required>
            <input type="text" name="ownerContact" placeholder="Owner Contact" required>
            <!-- Add other property fields as needed -->
            <input type="submit" class="btn btn-primary" name="addProperty" value="Add Property">
        </form>
    </div>
</body>
</html>
