<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'bug_tracker_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bugId = $_SESSION['last_bug_id'] ?? null;
if ($bugId) {
    $stmt = $conn->prepare("SELECT * FROM bugs WHERE id = ?");
    $stmt->bind_param('i', $bugId);
    $stmt->execute();
    $result = $stmt->get_result();
    $bug = $result->fetch_assoc();
    echo json_encode($bug);
}

$stmt->close();
$conn->close();
?>