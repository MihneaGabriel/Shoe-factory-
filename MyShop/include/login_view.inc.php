<?php

//declare(stirct_types= 1);

function check_login_errors(){
    
    if(isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];
    
        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="input-description">' . $error . '</p>';
        }

        unset($_SESSION["errors_login"]);
    } else if(isset($_GET['login']) && $_GET['login'] === 
    "success") { // ADMIN
        echo "<br>";
        echo 'Login success!';
        header("Location: ../display.php");
    }else if(isset($_GET['login']) && $_GET['login'] === 
    "nonadmin"){ // USER
        echo "<br>";
        echo 'Login success!';
        header("Location: ../userdisplay.php");
    }

}

