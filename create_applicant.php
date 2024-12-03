<?php
require_once("Models/Applicant.php");
require_once("Models/auth_check.php");

$auth = new Auth();
$auth->ensureAuthenticated(); // Ensure the user is logged in

// Assuming the logged-in user ID is stored in the session
$userId = $_SESSION['user_id']; // This assumes you have a session with user ID

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debugging the submitted data
    var_dump($_POST);
    
    // Collect and sanitize form inputs
    $username = htmlspecialchars($_POST['username']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $birth_date = htmlspecialchars($_POST['birth_date']);
    $gender = htmlspecialchars($_POST['gender']);
    $email_address = htmlspecialchars($_POST['email_address']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $applied_position = htmlspecialchars($_POST['applied_position']);
    $start_date = htmlspecialchars($_POST['start_date']);
    $address = htmlspecialchars($_POST['address']);
    $nationality = htmlspecialchars($_POST['nationality']);

    // Insert applicant into the database and log the action
    $applicantObj = new Applicant();
    $applicantObj->createApplicant(
        $username,
        $first_name,
        $last_name,
        $birth_date,
        $gender,
        $email_address,
        $phone_number,
        $applied_position,
        $start_date,
        $address,
        $nationality,
        $userId // Pass the user ID to log the action
    );

    // Redirect after successful creation
    header("Location: index.php?success=Applicant added successfully.");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Applicant</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold text-center text-pink-600 mb-6">Create New Applicant</h1>

        <!-- Form to Create New Applicant -->
        <form action="create_applicant.php" method="POST" class="bg-white p-8 rounded-lg shadow-xl space-y-6">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 font-semibold">First Name</label>
                <input type="text" id="first_name" name="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 font-semibold">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="birth_date" class="block text-gray-700 font-semibold">Birth Date</label>
                <input type="date" id="birth_date" name="birth_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-gray-700 font-semibold">Gender</label>
                <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="email_address" class="block text-gray-700 font-semibold">Email Address</label>
                <input type="email" id="email_address" name="email_address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 font-semibold">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="applied_position" class="block text-gray-700 font-semibold">Applied Position</label>
                <input type="text" id="applied_position" name="applied_position" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-semibold">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold">Address</label>
                <textarea id="address" name="address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required></textarea>
            </div>

            <div class="mb-4">
                <label for="nationality" class="block text-gray-700 font-semibold">Nationality</label>
                <input type="text" id="nationality" name="nationality" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-400" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="bg-pink-500 text-white px-6 py-3 rounded-lg hover:bg-pink-600 focus:ring-2 focus:ring-pink-300 transition duration-300">Create Applicant</button>
            </div>
        </form>

        <a href="index.php" class="text-pink-500 hover:underline mt-4 inline-block">Back to Applicants List</a>
    </div>

</body>
</html>
