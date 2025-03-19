<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location:login.php');
}


include_once('connection.php');
$db = new DB_con();
$uid = $_SESSION['uid'];
$uname = $db->getUserById($uid);

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["stock_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}


if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'update') {
        // echo "<script>console.log('wawa)</script>";
        $total = 0;
        foreach ($_SESSION['cart'] as $k => $v) {
            if ($_POST["stock_id"] == $k) {
                if ($_POST["quantity"] == '0') {
                    unset($_SESSION["cart"][$k]);
                } else {
                    $_SESSION['cart'][$k]["quantity"] = $_POST["quantity"];
                }
            }
            $total += $_SESSION['cart'][$k]["stock_price"] * $_SESSION['cart'][$k]["quantity"];
        }
        if ($total != 0 && is_numeric($total)) {
            print number_format($total, 2);
            exit;
        }
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">


    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

    <style>
        img {
            max-width: 100%;
            height: auto;
            background: lightblue;
            background: radial-gradient(white 30%, lightblue 70%);
        }

        .fa-star,
        .fa-star-half {
            color: yellowgreen;
            padding: 3% 0;
        }

        #cart_count {
            text-align: center;
            padding: 0 0.9rem 0.1rem 0.9rem;
            border-radius: 3rem;
        }

        .shopping-cart {
            padding: 3% 0;
        }

        .cart-items+.cart-items {
            padding: 2% 0;
        }

        .price-details h6 {
            padding: 3% 2%;
        }

        .container-fluid {
            margin-top: 150px;
        }
    </style>
</head>

<body>


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                        <li class="scroll-to-section"><a href="index.php">Home</a></li>
                            <li class="scroll-to-section"><a href="product_page.php">Product</a></li>
                            <li class="submenu">
                                <a href="javascript:;">User</a>
                                <ul>
                                    <li><a href="about.html">Update Profile</a></li>
                                    <li><a href="products.html">View Orders</a></li>
                                    <li><a href="single-product.html">Wishlist</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#kids"><?= 'Wecome' . ' ' . $uname ?></a></li>
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






    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">

                <div class="shopping-cart">
                    <h6>My Cart</h6>
                    <hr>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $k => $prod) {
                            $total = $total + $prod['stock_price'] * $prod['quantity'];
                    ?>
                            <form action="cart.php?action=remove&id=<?= $prod['stock_id'] ?>" method="post" class="cart-items">
                                <div class="border rounded">
                                    <div class="row bg-white">
                                        <div class="col-md-3 pl-0">
                                            <img src="<?= $prod["file_name"] ?>" alt="Image1" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <h5 class="pt-2">Name: <?= $prod['color_name'] . ' ' . $prod['product_name'] ?></h5>
                                            <h5 class="pt-2">Price : Rs <?= $prod['stock_price'] ?></h5>
                                            <h5 class="pt-2">Size : <?= $prod['unit_name'] ?></h5>
                                            <h5 class="pt-2">Available : <?= $prod['stock_qty'] ?></h5>
                                        </div>
                                        <div class="col-md-3 py-5">
                                            <div>
                                                <h6 class="mb-2">Quantity : <input type="text" name="quantity" id="<?= $k ?>" value="<?= $prod['quantity'] ?>" class="form-control w-50 d-inline" onBlur="saveCart(this);"></h6>
                                                <button type="submit" class="btn btn-danger" name="remove">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    } else {
                        echo "<h5 class='text-center mt-5'> Cart is empty</h5>";
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-4 offset-md-1 border rounded mt-5 mb-5 bg-white h-25">
                <div class="pt-4">
                    <h6>PRICE DETAILS</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price (0 items)</h6>";
                            }
                            ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Amount Payable</h6>
                        </div>
                        <div class="col-md-6">
                            <h6>Rs <?php echo $total; ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6 id="total_price"><?php
                                                    echo $total;
                                                    ?></h6>
                        </div>
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <a href="product_page.php">
                            <button class="btn btn-warning">Continue Shopping</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="checkout.php">
                            <button class="btn btn-success"> Go to checkout </button>
                        </a>
                    </div>
                </div>
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

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>
        function saveCart(obj) {
            var quantity = $(obj).val();
            var stock_id = $(obj).attr("id");
            console.log(obj);
            console.log(quantity);
            console.log(stock_id);
            $.ajax({
                url: "?action=update",
                type: "POST",
                data: {
                    "stock_id": stock_id,
                    "quantity": quantity
                },
                success: function(data, status) {
                    $("#total_price").html(data)
                    console.log(data);
                },
                error: function() {
                    alert("Problem in sending reply");
                }
            });
        }
        $(function() {
            var selectedClass = "";
            $("p").click(function() {
                selectedClass = $(this).attr("data-rel");
                $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("." + selectedClass).fadeOut();
                setTimeout(function() {
                    $("." + selectedClass).fadeIn();
                    $("#portfolio").fadeTo(50, 1);
                }, 500);

            });
        });
    </script>

    <!-- 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
</body>

</html>