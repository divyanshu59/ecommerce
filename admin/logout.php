<?php

setcookie("customerlogin", "", time() + (-86400 * 5), "/");
setcookie("customerusername", "", time() + (-86400 * 5), "/");
setcookie("customerpassword", "", time() + (-86400 * 5), "/");
setcookie("customername", "", time() + (-86400 * 5), "/");
header('Location: index.php');
