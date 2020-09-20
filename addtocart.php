<?php
include_once 'config.php';

if (!isset($_COOKIE['userlogin'])) {
    header('Location: login.php');
}

$email = $_COOKIE['useremail'];

$sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
$queryRun = mysqli_query($con, $sql);
if (mysqli_num_rows($queryRun) > 0) {
    while ($row = mysqli_fetch_array($queryRun)) {
        $userid = $row[0];
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "INSERT INTO `cart`(`productid`, `userid`) VALUES ('$id','$userid')";
    $queryRun = mysqli_query($con, $sql);
}
header('Location: cart.php');
