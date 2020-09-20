<?php

setcookie("userlogin", "", time() + (-86400 * 5), "/");
setcookie("useremail", "", time() + (-86400 * 5), "/");
setcookie("userpassword", "", time() + (-86400 * 5), "/");
setcookie("username", "", time() + (-86400 * 5), "/");
header('Location: index.php');
