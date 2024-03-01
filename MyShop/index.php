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
    </form>

    <?php
        check_login_errors();
    ?>

    <form action="include/signup.inc.php" method="post">
        <h3>Signup</h3>
        <?php
            signup_input();
        ?>

        <input type="text" name="Oras" placeholder="Oras">
        <input type="text" name="Strada" placeholder="Strada">
        <input type="text" name="NrTel" placeholder="NrTel">
        <select name="Sex">
            <option value="M">Masculin</option>
            <option value="F">Feminin</option>
        </select>
        <input type="date" value="2017-06-01" name="DataNasterii" placeholder="DataNasterii">
        <input type="number" value="0" name="Salariu" placeholder="Salariu">

        <button>Signup</button>
        
    </form>

    <?php
    check_signup_errors();
    ?>
    
</body>
</html>