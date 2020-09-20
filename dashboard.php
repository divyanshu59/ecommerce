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



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $siteName; ?></title>

    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="asset/css/index.css">
</head>

<body>
    <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
            <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                <span class="mdc-top-app-bar__title"> <?php echo $siteName; ?></span>


            </section>
            <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                <form id="searchBar" action="search.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit" class="material-icons">search</button>
                </form>
                <a class="material-icons mdc-top-app-bar__action-item mdc-icon-button" href="cart.php" aria-label="Search">shopping_cart</a>
                <?php
                if (isset($_COOKIE['userlogin'])) {
                    echo '<a class="material-icons mdc-top-app-bar__action-item mdc-icon-button" href="dashboard.php" aria-label="Options">dashboard</a>';
                } else {
                    echo '<a class="material-icons mdc-top-app-bar__action-item mdc-icon-button" href="login.php" aria-label="Options">login</a>';
                }
                ?>

            </section>
        </div>
    </header>
    <br><br>
    <br><br>
    <br>
    <div class="productmain">
        <a href="logout.php" class="logoutBtn">Logout?</a>
        <h2>Orders</h2>
        <br>
        <?php
        $sql = "SELECT * FROM `orders` WHERE `userid` = $userid ORDER BY `date` DESC";
        $queryRun = mysqli_query($con, $sql);
        if (mysqli_num_rows($queryRun) > 0) {
            while ($row = mysqli_fetch_array($queryRun)) {

                if ($row[11] == 1) {
                    $color = "#FFFFBF";
                    $status = "Pending";
                } else if ($row[11] == 0) {
                    $color = "#ffcccb";
                    $status = "Canceled";
                } else if ($row[11] == 2) {
                    $color = "#00FA9A";
                    $status = "Completed";
                }


                $productid = $row[1];

                $sql2 = "SELECT * FROM `products` WHERE `id` = $productid ";
                $queryRun2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($queryRun2) > 0) {
                    while ($row2 = mysqli_fetch_array($queryRun2)) {

                        if ($row2[7] != null) {
                            $images = explode(',', $row2[7]);

                            $imageUrl = $images[0];
                        } else {
                            $imageUrl = "asset/image/product.jpg";
                        }
        ?>
                        <div style="background-color: <?php echo $color; ?>; margin-bottom: 10px;" class='my-card-content mdc-card productcard'>
                            <div class="row">
                                <div class="col-4">
                                    <img src="<?php echo $imageUrl; ?>" width="100%">
                                </div>
                                <div class="col-4">
                                    <h3>Product Details</h3>
                                    <h2><?php echo $row2[1] ?></h2>
                                    <p>Cost: ₹<?php echo $row2[6] ?></p>
                                    <p>Payment Method: <?php echo $row[12] ?></p>
                                    <p>Status: <?php echo $status; ?></p>


                                </div>
                                <div class="col-4">

                                    <h3>User Details</h3>

                                    <p><?php echo $row[2] ?></p>
                                    <p><?php echo $row[3] ?></p>
                                    <p><?php echo $row[4] ?></p>
                                    <p>Address:</p>
                                    <p><?php echo $row[5] ?></p>
                                    <p><?php echo $row[6] ?></p>
                                    <p><?php echo $row[7] ?><?php echo $row[8] ?><?php echo $row[9] ?></p>
                                    <p>Date: <?php echo $row[10] ?></p>




                                </div>
                            </div>
                        </div>

        <?php
                    }
                }
            }
        } ?>
    </div>

</body>

</html>