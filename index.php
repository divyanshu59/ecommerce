<?php

include_once 'config.php';



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
    <br><br><br><br><br>

    <?php
    $sql = "SELECT * FROM `category` WHERE `status` = 1";
    $queryRun = mysqli_query($con, $sql);

    if (mysqli_num_rows($queryRun) > 0) {
        while ($row = mysqli_fetch_array($queryRun)) {
            $catid = $row[0];
    ?>
            <div class='my-card-content mdc-card mainPageCart'>
                <h3><?php echo $row[1]; ?></h3>
                <div class="row">


                    <?php

                    $sql2 = "SELECT * FROM `products` where `catid` = '$catid'";
                    $queryRun2 = mysqli_query($con, $sql2);

                    if (mysqli_num_rows($queryRun2) > 0) {
                        while ($row2 = mysqli_fetch_array($queryRun2)) {

                            if ($row2[7] != null) {
                                $images = explode(',', $row2[7]);
                                $url = $images[0];
                            } else {
                                $url = "asset/image/product.jpg";
                            }


                    ?>

                            <div class="col-2">

                                <img class="" width="150" src="<?php echo $url; ?>">
                                <br>
                                <span class="mdc-image-list__label"><?php echo $row2[1]; ?></span>

                            </div>

                    <?php
                        }
                    } else {
                        echo '
                        <div class="col-12">
                        <center style="color: red;">No Product Found in this Category</center>
                        <br>
                        </div>
                        ';
                    }
                    ?>
                </div>
            </div>
    <?php
        }
    }
    ?>


</body>

</html>