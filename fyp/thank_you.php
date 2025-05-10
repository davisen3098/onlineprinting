<?php
session_start();

if (!isset($_SESSION['confirm_order']) || empty($_SESSION['confirm_order'])) {
    header('location:product_page.php');
    exit();
}

include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <h1>Thank you!</h1>
            <p>
                Your order has been placed.
                <?php unset($_SESSION['confirm_order']); ?>
            </p>
        </div>
    </div>
</body>

</html>