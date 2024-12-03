<?php
require_once("Models/auth_check.php");

$auth = new Auth();
$auth->checkAuthentication(); // Redirect to index.php if logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-3xl shadow-xl max-w-md w-full">
        <h1 class="text-3xl font-semibold text-center text-pink-600 mb-6">Login</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="text-red-500 mb-4 text-center"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="text-green-500 mb-4 text-center"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>

        <form action="action/process_login.php" method="POST" class="space-y-6">
            <div>
                <label for="usernameOrEmail" class="block text-gray-700 font-medium">Username or Email:</label>
                <input type="text" id="usernameOrEmail" name="usernameOrEmail" required
                       class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 transition duration-200 ease-in-out">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password:</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-pink-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 transition duration-200 ease-in-out">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white rounded-lg px-4 py-2 hover:bg-pink-600 focus:ring-2 focus:ring-pink-400 transition duration-200 ease-in-out">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Don't have an account? <a href="register.php" class="text-pink-500 hover:underline">Register here</a>.
        </p>
    </div>
</body>
</html>
