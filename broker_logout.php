<?php
// broker_logout.php
session_start();
session_destroy();

// Prevent caching of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

header("Location: broker_login.php"); // Redirect to broker login page after logout
exit();
?>
