<?php
// include Function  file
include_once('connection.php');
// Object creation
$db = new DB_con();


if (isset($_POST['submit'])) {


  // Posted Values
  $username = $_POST['uname'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $mob = $_POST['mobile'];
  $dob = $_POST['dob'];
  $town = $_POST['town'];
  $street = $_POST['street'];
  $zip = $_POST['zip'];
  $password = $_POST['pwd'];

  // File upload path
  $targetDir = "img/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (!empty($_FILES["file"]["name"])) {
    $allowTypes = array('jpg', 'png', 'jpeg');
    if (in_array($fileType, $allowTypes)) {
      //Function Calling
      $result = $db->registration($username, $fname, $lname, $password, $email, $mob, $dob, $street, $town, $zip, $fileName);
      if ($result) {
        echo "<script> alert('Registration successfull')</script>";
        echo "<script>window.location.href='login.php'</script>";
      } else {
        echo "<script> alert('Username already exists') </script>";
      }
    } else {
      echo "<script> alert('Only jpg , png and jpeg images allowed') </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title> User registration </title>

  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/templatemo-hexashop.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script> -->
  <link rel="stylesheet" href="login.css" />
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
              <li class="submenu">
                <a href="javascript:;" class="active">User</a>
                <ul>
                  <li><a href="registration.php">Sign Up</a></li>
                  <li><a href="login.php">Sign In</a></li>
                </ul>
              </li>
              <li class="scroll-to-section"><a href="#contact.php">Contact Us</a></li>
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

  <div class="backdrop mt-4">
    <div class="col-md-4 mx-auto forms">
      <h4 class="text-center">SIGN UP</h4>
      <br />
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-12" id="fname-box">
          <input type="text" class="form-control" placeholder="First Name" required id="fname" name="fname" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="fname-msg"></span>
        </div>
        <div class="form-group col-md-12" id="lname-box">
          <input type="text" class="form-control" placeholder="Last Name" required id="lname" name="lname" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="lname-msg"></span>
        </div>

        <div class="form-group col-md-12" id="uname-box">
          <input type="text" class="form-control" placeholder="Username" required id="uname" name="uname" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="uname-msg"></span>
        </div>

        <div class="form-group col-md-12" id="email-box">
          <input type="email" class="form-control" placeholder="Email Address" required id="email" name="email" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="email-msg"></span>
        </div>

        <div class="form-group col-md-12" id="mobile-box">
          <input type="number" class="form-control" placeholder="Mobile" required id="mobile" name="mobile" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="mobile-msg"></span>
        </div>
        <div class="form-group col-md-12" id="dob-box">
          <input type="date" class="form-control" placeholder="Date of birth" required id="dob" name="dob" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="dob-msg"></span>
        </div>

        <div class="form-group col-md-12" id="town-box">
          <input type="text" class="form-control" placeholder="Town" required id="town" name="town" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="town-msg"></span>
        </div>

        <div class="form-group col-md-12" id="street-box">
          <input type="text" class="form-control" placeholder="Street" required id="street" name="street" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="street-msg"></span>
        </div>

        <div class="form-group col-md-12" id="zip-box">
          <input type="number" class="form-control" placeholder="Zip Code" required id="zip" name="zip" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="zip-msg"></span>
        </div>
        <div class="form-group col-md-12">
          <div class="form-group mt-3">
            <label>Choose profile picture to upload</label>
            <input type="file" name="file" />
          </div>
        </div>
        <div class="form-group col-md-12" id="pwd-box">
          <input type="password" class="form-control" placeholder="Password" required id="pwd" name="pwd" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="pwd-msg"></span>
        </div>
        <div class="form-group col-md-12" id="cpwd-box">
          <input type="password" class="form-control" placeholder="Confirm Password" required id="cpwd" />
          <i class="fa fa-check-circle success_icon"></i>
          <i class="fa fa-exclamation-circle error_icon"></i>
          <span id="cpwd-msg"></span>
        </div>
        <div class="form-group col-md-12">
          <input type="submit" class="btn btn-warning form-control" value="Register" name="submit" />
        </div>
      </form>
    </div>

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

    <script>
      $("#fname").focusout(function() {
        fname_check();
      });
      $("#lname").focusout(function() {
        lname_check();
      });
      $("#email").focusout(function() {
        email_check();
      });
      $("#pwd").focusout(function() {
        pwd_check();
      });
      $("#cpwd").focusout(function() {
        cpwd_check();
      });

      $("#mobile").focusout(function() {
        mobile_check();
      });

      $("#uname").focusout(function() {
        username_check();
      });

      $("#dob").focusout(function() {
        checkAge();
      });

      $("#street").focusout(function() {
        street_check();
      });

      $("#town").focusout(function() {
        town_check();
      });

      $("#zip").focusout(function() {
        zip_check();
      });

      function fname_check() {
        var name = /^[a-zA-Z]*$/;
        var fname = $("#fname").val();

        if (name.test(fname) && fname !== "") {
          $("#fname-box").removeClass("error");
          $("#fname-box").toggleClass("success");
          $("#fname-msg").html("First Name is Correct");
        } else {
          $("#fname-box").removeClass("success");
          $("#fname-box").toggleClass("error");
          $("#fname-msg").html(
            "Special Characters or numbers  are not allowed"
          );
        }
      }

      function lname_check() {
        var name = /^[a-zA-Z]*$/;
        var lname = $("#lname").val();

        if (name.test(lname) && lname !== "") {
          $("#lname-box").removeClass("error");
          $("#lname-box").toggleClass("success");
          $("#lname-msg").html("Last Name is Correct");
        } else {
          $("#lname-box").removeClass("success");
          $("#lname-box").toggleClass("error");
          $("#lname-msg").html(
            "Special Characters or numbers  are not allowed"
          );
        }
      }

      function username_check() {
        var uname = $("#lname").val();

        if (uname != "") {
          $("#uname-box").removeClass("error");
          $("#uname-box").toggleClass("success");
          $("#uname-msg").html("Username is Correct");
        } else {
          $("#uname-box").removeClass("success");
          $("#uname-box").toggleClass("error");
          $("#uname-msg").html("Username cannot be empty");
        }
      }

      function town_check() {
        var name = /^[a-zA-Z]*$/;
        var town = $("#town").val();

        if (name.test(town) && town !== "") {
          $("#town-box").removeClass("error");
          $("#town-box").toggleClass("success");
          $("#town-msg").html("Town name is Correct");
        } else {
          $("#town-box").removeClass("success");
          $("#town-box").toggleClass("error");
          $("#town-msg").html("");
        }
      }

      function street_check() {

        var name = /^[a-zA-Z]*$/;
        var street = $("#street").val();

        if (name.test(street) && street !== "") {
          $("#street-box").removeClass("error");
          $("#street-box").toggleClass("success");
          $("#street-msg").html("Street name is Correct");
        } else {
          $("#street-box").removeClass("success");
          $("#street-box").toggleClass("error");
          $("#street-msg").html("Special Characters or numbers  are not allowed");
        }
      }

      function email_check() {
        var pattern =
          /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var email = $("#email").val();

        if (pattern.test(email) && email !== "") {
          $("#email-box").removeClass("error");
          $("#email-box").toggleClass("success");
          $("#email-msg").html("Email is Available");
        } else {
          $("#email-box").removeClass("success");
          $("#email-box").toggleClass("error");
          $("#email-msg").html("Invalid Email Format");
        }
      }

      //function to validate the password
      function pwd_check() {
        var pwd = $("#pwd").val().length;

        if (pwd >= 6) {
          $("#pwd-box").removeClass("error");
          $("#pwd-box").toggleClass("success");
          $("#pwd-msg").html("Strong");
        } else {
          $("#pwd-box").removeClass("success");
          $("#pwd-box").toggleClass("error");
          $("#pwd-msg").html("Password must be greater than 6 Characters");
        }
      }

      // function to check if the zip code is 6 digits in length
      function zip_check() {
        var pwd = $("#zip").val().length;

        if (pwd >= 6) {
          $("#zip-box").removeClass("error");
          $("#zip-box").toggleClass("success");
          $("#zip-msg").html("Strong");
        } else {
          $("#zip-box").removeClass("success");
          $("#zip-box").toggleClass("error");
          $("#zip-msg").html("Zip code  must be 6 digits in lenght");
        }
      }

      //function to validate the mobile number
      function mobile_check() {
        var mob = $("#mobile").val().length;

        if (mob == 8) {
          $("#mobile-box").removeClass("error");
          $("#mobile-box").toggleClass("success");
          $("#mobile-msg").html("Valid Mobile Number");
        } else {
          $("#mobile-box").removeClass("success");
          $("#mobile-box").toggleClass("error");
          $("#mobile-msg").html("Password must only contain 8 numbers");
        }
      }

      function cpwd_check() {
        var pwd = $("#pwd").val();
        var cpwd = $("#cpwd").val();

        if (pwd !== cpwd) {
          $("#cpwd-box").removeClass("success");
          $("#cpwd-box").toggleClass("error");
          $("#cpwd-msg").html("Password does not match");
        } else {
          $("#cpwd-box").removeClass("error");
          $("#cpwd-box").toggleClass("success");
          $("#cpwd-msg").html("Password Match");
        }
      }

      function checkAge() {
        var dob = $("#dob").val();
        if ($("#dob").val() == "") {
          $("#dob-box").removeClass("success");
          $("#dob-box").toggleClass("error");
          $("#dob-msg").html("Please enter your date of birth");
        }
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        if (age < 18) {
          $("#dob-box").removeClass("success");
          $("#dob-box").toggleClass("error");
          $("#dob-msg").html(
            "You must have at least 18 years old to be able to register"
          );
        }

        if (age > 110) {
          $("#dob-box").removeClass("success");
          $("#dob-box").toggleClass("error");
          $("#dob-msg").html("You cannot be older than 110 years old");
        }
      }
    </script>
  </div>



</body>

</html>