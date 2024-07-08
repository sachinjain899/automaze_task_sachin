<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'bug_tracker_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$comment = $_POST['comment'];
$urgency = $_POST['urgency'];

$stmt = $conn->prepare("INSERT INTO bugs (title, comment, urgency, status) VALUES (?, ?, ?, 'Open')");
$stmt->bind_param('sss', $title, $comment, $urgency);
$stmt->execute();
$stmt->close();

$_SESSION['last_bug_id'] = $conn->insert_id;

echo '<div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Thank You!</h1>
        <p>Your bug report has been submitted.</p>
      </div>';

$conn->close();
?>