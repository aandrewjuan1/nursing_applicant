<?php
require_once("../Models/Applicant.php");
session_start(); // Start session to get the logged-in user ID

// Ensure the user is logged in (check if the session contains a user ID)
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Get the updated values from the form
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $applied_position = $_POST['applied_position'];
    $start_date = $_POST['start_date'];
    $address = $_POST['address'];
    $nationality = $_POST['nationality'];

    // Create a new Applicant object
    $applicantObj = new Applicant();

    // Update the applicant in the database, passing the userId for logging
    $applicantObj->updateApplicant($id, $username, $first_name, $last_name, $email_address, $phone_number, $applied_position, $start_date, $address, $nationality, $userId);

    // Redirect back to the applicants list after successful update
    header("Location: ../index.php?success=Applicant updated successfully.");
    exit();
}
?>
