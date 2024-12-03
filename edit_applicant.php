<?php
require_once("./Models/Applicant.php");
require_once("Models/auth_check.php");
$auth = new Auth();
$auth->ensureAuthenticated(); // Redirect to index.php if logged in

// Check if the ID is provided in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Redirect if no valid ID is provided
    header("Location: ../index.php");
    exit();
}

$applicantId = intval($_GET['id']);

// Create a new Applicant object
$applicantObj = new Applicant();

// Fetch the applicant details by ID
$applicant = $applicantObj->getApplicantById($applicantId);

if (!$applicant) {
    // Redirect if no applicant is found for the given ID
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Applicant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50">

<div class="container mx-auto p-8">
    <h1 class="text-4xl font-semibold text-center text-pink-600 mb-6">Edit Applicant</h1>

    <form action="action/process_update_applicant.php" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow-lg">
        <!-- Hidden ID field -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($applicant['id']); ?>">

        <!-- Username -->
        <div class="flex flex-col">
            <label for="username" class="font-semibold text-gray-700">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($applicant['username']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- First Name -->
        <div class="flex flex-col">
            <label for="first_name" class="font-semibold text-gray-700">First Name</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($applicant['first_name']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Last Name -->
        <div class="flex flex-col">
            <label for="last_name" class="font-semibold text-gray-700">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($applicant['last_name']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Email Address -->
        <div class="flex flex-col">
            <label for="email_address" class="font-semibold text-gray-700">Email</label>
            <input type="email" name="email_address" id="email_address" value="<?php echo htmlspecialchars($applicant['email_address']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Phone Number -->
        <div class="flex flex-col">
            <label for="phone_number" class="font-semibold text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($applicant['phone_number']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Applied Position -->
        <div class="flex flex-col">
            <label for="applied_position" class="font-semibold text-gray-700">Applied Position</label>
            <input type="text" name="applied_position" id="applied_position" value="<?php echo htmlspecialchars($applicant['applied_position']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Start Date -->
        <div class="flex flex-col">
            <label for="start_date" class="font-semibold text-gray-700">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($applicant['start_date']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Address -->
        <div class="flex flex-col">
            <label for="address" class="font-semibold text-gray-700">Address</label>
            <textarea name="address" id="address" rows="4" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required><?php echo htmlspecialchars($applicant['address']); ?></textarea>
        </div>

        <!-- Nationality -->
        <div class="flex flex-col">
            <label for="nationality" class="font-semibold text-gray-700">Nationality</label>
            <input type="text" name="nationality" id="nationality" value="<?php echo htmlspecialchars($applicant['nationality']); ?>" class="border p-3 rounded-lg focus:ring-2 focus:ring-pink-500" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-pink-500 text-white px-6 py-3 rounded-lg hover:bg-pink-600 focus:ring-2 focus:ring-pink-400 transition">Update Applicant</button>
    </form>

    <!-- Back Button -->
    <a href="index.php" class="text-pink-500 hover:text-pink-700 mt-4 inline-block">Back to Applicants List</a>
</div>

</body>
</html>
