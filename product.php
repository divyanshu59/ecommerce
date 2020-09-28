<?php

include_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $isLogin = false;
    if (isset($_COOKIE['userlogin'])) {
        $buyUrl = "buy.php?id=$id";
        $isLogin = true;

        $email = $_COOKIE['useremail'];

        $sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
        $queryRun = mysqli_query($con, $sql);
        if (mysqli_num_rows($queryRun) > 0) {
            while ($row = mysqli_fetch_array($queryRun)) {
                $userid = $row[0];
            }
        }
    } else {
        $buyUrl = "login.php";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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


        <?php
        $sql = "SELECT * FROM `products` WHERE `id` = $id ";
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
        ?>
                <div class='my-card-content mdc-card productcard'>
                    <div class='row'>
                        <div class='col-5'>
                            <img src='<?php echo $url ?>' width='100%'>
                        </div>
                        <div class='col-7'>

                            <h1><?php echo $row[1] ?></h1>

                            <samp>Category: <?php echo $category ?></samp>
                            <h4>Description:</h4>
                            <p><?php echo $row[2]; ?></p>
                            <h4>Features:</h4>
                            <ul>
                                <?php
                                $features = explode(',', $row[5]);
                                foreach ($features as $feature) {
                                    # code...
                                    echo " <li> $feature</li>";
                                }
                                ?>

                            </ul>
                            <?php if ($row[8] == 0) {
                                echo "<span style='color: red;'>Note: This Item is Out Of Stock</span>";
                            } ?>
                            <br>
                            <a href="<?php echo $buyUrl; ?>" style="color: white; text-decoration: none;" class="mdc-touch-target-wrapper">
                                <button class="mdc-button mdc-button--outlined mdc-button--raised">
                                    <div class="mdc-button__ripple"></div>
                                    <i class="material-icons mdc-button__icon" aria-hidden="true">local_mall</i>

                                    <span class="mdc-button__label">Buy Now For ₹ <?php echo $row[6] ?></span>
                                </button>
                            </a>


                            <a href="addtocart.php?id=<?php echo $id; ?>" class="mdc-button ">
                                <div class="mdc-button__ripple"></div>
                                <i class="material-icons mdc-button__icon" aria-hidden="true">shopping_cart</i>
                                <span class="mdc-button__label">Add To Cart</span>
                            </a>





                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="mdc-image-list my-image-list">
                                <?php
                                $images = explode(',', $row[7]);
                                for ($i = 0; $i < count($images) - 1; $i++) {
                                ?>
                                    <li class="mdc-image-list__item">
                                        <div class="mdc-image-list__image-aspect-container">
                                            <img class="mdc-image-list__image" src="<?php echo $images[$i]; ?>">
                                        </div>
                                        <div class="mdc-image-list__supporting">
                                            <span class="mdc-image-list__label">Product Image
                                                <?php echo $i + 1; ?></span>
                                        </div>
                                    </li>
                                <?php
                                }
                                ?>


                            </ul>
                        </div>
                        <div class="col-12">
                            <h4>Full Description:</h4>
                            <p><?php echo $row[3]; ?></p>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h1>Reviews</h1>
                            <?php
                            if ($isLogin) {
                            ?>
                                <form id="feedback" action="product.php?id=<?php echo $id; ?>" method="post">

                                    <div class="rating">
                                        <label>
                                            <input type="radio" name="stars" value="1" />
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="2" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="3" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="4" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="stars" value="5" />
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                            <span class="icon">★</span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="userid" value="<?php echo $userid ?>">
                                    <input type="hidden" name="productid" value="<?php echo $id ?>">
                                    <input type="text" name="feedback" placeholder="Feedback" id="" required>
                                    <input type="submit" name="submit" value="Give Feedback">
                                </form>
                                <?php
                            } else {
                                echo "<a href='login.php' style='color: red;'>Please Login To Write A Review..</a> <br> <br>";
                            }

                            $sql3 = "SELECT * FROM `feedback` WHERE `productid` = $id AND `status` = 1 ";
                            $queryRun3 = mysqli_query($con, $sql3);
                            if (mysqli_num_rows($queryRun3) > 0) {
                                while ($row3 = mysqli_fetch_array($queryRun3)) {
                                    $userid = $row3[1];
                                    $sql4 = "SELECT * FROM `users` WHERE `id` = $userid ";
                                    $queryRun4 = mysqli_query($con, $sql4);
                                    if (mysqli_num_rows($queryRun4) > 0) {
                                        while ($row4 = mysqli_fetch_array($queryRun4)) {
                                            $username = $row4[1];
                                        }
                                    }
                                ?>

                                    <div class='my-card-content mdc-card reviewCard'>
                                        <h3><?php echo $username ?></h3>

                                        <div class="stars">
                                            <?php
                                            for ($i = 0; $i < $row3[3]; $i++) {
                                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                            }
                                            ?>
                                        </div>

                                        <p><?php echo $row3[4] ?></p>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                        </div>

                    </div>

                </div>

        <?php
            }
        } ?>
    </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $productid = $_POST['productid'];
    $stars = $_POST['stars'];
    $userid = $_POST['userid'];
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO `feedback`(`userid`, `productid`, `star`, `text`, `status`) 
    VALUES ('$userid','$productid','$stars','$feedback','1')";
    $queryRun = mysqli_query($con, $sql);

    header("Location: product.php?id=$productid");
}

?>