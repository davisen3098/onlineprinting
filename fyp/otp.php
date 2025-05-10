<?php
session_start();
$uid = $_SESSION['uid'];
$sub = substr($_SESSION['umobile'], 6);
include_once('connection.php');
$db = new DB_con();
if (isset($_POST['submit'])) {
	$num1 = $_POST['num1'];
	$num2 = $_POST['num2'];
	$num3 = $_POST['num3'];
	$num4 = $_POST['num4'];
	$num5 = $_POST['num5'];
	$num6 = $_POST['num6'];

	$otp = $num1 . $num2 . $num3 . $num4 . $num5 . $num6;

	// get the user's otp number from DB
	$result = $db->getOtp($uid);
	$num = mysqli_fetch_array($result);
	if ($num > 0) {
		$db_otp = $num['otp'];
		$result = $db->checkOtp($db_otp);

		if ($result == true) {
			if ($otp == $db_otp) {
				// otp matches
				$unsetLogcount = $db->unsetLogcount($uid);
				echo "<script>window.location.href='product_page.php'</script>";
			} else {
				// otp does not match
				echo "<script>alert('Wrong Otp')</script>";
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="css/otp.css">
	<title> OTP verification</title>
</head>

<body>
	<div class="container d-flex justify-content-center align-items-center">

		<div class="card text-center">

			<div class="card-header p-5">
				<img src="img/otp_image.png">
				<h5 class="mb-2">OTP VERIFICATION</h5>
				<div>
					<!-- <small>code has been send to <?php echo $mobile ?> </small> -->
					<small> code has been sent to your mail</small>
				</div>
			</div>
			<form action="" method="post">
				<div class="input-container d-flex flex-row justify-content-center mt-2">
					<input type="text" name="num1" class="m-1 text-center form-control rounded" maxlength="1">
					<input type="text" name="num2" class="m-1 text-center form-control rounded" maxlength="1">
					<input type="text" name="num3" class="m-1 text-center form-control rounded" maxlength="1">
					<input type="text" name="num4" class="m-1 text-center form-control rounded" maxlength="1">
					<input type="text" name="num5" class="m-1 text-center form-control rounded" maxlength="1">
					<input type="text" name="num6" class="m-1 text-center form-control rounded" maxlength="1">

				</div>

				<div>
					<small>
						didn't get the otp ?
						<a href="resendOtp.php" class="text-decoration-none">Resend</a>
					</small>
				</div>

				<div class="mt-3 mb-5">
					<input type="submit" class="btn btn-success px-4 verify-btn" value="verify" name="submit">
				</div>
			</form>

		</div>

	</div>
</body>

</html>