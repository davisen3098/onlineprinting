<?php
require_once '../config.php';

class SupplierRegistration extends DBConnection {
    public function __construct() {
        parent::__construct();
        error_reporting(0); // Disable error display for security
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        extract($_POST);

        // Validate required fields
        if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($company) || empty($address)) {
            return "All fields are required.";
        }

        // Check if email already exists
        $stmt = $this->conn->prepare("SELECT SupplierID FROM supplier WHERE Email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return "Email already exists.";
        }
        $stmt->close();

        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert supplier into database
        $stmt = $this->conn->prepare("INSERT INTO supplier (Name, Email, Password, Phone, CompanyName, Address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssss', $name, $email, $hashed_password, $phone, $company, $address);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "Registration failed. Please try again.";
        }
    }
}

// Create instance
$register = new SupplierRegistration();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $register->register();
}
?>