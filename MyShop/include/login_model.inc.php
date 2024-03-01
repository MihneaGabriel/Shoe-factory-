<?php

//declare(stirct_types= 1);

function get_user( object $pdo, string $nume){
    $query = "SELECT * FROM angajati WHERE Nume = :Nume;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Nume", $nume);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // grabbing first result
    return $result;
}

