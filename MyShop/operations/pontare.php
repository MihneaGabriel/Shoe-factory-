<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $articol = $_POST["Articol"];
    $codarticol = $_POST["CodArticol"];
    $pret = $_POST["Pret"];
    $nrbucati = $_POST["Bucati"];
    $termen = $_POST["TermenLimita"];
    $brand = $_POST["SelectedBrand"]; //LinieProdID
    $ore = $_POST["Ore"];

    try {
        require_once "../include/db.inc.php";
        require_once "pontare_model.php";
        require_once "pontare_contr.php";

        // ERROR HANDLER
        $errors = [];

        if (is_codart_empty($codarticol)) {
            $errors["empty_code"] = "Nu ati introdus un cod de articol!";
        }

        if (is_codart_the_same($pdo, $codarticol)) {
            $errors["same_code"] = "Articolul exista deja!";
        }

        require_once '../include/config_session.inc.php';

        if ($errors) { // Daca nu exista deja , il creeaza

            $sql = "UPDATE articoleexport A 
                    INNER JOIN articolevestimentare B ON A.ArticolID = B.ArticolID
                    SET A.NrBucati = (A.NrBucati + $nrbucati  )
                    WHERE B.NumeModel = '$articol' AND B.Pret = $pret AND B.LinieProductieID = $brand;";

            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute();
            if($result)
            {
                $rowCount = $stmt->rowCount();
                if( $rowCount > 0 )
                    $errors["update_code"] = "S-au adaugat nr de bucati!";
            }
       
            $_SESSION["errors_code"] = $errors;
            header("Location: ../usertodo.php");

            $pdo = null;
            $stmt = null;
            die();
        }


        create_ponting($pdo, $articol, $codarticol, $pret, $termen, $brand, $id, $ore, $nrbucati);
        header("Location: ../usertodo.php?usertodo=success");

        $pdo = null;
        $stmt = null;

        die();


    } catch (PDOException $e) {
        die("Querry failed: " . $e->getMessage());
    }

} else {
    echo "nu e bine";
    die();
}

