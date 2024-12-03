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
    // Get the applicant ID from the POST data
    $applicantId = intval($_POST['id']);

    // Create a new Applicant object
    $applicantObj = new Applicant();

    // Delete the applicant by ID, passing the userId for logging
    $applicantObj->deleteApplicant($applicantId, $userId);

    // Redirect back to the applicants list after deletion
    header("Location: ../index.php?success=Applicant deleted successfully.");
    exit();
}
?>
