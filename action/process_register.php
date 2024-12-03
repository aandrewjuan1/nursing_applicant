<?php
require_once("../Models/User.php"); // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        header("Location: ../register.php?error=Please fill in all fields.");
        exit();
    }

    $user = new User();
    $result = $user->register($username, $email, $password, $confirmPassword);

    if ($result === "Registration successful!") {
        header("Location: ../login.php?success=" . urlencode($result));
        exit();
    } else {
        header("Location: ../register.php?error=" . urlencode($result));
        exit();
    }
} else {
    header("Location: ../register.php?error=Invalid request method.");
    exit();
}
?>
