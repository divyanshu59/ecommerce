<?php

include_once 'config.php';

if (isset($_COOKIE['userlogin'])) {
    header('Location: index.php');
    die("Please Wait You are Rediritig..");
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
    <title><?php echo $siteName; ?> - Admin</title>
    <link href="admin/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="signup.php">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Name</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="name" type="text" placeholder="Enter name" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="email" type="email" placeholder="Enter email address" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <input class="form-control py-4" id="inputPassword" name="pass" type="password" placeholder="Enter password" required>
                                        </div>
                                        <?php
                                        if (isset($_GET['error'])) {
                                            echo '
                                                <center>
                                                    <span style="color: red;">Invalid Datas</span>
                                                </center>
                                            ';
                                        }
                                        ?>

                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <input class="btn btn-primary" name="submit" type="submit" value="Signup">
                                            <a class="btn" style="color: #007bff;" href="login.php">Login Now</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; <?php echo $siteName; ?> 2020</div>

                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];

    if ($email != "" && $pass != "") {
        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `status`) 
        VALUES ('$name','$email','$pass','1')";
        $queryRun = mysqli_query($con, $sql);
        if ($queryRun) {
            setcookie("userlogin", "1", time() + (86400 * 5), "/");
            setcookie("useremail", $email, time() + (86400 * 5), "/");
            setcookie("userpassword", $pass, time() + (86400 * 5), "/");
            setcookie("username", $name, time() + (86400 * 5), "/");
            header('Location: index.php');
        } else {
            header('Location: signup.php?error=true');
        }
    }
}

?>