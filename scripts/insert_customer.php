<?php
require '../config.php';

$customers = [
    ['John Doe', 'johndoe@example.com', 'password123', '1234567890', '123 Main St'],
    ['Jane Smith', 'janesmith@example.com', 'mypassword', '9876543210', '456 Elm St'],
    ['Alice Brown', 'alicebrown@example.com', 'alicepass', '1112223333', '789 Pine St']
];

foreach ($customers as $customer) {
    $name = $customer[0];
    $email = $customer[1];
    $plain_password = $customer[2];
    $phone = $customer[3];
    $address = $customer[4];

    // Check if email already exists
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM customer WHERE Email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count == 0) {
        // Hash the password before inserting
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Insert new record
        $stmt = $conn->prepare("INSERT INTO customer (Name, Email, Password, Phone, Address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $hashed_password, $phone, $address);
        if ($stmt->execute()) {
            echo "Customer '$name' added successfully!<br>";
        } else {
            echo "Error adding '$name': " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Customer '$name' already exists. Skipping...<br>";
    }
}
?>
