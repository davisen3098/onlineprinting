<?php
include_once('connection.php');
$db = new DB_con();
if (isset($_POST['submit'])) {
    $db->resetPass($_POST['cid'], $_POST['pass']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>

</head>

<body>
    <form action="" method="post">
        <input type="text" name="pass">
        <input type="hidden" value="3" name="cid">
        <input type="submit" name="submit" value="submit">
    </form>
</body>

</html>