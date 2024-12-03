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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full">
        <h1 class="text-3xl font-bold text-center text-pink-600 mb-6">Create an Account</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="text-red-600 mb-4 text-center"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <form action="action/process_register.php" method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-gray-700 font-semibold">Username:</label>
                <input type="text" id="username" name="username" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold">Email:</label>
                <input type="email" id="email" name="email" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold">Password:</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>
            <div>
                <label for="confirm_password" class="block text-gray-700 font-semibold">Repeat Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-pink-400">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white rounded-lg px-4 py-3 hover:bg-pink-600 focus:ring-2 focus:ring-pink-400">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Already have an account? <a href="login.php" class="text-pink-500 hover:underline">Login here</a>.
        </p>
    </div>

</body>
</html>
