<?php
require_once("Models/ActivityLog.php");
require_once("Models/auth_check.php");

$auth = new Auth();
$auth->ensureAuthenticated(); // Ensure the user is logged in

$activityLogObj = new ActivityLog();
$logs = $activityLogObj->getActivityLogs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-pink-50">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center text-pink-600 mb-6">Activity Logs</h1>

        <!-- If there is an error message, show it in a styled alert box -->
        <?php if (is_string($logs)): ?>
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <p><?php echo htmlspecialchars($logs); ?></p>
            </div>
        <?php else: ?>
            <!-- Table for activity logs -->
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                <thead class="bg-pink-100">
                    <tr class="text-gray-700">
                        <th class="px-6 py-3 text-left">Activity By</th>
                        <th class="px-6 py-3 text-left">Action</th>
                        <th class="px-6 py-3 text-left">Record ID</th>
                        <th class="px-6 py-3 text-left">Search Keywords</th>
                        <th class="px-6 py-3 text-left">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr class="border-b">
                            <td class="px-6 py-4"><?php echo htmlspecialchars($log['user_email']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($log['action_type']); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($log['record_id'] ?? 'NA'); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($log['search_keywords'] ?? 'NA'); ?></td>
                            <td class="px-6 py-4"><?php echo htmlspecialchars($log['action_timestamp']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <!-- Back Button -->
        <a href="index.php" class="bg-pink-500 text-white px-6 py-3 rounded-lg hover:bg-pink-600 mt-6 inline-block">Back to Applicants</a>
    </div>

</body>
</html>
