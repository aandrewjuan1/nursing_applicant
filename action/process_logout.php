<?php
require_once("../Models/User.php");

// Create a new User object
$user = new User();

// Call the logout method
$user->logout();

// Redirect to login page after logging out
header("Location: ../login.php");
exit();
?>
