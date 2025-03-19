<?php
session_start();
unset($_SESSION['aid']);
unset($_SESSION['aname']);
header("location:adminLogin.php");
