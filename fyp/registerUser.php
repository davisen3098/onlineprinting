<?php
// include Function  file
include_once('connection.php');
// Object creation
$userdata = new DB_con();


if (isset($_POST['submit'])) {

    // Posted Values
    $dob = $_POST['dob'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    //Function Calling
    //$sql = $userdata->registration($username, $email, $password, $dob);
    if ($sql) {
        // Message for successfull insertion
        echo "<script>alert('Registration successfull.');</script>";
        echo "<script>window.location.href='userLogin.php'</script>";
    } else {
        // Message for unsuccessfull insertion
        echo "<script>alert('Something went wrong. Please try again');</script>";
        echo "<script>window.location.href='registration.php'</script>";
    }
}
