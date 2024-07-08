<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'bug_tracker_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM bugs ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($bug = $result->fetch_assoc()) {
        echo "<div class='bg-white p-4 rounded shadow mb-4'>
                <h2 class='text-xl font-bold'>{$bug['title']}</h2>
                <p>{$bug['comment']}</p>
                <p><strong>Urgency:</strong> {$bug['urgency']}</p>
                <p><strong>Status:</strong> {$bug['status']}</p>
                <form action='update-bug-status.php' method='post'>
                    <input type='hidden' name='bug_id' value='{$bug['id']}'>
                    <select name='status' class='mb-2'>
                        <option value='Open' " . ($bug['status'] == 'Open' ? 'selected' : '') . ">Open</option>
                        <option value='In Progress' " . ($bug['status'] == 'In Progress' ? 'selected' : '') . ">In Progress</option>
                        <option value='Closed' " . ($bug['status'] == 'Closed' ? 'selected' : '') . ">Closed</option>
                    </select>
                    <textarea name='comment' class='w-full p-2 mb-2' placeholder='Add a comment'></textarea>
                    <button type='submit' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Update Status</button>
                </form>
              </div>";
    }
} else {
    echo "No bugs found.";
}

$conn->close();
?>