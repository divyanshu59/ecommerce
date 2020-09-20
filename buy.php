<?php

include_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!isset($_COOKIE['userlogin'])) {
        header('Location: login.php');
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
                        <div class='col-7 paymentForm --mdc-theme-primary'>
                            <center>

                                <h1><?php echo $row[1] ?></h1>
                                <h3>Amount To Pay: ₹ <?php echo $row[6] ?></h3>
                                <samp>Category: <?php echo $category ?></samp>
                                <br>
                                <br>
                                <?php if ($row[8] == 0) {
                                    echo "<span style='color: red;'>Note: This Item is Out Of Stock</span>";
                                } ?>
                                <br>
                                <h1>Buy Now</h1>
                                <form action="buy.php?id=<?php echo $id; ?>" method="POST">
                                    <input type="text" name="name" placeholder="Buyer Name" id="" required>
                                    <input type="email" name="email" placeholder="Buyer Email" id="" required>
                                    <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="phone" placeholder="Buyer Phone Number" id="" required>
                                    <br><label>Address Details</label>
                                    <br>
                                    <input type="text" name="addressLine1" placeholder="Buyer Address Line 1" id="" required>
                                    <input type="text" name="addressLine2" placeholder="Buyer Address Line 2" id="" required>
                                    <input type="text" name="city" placeholder="City" id="" required>
                                    <input type="text" name="state" placeholder="State" id="" required>
                                    <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="pincode" placeholder="Pincode" id="" required>
                                    <br>
                                    <input type="radio" id="male" name="paymode" value="cod" required>
                                    <label for="male">Cash on Delivery</label><br>
                                    <input type="radio" id="online" name="paymode" value="online" required>
                                    <label for="female">Online Payment</label><br>


                                    <input type="submit" name="submit" value="Buy Now">


                                    <input type="hidden" name="productid" value="<?php echo $id ?>">
                                    <input type="hidden" name="pasname" value="<?php echo $row[1] ?>">
                                    <input type="hidden" name="amount" value="<?php echo $row[6] ?>">

                                </form>
                            </center>

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
    $paymode = $_POST['paymode'];

    if ($paymode == "cod") {
        $url = "thank.php";
        $status = 1;
    } else {
        $url = "pay.php";
        $status = 0;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $productid = $_POST['productid'];
    $pasname = $_POST['pasname'];
    $cost = $_POST['amount'];


    $sql = "INSERT INTO `orders`(`productid`, `name`, `email`, `phone`, `address1`, `address2`, `city`, `state`, `pincode`, `status`, `paymode`) 
    VALUES ('$productid','$name','$email','$phone','$addressLine1','$addressLine2','$city','$state','$pincode',1, '$paymode')";
    $queryRun = mysqli_query($con, $sql);

    $_SESSION["userid"] = $userid;
    $_SESSION["pasid"] = $pasid;
    $_SESSION["pasname"] = $pasname;
    $_SESSION["name"] = $name;
    $_SESSION["phone"] = "$phone";
    $_SESSION["email"] = "$email";
    $_SESSION["amount"] = "$cost";


    $to = "$email"; // note the comma

    // Subject
    $subject = "New Order At $siteName";

    // Message
    $message = "
<html>
<head>
<title>Thankyou For your Order At AddKoncepts</title>
</head>
<body>
  <h2>Thankyou For Your order With Us!</h2>
    <br>
    <br>
  <h3>Your order Details are: </h3>
  <b>Buyer Name : </b> $name <br>
  <b>Buyer Phone : </b> $phone <br>
  <b>Product Name : </b> $pasname <br>
  <b>Product Cost : </b> $cost <br>
  <br>
    <h3>Address Details</h3>
    <p>$addressLine1</p>
    <p>$addressLine2</p>
    <p>$city, $state ($pincode)</p>


  <br>
  <h3>Contact Us</h3>
  <a href=''></a>
</body>
</html>
";

    require 'vendor/autoload.php';

    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("contact@addkoncepts.co.in", "addkoncepts");
    $email->setSubject("$subject");
    $email->addTo("$to", "$name");
    $email->addContent("text/html", "$message");
    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: ' . $e->getMessage() . "\n";
    }



    header("Location: $url");
}

?>