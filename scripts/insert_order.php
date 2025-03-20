<?php
require '../config.php'; // Ensure database connection is set up correctly

// Sample orders data including CustomerID and OrderDate
$orders = [
    [1, '2025-03-20 10:30:00', 'Processing', 150.75, 'Credit Card'],
    [2, '2025-03-19 14:15:00', 'Shipped', 200.50, 'PayPal'],
    [3, '2025-03-18 09:45:00', 'Pending', 75.00, 'Bank Transfer'],
    [4, '2025-03-17 17:20:00', 'Completed', 99.99, 'Debit Card'],
    [5, '2025-03-16 11:10:00', 'Cancelled', 50.00, 'Cash'],
    [6, '2025-03-15 20:05:00', 'Processing', 120.30, 'Credit Card']
];

// Prepare the SQL statement including OrderDate
$stmt = $conn->prepare("INSERT INTO `order` (CustomerID, OrderDate, Status, TotalAmount, PaymentMethod) VALUES (?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (CustomerID: int, OrderDate: string, Status: string, TotalAmount: decimal, PaymentMethod: string)
$stmt->bind_param("issds", $customerID, $orderDate, $status, $totalAmount, $paymentMethod);

// Loop through the orders array and execute the prepared statement
foreach ($orders as $order) {
    $customerID = $order[0];
    $orderDate = $order[1]; // Explicit OrderDate
    $status = $order[2];
    $totalAmount = $order[3];
    $paymentMethod = $order[4];

    if ($stmt->execute()) {
        echo "Order for Customer ID '$customerID' added successfully!<br>";
    } else {
        echo "Error adding order for Customer ID '$customerID': " . $stmt->error . "<br>";
    }
}

// Close statement and connection
$stmt->close();
?>
