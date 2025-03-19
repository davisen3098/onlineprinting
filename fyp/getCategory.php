<?php
//include "connection.php";

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'final');

if (isset($_POST['depart'])) {
    $pt_id = $_POST['depart']; // department id
}

//https://www.000webhost.com/members/website/list

//the connection string object
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());
$users_arr = array();

if ($pt_id > 0) {
    //define insert query
    $query = "select cat_id,cat_name from category where pt_id = '$pt_id'";
    //execute query on connection object (conn) and echo result
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $cat_id = $row['cat_id'];
        $cat_name = $row['cat_name'];

        $users_arr[] = array("cat_id" => $cat_id, "cat_name" => $cat_name);
    }
}

$conn->close();

//encoding array to json format
echo json_encode($users_arr);


