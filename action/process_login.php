<?php
require_once("../Models/User.php"); // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['usernameOrEmail']);
    $password = trim($_POST['password']);

    if (empty($usernameOrEmail) || empty($password)) {
        header("Location: ../login.php?error=Please fill in all fields.");
        exit();
    }

    $user = new User();
    $result = $user->login($usernameOrEmail, $password);

    if ($result === "Login successful!") {
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=" . urlencode($result));
        exit();
    }
} else {
    header("Location: ../login.php?error=Invalid request method.");
    exit();
}
?>
