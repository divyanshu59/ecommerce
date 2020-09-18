<?php
include_once '../config.php';

if (!isset($_COOKIE['adminlogin'])) {
    header('Location: login.php');
    die("Please Wait You are Rediritig..");
} else {
    $name = $_COOKIE['adminname'];
    $email = $_COOKIE['adminemail'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = $_GET['to'];

    $sql = "UPDATE `products` SET `status`='$status' WHERE `id` = '$id'";
    $queryRun = mysqli_query($con, $sql);
}
header('Location: products.php');
