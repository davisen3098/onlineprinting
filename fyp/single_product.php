<?php
session_start();
include_once 'connection.php';
$db = new DB_con();
if (isset($_SESSION['uid'])) {

    $uid = $_SESSION['uid'];
    $uname = $db->getUserById($uid);

    if (isset($_GET['id'])) {
        $result = $db->getProductById($_GET['id']);
        //ti getUnit avant
        $unit_test = $db->getUnitById($_GET['id']);

        if (mysqli_num_rows($result) > 0) {
            //retrieving the current product information from sb
            while ($row = mysqli_fetch_assoc($result)) {
                $picture = $row['file_name'];
                $pid = $row['p_id'];
                $product_name = $row['p_name'];
                $product_description = $row['p_desc'];
                $stock_price = $row['stock_price'];
                $color = $row['color_name'];
                $color_id = $row['color_id'];
                $unit = $row['unit_name'];
                $unit_id = $row['unit_id'];
                $cat_id = $row['cat_id'];
                $stock_qty = $row['stock_qty'];
                $stock_id = $row['stock_id'];
            }

            $db_color = $db->getColorById($pid, $unit_id);
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
                    }
                } else {
                    echo "<script>alert('Product out of stock')</script>";
                }
            }

            $curl = curl_init();

            $video = "Grow" . $color  . $product_name . "plant";

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBFZl9zumaoFWsybzJf-0w8zMpEdVTzb7c&q=' . $video . '&type=video&part=snippet',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $data = json_decode($response);
        }
    } else {
        header("location:testHome.php");
    }
} else {
    header("location:login.php");
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /*****************globals*************/
        body {
            font-family: 'open sans';
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }

        .card {
            margin-top: 50px;
            background: #eee;
            padding: 3em;
            line-height: 1.5em;
        }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title,
        .price,
        .sizes,
        .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked,
        .price span {
            color: #ff9f1a;
        }

        .product-title,
        .rating,
        .product-description,
        .price,
        .vote,
        .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
            border: 3px solid black
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        /* .add-to-cart,
        .like {
            background: #ff9f1a;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        } */

        /* .add-to-cart:hover,
        .like:hover {
            background: #b36800;
            color: #fff;
        } */

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }

            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        #product-container {
            margin-top: 125px;
            /* margin-bottom: 175px; */
        }


        label.radio {
            cursor: pointer
        }

        label.radio input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.radio span {
            padding: 2px 9px;
            border: 2px solid #ff0000;
            display: inline-block;
            color: #ff0000;
            border-radius: 3px;
            text-transform: uppercase
        }

        label.radio input:checked+span {
            border-color: #ff0000;
            background-color: #ff0000;
            color: #fff
        }

        /*# sourceMappingURL=style.css.map */


        label.test {
            cursor: pointer
        }

        label.test input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: hidden;
            pointer-events: none
        }

        label.test span {
            height: 2em;
            width: 2em;
            vertical-align: middle;
            margin-right: 10px;
            /* padding: 2px 9px; */
            border: 2px solid black;
            display: inline-block;
            color: #ff0000;
            border-radius: 3px;
            /* text-transform: uppercase */
        }


        label.test input:checked+span {
            border: 5px solid #ff0000;
            /* background-color: ;
            color: #fff */
        }

        .btn-danger {
            background-color: #ff0000 !important;
            border-color: #ff0000 !important
        }

        .btn-danger:hover {
            background-color: #da0606 !important;
            border-color: #da0606 !important
        }

        .btn-danger:focus {
            box-shadow: none
        }


        /* .cart i {
            margin-right: 10px
        } */
    </style>


    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

    <title>Home</title>
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
                            <li class="scroll-to-section"><a href="product_page.php" class="">Product</a></li>
                            <li class="scroll-to-section"><a href="cart.php">Cart : <?= $count ?> </a></li>
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


    <div class="container" id="product-container">
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1"><img src="<?= 'img/' . $picture ?>" /></div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?= $unit . ' ' . $color . ' ' . $product_name ?></h3>
                        <div class="rating">
                            <div class="stars">
                                Average rating :
                                <?php
                                $star_count = 5;
                                $rating = $db->getRating($pid);
                                $star_left = $star_count - $rating;

                                for ($i = 0; $i < $star_count; $i++) {
                                    if ($star_count && $rating > 0) {
                                ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="fa fa-star"></span>
                                <?php
                                    }
                                    $rating--;
                                }
                                ?>
                            </div>

                            <?php
                            $review_count = $db->getNumberOfReviews($pid);
                            ?>

                        </div>
                        <span class="review-no mb-2"><strong> Number of reviews :</strong> <?= $review_count . ' ' . 'reviews' ?></span>
                        <span class="review-no mb-2"><strong> Stock Available :</strong> <?= $stock_qty ?></span>
                        <p class="product-description"><strong>Description:</strong> <?= $product_description ?></p>
                        <h4 class="price">current price: <span><?= 'Rs' . ' ' . $stock_price ?></span></h4>

                        <div class="sizes">
                            <h6 class="text-uppercase mb-1">Size available:</h6>
                            <?php
                            foreach ($unit_test as $row) {
                                $unid = $row['unit_id'];
                                $change_unit = $db->getProductByUnit($unid, $pid, $color_id);
                            ?>
                                <label class="radio">
                                    <a href="single_product.php?id=<?= $change_unit ?>">
                                        <input type="radio" name="size" value="S" <?php if ($unit == $row['unit_name']) { ?> checked <?php } ?>>
                                        <span><?= $row['unit_name'] ?></span>
                                    </a>
                                </label>

                            <?php } ?>

                        </div>
                        <h5 class="colors">colors:
                            <?php
                            foreach ($db_color as $col) {
                                $cid = $col['color_id'];
                                $change_color = $db->getProductByColor($unit_id, $pid, $cid);
                            ?>
                                <label class="test">
                                    <a href="single_product.php?id=<?= $change_color ?>">
                                        <input type="radio" name="size" <?php if ($color == $col['color_name']) { ?> checked <?php } ?>>
                                        <span class="color-test" style="background-color:<?= $col['color_name'] ?>;"></span>
                                    </a>
                                </label>

                            <?php } ?>
                        </h5>
                        <div class="cart mt-4 align-items-center">

                            <form action="" method="post">
                                <input type="hidden" name="stock_id" value="<?= $stock_id ?>">
                                <input type="hidden" name="stock_price" value="<?= $stock_price ?>">
                                <input type="hidden" name="unit_name" value="<?= $unit ?>">
                                <input type="hidden" name="stock_qty" value="<?= $stock_qty ?>">
                                <input type="hidden" name="file_name" value="<?= $picture ?>">
                                <input type="hidden" name="color_name" value="<?= $color ?>">
                                <input type="hidden" name="p_name" value="<?= $product_name ?>">
                                <button name="submit" type="submit" class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button>
                                <buttonc class="btn btn-danger mr-2 px-3"><i class="fa fa-heart"></i></buttonc>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Related Videos</h2>
                        <span>These videos will help you on how to grow and take care of your plants</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">
                            <?php
                            foreach ($data->items as $items) {
                                $id = $items->id->videoId;
                            ?>
                                <iframe width="420" height="315" src="<?= 'https://www.youtube.com/embed/' . $id ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Related products</h2>
                        <span>Product that are related to the current product </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel">

                            <?php
                            $related_prod = $db->relatedProducts($cat_id);
                            if (mysqli_num_rows($related_prod) > 0) {
                                foreach ($related_prod as $cat) {
                            ?>
                                    <div class="item">
                                        <div class="thumb">
                                            <div class="hover-content">
                                                <ul>
                                                    <li><a href="single-product.html"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="single-product.html"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="single-product.html"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <img src="<?= 'img/' . $cat["file_name"] ?>" alt="">
                                        </div>
                                        <div class="down-content">
                                            <h4><?= $cat["p_name"] ?></h4>
                                            <span>Rs <?= $cat['stock_price'] ?></span>
                                            <ul class="stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                            </ul>
                                        </div>
                                    </div>

                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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