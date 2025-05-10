<?php
session_start();
// include connection  file
include_once('connection.php');
include_once('phpMailer.php');
// Object creation;
$db = new DB_con();
if (isset($_POST['submit'])) {
    // Posted Values
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Function Calling
    $result = $db->userLogin($username, $password);
    $num = mysqli_fetch_array($result);
    if ($num > 0) {
        $_SESSION['uid'] = $num['cust_id'];
        $_SESSION['uname'] = $num['cust_username'];
        $_SESSION['umobile'] = $num['cust_mobile'];
        $log_count = $num['cust_log_count'];
        $email = $num['cust_email'];


        if (!empty($_POST["remember"])) {
            setcookie("userLogin", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));
            setcookie("userPassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["userLogin"])) {
                setcookie("userLogin", "");
            }
            if (isset($_COOKIE["userPassword"])) {
                setcookie("userPassword", "");
            }
        }

        if ($log_count == 0) {
            // generate OTP
            $otp = rand(100000, 999999);

            $mailStatus = sendMail($email, $otp);

            if ($mailStatus = true) {
                $result = $db->addOtp($_SESSION['uid'], $otp);
            }
            //redirect to otp page
            echo "<script>window.location.href='otp.php'</script>";
        } elseif ($log_count == 1) {
            //redirect directly to home page
            echo "<script>window.location.href='product_page.php'</script>";
        }
    } else {
        // Message for unsuccessfull login
        echo "<script>alert('Invalid credentials Please try again');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!-- <link rel="stylesheet" href="admin.css"> -->
    <style>
        #lgfrm {
            background-image: url('img/wall.jpg');
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        /* 
        body {
            background-color: #616F39;
        } */
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
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="index.php">Home</a></li>
                            <li class="scroll-to-section"><a href="contact.php">Contact us</a></li>
                            <li class="submenu">
                                <a href="javascript:;" class="active">User</a>
                                <ul>
                                    <li><a href="registration.php">Sign Up</a></li>
                                    <li><a href="login.php">Sign In</a></li>
                                </ul>
                            </li>
                            <li class="scroll-to-section"><a href="#explore">Explore</a></li>
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

    <!-- Login Form Area Start -->
    <section class="vh-100" id="lgfrm">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100 ">
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form action="" method="post">
                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <input type="username" name="username" placeholder="Username" class="form-control form-control-lg" value="<?php if (isset($_COOKIE["userLogin"])) {
                                                                                                                                            echo $_COOKIE["userLogin"];
                                                                                                                                        } ?>" />
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" placeholder="Password" class="form-control form-control-lg" value="<?php if (isset($_COOKIE["userPassword"])) {
                                                                                                                                            echo $_COOKIE["userPassword"];
                                                                                                                                        } ?>" />
                        </div>
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" <?php if (isset($_COOKIE["userLogin"])) { ?> checked <?php } ?> />
                                <label class="form-check-label text-warning" for="form1Example3"> Remember me </label>
                            </div>
                            <a href="" class="text-warning">Forgot password?</a>
                        </div>

                        <!-- Submit button -->
                        <input type="submit" value="Sign in" name="submit" class="btn btn-primary btn-lg btn-block">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Form Area End -->

    <!-- Footer Start -->
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
    <!-- Footer Ends -->
    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>