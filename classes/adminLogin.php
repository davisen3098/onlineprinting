<?php
require_once '../config.php';
require_once '../vendor/autoload.php';

class adminLogin extends DBConnection {
    public function __construct() {
        parent::__construct();
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT AdminID, Password FROM admin WHERE Username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($AdminID, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['admin_id'] = $AdminID;
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                return "Invalid username or password.";
            }
        } else {
            return "Invalid username or password.";
        }
    }
}

$login = new adminLogin();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $message = $login->login($username, $password);
    } else {
        $message = "username and password are required.";
    }
}
