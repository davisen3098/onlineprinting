<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location:login.php');
}
include_once('connection.php');
include_once('config.php');
$database = new DB_con();
$uid = $_SESSION['uid'];
$uname = $database->getUserById($uid);
$result = $database->getAllStock();

if (isset($_SESSION['cart'])) {
    if (count($_SESSION['cart']) > 0) {
        $count = count($_SESSION['cart']);
    } else {
        $count = 0;
    }
} else {
    $count = 0;
}

if (isset($_POST['submit'], $_POST['stock_id'])) {
    if ($_POST['stock_qty'] > 0) {
        if (isset($_SESSION['cart'])) {

            $item_array_id = array_column($_SESSION['cart'], "stock_id");

            if (in_array($_POST['stock_id'], $item_array_id)) {
                echo "<script>alert('Product is already added in the cart..!')</script>";
                echo "<script>window.location = 'product_page.php'</script>";
            } else {

                $count = count($_SESSION['cart']);
                $item_array = array(
                    'stock_id' => $_POST['stock_id'],
                    'stock_price' => $_POST['stock_price'],
                    'unit_name' => $_POST['unit_name'],
                    'quantity' => 1,
                    'stock_qty' => $_POST['stock_qty'],
                    'color_name' => $_POST['color_name'],
                    'file_name' => 'img/' . $_POST['file_name'],
                    'product_name' => $_POST['p_name'],
                );

                $_SESSION['cart'][$count] = $item_array;
                $count = count($_SESSION['cart']);
                echo "<script>alert('Product added to cart')</script>";
            }
        } else {

            $item_array = array(
                'stock_id' => $_POST['stock_id'],
                'stock_price' => $_POST['stock_price'],
                'unit_name' => $_POST['unit_name'],
                'quantity' => 1,
                'stock_qty' => $_POST['stock_qty'],
                'color_name' => $_POST['color_name'],
                'file_name' => 'img/' . $_POST['file_name'],
                'product_name' => $_POST['p_name'],

            );

            // Create new session variable
            $_SESSION['cart'][0] = $item_array;
            $count = count($_SESSION['cart']);
            echo "<script>alert('Product added to cart')</script>";
        }
    } else {
        echo "<script>alert('Product out of stock')</script>";
        echo "<script>window.location = 'product_page.php'</script>";
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



    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">

    <style>
        #loading {
            text-align: center;
            background: url('img/loader.gif') no-repeat center;
            height: 150px;
        }
    </style>


    <title>Product Page</title>
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
                            <li class="scroll-to-section"><a href="cart.php">Cart : <?= $count ?> </a></li>
                            <li class="submenu">
                                <a href="javascript:;">Profile</a>
                                <ul>
                                    <li><a href="updateProfile.php">Update Profile</a></li>
                                    <li><a href="view-order.php">View Orders</a></li>
                                    <li><a href="wishlist.php">View Wishlist</a></li>

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



    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading-two" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Check our products </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="list-group" style="border:1px solid black;">
                    <h4 class="text-center">Categories</h4>
                    <div style="height: 180px;overflow-y: auto; overflow-x: hidden;">
                        <div class="list-group">
                            <?php
                            $query = "SELECT DISTINCT(cat_name) FROM category";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $rs = $statement->fetchAll();
                            foreach ($rs as $row) {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="checkbox" class="common_selector category" value="<?php echo $row['cat_name']; ?>"> <?php echo $row['cat_name']; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="list-group" style="border:1px solid black;">
                    <h4 class="text-center">Product Type</h4>
                    <div style="height: 180px;overflow-y: auto; overflow-x: hidden;">
                        <div class="list-group">
                            <?php
                            $query = "SELECT DISTINCT(pt_name) FROM product_type";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $rs = $statement->fetchAll();
                            foreach ($rs as $row) {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="checkbox" class="common_selector product_type" value="<?php echo $row['pt_name']; ?>"> <?php echo $row['pt_name']; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="list-group" style="border:1px solid black;">
                    <h4 class="text-center">Colors</h4>
                    <div style="height: 180px;overflow-y: auto; overflow-x: hidden;">
                        <div class="list-group">
                            <?php
                            $query = "SELECT DISTINCT(color_name) FROM color";
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $rs = $statement->fetchAll();
                            foreach ($rs as $row) {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="checkbox" class="common_selector color" value="<?php echo $row['color_name']; ?>"> <?php echo $row['color_name']; ?></label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Latest Plant Area Starts ***** -->
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>All products</h2>
                        <span>All the products available on our website</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row filter_data">
                <!-- <?php if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $cat) {
                        ?>
                        <div class="col-md-4 mt-5">
                            <div class="men-item-carousel">
                                <div class="item">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <form action="" method="post">
                                                <ul>
                                                    <li><a href="single_product.php?id=<?= $cat['stock_id'] ?>"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="review_product.php?id=<?= $cat['stock_id'] ?>"><i class="fa fa-star"></i></a></li>
                                                    <input type="hidden" name="stock_id" value="<?= $cat['stock_id'] ?>">
                                                    <input type="hidden" name="stock_price" value="<?= $cat['stock_price'] ?>">
                                                    <input type="hidden" name="unit_name" value="<?= $cat['unit_name'] ?>">
                                                    <input type="hidden" name="stock_qty" value="<?= $cat['stock_qty'] ?>">
                                                    <input type="hidden" name="file_name" value="<?= $cat['file_name'] ?>">
                                                    <input type="hidden" name="color_name" value="<?= $cat['color_name'] ?>">
                                                    <input type="hidden" name="p_name" value="<?= $cat['p_name'] ?>">
                                                    <li><button id="test-button" type="submit" name="submit"><i class="fa fa-shopping-cart"></i></button></li>
                                                </ul>
                                            </form>
                                        </div>
                                        <img src="<?= 'img/' . $cat["file_name"] ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <h4><?= $cat["p_name"] ?></h4>
                                        <span><?= 'Rs' . $cat['stock_price'] ?></span>
                                        <ul class="stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                            }
                        }
                ?> -->

            </div>
        </div>
        </div>
    </section>
    <!-- ***** Latest Plant Area Ends ***** -->

    <!-- ***** Footer Start ***** -->
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


    <!-- Plugins -->
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="assets/js/datepicker.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/isotope.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {

            filter_data();
            $('.filter_data').html('<div id="loading" style=""></div>');

            function filter_data() {
                var action = 'fetch_data';
                var product_type = get_filter('product_type');
                var category = get_filter('category');
                var color = get_filter('color');
                $.ajax({
                    url: "fetch_data.php",
                    method: "POST",
                    data: {
                        action: action,
                        category: category,
                        product_type: product_type,
                        color: color,
                    },
                    success: function(data) {
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function() {
                filter_data();
            });

            // $('#price_range').slider({
            //     range: true,
            //     min: 1000,
            //     max: 65000,
            //     values: [1000, 65000],
            //     step: 500,
            //     stop: function(event, ui) {
            //         $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            //         $('#hidden_minimum_price').val(ui.values[0]);
            //         $('#hidden_maximum_price').val(ui.values[1]);
            //         filter_data();
            //     }
            // });

        });




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

</body>

</html>