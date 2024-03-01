<?php
require_once 'include/config_session.inc.php';
require_once 'include/signup_view.inc.php';
require_once 'include/login_view.inc.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="
    default-src 'self';
    script-src 'self' 'unsafe-eval' https://trusted-cdn.com;
    ">
    <title>MyShop</title>
    <link rel="stylesheet" href="style/indexstyle.css">

</head>

<body>
    <form action="include/login.inc.php" method="post">
        <h3>Login</h3>

        <input type="text" name="Nume" placeholder="Nume">
        <input type="password" name="CNP" placeholder="Cod numeric personal">
        <button>Login</button>

        <p class="signup-prompt">Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </form>


    <?php
    check_login_errors();
    ?>

</body>

</html>