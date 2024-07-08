<?php
// Encrypted string
$encryptedString = "OtSrzlB7n3MjD01XlzM4MfNeam1Z-oCnO3kEkxptuS4";

// Decode base64 string
$encryptedData = base64_decode($encryptedString);

// Write encrypted data to a temporary file
file_put_contents('encrypted.bin', $encryptedData);

// Decrypt using OpenSSL command line
$password = 'automaze';
$decrypted = shell_exec("openssl enc -aes-256-cbc -d -in encrypted.bin -base64 -pass pass:$password");

// Print decrypted data
echo "Decrypted value: $decrypted\n";
?>