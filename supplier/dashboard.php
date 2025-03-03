<?php
session_start();
if (!isset($_SESSION['supplier_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Supplier Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['supplier_email']; ?>!</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</body>
</html>
