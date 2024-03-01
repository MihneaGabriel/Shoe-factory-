<?php

declare(strict_types= 1);

function is_input_empty(string $nume, string $cnp) { 
    if(empty($nume) || empty($cnp)) {
        return true;
    } else {
        return false;
    }
}

function is_username_taken(object $pdo, string $nume) {
    if(get_username( $pdo, $nume)) {
        return true;
    } else {
        return false;
    }
}

function is_lastname_taken(object $pdo, string $prenume) { 
    if(get_username( $pdo, $prenume)) {
        return true;
    } else {
        return false;
    }
}

function is_cnp_taken(object $pdo, string $cnp) {
    if(get_cnp( $pdo, $cnp)) {
        return true;
    } else {
        return false;
    }
}

function create_user(object $pdo, string $nume, string $prenume, string $cnp, string $oras, string $strada, string $nrtel, string $sex, string $data, string $salariu, string $linie ) {
   set_user($pdo, $nume, $prenume, $cnp, $oras, $strada, $nrtel, $sex, $data, $salariu, $linie );
}
