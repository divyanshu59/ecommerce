<?php
include_once '../config.php';
$id = $_GET['id'];


$sql = "DELETE FROM `faq` WHERE `id` = $id ";
$queryRun = mysqli_query($con, $sql);

header('Location: faq.php');
