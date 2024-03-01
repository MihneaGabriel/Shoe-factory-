<?php

//declare(stirct_types= 1);

function is_input_empty(string $nume, string $cnp) { // string??
    if(empty($nume) || empty($cnp)) {
        return true;
    } else {
        return false;
    }
}

function is_username_wrong(bool|array $result){
    if(!$result) {
        return true;
    } else {
        return false;
    }
}

function is_cnp_wrong(string $cnp, string $nonhashedCNP) {

    if(!($cnp == $nonhashedCNP) ){
        return true;
    } else {
        return false;
    }
}

function is_admin(string $nume, string $cnp){
    if($nume == 'Admin' && $cnp == '1234' )
        return true;
    else
        return false;
}

