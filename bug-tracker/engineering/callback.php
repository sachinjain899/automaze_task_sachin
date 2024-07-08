<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'bug_tracker_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_GET['state'] != $_SESSION['oauth_state']) {
    die('Invalid state');
}

$clientId = '';
$clientSecret = '';
$code = $_GET['code'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://github.com/login/oauth/access_token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'code' => $code,
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
$accessToken = $data['access_token'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.github.com/user");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: token ' . $accessToken,
    'User-Agent: BugTrackerApp'
]);
$userResponse = curl_exec($ch);
curl_close($ch);

$userData = json_decode($userResponse, true);
$githubId = $userData['id'];
$username = $userData['login'];

$stmt = $conn->prepare('INSERT INTO users (github_id, username, access_token) VALUES (?, ?, ?) 
                      ON DUPLICATE KEY UPDATE access_token = ?');
$stmt->bind_param('isss', $githubId, $username, $accessToken, $accessToken);
$stmt->execute();
$stmt->close();

$_SESSION['github_id'] = $githubId;

$conn->close();

header('Location: index.php');
?>