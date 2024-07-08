<?php
session_start();
if (!isset($_SESSION['github_id'])) {
    header('Location: login.php');
    exit;
}
$db = new SQLite3('../db/bugs.db');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engineering Dashboard</title>
    <link href="../assets/tailwind.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Bugs Dashboard</h1>
    <div hx-get="update-bug.php" hx-trigger="load, every 5s" hx-swap="innerHTML">
        <!-- Bugs will be loaded here -->
    </div>
</body>
</html>