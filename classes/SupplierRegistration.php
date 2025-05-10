<?php
require_once '../config.php';

class SupplierRegistration extends DBConnection {
    public function __construct() {
        parent::__construct();
        error_reporting(0); // Disable in production
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        // Extract fields
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $phone    = trim($_POST['phone'] ?? '');
        $company  = trim($_POST['company'] ?? '');
        $brn      = trim($_POST['brn'] ?? '');
        $address  = trim($_POST['address'] ?? '');

        // Required fields check
        if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($company) || empty($brn) || empty($address)) {
            return "All fields are required.";
        }

        // BRN format check (9-digit)
        if (!preg_match('/^\d{9}$/', $brn)) {
            return "Invalid Business Registration Number. It must be exactly 9 digits.";
        }

        // Check email uniqueness
        $stmt = $this->conn->prepare("SELECT SupplierID FROM supplier WHERE Email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return "Email already exists.";
        }
        $stmt->close();

        // Check BRN uniqueness
        $stmt = $this->conn->prepare("SELECT SupplierID FROM supplier WHERE brn = ?");
        $stmt->bind_param('s', $brn);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return "Business Registration Number already exists.";
        }
        $stmt->close();

        // Validate and get uploaded file content
        if (!isset($_FILES['business_card']) || $_FILES['business_card']['error'] !== UPLOAD_ERR_OK) {
            return "Please upload a valid business card or registration document.";
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $mimeType = mime_content_type($_FILES['business_card']['tmp_name']);

        if (!in_array($mimeType, $allowedTypes)) {
            return "Only JPG, PNG, and PDF files are allowed.";
        }

        $fileData = file_get_contents($_FILES['business_card']['tmp_name']);

        // Hash password securely
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database with BLOB
        $stmt = $this->conn->prepare("INSERT INTO supplier (Name, Email, Password, Phone, CompanyName, Address, brn, business_card) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $null = NULL; // Placeholder for binary
        $stmt->bind_param('sssssssb', $name, $email, $hashed_password, $phone, $company, $address, $brn, $null);
        $stmt->send_long_data(7, $fileData); // bind BLOB data

        if ($stmt->execute()) {
            return "success";
        } else {
            return "Registration failed. Please try again.";
        }
    }
}

// Create instance and handle post
$register = new SupplierRegistration();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $register->register();
}
?>
