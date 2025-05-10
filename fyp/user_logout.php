<?php
session_start();
unset($_SESSION['uid']);
unset($_SESSION['cart']);
unset($_SESSION['uname']);
unset($_SESSION['umobile']);
header("location:login.php");
