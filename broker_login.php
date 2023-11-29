<?php
// broker_login.php
session_start();
if (isset($_SESSION["broker"])) {
    header("Location: broker_dashboard.php"); // Redirect to broker dashboard if already logged in
    exit();
}

// Include database connection
require_once "database.php";

// Handle broker login form submission
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate input (you may need to add more validation)
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Perform database query to check credentials
        $sql = "SELECT * FROM brokers WHERE broker_email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // Verify the password
                if (password_verify($password, $row['broker_password'])) {
                    $_SESSION["broker"] = $row['broker_id'];
                    header("Location: broker_dashboard.php");
                    exit();
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "Email not found.";
            }

            mysqli_stmt_close($stmt);
        } else {
            die("Something went wrong");
        }
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
        <h2>Broker Login</h2>
        <?php
        if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
        ?>
        <form action="broker_login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <input type="submit" class="btn btn-primary" name="login" value="Login">
        </form>
    </div>
</body>
</html>
