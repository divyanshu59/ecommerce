<?php

include_once '../config.php';

if (!isset($_COOKIE['adminlogin'])) {
    header('Location: login.php');
    die("Please Wait You are Rediritig..");
} else {
    $name = $_COOKIE['adminname'];
    $email = $_COOKIE['adminemail'];
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - <?php echo $siteName; ?></title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><?php echo $siteName; ?></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                    <a class="dropdown-item"><?php echo $name; ?></a>
                    <a class="dropdown-item"><?php echo $email; ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="users.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="category.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Category
                        </a>
                        <a class="nav-link" href="products.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Products
                        </a>
                        <a class="nav-link" href="orders.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Orders
                        </a>

                        <a class="nav-link" href="changepassword.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Change Password
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $name ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Products</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">New Product</li>
                    </ol>
                    <form action="addproduct.php" method="post" enctype="multipart/form-data">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                        <br>
                        <label>Short Description</label>
                        <textarea name="sdesc" class="form-control" rows="5"></textarea>
                        <br>
                        <label>Long Description</label>
                        <textarea name="ldesc" class="form-control" rows="10"></textarea>
                        <br>
                        <label>Features Coma Seperated (,)</label>
                        <textarea name="features" class="form-control" rows="2"></textarea>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Product Cost (₹)</label>
                                <input type="number" name="cost" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <center><label>In Stock</label></center>
                                <input type="checkbox" checked name="instock" value="1" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <center><label>Is Active</label></center>
                                <input type="checkbox" checked name="isactive" value="1" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <center><label>Select Category</label></center>
                                <select name="category" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM `category`";
                                    $queryRun = mysqli_query($con, $sql);

                                    if (mysqli_num_rows($queryRun) > 0) {
                                        while ($row = mysqli_fetch_array($queryRun)) {
                                            echo "<option value='$row[0]'>$row[1]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <label>Product Images</label>
                        <input type="file" name="name" class="form-control" required multiple accept="image/*" onchange="PreviewImage();">
                        <br>
                        <input type="submit" value="Add Category" name="submit" class="btn btn-primary " required>
                    </form>



                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Copyright <?php echo $siteName ?> 2020</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>



</body>

</html>



<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $sdesc = $_POST['sdesc'];
    $ldesc = $_POST['ldesc'];
    $cost = $_POST['cost'];
    $features = $_POST['features'];
    $instock = $_POST['instock'];
    $isactive = $_POST['isactive'];
    $category = $_POST['category'];


    $sql = "INSERT INTO `products`(`name`, `sdesc`, `ldesc`, `catid`, `features`, `cost`, `photos`, `isStock`, `status`) 
    VALUES ('$name','$sdesc','$ldesc','','$features','$cost','$category','$instock','$isactive')";
    $queryRun = mysqli_query($con, $sql);

    header('Location: products.php');
}
?>