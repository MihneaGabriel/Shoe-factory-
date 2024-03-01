<?php

//declare(stirct_types= 1);

function check_ponting_errors(){
    
    if(isset($_SESSION["errors_code"])){
        $errors = $_SESSION["errors_code"];
    
        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="input-description" style="text-align:center">' . $error . '</p>';
        }

        unset($_SESSION["errors_code"]);
    } 
}

