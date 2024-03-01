<?php
require_once '../include/db.inc.php';
if (isset($_GET['addid'])) {
    $numeid = $_GET['addid'];

    $sql = "SELECT * FROM angajati WHERE Nume='$numeid'";
    $result = $pdo->query($sql);

    // #ERROR HANDLER De adaugat cand vine ideea
    // $stmt = "";
    // $querry = "SELECT $stmt='AngajatID' FROM intretinuti WHERE Nume='$numeid'";
    // if ($stmt) {
    //     // header("Location: ../display.php");
    //     echo "Linie de productie INEXISTENTA!";
    //     die();
    // }

    if ($result) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["AngajatiD"];
            $nume = $row["Nume"];
            $prenume = $row["Prenume"];
            $sex = $row["Sex"];
            $data = $row["DataNasterii"];


            $query = "INSERT INTO intretinuti(Nume, Prenume,Sex, DataNasterii, AngajatID) VALUES
               (:Nume, :Prenume, :Sex, :DataNasterii, :AngajatID )";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":Nume", $nume);
            $stmt->bindParam(":Prenume", $prenume);
            $stmt->bindParam(":Sex", $sex);
            $stmt->bindParam(":DataNasterii", $data);
            $stmt->bindParam(":AngajatID", $id);


            $stmt->execute();

            if( $nume == "Admin")
                header('Location: ../display.php');
            else
                header('Location: ../userdisplay.php');

        }
    } else {
        die();
    }
}

?>