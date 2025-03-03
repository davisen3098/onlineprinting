<?php
require_once '../config.php';

class SupplierLogin extends DBConnection {
    public function __construct() {
        parent::__construct();
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT SupplierID, Password FROM supplier WHERE Email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($supplierID, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['supplier_id'] = $supplierID;
                $_SESSION['supplier_email'] = $email;
                header("Location: dashboard.php");
                exit();
            } else {
                return "Invalid email or password.";
            }
        } else {
            return "Invalid email or password.";
        }
    }
}

$login = new SupplierLogin();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $message = $login->login($email, $password);
    } else {
        $message = "Email and password are required.";
    }
}
