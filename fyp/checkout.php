<?php
session_start();
include_once('connection.php');
if (!isset($_SESSION['uid'])) {
    header('location:login.php');
}

$user_id = $_SESSION['uid'];
$uid = $_SESSION['uid'];
$dbh = new DB_con();
$uname = $dbh->getUserById($uid);

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('location:product_page.php');
    exit();
}

include_once('config.php');

$sql = "select * from customer where cust_id = :cust_id";
$statement = $db->prepare($sql);
$params = [
    'cust_id' => $user_id
];
$statement->execute($params);
$get_user_info = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($get_user_info as $user) {
    $fname = $user['cust_firstname'];
    $lname = $user['cust_lastname'];
    $email = $user['cust_email'];
    $town = $user['cust_town'];
    $street = $user['cust_street'];
    $address = $street . ' ' . $town;
}



//$cartItemCount = count($_SESSION['cart']);

if (isset($_POST['submit'])) {
    if (isset($user_id)) {

        $sql = 'insert into orders (o_date,o_total,cust_id,o_status) values (:o_date,:o_total,:cust_id,:o_status)';
        $statement = $db->prepare($sql);
        $params = [
            'o_date' => date('Y-m-d H:i:s'),
            'o_total' => 0,
            'cust_id' => $user_id,
            'o_status' => 0,
        ];

        $statement->execute($params);
        if ($statement->rowCount() == 1) {

            $get_order_id = $db->lastInsertId();

            if (isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
                $sqlDetails = 'insert into order_detail (o_id,stock_id,qty) values(:order_id,:stock_id,:qty)';
                $orderDetailStmt = $db->prepare($sqlDetails);

                //$totalPrice = 0;
                foreach ($_SESSION['cart'] as  $item) {
                    $totalPrice += $item['stock_price'] * $item['quantity'];

                    $quantity_query = "select stock_qty,stock_sale from stock where stock_id = :stock_id";
                    $qtystmt = $db->prepare($quantity_query);
                    $paramQty = [
                        "stock_id" => $item['stock_id'],
                    ];

                    $qtystmt->execute($paramQty);
                    $stqty = $qtystmt->fetch(PDO::FETCH_ASSOC);

                    $qty = $stqty['stock_qty'];
                    $sale = $stqty['stock_sale'];

                    $updateStock = "update stock set stock_qty =:stock_qty, stock_sale =:stock_sale  where stock_id =:stock_id";
                    $updateStockSmtm = $db->prepare($updateStock);
                    $newStockQty = $qty - $item['quantity'];
                    $sale = $sale + $item['quantity'];
                    $updateStockParams = [
                        'stock_qty' => $newStockQty,
                        'stock_id' => $item['stock_id'],
                        'stock_sale' => $sale
                    ];
                    $updateStockSmtm->execute($updateStockParams);
                    $paramOrderDetails = [
                        'order_id' =>  $get_order_id,
                        'stock_id' =>  $item['stock_id'],
                        'qty' =>  $item['quantity'],
                    ];
                    $orderDetailStmt->execute($paramOrderDetails);
                }

                $updateSql = 'update orders set o_total = :o_total where o_id = :o_id';

                $rs = $db->prepare($updateSql);
                $prepareUpdate = [
                    'o_total' => $totalPrice,
                    'o_id' => $get_order_id
                ];

                $rs->execute($prepareUpdate);

                unset($_SESSION['cart']);
                $_SESSION['confirm_order'] = true;
                header('location:thanks.php');
                exit();
            }
        } else {
            $errorMsg[] = 'Unable to save your order. Please try again';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <title>Checkout</title>
</head>

<body>


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="product_page.php">Product</a></li>
                            <li class="scroll-to-section"><a href=""><?= 'Wecome' . ' ' . $uname ?></a></li>
                            <li class="scroll-to-section"><a href="user_logout.php">Logout</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <div class="container" style="margin-top: 150px; margin-bottom:50px">
        <!-- <div class="row mt-2 mb-2">
            <div class="col-md-12 col-xs-12">
                <h1>
                    Cool T-Shirt Shop
                </h1>
            </div>
        </div> -->
        <div class="row mt-3">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $cartItem) {
                        $total += $cartItem['stock_price'] * $cartItem['quantity'];
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $cartItem['product_name'] ?></h6>
                                <small class="text-muted">Quantity: <?php echo $cartItem['quantity'] ?> X Price: <?php echo $cartItem['stock_price'] ?></small>
                            </div>
                            <span class="text-muted">Rs <?php echo $unitTotal = $cartItem['stock_price'] * $cartItem['quantity'] ?></span>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rupees)</span>
                        <strong>Rs <?= $total ?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <!-- <?php
                        if (isset($errorMsg) && count($errorMsg) > 0) {
                            foreach ($errorMsg as $error) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                        }
                        ?> -->
                <form class="needs-validation" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="First Name" value="<?= $fname ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Last Name" value="<?= $lname ?>" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?= $email ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?= $address ?>" readonly>
                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="">
                            <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Checkout</button>
                </form>
            </div>
        </div>

    </div>




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="assets/images/white-logo.png" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                            <li><a href="#">The Vale , Riviere du Rempart ,Mauritius</a></li>
                            <li><a href="#">nathanfab27@gmail.com</a></li>
                            <li><a href="#">+230 59036523</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Shopping &amp; Categories</h4>
                    <ul>
                        <li><a href="#">Plant Shopping</a></li>
                        <li><a href="#">Gardening Tool Shopping</a></li>
                        <li><a href="#">Potting Mix Shopping</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Homepage</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4>Help &amp; Information</h4>
                    <ul>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">FAQ's</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2023 Nouzardin Co., Ltd. All Rights Reserved.
                        </p>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>