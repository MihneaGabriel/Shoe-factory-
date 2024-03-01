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
        <input type="date" name="DataNasterii" placeholder="DataNasterii">
        <input type="number" value="0" name="Salariu" placeholder="Salariu">
        <select name="Linie">
            <option value="1">Zara</option>
            <option value="2">Bershka</option>
            <option value="3">Pull&Bear</option>
            <option value="4">H&M</option>
            <option value="5">Reserved</option>
        </select>

        <button>Signup</button>

    </form>

    <?php
    check_signup_errors();
    ?>

</body>

</html>