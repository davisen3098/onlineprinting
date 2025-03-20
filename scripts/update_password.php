<?php
require_once '../config.php';

// Update the password for admin
$username = "admin";
$new_password = "admin123"; // Change this to your desired password
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Connect to database
$db = new DBConnection();
$conn = $db->conn;

// Update the password in the database
$stmt = $conn->prepare("UPDATE admin SET Password = ? WHERE Username = ?");
$stmt->bind_param('ss', $hashed_password, $username);
$result = $stmt->execute();

if ($result) {
    echo "Password successfully updated for $username<br>";
    echo "New hash: $hashed_password<br>";
    echo "You can now try logging in with the new password.";
} else {
    echo "Failed to update password: " . $conn->error;
}
?>
