<?php
$conn = new mysqli('localhost', 'root', '', 'bug_tracker_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create bugs table
$sql = "CREATE TABLE IF NOT EXISTS bugs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    comment TEXT,
    urgency VARCHAR(20),
    status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table bugs created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    github_id VARCHAR(255),
    username VARCHAR(255),
    access_token TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>