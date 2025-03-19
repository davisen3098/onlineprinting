<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location:login.php');
}

$uid =  $_SESSION['uid'];
DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'final');

if (isset($_POST['pid'])) {
    $pid = trim($_POST['pid']);
}



if (isset($_POST['rating_data'])) {
    $user_rating = $_POST['rating_data'];
    //the connection string object
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());

    $check_query = "SELECT * from rating where cust_id = '" . $uid . "' and p_id = '" . $pid . "' ";
    $query_check_result = mysqli_query($conn, $check_query);
    $num = mysqli_num_rows($query_check_result);
    if ($num > 0) {
        while ($row = mysqli_fetch_array($query_check_result, MYSQLI_ASSOC)) {
            $db_rat_val = $row['rating_value'];
        }
        if ($db_rat_val == $user_rating) {
            echo "You have already gave this rating to this product";
        } elseif ($db_rat_val != $user_rating) {
            $update_query = "UPDATE rating set rating_value = '" . $user_rating . "' where cust_id = '" . $uid . "' and p_id = '" . $pid . "'";
            $update_query_result = mysqli_query($conn, $update_query);
            if ($update_query_result) {
                echo "The rating of this product was updated successfully";
            }
        }
    } elseif ($num == 0) {
        $query = "INSERT INTO rating (rating_value,cust_id,p_id) VALUES ('$user_rating','$uid','$pid')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "Your Review & Rating Successfully Submitted";
        } else {
            echo "something went wrong";
        }
    }
    $conn->close();
}


if (isset($_POST["action"]) && $_POST["pid"]) {
    $p_id = trim($_POST['pid']);
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());

    $query = "SELECT * FROM rating where p_id = '" . $p_id . "'  ORDER BY rating_id DESC ";

    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {
        $review_content[] = array(
            'rating'        =>    $row["rating_value"],
        );

        if ($row["rating_value"] == '5') {
            $five_star_review++;
        }

        if ($row["rating_value"] == '4') {
            $four_star_review++;
        }

        if ($row["rating_value"] == '3') {
            $three_star_review++;
        }

        if ($row["rating_value"] == '2') {
            $two_star_review++;
        }

        if ($row["rating_value"] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["rating_value"];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    =>    number_format($average_rating, 1),
        'total_review'        =>    $total_review,
        'five_star_review'    =>    $five_star_review,
        'four_star_review'    =>    $four_star_review,
        'three_star_review'    =>    $three_star_review,
        'two_star_review'    =>    $two_star_review,
        'one_star_review'    =>    $one_star_review,
        'review_data'        =>    $review_content
    );

    echo json_encode($output);
}
