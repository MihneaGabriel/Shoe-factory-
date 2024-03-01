<?php

declare(strict_types= 1);

function signup_input(){
  
    if(isset($_SESSION["signup_data"]["Nume"]) && !isset($_SESSION
    ["errors_signup"]["username_taken"])) {
        echo '<input type="text" name="Nume" 
        placeholder="Nume" value="' . $_SESSION["signup_data"]
        ["Nume"] . '">';
    } else {
        echo '<input type="text" name="Nume" 
        placeholder="Nume">';
    }

    if(isset($_SESSION["signup_data"]["Prenume"]) && !isset($_SESSION
    ["errors_signup"]["lastname_taken"])) {
        echo '<input type="text" name="Prenume" 
        placeholder="Prenume" value="' . $_SESSION["signup_data"]
        ["Prenume"] . '">';
    } else {
        echo '<input type="text" name="Prenume" 
        placeholder="Prenume">';
    }

    echo '<input type="password" name="CNP" placeholder="CNP">';

}

function check_signup_errors(){
    if(isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"]; //array
        
        echo "<br><br><br>";

        foreach($errors as $errors){
            echo '<p class="input-description">' . $errors . '</p>';
        }

        unset($_SESSION["errors_signup"]);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === 
        "success") {
        echo "<br>";
        echo "Signup success!";
        sleep(2);
        header("Location: ../login.php");
        
    }
}