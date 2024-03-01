<?php

declare(strict_types= 1);

function get_username(object $pdo, string $nume) {
    $query = "SELECT Nume FROM angajati WHERE Nume = :Nume;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":Nume", $nume);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // grabbing first result
    return $result;
}

function get_cnp(object $pdo, string $cnp) {
    $query = "SELECT CNP FROM angajati WHERE CNP = :CNP;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":CNP", $cnp);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC); // grabbing first result
    return $result;
}

function set_user(object $pdo, string $nume, string $prenume, string $cnp, string $oras, string $strada, string $nrtel, string $sex, string $data, string $salariu, string $linie ) {
    $query = "INSERT INTO angajati(Nume, Prenume, CNP, Oras, Strada, NrTel, Sex, DataNasterii, Salariu, LinieProductieID) VALUES
               (:Nume, :Prenume, :CNP, :Oras, :Strada, :NrTel, :Sex, :DataNasterii, :Salariu, :LinieProductieID );";
    $stmt = $pdo->prepare($query);

    $nonhashedCNP = $cnp;
    
    $stmt->bindParam(":Nume", $nume);
    $stmt->bindParam(":Prenume", $prenume);
    $stmt->bindParam(":CNP", $cnp);
    $stmt->bindParam(":Oras", $oras);
    $stmt->bindParam(":Strada", $strada);
    $stmt->bindParam(":NrTel", $nrtel);
    $stmt->bindParam(":Sex", $sex);
    $stmt->bindParam(":DataNasterii", $data);
    $stmt->bindParam(":Salariu", $salariu);
    $stmt->bindParam(":LinieProductieID", $linie);
    $stmt->execute();

}
