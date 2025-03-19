<?php
// include Function  file
include_once('../connection.php');
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
    //Function Calling
    $result = $db->registration($username, $lname, $fname, $town, $street, $zip, $email, $dob, $mob, $password);
    if ($result) {
        // Message for successfull insertion
        echo "<script>alert('Registration successfull.');</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else {
        // Message for unsuccessfull insertion
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='registration.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../login.css" />
</head>

<body>
    <div class="backdrop">
        <div class="col-md-4 mx-auto forms">
            <h4 class="text-center">SIGN UP</h4>
            <br />
            <form action="" method="post">

                <div class="form-group col-md-12" id="uname-box">
                    <input type="text" class="form-control" placeholder="Username" required id="uname" name="uname" />
                    <i class="fa fa-check-circle success_icon"></i>
                    <i class="fa fa-exclamation-circle error_icon"></i>
                    <span id="uname-msg"></span>
                </div>



                <div class="form-group col-md-12" id="pwd-box">
                    <input type="password" class="form-control" placeholder="Password" required id="pwd" name="pwd" />
                    <i class="fa fa-check-circle success_icon"></i>
                    <i class="fa fa-exclamation-circle error_icon"></i>
                    <span id="pwd-msg"></span>
                </div>

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-warning form-control" value="submit" name="submit" />
                </div>
            </form>
        </div>
        <script>
           $("#pwd").focusout(function() {
                pwd_check();
            });
 

            $("#uname").focusout(function() {
                username_check();
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

                if (uname !== "") {
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
                var uname = $("#town").val();

                if (uname !== "") {
                    $("#town-box").removeClass("error");
                    $("#town-box").toggleClass("success");
                    $("#town-msg").html("Town name is Correct");
                } else {
                    $("#town-box").removeClass("success");
                    $("#town-box").toggleClass("error");
                    $("#town-msg").html("Town name cannot be empty");
                }
            }

            function street_check() {
                var uname = $("#street").val();

                if (uname !== "") {
                    $("#street-box").removeClass("error");
                    $("#street-box").toggleClass("success");
                    $("#street-msg").html("Street name is Correct");
                } else {
                    $("#street-box").removeClass("success");
                    $("#street-box").toggleClass("error");
                    $("#street-msg").html("Street name cannot be empty");
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
                    $("#email-msg").html("Invalid Email Address");
                }
            }

            //function to validate the password
            function pwd_check() {
                var pwd = $("#pwd").val().length;

                if (pwd > 6) {
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

                if (pwd > 6) {
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