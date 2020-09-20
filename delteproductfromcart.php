<?php
include_once 'config.php';

if (!isset($_COOKIE['userlogin'])) {
    header('Location: login.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `cart` WHERE `id` = '$id'";
    $queryRun = mysqli_query($con, $sql);
}
header('Location: cart.php');
