<?php
session_start();

$clientId = 'YOUR_GITHUB_CLIENT_ID';
$redirectUri = 'http://localhost/engineering/callback.php';
$state = bin2hex(random_bytes(16));
$_SESSION['oauth_state'] = $state;

$authUrl = "https://github.com/login/oauth/authorize?client_id=$clientId&redirect_uri=$redirectUri&state=$state&scope=user";

header("Location: $authUrl");
exit;
?>