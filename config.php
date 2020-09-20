<?php

ob_start();


// Config Site Basic Data 
$siteName = "E-Kommerce";
$tagLine1 = "E-Kommerce: Buy goods Online";
$adminMail = "bilwg.com@gmail.com";

// DATABASE Connection
$servername = "localhost";
$username = "addkon7l_card";
$password = "9]U#0&rVBFT";
$database = "ecomsite";


// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
//echo "Database Connected successfully";
