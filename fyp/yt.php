<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyBFZl9zumaoFWsybzJf-0w8zMpEdVTzb7c&q=red%20rose%20care&type=video&part=snippet',
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

  <title>Document</title>
</head>

<body>
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
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#men">Men's</a></li>
              <li class="scroll-to-section"><a href="#women">Women's</a></li>
              <li class="scroll-to-section"><a href="#kids">Kid's</a></li>
              <li class="submenu">
                <a href="javascript:;">Pages</a>
                <ul>
                  <li><a href="about.html">About Us</a></li>
                  <li><a href="products.html">Products</a></li>
                  <li><a href="single-product.html">Single Product</a></li>
                  <li><a href="contact.html">Contact Us</a></li>
                </ul>
              </li>
              <!-- <li class="scroll-to-section"><a href="#kids"><?= 'Wecome' . ' ' . $uname ?></a></li>
              <li class="scroll-to-section"><a href="user_logout.php">Logout</a></li> -->
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

  <section class="section" id="men">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Latest Plant</h2>
            <span>Lastest Plant added in our stock</span>
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