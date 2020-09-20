<?php

include_once 'config.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
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
    <div class="row">
        <div class="col-8 main">

            <?php
            $sql = "SELECT * FROM `products` WHERE `name` LIKE '%$search%' OR  `name` LIKE '$search%' OR  `name` LIKE '%$search'  ";
            $queryRun = mysqli_query($con, $sql);
            if (mysqli_num_rows($queryRun) > 0) {
                while ($row = mysqli_fetch_array($queryRun)) {
                    $url = "";
                    $catid = $row[4];

                    $sql2 = "SELECT * FROM `category` WHERE `id` = '$catid' ";
                    $queryRun2 = mysqli_query($con, $sql2);
                    if (mysqli_num_rows($queryRun2) > 0) {
                        while ($row2 = mysqli_fetch_array($queryRun2)) {
                            $category = $row[1];
                        }
                    }

                    if ($row[7] != null) {
                        $images = explode(',', $row[7]);
                        $url = $images[0];
                    } else {
                        $url = "asset/image/product.jpg";
                    }

                    echo "
                    <div class='my-card-content mdc-card'>
                    <div class='row'>
                        <div class='col-3'>
                            <img src='$url' width='100%'>
                        </div>
                        <div class='col-9'>
                            <a href='product.php?id=$row[0]'><h2>$row[1]</h2> </a>
                            <samp>Category: $category</samp>
                            <h4>Cost: ₹ $row[6]</h4>
                           
                        </div>
                    </div>
                    </div>
                    ";
                }
            }

            ?>



        </div>
    </div>

</body>

</html>